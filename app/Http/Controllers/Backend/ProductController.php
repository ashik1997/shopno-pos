<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\Product;
use App\Batch;
use App\StockIn;
use App\ProductBrand;
use App\Suppliers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $product = new Product();
            $product->name = $request->name;
            $product->product_category_id = $request->product_category_id;
            $product->product_sub_category_id = $request->product_sub_category_id;
            $product->brand_id = $request->brand_id;

            $product->save();
            return redirect(route('product-add'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Product successfully added`
                })
                </script>
                ');
        }
        $brands = ProductBrand::get();
        return view("product.add")->with(compact('brands'));
    }
    public function list(){
        $products = Product::with('category','subcategory','brand')->paginate(10);
        return view("product.list")->with(compact('products'));
    }
    public function edit(Request $request, $id){
        $product = Product::FindOrFail($id);
        if ($request->isMethod('post')) {
            $product->name = $request->name;
            $product->product_category_id = $request->product_category_id;
            $product->product_sub_category_id = $request->product_sub_category_id;
            $product->brand_id = $request->brand_id;
            $product->save();
            return redirect(route('product-edit',$product->id))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Product successfully updated`
                })
                </script>
                ');
        }
        return view("product.edit")->with(compact('product'));
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            $data = Product::FindOrFail($id);
            Product::find($id)->delete();
            return redirect(route('product-list'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Product successfully deleted`
                })
                </script>
                ');
        }
    }
    public function stock_add(Request $request){
        if ($request->isMethod('post')) {
            $batch = new Batch;
            $batch->id = $request->batch_id;
            $batch->invoice_no = $request->invoice_no;
            $batch->store_id = $request->store_id;
            $batch->stock_date = $request->stock_date;
            $batch->save();
            $size = count(collect($request)->get('product_id'));
            // Try: dd($size);
            for ($i = 0; $i < $size; $i++)
            {
                $stock_in = new StockIn;
                $stock_in->product_id = $request->get('product_id')[$i];
                $stock_in->supplier_id = $request->get('supplier_id')[$i];
                $stock_in->purchase_price = $request->get('purchase_price')[$i];
                $stock_in->sell_price = $request->get('sell_price')[$i];
                $stock_in->rack_id = $request->get('rack_id')[$i];
                $stock_in->qty = $request->get('qty')[$i];
                $stock_in->expiration_date = $request->get('expiration_date')[$i];
                $stock_in->alert_date = $request->get('alert_date')[$i];
                $stock_in->batch_id = $batch->id;
                $stock_in->save();
            }
            
            return redirect(route('product-stock-in'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Product stock in successfully added`
                })
                </script>
                ');
        }
        $products = Product::get();
        $suppliers = Suppliers::orderBy('id')->get();
        return view("product.stock_in.add")->with(compact('products','suppliers'));
    }
    public function stock_in_list(){
        $batchs = Batch::with('store')->paginate(10);
        return view("product.stock_in.list")->with(compact('batchs'));
    }
    public function stock_in_details($id){
        $batch = Batch::with('store','stock_ins')->where('id', $id)->first();
        return view("product.stock_in.details")->with(compact('batch'));
    }
    public function product_sale(Request $request){
        if ($request->isMethod('post')) {
            // code...
        }
        return view('product.sale.new');
    }
}
