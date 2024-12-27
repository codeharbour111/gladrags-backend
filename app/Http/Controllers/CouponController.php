<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CouponCollection;

class CouponController extends Controller
{
    public function index()
    {
        $coupon = Coupon::paginate(10);

        return response()->json($coupon,200);
    }

    public function viewCoupon()
    {
        $coupons = Coupon::paginate(10);
        
        return view('pages.coupon.coupon-list', compact('coupons'));
    }

    public function addCoupon()
    {
        return view('pages.coupon.add-new-coupon');
    }

    public function load()
    {
        return new CouponCollection(Coupon::paginate(10));
    }

    public function storeCoupon(Request $request)
    {
        try
        {
            $validated = $request->validate([
            'code' => 'required',
            'expire_date' => 'required',
            'discount_amount'=>'required']);

            $coupon = new Coupon();

            $coupon->code  = $request->code;
            $coupon->discount_amount = $request->discount_amount;
            $coupon->expire_date = $request->expire_date;

            $coupon->save();

            return redirect()->route('coupon.list')->with('success', 'Coupon added successfully!');
        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }

    public function editCoupon($id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('pages.coupon.edit-coupon', compact('coupon'));
    }

    public function update(Request $request,$id)
    {
        $request->validate
        ([
            'code' => 'required',
            'expire_date' => 'required',
            'discount_amount'=>'required'
        ]);

        $coupon = Coupon::findOrFail($id);

        try
        {
            $coupon->code  = $request->code;
            $coupon->discount_amount = $request->discount_amount;
            $coupon->expire_date = $request->expire_date;

            $coupon->save();

            return redirect()->route('coupon.list')->with('success', 'Coupon saved successfully!');

        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        
        $coupon->delete();

        return redirect()->route('coupon.list')->with('success', 'Coupon removed successfully!');
    }

    public function getCouponByCode(Request $request)
    {
        $code = $request->input('code');
       
        $coupon = Coupon::where('code', $code)->first();

        if ($coupon) {
            return response()->json(
                ['status'  => 'success',
                'data' => $coupon], 200);
        } else {
            return response()->json([
                'status'  => 'error',
                'message' => 'Coupon not found'
            ], 404);
        }
    }

    public function show($id)
    {
        $coupon = Coupon::find($id);
       
        if($coupon)
        {
            return response()->json($coupon,200);
        }
        else
        {
            return response()->json(
            [
                'status'  => 'success',
                'message' => 'Coupon not found'
            ]);
        }
    }

    public function store(Request $request)
    {
        try
        {
            $validated = $request->validate
            ([
                'code' => 'required',
                'expire_date' => 'required',
                'discount_amount'=>'required'
            ]);

            $coupon = new Coupon();

            $coupon->code  = $request->code;
            $coupon->discount_amount = $request->discount_amount;
            $coupon->expire_date = $request->expire_date;

            $coupon->save();

            return response()->json
            (
            [
                'status'  => 'success',
                'message' => 'Coupon added'
            ],201);
        }
        catch(Exception $e)
        {
            return response()->json($e,500);
        }
    }
}
