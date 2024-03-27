<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    private $categories, $products,$product;
    public function index()
    {

        return view('front.home.home');
    }

}
