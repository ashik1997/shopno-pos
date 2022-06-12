<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\SupplierPayments;
use App\Suppliers;
use App\BankAccount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $supplier_payment = new SupplierPayments();
            $supplier_payment->supplier_id = $request->supplier_id;
            $supplier_payment->bank_account_id = $request->bank_account_id;
            $supplier_payment->amount = $request->amount;
            $supplier_payment->note = $request->note;
            $supplier_payment->paid_date = $request->paid_date;
            $supplier_payment->save();
            return redirect(route('supplier-payment-add'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Supplier payment successfully added`
                })
                </script>
                ');
        }
        $bank_accounts = BankAccount::get();
        $suppliers = Suppliers::get();
        return view("bank.supplier_payment.add")->with(compact('bank_accounts','suppliers'));
    }
    public function list(){
        $supplier_payments = SupplierPayments::with('supplier','bank_account')->orderBy('id')->paginate(10);
        return view("bank.supplier_payment.list")->with(compact('supplier_payments'));
    }
    public function edit(Request $request, $id){
        $supplier_payment = SupplierPayments::FindOrFail($id);
        if ($request->isMethod('post')) {
            $supplier_payment->supplier_id = $request->supplier_id;
            $supplier_payment->bank_account_id = $request->bank_account_id;
            $supplier_payment->amount = $request->amount;
            $supplier_payment->note = $request->note;
            $supplier_payment->paid_date = $request->paid_date;
            $supplier_payment->save();
            return redirect(route('supplier-payment-edit',$supplier_payment->id))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Supplier payment successfully added`
                })
                </script>
                ');
        }
        $bank_accounts = BankAccount::get();
        $suppliers = Suppliers::get();
        return view("bank.supplier_payment.edit")->with(compact('supplier_payment','bank_accounts','suppliers'));
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            SupplierPayments::find($id)->delete();
            return redirect(route('supplier-payment-list'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Supplier payment successfully deleted`
                })
                </script>
                ');
        }
    }
}
