<?php

namespace App\Http\Controllers\Client;

use App\Coupons;
use App\Products;
//use Brian2694\Toastr\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yoeunes\Toastr\Toastr;

class CartsController extends Controller
{
    public function addToCart(Request $request)
    {
        $data = $request->all();

        if (empty($data['user_email'])){
            $data['user_email'] = "";
        }
        $session_id = Session::get('session_id');
        if (empty($session_id)) {
            $session_id = str_random(40);
            Session::put('session_id', $session_id);
        }

        $sizeArr = explode('-',$data['size']);


        $countProduct = DB::table('carts')->where(['product_id' => $data['product_id'],  'product_color' => $data['product_color'],
             'price' => $data['price'],'size' => $sizeArr[1], 'session_id' => $session_id])->count();
        if ($countProduct>0){
            return redirect()->back();
        }else{
            DB::table('carts')->insert(['product_id' => $data['product_id'], 'product_name' => $data['product_name'], 'product_color' => $data['product_color'],
                'product_code' => $data['product_code'], 'price' => $data['price'],'size' => $sizeArr[1],'quantity' => $data['quantity'],
                'user_email' => $data['user_email'],'session_id' => $session_id]);
        }

        return redirect()->route('client.getCart');
    }

    public function getCart(){
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
//                echo "<pre>";print_r($userCart);die();

        foreach ($userCart as $key=>$products){
            $productDetails = Products::where(['id'=>$products->product_id])->first();
            $userCart[$key]->image = $productDetails->image;
        }
//                echo "<pre>";print_r($userCart);die();


        return view('client.pages.product.cart',compact('userCart'));
    }

    public function deleteCart($id){
        DB::table('carts')->where('id',$id)->delete();
        return redirect()->back();
    }

    public function updateCartQuantity($id,$quantity){
        DB::table('carts')->where('id',$id)->increment('quantity',$quantity);
        return redirect()->back();
    }

    public function applyCoupon(Request $request){
        $data =$request->all();
        $couponCount = Coupons::where('coupon_code',$data['coupon_code'])->count();
        if($couponCount == 0){
            toastr()->error('không tồn tại mã giảm giá này', '', ['timeOut' => 5000]);
            return redirect()->back();
        }else{
            $couponDetails = Coupons::where('coupon_code',$data['coupon_code'])->first();
            if($couponDetails->status === 0){
                toastr()->error('không sử dụng được mã giảm giá này','',['timeOut' => 5000]);
                return redirect()->back();
            }
            //kiem tra ngay het han cua code
            $expiry_date = $couponDetails->expiry_date;
            $current_date = date('Y-m-d');
            if ($expiry_date<$current_date){
                toastr()->error('mã giảm giá này đã hết hạn','',['timeOut' => 5000]);
                return redirect()->back();
            }
            //tinh giam gia cho coupon
            $session_id = Session::get('session_id');
//            dd($session); dang null
            $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
            $total_amount = 0;
            foreach ($userCart as $item){
                $total_amount = $total_amount + ($item->price*$item->quantity);
            }

            //xet xem tinh theo cach nao
            if ($couponDetails->amount_type == 'Fixed'){
                $couponAmount = $couponDetails->amount;
            }else{
                $couponAmount = $total_amount*($couponDetails->amount/100);
            }

            Session::put('CouponAmount',$couponAmount);
            Session::put('CouponCode',$data['coupon_code']);
            toastr()->success('áp dụng thành công mã giảm giá', '', ['timeOut' => 5000]);
            return redirect()->back();

        }
    }
}






