<?php

namespace App\Http\Controllers\Backend;
use Auth;
use Image;
use App\PaymentCardType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request){
        if ($request->isMethod('post')) {
            $card = new PaymentCardType();
            $card->card_type = $request->card_type;

            $card->save();
            return redirect(route('card-add'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Card successfully added`
                })
                </script>
                ');
        }
        return view("bank.card.add");
    }
    public function list(){
        $cards = PaymentCardType::paginate(10);
        return view("bank.card.list")->with(compact('cards'));
    }
    public function edit(Request $request, $id){
        $card = PaymentCardType::FindOrFail($id);
        if ($request->isMethod('post')) {
            $card->card_type = $request->card_type;
            $card->save();
            return redirect(route('card-edit',$card->id))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Card successfully added`
                })
                </script>
                ');
        }
        return view("bank.card.edit")->with(compact('card'));
    }
    public function destroy($id)
    {
        if (!empty($id)) {
            $data = PaymentCardType::FindOrFail($id);
            PaymentCardType::find($id)->delete();
            return redirect(route('card-list'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Card successfully deleted`
                })
                </script>
                ');
        }
    }
}
