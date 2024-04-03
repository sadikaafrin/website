<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{

    public function manage(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0);" class="edit btn btn-success btn-sm">Edit</a>
                     <a href="javascript:void(0);" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('description', function ($row) {

                    return $row->description;
                })
                ->addColumn('image', function ($row) {
                    if($row->image != null){
                        $img = asset('uploads/categories/'.$row->image);
                    }
                    else{
                        $img = asset('uploads/categories/'.$row->image);
                    }
                    $html = '<div class="text-center" uk-lightbox><a href="'.$img.'">
                        <img style="width: 70px; border: 1px solid #ddd; border-radius: 4px; padding: 1px;" src="'. $img .'" alt="">
                    </a></div>';
                    return $html;
                })
                ->rawColumns(['action', 'name', 'description', 'image'])
                ->make(true);
        }

        // $categories = Category::all();
        // return view('admin.category.manage', compact('categories'));
        return view('admin.category.manage');

    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],
        [
            'name.required' => 'Name is Required',
            'name.unique' => 'Category Already Exists',
            'description.required' => 'Description is Required',
            'image.required' => 'Image is Required',
            'image.image' => 'The file must be an image.',

        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/categories'), $imageName);
            $category->image = $imageName;
        }



        $category->save();

        return response()->json([
           'status' => 'success',
        ]);
    }

    public function updateCategory(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:categories,name,'.$request->id,
            'description' => 'required',
            // 'image' => 'nullable|image',
        ]);

        $category =Category::find($request->id);

        $category->name = $request->name;
        $category->description = $request->description;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = Category::where('id',$request->id)->first();
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('uploads/categories/'), $imageName);
            $category->image = $imageName;
        }

        $category->save();

        return response()->json([
           'status' => 'success',
        ]);
    }


    public function deleteCategory(Request $request)
    {
        Category::find($request->category_id)->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }

}

