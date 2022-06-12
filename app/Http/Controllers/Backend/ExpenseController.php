<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\Store;
use App\Expense;
use App\BankAccount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $expense = new Expense();
            $expense->store_id = $request->store_id;
            $expense->bank_account_id = $request->bank_account_id;
            $expense->amount = $request->amount;
            $expense->expense_type = $request->expense_type;
            $expense->expense_date = $request->expense_date;
            $expense->save();
            return redirect(route('expense-add'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Expense successfully added`
                })
                </script>
                ');
        }
        $bank_accounts = BankAccount::get();
        $stores = Store::get();
        return view("expense.add")->with(compact('bank_accounts','stores'));
    }
    public function list(){
        $expenses = Expense::with('store','bank_account')->orderBy('id')->paginate(10);
        return view("expense.list")->with(compact('expenses'));
    }
    public function edit(Request $request, $id){
        $expense = Expense::FindOrFail($id);
        if ($request->isMethod('post')) {
            $expense->store_id = $request->store_id;
            $expense->bank_account_id = $request->bank_account_id;
            $expense->amount = $request->amount;
            $expense->expense_type = $request->expense_type;
            $expense->expense_date = $request->expense_date;
            $expense->save();
            return redirect(route('expense-edit',$expense->id))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Expense successfully updated`
                })
                </script>
                ');
        }
        $bank_accounts = BankAccount::get();
        $stores = Store::get();
        return view("expense.edit")->with(compact('expense','bank_accounts','stores'));
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            Expense::find($id)->delete();
            return redirect(route('expense-list'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Expense successfully deleted`
                })
                </script>
                ');
        }
    }
}
