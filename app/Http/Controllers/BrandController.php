<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()){
            $brands = Brand::latest()->select('*');
            // $brands = Brand::order('id', 'DESC');
            return DataTables::of($brands)
            ->addColumn('Sl', function ($row) {
                static $sl = 0;
                $sl++;
                return $sl;
            })
            ->addColumn('action', function ($row){
                $btn = "";
                $btn .= '&nbsp;';
                $btn .= ' <a href="#" data-id="' . $row->id . '" class="btn btn-primary btn-sm action-button update_brand_form"><i class="fa fa-edit"></i></a>';
                $btn .= '&nbsp;';
                $btn .= ' <a href="#" class="btn btn-danger btn-sm delete_brand action-button" data-id="' . $row->id . '"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['Sl', 'action'])
            ->make(true);
        }
        return view('admin.brand.add');
    }

    public function create(Request $request)
    {
       $request->validate([
        'name' => 'required|unique:brands',
        'description'=> 'required',
        'image' => 'required|image|mimes:png,jpg, jpeg|max:2048',
       ],
       [
        'name.required' => 'Name is Required',
        'name.unique' => 'Name is Already Exists',
        'description.required' => 'Description is Required',
        'image.required' => 'Image is Required',
        'image.image' => 'The file must be an image',
       ]);

       $brand = new Brand();
       $brand->name = $request->name;
       $brand->description = $request->description;

       if($request->hasFile('image')){
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('uploads/brands'), $imageName);
        $brand->image = $imageName;
       }

       $brand->save();
       return response()->json([
        'status' =>'success',
       ]);
    }
 public function edit($id)
 {
    $brand = Brand::findOrFail($id);
    return response()->json($brand);
 }

 public function update(Request $request, $id)
 {
    $request->validate([
        'name' => ['required', 'min:5', 'max:40'],
        'description'=> ['nullable'],
        'image' => ['nullable'],
    ]);
    $brand = Brand::findOrFail($id);
    $brand->name = $request->name;
    $brand->description = $request->description;

    if($request->hasFile('image') && $request->file('image')->isValid()){
        $image = Brand::where('id',$request->id)->first();
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalName();
        $image->move(public_path('uploads/brands'), $imageName);
        $brand->image = $imageName;
    }

    $brand->save();
    return response()->json([
        'status' => 'success',
    ]);
 }

 public function delete(Request $request)
 {
    Brand::find($request->brand_id)->delete();
    return response()->json([
       'status' =>'success',
    ]);
 }

}
