<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{

    public function manage(Request $request)
    {
        if($request->ajax()){
            $categories = Category::latest()->select('*');
            return DataTables::of($categories)
            ->addColumn('sl', function ($row) {
                static $sl = 0;
                $sl++;
                return $sl;
            })

                ->addColumn('action', function ($row) {
                    $btn = "";
                    $btn .= '&nbsp;';
                    $btn .= ' <a href="#" data-id="' . $row->id . '" class="btn btn-primary btn-sm action-button update_category_form"><i class="fa fa-edit"></i></a>';
                    $btn .= '&nbsp;';
                    $btn .= ' <a href="#" class="btn btn-danger btn-sm delete_category action-button" data-id="' . $row->id . '"><i class="fa fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['sl', 'action'])
                ->make(true);
    }

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

    public function editCategory($id){
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    public function updateCategory(Request $request, $id)
    {

        $request->validate([

            'id' => ['required'],
            'name' => ['required', 'min: 3', 'max:80'],
            'description' => ['nullable'],
            'image' => ['nullable'],
        ]);

        $category =Category::findOrFail($id);

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

