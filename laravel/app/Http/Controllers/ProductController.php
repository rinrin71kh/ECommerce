<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
   
    public function getProducts() {
        $products = Product::all();
        return response()->json($products);
    }


 

    public function createProduct(Request $req )
    {
        
        $category = Category::find($req->category_id);
        
        if(!$category){
            return ["message" => "Can't find this catetory!"];
        }
        
        $product = new Product;
        $product->name = $req->name;
        $product->pricing = $req->pricing;
        $product->category_id = $req->category_id;
        $product->description = $req->description;
        $product->save();
        
        return $product;
    }
  
    public function getProduct($productId)
    {
        $product = Product::find($productId);

        if(!$product){
            return ["message" => "Can't find this product!"];
        }
        return $product;
    }

   
    public function updateProduct(Request $req, $productId)
    {
        

        $category = Category::find($req->category_id);
        
        if(!$category){
            return ["message" => "Can't find this catetory!"];
        }
        
        $product = Product::find($productId);

        if(!$product){
            return ["message" => "Update unsuccessfull!"];
        }

        $product->name = $req->name;
        $product->category_id = $req->category_id;
        $product->pricing = $req->pricing;
        $product->description = $req->description;
        $product->save();

        return $product;
    }
 
    public function deleteProduct($productId)
    {
        $product = Product::find($productId);

        if(!$product){
            return ["message" => "Delete unsuccessfull!"];
        }
        
        $product->delete();

        return ["message" => "Delete successfull!"];
    }
}
