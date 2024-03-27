<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function manage()
    {
        $categories = Category::all();
        return view('admin.category.manage', compact('categories'));
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
            'name' => 'required|unique:categories, name, '.$request->id,
            'description' => 'required',
            'image' => 'nullable',
        ],
         [

            'name.required' => 'Name is Required',
            'name.unique' => 'Category Already Exists',
            'description.required' => 'Description is Required',
            'image.required' => 'Image is Required',
            'image.image' => 'The file must be an image.',
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

