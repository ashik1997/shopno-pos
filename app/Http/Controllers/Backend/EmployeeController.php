<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\User;
use App\Store;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $user = new User();
            $user->store_id = $request->store_id;
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->job_title = $request->job_title;
            $user->date_of_birth = $request->date_of_birth;
            $user->join_date = $request->join_date;
            $user->salary = $request->salary;
            $user->nid = $request->nid;

            if ($request->hasFile('image')) {
                // image
                $extension = strtolower($request->file('image')->getClientOriginalExtension());
                $file_name = time().'.'.$extension;
                $image = Image::make($request->image)->resize(300, 300);
                $image->save('images/employees/'.$file_name);
                $user->img = $file_name;
            }

            $user->blood_group = $request->blood_group;
            $user->role = $request->role;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect(route('employee-add'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Employee successfully added`
                })
                </script>
                ');
        }
        $stores = Store::get();
        $roles = Role::get();
        return view("employee.add")->with(compact('stores','roles'));
    }
    public function list(){
        $employees = User::orderBy('id')->paginate(10);
        return view("employee.list")->with(compact('employees'));
    }
    public function edit(Request $request, $id){
        $employee = User::FindOrFail($id);
        if ($request->isMethod('post')) {
            // $user = new User();
            $employee->store_id = $request->store_id;
            $employee->name = $request->name;
            $employee->phone = $request->phone;
            $employee->email = $request->email;
            $employee->job_title = $request->job_title;
            $employee->date_of_birth = $request->date_of_birth;
            $employee->join_date = $request->join_date;
            $employee->salary = $request->salary;
            $employee->nid = $request->nid;

            if ($request->hasFile('image')) {
                // image
                if (file_exists('images/employees/'.$employee->img) && !empty($employee->img)) {
                    @unlink('images/employees/'.$employee->img);
                }
                $extension = strtolower($request->file('image')->getClientOriginalExtension());
                $file_name = time().'.'.$extension;
                $image = Image::make($request->image)->resize(300, 300);
                $image->save('images/employees/'.$file_name);
                $employee->img = $file_name;
            }

            $employee->blood_group = $request->blood_group;
            $employee->role = $request->role;
            $employee->username = $request->username;
            if (!empty($request->password)) {
                $employee->password = Hash::make($request->password);
            }
            $employee->save();
            return redirect(route('employee-edit',$employee->id))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Employee successfully added`
                })
                </script>
                ');
        }
        $stores = Store::get();
        $roles = Role::get();
        return view("employee.edit")->with(compact('stores','employee','roles'));
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            $data = User::FindOrFail($id);
            $image = 'images/employees/'.$data->img;
            if (file_exists($image)) {
                @unlink($image);
            }
            User::find($id)->delete();
            return redirect(route('employee-list'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `User successfully deleted`
                })
                </script>
                ');
        }
    }
}
