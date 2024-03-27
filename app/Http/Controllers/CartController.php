<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    private $product, $cartProducts;

    public function index(Request $request, $id)
    {
        $this->product = Product::find($id);
        Cart::add([
            'id'        => $id,
            'name'      => $this->product->name,
            'qty'       => $request->qty,
            'price'     => $this->product->selling_price,
            'options'   => [
                'image'  => $this->product->image,
                'brand' => $this->product->brand->name,
                'category' => $this->product->category->name,
            ]
        ]);
        return redirect('/show-cart-product');
    }
    public function show()
    {
        $this->cartProducts = Cart::content();
//        return $this->cartProducts;
        return view('front.cart.show', ['products' => $this->cartProducts]);
    }

    public function update(Request $request,$rowId)
    {
        Cart::update($rowId, ['qty' => $request->qty]);
        return redirect('/show-cart-product')->with('message', 'Cart product info updated successfully');

    }

    public function delete($rowId)
    {
        Cart::remove($rowId);
        return redirect('/show-cart-product')->with('message', 'Cart product info deleted successfully');
    }
}
