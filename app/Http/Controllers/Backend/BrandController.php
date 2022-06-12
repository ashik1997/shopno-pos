<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Image;
use App\ProductBrand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $brand = new ProductBrand();
            $brand->name = $request->name;

            $brand->save();
            return redirect(route('brand-add'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Product brand successfully added`
                })
                </script>
                ');
        }
        return view("product.brand.add");
    }
    public function list(){
        $brands = ProductBrand::paginate(10);
        return view("product.brand.list")->with(compact('brands'));
    }
    public function edit(Request $request, $id){
        $brand = ProductBrand::FindOrFail($id);
        if ($request->isMethod('post')) {
            $brand->name = $request->name;
            $brand->save();
            return redirect(route('brand-edit',$brand->id))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Product brand successfully added`
                })
                </script>
                ');
        }
        return view("product.brand.edit")->with(compact('brand'));
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            $data = ProductBrand::FindOrFail($id);
            ProductBrand::find($id)->delete();
            return redirect(route('brand-list'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Product brand successfully deleted`
                })
                </script>
                ');
        }
    }
}
