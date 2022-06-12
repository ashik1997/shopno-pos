<?php

namespace App\Http\Controllers\Api;
use App\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories(){
        return $categories = ProductCategory::where('parent_id',0)->get();
    }
    public function subcategories($id){
        return $categories = ProductCategory::where('parent_id',$id)->get();
    }
}
