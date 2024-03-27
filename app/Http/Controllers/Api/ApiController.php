<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    private $category, $categories, $products, $product, $subCategories, $result;
    public function getAllCategory()
    {
        $this->categories = Category::all();
        foreach ($this->categories as $key => $category)
        {
            $this->subCategories = SubCategory::where('category_id', $category->id)->get();
            $this->result[$key]['category'] = $category;
            $this->result[$key]['sub_category'] = $this->subCategories;
        }
        return response()->json($this->result);
    }

    public function getLatestProduct()
    {
        $this->products = Product::orderBy('id', 'desc')->take(4)->get(['id', 'name', 'selling_price', 'image']);
        foreach ($this->products as $product)
        {
            $product->image = asset($product->image);
        }
        return response()->json($this->products);
    }

    public function getProductByCategory($id)
    {
        $this->products = Product::where('category_id', $id)->orderBy('id', 'desc')->take(4)->get(['id', 'name', 'selling_price', 'image']);
        foreach ($this->products as $product)
        {
            $product->image = asset($product->image);
        }
        return response()->json($this->products);
    }

    public function getProductById($id)
    {
        $this->product = Product::find($id);
        $this->product->image = asset($this->product->image);
        $this->product->category = Category::find($this->product->category_id)->name;
        $this->product->brand = Brand::find($this->product->brand_id)->name;
        return response()->json($this->product);
    }


}
