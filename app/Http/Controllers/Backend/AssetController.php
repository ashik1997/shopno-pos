<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\Store;
use App\Assets;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $asset = new Assets();
            $asset->store_id = $request->store_id;
            $asset->name = $request->name;
            $asset->unit_price = $request->unit_price;
            $asset->qty = $request->qty;
            $asset->amount = $request->amount;
            $asset->purchase_date = $request->purchase_date;
            $asset->save();
            return redirect(route('asset-add'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Asset successfully added`
                })
                </script>
                ');
        }
        $stores = Store::get();
        return view("asset.add")->with(compact('stores'));
    }
    public function list(){
        $assets = Assets::with('store')->orderBy('id')->paginate(10);
        return view("asset.list")->with(compact('assets'));
    }
    public function edit(Request $request, $id){
        $asset = Assets::FindOrFail($id);
        if ($request->isMethod('post')) {
            $asset->store_id = $request->store_id;
            $asset->name = $request->name;
            $asset->unit_price = $request->unit_price;
            $asset->qty = $request->qty;
            $asset->amount = $request->amount;
            $asset->purchase_date = $request->purchase_date;
            $asset->save();
            return redirect(route('asset-edit',$asset->id))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Asset successfully updated`
                })
                </script>
                ');
        }
        $stores = Store::get();
        return view("asset.edit")->with(compact('asset','stores'));
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            Assets::find($id)->delete();
            return redirect(route('asset-list'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Asset successfully deleted`
                })
                </script>
                ');
        }
    }
}
