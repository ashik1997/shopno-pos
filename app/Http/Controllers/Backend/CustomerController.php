<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            $customer->address = $request->address;

            if ($request->hasFile('image')) {
                // image
                $extension = strtolower($request->file('image')->getClientOriginalExtension());
                $file_name = time().'.'.$extension;
                $image = Image::make($request->image)->resize(300, 300);
                $image->save('images/customer/'.$file_name);
                $customer->img = $file_name;
            }
            $customer->save();
            return redirect(route('customer-add'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Customer successfully added`
                })
                </script>
                ');
        }
        return view("customer.add");
    }
    public function list(){
        $customers = Customer::orderBy('id')->paginate(10);
        return view("customer.list")->with(compact('customers'));
    }
    public function edit(Request $request, $id){
        $customer = Customer::FindOrFail($id);
        if ($request->isMethod('post')) {
            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            $customer->address = $request->address;

            if ($request->hasFile('image')) {
                // image
                if (file_exists('images/customer/'.$customer->img) && !empty($customer->img)) {
                    @unlink('images/customer/'.$customer->img);
                }
                $extension = strtolower($request->file('image')->getClientOriginalExtension());
                $file_name = time().'.'.$extension;
                $image = Image::make($request->image)->resize(300, 300);
                $image->save('images/customer/'.$file_name);
                $customer->img = $file_name;
            }
            $customer->save();
            return redirect(route('customer-edit',$customer->id))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Customer successfully added`
                })
                </script>
                ');
        }
        return view("customer.edit")->with(compact('customer'));
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            $data = Customer::FindOrFail($id);
            $image = 'images/customer/'.$data->img;
            if (file_exists($image)) {
                @unlink($image);
            }
            Customer::find($id)->delete();
            return redirect(route('customer-list'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Customer successfully deleted`
                })
                </script>
                ');
        }
    }
}
