<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderCancel;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use PDF;

class AdminOrderController extends Controller
{
    private $orders, $order, $orderDetails, $product, $orderCancel, $productString;
    public function index()
    {
        $this->orders = Order::latest('id')->get();
        return view('admin.order.manage', ['orders' => $this->orders]);
    }

    public function detail($id)
    {
        $this->order = Order::find($id);
        return view('admin.order.detail', ['order' => $this->order]);
    }
    public function invoice($id)
    {
        $this->order = Order::find($id);
        return view('admin.order.invoice',['order' => Order::find($id)]);
    }
    public function downloadInvoice($id)
    {
        $this->order = Order::find($id);
        $pdf = PDF::loadView('admin.order.download-invoice', ['order' => $this->order]);
        return $pdf->stream('invoice-'.$id.'.pdf');

    }

    public function edit($id)
    {
        $this->order = Order::find($id);
        return view('admin.order.edit', ['order' => $this->order]);
    }
    public function update(Request $request, $id)
    {
       $this->order = Order::find($id);
        $this->order->Order_status = $request->order_status;
        $this->order->payment_status = $request->payment_status;
        $this->order->delivery_address = $request->deliver_address;
        $this->order->save();
       if ($request->order_status == 'Complete')
       {
           $this->order->payment_amount = $request->payment_amount;
           $this->order->payment_date = date('Y-m-d');
           $this->order->payment_timestamp = strtotime(date('Y-m-d H:i:s'));
           $this->order->delivery_date = date('Y-m-d');
           $this->order->delivery_timestamp = strtotime(date('Y-m-d'));
           $this->order->save();

           $this->orderDetails = OrderDetail::where('order_id', $id)->get();
           foreach ($this->orderDetails as $orderDetail)
           {
                $this->product = Product::find($orderDetail->product_id);
                $this->product->stock_amount = $this->product->stock_amount - $orderDetail->product_quantity;
                $this->product->save();
           }
       }
       return redirect('/admin-order-manage')->with('message', 'Order info update successfully.');
    }
    public function delete($id)
    {
        $this->order = Order::find($id);
        $this->orderDetails = OrderDetail::where('order_id', $id)->get();
            foreach ($this->orderDetails as $orderDetail)
            {
                $this->productString .= '{'. $orderDetail->product_id.','.$orderDetail->product_name.','.$orderDetail->product_price.'.'.$orderDetail->product_quantity.'}';
            }

        $this->orderCancel = new OrderCancel();
        $this->orderCancel->order_id    = $this->order->id;
        $this->orderCancel->customer_id = $this->order->customer_id;
        $this->orderCancel->order_total =  $this->order->order_total;
        $this->orderCancel->tax_amount =  $this->order->tax_amount;
        $this->orderCancel->shipping_cost =  $this->order->shipping_cost;
        $this->orderCancel->Order_date = $this->order->Order_date;
        $this->orderCancel->cancel_date = date('Y-m-d');
        $this->orderCancel->payment_type = $this->order->payment_type;
        $this->orderCancel->product_info =     $this->productString;
        $this->orderCancel->save();

        $this->order->delete();
        foreach ($this->orderDetails as $orderDetail)
        {
            $orderDetail->delete();
        }
        return redirect('/admin-order-manage')->with('message', 'Order info delete successfully.');
    }
}
