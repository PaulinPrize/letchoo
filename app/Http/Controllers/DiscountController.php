<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ User, Coupon, Discount };

class DiscountController extends Controller
{
    public function manage_amount(Request $request) {

        $request->validate([
            'host_amount' =>  ['regex:/^[0-9]+(\.[0-9][0-9]?)?$/'],
            'guest_amount' => ['regex:/^[0-9]+(\.[0-9][0-9]?)?$/']
        ]);

        //check if amounts already exists in the database
        $coupon = Coupon::orderBy('id', 'ASC')->first();

        if($coupon) {

            $coupon->update([
                "host_amount" => $request->host_amount,
                "guest_amount" => $request->guest_amount,
            ]);

        } else {

            $coupon = Coupon::create([
                "host_amount" => $request->host_amount,
                "guest_amount" => $request->guest_amount,
            ]);
        }

        return view('discounts.manage_amount', compact('coupon'));

    }

    public function show_form() {

        $coupon = Coupon::orderBy('id', 'ASC')->first();
        return view('discounts.manage_amount', compact('coupon'));

    }
}
