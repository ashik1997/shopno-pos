<?php
namespace App\Http\Controllers\Api;
use App\Suppliers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function supplier_by_id($id){
        return $product = Suppliers::where('id',$id)->get();
    }
    public function suppliers(){
        return $suppliers = Suppliers::all();
    }
}
