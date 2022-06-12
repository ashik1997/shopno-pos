<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\EmployeeSalary;
use App\User;
use App\BankAccount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $salary_pay = new EmployeeSalary();
            $salary_pay->user_id = $request->user_id;
            $salary_pay->bank_account_id = $request->bank_account_id;
            $salary_pay->amount = $request->amount;
            $salary_pay->note = $request->note;
            $salary_pay->paid_date = $request->paid_date;
            $salary_pay->pay_for_month = $request->pay_for_month;
            $salary_pay->save();
            return redirect(route('salary-pay-add'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Employee salary pay successfully added`
                })
                </script>
                ');
        }
        $bank_accounts = BankAccount::get();
        $employees = User::get();
        return view("employee.salary_pay.add")->with(compact('bank_accounts','employees'));
    }
    public function list(){
        $salary_pays = EmployeeSalary::with('user','bank_account')->orderBy('id')->paginate(10);
        return view("employee.salary_pay.list")->with(compact('salary_pays'));
    }
    public function edit(Request $request, $id){
        $salary_pay = EmployeeSalary::FindOrFail($id);
        if ($request->isMethod('post')) {
            $salary_pay->user_id = $request->user_id;
            $salary_pay->bank_account_id = $request->bank_account_id;
            $salary_pay->amount = $request->amount;
            $salary_pay->note = $request->note;
            $salary_pay->paid_date = $request->paid_date;
            $salary_pay->pay_for_month = $request->pay_for_month;
            $salary_pay->save();
            return redirect(route('salary-pay-edit',$salary_pay->id))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Employee salary pay successfully updated`
                })
                </script>
                ');
        }
        $bank_accounts = BankAccount::get();
        $employees = User::get();
        return view("employee.salary_pay.edit")->with(compact('salary_pay','bank_accounts','employees'));
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            EmployeeSalary::find($id)->delete();
            return redirect(route('salary-pay-list'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Employe salary pay successfully deleted`
                })
                </script>
                ');
        }
    }
}
