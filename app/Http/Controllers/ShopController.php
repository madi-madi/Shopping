<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Product;

class ShopController extends Controller
{
    //

    public function index($id)
    {
    	$invoice = Invoice::find($id);
    	//dd($invoice->product);
    	$product = Product::all();
    	return view('shop', compact('invoice'));
    }
}
