<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        
        return view("showProducts");
    }
    public function storeProducts(Request $request){
        // dd($request->all());
        $image = base64_encode(file_get_contents($request->file('image')->path()));
        // $image = $request->image;


            DB::table('products')->insert([
                'name' => $request->name,
                'price' => $request->price,
                'image' => $image,
                                // 'image' => $image,

            ]);
    
            return response()->json(['status' => 200, 'message' => 'Product  was added successfully']);
        // } else {
        //     return response()->json(['status' => 400, 'message' => 'Image not provided or invalid']);
        // }
    }
    public function products(){
      
            try {
                // Fetch products from the database directly using the DB facade
                $products = DB::table('products')->get();
    
                return response()->json([
                    'status' => 200,
                    'message' => 'Product  was fetched successfully', // HTTP 200 OK status
                    'data' => $products,
                ]);
            } catch (\Exception $e) {
                // Handle any exceptions, e.g., database connection error
                return response()->json([
                    'status' =>500, // HTTP 500 Internal Server Error status
                    'error' => 'An error occurred while fetching products.',
                ]);
            }
        }
    
}
