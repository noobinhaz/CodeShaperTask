<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use App\Enums\UserType;
class PaymentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'stripeToken' => 'required',
            'amount' => 'required|numeric',
        ]);

        $payment = Payment::create([
            'user_id' => auth()->user()->id,
            'amount' => $request->amount,
        ]);
        // Implement the charging process -.-"
        // $payment->charge($request->amount, [
        //     'source' => $request->stripeToken,
        // ]);

        if($request->amount > 0){

            User::where('id', auth()->user()->id)->update(['user_type'=>UserType::PREMIUM]);
        }else{
            User::where('id', auth()->user()->id)->update(['user_type'=>UserType::FREE]);
        }

        // Redirect the user to a success page
        return redirect('/dashboard/plans')->with('message', 'You have changed your plan successfully');
    }

    public function paymentPage(){
        return view('payment.store');
    }
}

