<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Image;

class SliderController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function slider()
    {
        return view ('backend.website_setting.slider');
    }


    public function sliderinsert(Request $request)
    {
        
        $data = array(
            'title' => $request->title,
            'url'    => $request->url,
            'admin_id'  => Auth()->user()->id,
        );

        $Picture = $request->file('image');

        if ($Picture)
        {
            $image_one_name= hexdec(uniqid()).'.'.$Picture->getClientOriginalExtension();
            Image::make($Picture)->save('public/image/sliderimage/'.$image_one_name,100);
            $data['image']='public/image/sliderimage/'.$image_one_name;
            DB::table('sliderinformation')->insert($data);
        }

        else
        {
            DB::table('sliderinformation')->insert($data);
        }
    }


    public function manageslider()
    {
        $Slider = DB::table('sliderinformation')->get();
        return view('backend.website_setting.manageslider', compact('Slider'));
    }


    public function sliderdelete($id)
    {
        $check = DB::table('sliderinformation')->where('id',$id)->first();
        if (isset($check->image)) 
        {
            unlink($check->image);
            DB::table('sliderinformation')->where('id',$id)->delete();
        }

        else
        {
            DB::table('sliderinformation')->where('id',$id)->delete();
        }
    }


    public function slideredit($id)
    {
        $Data = DB::table('sliderinformation')->where('id',$id)->first();
        return view('backend.website_setting.updateslider',compact('Data'));
    }


    public function sliderupdate(Request $request, $id)
    {
        $data = array(
            'title' => $request->title,
            'url'    => $request->url,
            'admin_id'  => Auth()->user()->id,
        );

        $Picture = $request->file('image');
        $old_image = $request->old_image;

        if ($Picture) 
        {
            if ($old_image) 
            {
                unlink($old_image);
            }
            $image_one_name= hexdec(uniqid()).'.'.$Picture->getClientOriginalExtension();
            Image::make($Picture)->save('public/image/sliderimage/'.$image_one_name,100);
            $data['image']='public/image/sliderimage/'.$image_one_name;
            DB::table('sliderinformation')->where('id',$id)->update($data);

        }   

        else
        {
            DB::table('sliderinformation')->where('id',$id)->update($data);
        }
    }


}
