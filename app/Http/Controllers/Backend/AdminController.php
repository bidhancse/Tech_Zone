<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use DB;
Use Image;
Use Auth;
use Hash;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function createadmin()
    {
        return view ('backend.user.createadmin');
    }

    
    public function insertadmin(Request $request)
    { 

        $data = array(
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'password'      =>Hash::make($request->password),
            'status'        => 1,
            'role_id'       => 1,
            'join_date'     => date('Y-m-d'),
            'admin_id'      => Auth()->user()->id,
        );

        $AdminImage = $request->file('image');

        if ($AdminImage)
        {
            $image_one_name= hexdec(uniqid()).'.'.$AdminImage->getClientOriginalExtension();
            Image::make($AdminImage)->save('public/image/adminimage/'.$image_one_name,80);
            $data['image']='public/image/adminimage/'.$image_one_name;
            DB::table('users')->insert($data);
        }

        else
        {
            DB::table('users')->insert($data);
        }
    }


    public function manageadmin()
    {
        $AdminData = DB::table('users')->where('role_id',1)->get();
        return view('backend.user.manageadmin', compact('AdminData'));
    }


    public function adminstatus(Request $request, $id)
    {
        $data=DB::table('users')->where('id',$id)->first();
        if($data->status == 0)
            DB::table('users')->where('id',$id)->update(['status' => 1]); 
        else
            DB::table('users')->where('id',$id)->update(['status' => 0]); 

        return response()->json();
    }


    public function deleteadmin($id)
    {
        $check = DB::table('users')->where('id',$id)->first();
        if (isset($check->image)) 
        {
            unlink($check->image);
            DB::table('users')->where('id',$id)->delete();
        }

        else
        {
            DB::table('users')->where('id',$id)->delete();
        }
    }


    public function adminedit($id)
    {
        $Data = DB::table('users')->where('id',$id)->first();
        return view('backend.user.updateadmin',compact('Data'));
    }


    public function adminupdate(Request $request, $id)
    {
        if($request->password == Null){
            $data = array(
                'name'      => $request->name,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'address'   => $request->address,
                'status'    => 1,
                'role_id'   => 1,
                'admin_id'  => Auth()->user()->id,
         );
        }
 
        else{
           $data = array(
                'name'      => $request->name,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'address'   => $request->address,
                'password'  =>Hash::make($request->password),
                'status'     => 1,
                'role_id'   => 1,
                'admin_id'  => Auth()->user()->id,
         );
 
       }
 
        $UserPicture = $request->file('image');
        $old_image = $request->old_image;
 
        if ($UserPicture) {
            if($old_image) {
                unlink($old_image);
            }
            $image_one_name= hexdec(uniqid()).'.'.$UserPicture->getClientOriginalExtension();
            Image::make($UserPicture)->save('public/image/adminimage/'.$image_one_name,80);
            $data['image']='public/image/adminimage/'.$image_one_name;
            DB::table('users')->where('id',$id)->update($data);
 
        }
 
        else {
            DB::table('users')->where('id',$id)->update($data);
        }
    }


}
