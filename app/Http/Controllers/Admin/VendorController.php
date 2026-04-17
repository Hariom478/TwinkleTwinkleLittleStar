<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class VendorController extends Controller
{
    public function vendor()
    {
        return view('vendor.vendor');
    }

    public function product_details($id)
    {
    	$id = decrypt($id);
    	$product=Products::Where('id',$id)->with('images','type')->first();

    	return view('user.product-details',compact('product'));
    }
}
