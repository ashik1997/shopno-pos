<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $store = new Store();
            $store->name = $request->name;
            $store->phone = $request->phone;
            $store->email = $request->email;
            $store->address = $request->address;

            if ($request->hasFile('image')) {
                // image
                $extension = strtolower($request->file('image')->getClientOriginalExtension());
                $file_name = time().'.'.$extension;
                $image = Image::make($request->image)->resize(300, 300);
                $image->save('images/store/'.$file_name);
                $store->logo = $file_name;
            }
            $store->save();
            return redirect(route('store-add'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Store successfully added`
                })
                </script>
                ');
        }
        return view("store.add");
    }
    public function list(){
        $stores = Store::orderBy('id')->paginate(10);
        return view("store.list")->with(compact('stores'));
    }
    public function edit(Request $request, $id){
        $store = Store::FindOrFail($id);
        if ($request->isMethod('post')) {
            $store->name = $request->name;
            $store->phone = $request->phone;
            $store->email = $request->email;
            $store->address = $request->address;

            if ($request->hasFile('image')) {
                // image
                if (file_exists('images/store/'.$store->logo) && !empty($store->logo)) {
                    @unlink('images/store/'.$store->logo);
                }
                $extension = strtolower($request->file('image')->getClientOriginalExtension());
                $file_name = time().'.'.$extension;
                $image = Image::make($request->image)->resize(300, 300);
                $image->save('images/store/'.$file_name);
                $store->logo = $file_name;
            }
            $store->save();
            return redirect(route('store-edit',$store->id))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Store successfully added`
                })
                </script>
                ');
        }
        return view("store.edit")->with(compact('store'));
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            $data = Store::FindOrFail($id);
            $image = 'images/store/'.$data->logo;
            if (file_exists($image)) {
                @unlink($image);
            }
            Store::find($id)->delete();
            return redirect(route('store-list'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Store successfully deleted`
                })
                </script>
                ');
        }
    }
}
