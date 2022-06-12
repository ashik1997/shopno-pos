<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Image;
use App\BankAccount;
use App\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $account = new BankAccount();
            $account->bank_name = $request->bank_name;
            $account->account_no = $request->account_no;
            $account->account_type = $request->account_type;
            $account->initial_balance = $request->initial_balance;
            $account->store_id = $request->store_id;

            $account->save();
            return redirect(route('account-add'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Bank account successfully added`
                })
                </script>
                ');
        }
        $stores = Store::get();
        return view("bank.account.add")->with(compact('stores'));
    }
    public function list(){
        $accounts = BankAccount::orderBy('id')->paginate(10);
        return view("bank.account.list")->with(compact('accounts'));
    }
    public function edit(Request $request, $id){
        $account = BankAccount::FindOrFail($id);
        if ($request->isMethod('post')) {
            $account->bank_name = $request->bank_name;
            $account->account_no = $request->account_no;
            $account->account_type = $request->account_type;
            $account->initial_balance = $request->initial_balance;
            $account->store_id = $request->store_id;
            $account->save();
            return redirect(route('account-edit',$account->id))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Bank account successfully added`
                })
                </script>
                ');
        }
        $stores = Store::get();
        return view("bank.account.edit")->with(compact('account','stores'));
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            BankAccount::find($id)->delete();
            return redirect(route('account-list'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Bank account successfully deleted`
                })
                </script>
                ');
        }
    }
}
