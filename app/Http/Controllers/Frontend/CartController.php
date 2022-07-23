<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use DB;
use Cart;
class CartController extends Controller
{
    

    /////////////// Shopping Cart ///////////////


    public function addtocart(Request $cart, $id)
    {
        $ProductData = DB::table('productinformation')->where('id',$id)->first();

        $SalePrice       =   $ProductData->sale_price;
        $DiscountPrice   =   $ProductData->discount_price;
        $PresentPrice    =   $SalePrice - $DiscountPrice;

        $data = array();

        $data['id'] = $ProductData->id;
        $data['name'] = $ProductData->product_name;
        $data['qty'] = $cart->quentity;
        $data['weight'] = 0;
        $data['price'] = $PresentPrice;
        $data['options']['sale_price'] = $SalePrice;
        $data['options']['product_color'] = $cart->product_color;
        $data['options']['image'] = $ProductData->image;

        Cart::add($data);

        return Redirect()->back()->with('message','Add to Cart Successfully Done');
    }


    public function checkcart()
    {
        $Cart = Cart::content();
        dd($Cart);
    }


    public function checkout()
    {
        return view('user.checkout');
    }


    public function cart()
    {
        return view('user.cart');
    }


    public function qty_update(Request $cart, $rowId)
    {
        Cart::update($rowId,$cart->qty);
        return redirect()->back()->with('message','Quentity Update Done');
    }


    public function product_remove($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back()->with('error','Product Remove Done');
    }


    public function cart_clear()
    {
        Cart::destroy();
        return redirect()->back()->with('error','Cart Clear Done');
    }


    public function shipping_details(Request $cart, $id)
    {
    
        $Data = array(
            'tracking_code'   =>   uniqid(),
            'name'             =>  $cart->name,
            'phone'            =>  $cart->phone, 
            'email'            =>  $cart->email,
            'country'          =>  $cart->country,
            'address'          =>  $cart->address,
            'upazila'          =>  $cart->upazila,
            'district'         =>  $cart->district,
            'payment_method'   =>  $cart->payment_method,
            'user_id'          =>  $id,
            'status'           =>  0,
            'order_date'       =>  date('Y-m-d'),
        );

        $Shipping = DB::table('invoiceinformation')->insertGetId($Data);
        $Content  = Cart::content();

        $CartData = array();
        foreach ($Content as $ProductData)
        {
            $CartData['invoice_id']   =   $Shipping;
            $CartData['product_id']   =   $ProductData->id;
            $CartData['qty']          =   $ProductData->qty;
            $CartData['color']        =   $ProductData->options->product_color;
            $CartData['price']        =   $ProductData->price;
            $CartData['total_price']  =   $ProductData->subtotal;

            DB::table('orderdetails')->insert($CartData);
        }

        Cart::destroy();

        return redirect('/')->with('message','Order Successfully Done');

    }




}
