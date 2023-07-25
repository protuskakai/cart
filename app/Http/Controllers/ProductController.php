<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use \Illuminate\Support\Str;

class ProductController extends Controller
{
    public function productList(Request $request)
    {
		
		
	 if(is_null( $request->cat))
	 {
		 // echo $cat;
		  $cat = "all";
	 }else
	 {
		 $cat = $request->cat;
		//  
	 }
	 $all="all";
	// echo strcmp(trim($cat),trim($all));
	// $cnt = (strcmp($cat, trim(strval("all"))
//	echo "cat ".$cat."   alls  ".$all;
	 if($cat == $all)
	//(	Str::equals($cat, $all))
		 
	 {	 
   //     echo $request->cat;
       $products = Product::all();
	 }else
	 {
		// echo $request->cat;
		// $products = Product::find($cat);
		
		//$products = Product::where('cat',$cat);
		//$products = Product::table('products')->where('cat', $cat);
		$products = Product::where('category',$cat)->get(); 
	 }	 
	/*
	 foreach($products as $product)
	 {
		 echo $product->name;
	 }
    */ 
	   $cnt= $products->count();
	  
      return view('products', compact('products','cat','cnt'));
    }
	
	public function productSearch(Request $request)
	{
		$cat = $request->ff;
		//echo $cat;
		$products = Product::where('name','LIKE','%'.$cat.'%')->get(); 
		
		$cnt= $products->count();
	  
      return view('products', compact('products','cat','cnt'));
	}
	
	 public function update(Request $request)
    {
		$data = array("a" => "Apple", "b" => "Ball", "c" => "Cat");

		header("Content-Type: application/json");
		//return json_encode($data);
	//	return "sddddfdf";
	    return response()->json(['status' => "success"]);
    }
	 public function aboutus()
    {
		
	    return view('aboutus');
    }
	 public function contacts()
    {
		
	    return view('contacts');
    }
	 public function home()
    {
		
	    return view('home');
    }
} 