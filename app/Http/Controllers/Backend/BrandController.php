<?php

namespace App\Http\Controllers\Backend;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Image;

class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function brand()
    {
        return view ('backend.brand.brand');
    }


    public function brandinsert(Request $request)
    {
        $id = IdGenerator::generate(['table' => 'brandinformation', 'length' => 11, 'prefix' =>'BRAND-']);

        $data = array(
            'id'        => $id,
            'brand_name' => $request->brand_name,
            'status'    => $request->status,
            'admin_id'  => Auth()->user()->id,
        );

        $Picture = $request->file('image');

        if ($Picture)
        {
            $image_one_name= hexdec(uniqid()).'.'.$Picture->getClientOriginalExtension();
            Image::make($Picture)->save('public/image/brandimage/'.$image_one_name,80);
            $data['image']='public/image/brandimage/'.$image_one_name;
            DB::table('brandinformation')->insert($data);
        }

        else
        {
            DB::table('brandinformation')->insert($data);
        }
    }


    public function managebrand()
    {
        $Brand = DB::table('brandinformation')->get();
        return view('backend.brand.managebrand', compact('Brand'));
    }


    public function brandstatus(Request $request, $id)
    {
        $data=DB::table('brandinformation')->where('id',$id)->first();
        if($data->status == 0)
            DB::table('brandinformation')->where('id',$id)->update(['status' => 1]); 
        else
            DB::table('brandinformation')->where('id',$id)->update(['status' => 0]); 

        return response()->json();
    }


    public function branddelete($id)
    {
        $check = DB::table('brandinformation')->where('id',$id)->first();
        if (isset($check->image)) 
        {
            unlink($check->image);
            DB::table('brandinformation')->where('id',$id)->delete();
        }

        else
        {
            DB::table('brandinformation')->where('id',$id)->delete();
        }
    }


    public function brandedit($id)
    {
        $Data = DB::table('brandinformation')->where('id',$id)->first();
        return view('backend.brand.updatebrand',compact('Data'));
    }


    public function brandupdate(Request $request, $id)
    {
        $data = array(
            'brand_name' => $request->brand_name,
            'status'    => $request->status,
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
            Image::make($Picture)->save('public/image/brandimage/'.$image_one_name,80);
            $data['image']='public/image/brandimage/'.$image_one_name;
            DB::table('brandinformation')->where('id',$id)->update($data);

        }   

        else
        {
            DB::table('brandinformation')->where('id',$id)->update($data);
        }
    }

    
}
