<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        $products =  Product::paginate(6);
        return view('index', compact('products'));
    }

}
