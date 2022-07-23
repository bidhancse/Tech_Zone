<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use DB;
use Hash;
Use Image;
Use Auth;

class UserController extends Controller
{

    public function usersignup(Request $request)
    {
        $data = array(
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'password'      =>Hash::make($request->password),
            'role_id'       => 2,
            'join_date'     => date('Y-m-d'),
        );

        DB::table('users')->insert($data);

        return Redirect()->back()->with('message','Sign Up Successfully Done');
    }


    public function updateprofile(Request $request, $id)
    {
        $data = array(

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        );

        $UserPicture = $request->file('image');
        $old_image = $request->old_image;

        if ($UserPicture) {
            if($old_image) {
                unlink($old_image);
            }
            $image_one_name= hexdec(uniqid()).'.'.$UserPicture->getClientOriginalExtension();
            Image::make($UserPicture)->save('public/image/userimage/'.$image_one_name,80);
            $data['image']='public/image/userimage/'.$image_one_name;
            DB::table('users')->where('id',$id)->update($data);
        }

        else {
            DB::table('users')->where('id',$id)->update($data);
        }

        return Redirect()->back()->with('message','Information Update Done'); 
    }


    public function updatepassword(Request $request)
    {
        $dbpassword       = Auth()->user()->password;
        $old_password     = $request->old_password;
        $new_password     = $request->new_password;
        $confirm_password = $request->confirm_password;

        if (Hash::check($old_password, $dbpassword)) {

            if ($new_password === $confirm_password) {
                DB::table('users')->where('id',Auth()->user()->id)->update(['password'=>Hash::make($new_password)]);
                Auth::logout();
                return redirect('/');
            }

            else{

                return redirect()->back()->with('error','New Password & Old Password not Matched');
            }
            
        }
        else{

            return redirect()->back()->with('error','Old Password not Matched');
        }
        
        return redirect()->back();
    }
    


    public function dashboard()
    {
        $PendingOrder = DB::table('invoiceinformation')->where('user_id',Auth()->user()->id)->where('status',0)->get();
        $ProcessingOrder = DB::table('invoiceinformation')->where('user_id',Auth()->user()->id)->where('status',1)->get();
        $ShippingOrder = DB::table('invoiceinformation')->where('user_id',Auth()->user()->id)->where('status',2)->get();
        $CompeleteOrder = DB::table('invoiceinformation')->where('user_id',Auth()->user()->id)->where('status',3)->get();
        $OrderData = DB::table('invoiceinformation')->where('user_id',Auth()->user()->id)->get();
        return view('user.dashboard', compact('PendingOrder','ProcessingOrder','ShippingOrder','CompeleteOrder','OrderData'));
    }


    public function ordertrack()
    {
        return view('frontend.pages.ordertrack');
    }

    
    public function trackingstatus(Request $request)
    {
        $track_code     = $request->order_track_code;
        $OrderStatus = DB::table('invoiceinformation')->where('tracking_code', $request->order_track_code)->first();
        
        return view('frontend.pages.orderstatus', compact('OrderStatus'));
    }


    public function ordertracking($id)
    {
        $OrderTrack=DB::table('invoiceinformation')->where('id',$id)->first();
        $OrderProduct=DB::table('orderdetails')->where('orderdetails.invoice_id',$id)
        ->leftjoin('productinformation','productinformation.id','orderdetails.product_id')
        ->select('orderdetails.*','productinformation.product_name','productinformation.image')
        ->get();
        return view('user.ordertracking', compact('OrderTrack','OrderProduct'));
    }


    public function wishlist($id)
    {
        $Data = array(
            'user_id' => Auth()->user()->id,
            'product_id' => $id,
        );

        $OldWishlists = DB::table('wishlists')->where('user_id',Auth()->user()->id)->where('product_id',$id)->first();

        if(isset($OldWishlists)){

            return redirect()->back()->with('error','Product Wishlists Already Exists');
        }

        else{
            
            DB::table('wishlists')->insert($Data);

            return redirect()->back()->with('message','Product Wishlists Insert Done');
        }

        
    }


    public function Wishlists()
    {
        $WishlistsData = DB::table('wishlists')->where('user_id',Auth()->user()->id)
        ->join('productinformation', 'productinformation.id', '=', 'wishlists.product_id')
        ->get();

        return view('frontend.pages.Wishlists', compact('WishlistsData'));
    }


    public function wishlistprodelete($id)
    {

        DB::table('wishlists')->where('product_id',$id)->delete();

        return Redirect()->back()->with('error','Wishlists Product Delete');

    }


    public function message(Request $request) {

        $data = array(
            
            'name'     => $request->name,
            'subject'  => $request->subject,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'details'  => $request->details,
        );

        DB::table('customermessage')->insert($data);


        return Redirect()->back()->with('info','Message Send Successfully Done');
        
    }


}
