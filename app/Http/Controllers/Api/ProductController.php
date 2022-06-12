<?php
namespace App\Http\Controllers\Api;
use App\Product;
use App\StockIn;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function product_by_id($id){
      return $product = Product::where('id',$id)->get();
  }
  public function products(){
      return $products = Product::all();
  }
  public function add_to_cart(Request $request)
  {
    // $cartItems = session('cart');
    $product = Product::where('id',$request->id)->first();
    $stock_in = StockIn::where('product_id',$request->id)->orderBy('id','desc')->first();
    $id = $product->id;
    $cart = session()->get('cart');
    // if cart is empty then this the first product
    if(!$cart) {
      $cart = [
              $id => [
                "id" => $id,
                "name" => $product->name,
                "qty" => 1,
                "price" => $product->price,
                "product" => $product,
                "stock_in" => $stock_in
              ]
      ];
      session()->put('cart', $cart);
      // return redirect()->back()->with('success', 'Product added to cart successfully!');
      return $cart;
    }
    // if cart not empty then check if this product exist then increment quantity
    if(isset($cart[$id])) {
      $cart[$id]['qty']++;
      session()->put('cart', $cart);
      // return redirect()->back()->with('success', 'Product added to cart successfully!');
      return $cart;
    }
    // if item not exist in cart then add to cart with quantity = 1
    $cart[$id] = [
        "id" => $id,
        "name" => $product->name,
        "qty" => 1,
        "price" => $product->price
    ];
    session()->put('cart', $cart);
    // return redirect()->back()->with('success', 'Product added to cart successfully!');
    return $cart;
  }
  public function update_cart(Request $request)
  {
    if($request->id and $request->quantity)
    {
      $cart = session()->get('cart');
      $cart[$request->id]["quantity"] = $request->quantity;
      session()->put('cart', $cart);
      session()->flash('success', 'Cart updated successfully');
    }
  }
  public function remove_cart(Request $request)
  {
    if($request->id) {
      $cart = session()->get('cart');
      if(isset($cart[$request->id])) {
        unset($cart[$request->id]);
        session()->put('cart', $cart);
      }
      session()->flash('success', 'Product removed successfully');
    }
  }
}
