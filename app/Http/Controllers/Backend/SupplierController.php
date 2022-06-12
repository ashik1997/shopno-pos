<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\Suppliers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $supplier = new Suppliers();
            $supplier->name = $request->name;
            $supplier->contact_person = $request->contact_person;
            $supplier->phone = $request->phone;
            $supplier->email = $request->email;
            $supplier->address = $request->address;

            if ($request->hasFile('image')) {
                // image
                $extension = strtolower($request->file('image')->getClientOriginalExtension());
                $file_name = time().'.'.$extension;
                $image = Image::make($request->image)->resize(300, 300);
                $image->save('images/supplier/'.$file_name);
                $supplier->img = $file_name;
            }
            $supplier->save();
            return redirect(route('supplier-add'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Supplier successfully added`
                })
                </script>
                ');
        }
        return view("supplier.add");
    }
    public function list(){
        $suppliers = Suppliers::orderBy('id')->paginate(10);
        return view("supplier.list")->with(compact('suppliers'));
    }
    public function edit(Request $request, $id){
        $supplier = Suppliers::FindOrFail($id);
        if ($request->isMethod('post')) {
            $supplier->name = $request->name;
            $supplier->contact_person = $request->contact_person;
            $supplier->phone = $request->phone;
            $supplier->email = $request->email;
            $supplier->address = $request->address;

            if ($request->hasFile('image')) {
                // image
                if (file_exists('images/supplier/'.$supplier->img) && !empty($supplier->img)) {
                    @unlink('images/supplier/'.$supplier->img);
                }
                $extension = strtolower($request->file('image')->getClientOriginalExtension());
                $file_name = time().'.'.$extension;
                $image = Image::make($request->image)->resize(300, 300);
                $image->save('images/supplier/'.$file_name);
                $supplier->img = $file_name;
            }
            $supplier->save();
            return redirect(route('supplier-edit',$supplier->id))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Supplier successfully added`
                })
                </script>
                ');
        }
        return view("supplier.edit")->with(compact('supplier'));
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            $data = Suppliers::FindOrFail($id);
            $image = 'images/supplier/'.$data->img;
            if (file_exists($image)) {
                @unlink($image);
            }
            Suppliers::find($id)->delete();
            return redirect(route('supplier-list'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Supplier successfully deleted`
                })
                </script>
                ');
        }
    }
}
