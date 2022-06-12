<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $product_category = new ProductCategory();
            $product_category->name = $request->name;
            $product_category->parent_id = $request->parent_id;

            $product_category->save();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Product category successfully added`
                })
                </script>
                ');
        }
        $categories = ProductCategory::where('parent_id', 0)->get();
        return view("product.category.add")->with(compact('categories'));
    }
    public function list(){
        $product_categories = ProductCategory::paginate(10);
        return view("product.category.list")->with(compact('product_categories'));
    }
    public function edit(Request $request, $id){
        $category = ProductCategory::FindOrFail($id);
        if ($request->isMethod('post')) {
            $category->name = $request->name;
            $category->parent_id = $request->parent_id;
            $category->save();
            return redirect(route('product-category-edit',$category->id))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Product category successfully added`
                })
                </script>
                ');
        }
        $categories = ProductCategory::where('parent_id', 0)->get();
        return view("product.category.edit")->with(compact('category','categories'));
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            $data = ProductCategory::FindOrFail($id);
            ProductCategory::find($id)->delete();
            return redirect()->back()->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Product category successfully deleted`
                })
                </script>
                ');
        }
    }
}
