<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\SupplierPaymentAlerts;
use App\Suppliers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierPaymentAlertController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $supplier_payment_alert = new SupplierPaymentAlerts();
            $supplier_payment_alert->supplier_id = $request->supplier_id;
            $supplier_payment_alert->amount = $request->amount;
            $supplier_payment_alert->pay_date = $request->pay_date;
            $supplier_payment_alert->notice_date = $request->notice_date;
            $supplier_payment_alert->save();
            return redirect(route('supplier-payment-alert-add'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Supplier payment alert successfully added`
                })
                </script>
                ');
        }
        $suppliers = Suppliers::get();
        return view("supplier.payment_alert.add")->with(compact('suppliers'));
    }
    public function list(){
        $supplier_payment_alerts = SupplierPaymentAlerts::with('supplier')->orderBy('id')->paginate(10);
        return view("supplier.payment_alert.list")->with(compact('supplier_payment_alerts'));
    }
    public function edit(Request $request, $id){
        $supplier_payment_alert = SupplierPaymentAlerts::FindOrFail($id);
        if ($request->isMethod('post')) {
            $supplier_payment_alert->supplier_id = $request->supplier_id;
            $supplier_payment_alert->amount = $request->amount;
            $supplier_payment_alert->pay_date = $request->pay_date;
            $supplier_payment_alert->notice_date = $request->notice_date;
            $supplier_payment_alert->save();
            return redirect(route('supplier-payment-alert-edit',$supplier_payment_alert->id))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Supplier payment alert successfully added`
                })
                </script>
                ');
        }
        $suppliers = Suppliers::get();
        return view("supplier.payment_alert.edit")->with(compact('supplier_payment_alert','suppliers'));
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            SupplierPaymentAlerts::find($id)->delete();
            return redirect(route('supplier-payment-alert-list'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Supplier payment alert successfully deleted`
                })
                </script>
                ');
        }
    }
}
