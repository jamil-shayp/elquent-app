<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // fetch all data from the database
    public function get_all(){
        $products = Product::all();

        return response()->json([
            'products' => $products,
            'msg' => 'Get all products successfully'
        ]);
    }

    // create a new product in db
    public function create(Request $request){
        
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);

        return $product;
    }
    // show a new product in db
    public function show(Request $request  ){
        
        $product = Product::find($request->id);
        return $product;
    }
    // update a new product in db
    public function update(Request $request  , $id){
        
        $product = Product::find($request->id);

        $productupdate([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);
        return $product;
    }


}
