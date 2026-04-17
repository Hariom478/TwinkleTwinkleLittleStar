<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductType;

class ProductController extends Controller
{
     public function index()
    {
        $types = ProductType::all();
        return view('product.product_type', compact('types'));
    }

    public function store(Request $request)
    {
        ProductType::create($request->all());
        return back();
    }

    public function update(Request $request, $id)
    {
        $type = ProductType::find($id);
        $type->update($request->all());

        return back();
    }
}
