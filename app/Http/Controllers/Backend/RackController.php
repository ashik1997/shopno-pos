<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\Rack;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $rack = new Rack();
            $rack->name = $request->name;

            $rack->save();
            return redirect(route('rack-add'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Rack successfully added`
                })
                </script>
                ');
        }
        return view("rack.add");
    }
    public function list(){
        $racks = Rack::paginate(10);
        return view("rack.list")->with(compact('racks'));
    }
    public function edit(Request $request, $id){
        $rack = Rack::FindOrFail($id);
        if ($request->isMethod('post')) {
            $rack->name = $request->name;
            $rack->save();
            return redirect(route('rack-edit',$rack->id))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Rack successfully added`
                })
                </script>
                ');
        }
        return view("rack.edit")->with(compact('rack'));
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            $data = Rack::FindOrFail($id);
            Rack::find($id)->delete();
            return redirect(route('rack-list'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Rack successfully deleted`
                })
                </script>
                ');
        }
    }
}
