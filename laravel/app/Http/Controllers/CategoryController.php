<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getCategories() {
       $categories = Category::all();
       return response()->json($categories);
    }
    
    public function createCategory() {
        return ["message" => "Creating 1 new category"];
    }
    
    public function getCategory($categoryId) {
        return ["message" => "Getting 1 category base on given categoryId"];
    }
    
    public function updateCategory($categoryId) {
        return ["message" => "Updating 1 category base on given categoryId"];
    }
    
    public function deleteCategory($categoryId) {
        return ["message" => "Deleting 1 category base on given categoryId"];
    }
    
}
