<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('home');
    }
    public function profile(Request $request){
        $user = User::find(Auth::user()->id);
        if ($request->isMethod('post')) {
            if (!empty($request->password)) {
                $this->validate($request, [
                    'password' => 'confirmed|min:6'
                ]);
                $user->password = $request->password;
            }
            
            if ($request->hasFile('img')) {
                // img
                $extension = strtolower($request->file('img')->getClientOriginalExtension());
                $file_name = time().'1.'.$extension;
                $img = Image::make($request->img)->resize(225, 225);
                $img->save('backend/dist/img/'.$file_name);
                $image_path = 'backend/dist/img/'.$user->img;
                if (file_exists($image_path)) {
                    @unlink($image_path);
                }
                $user->img = $file_name;
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->save();
            // return redirect(route('profile'))->with('flash_success','
            //     <script>
            //     Toast.fire({
            //       icon: `success`,
            //       title: `Profile successfully updated`
            //     })
            //     </script>
            //     ');
        }
        // return view('admin.settings.profile');
    }
    public function password_update(Request $request){
        $user = User::find(Auth::user()->id);
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'password' => 'required|string|min:8|confirmed'
            ]);
            $user->password = Hash::make($request->password);
            $user->save();
            // return redirect(route('profile'))->with('flash_success','
            //     <script>
            //     Toast.fire({
            //       icon: `success`,
            //       title: `Password successfully updated`
            //     })
            //     </script>
            //     ');
        }
        // return view('admin.settings.profile');
    }
}
