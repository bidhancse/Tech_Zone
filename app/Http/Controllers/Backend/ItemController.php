<?php

namespace App\Http\Controllers\Backend;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Image;


class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function item()
    {
        return view ('backend.item.item');
    }


    public function iteminsert(Request $request)
    {
        $id = IdGenerator::generate(['table' => 'iteminformation', 'length' => 10, 'prefix' =>'ITEM-']);

        $data = array(
            'id'        => $id,
            'item_name' => $request->item_name,
            'status'    => $request->status,
            'admin_id'  => Auth()->user()->id,
        );

        $Picture = $request->file('image');

        if ($Picture)
        {
            $image_one_name= hexdec(uniqid()).'.'.$Picture->getClientOriginalExtension();
            Image::make($Picture)->save('public/image/itemimage/'.$image_one_name,80);
            $data['image']='public/image/itemimage/'.$image_one_name;
            DB::table('iteminformation')->insert($data);
        }

        else
        {
            DB::table('iteminformation')->insert($data);
        }
    }


    public function manageitem()
    {
        $Item = DB::table('iteminformation')->get();
        return view('backend.item.manageitem', compact('Item'));
    }


    public function changeStatus(Request $request, $id)
    {
        $data=DB::table('iteminformation')->where('id',$id)->first();
        if($data->status == 0)
            DB::table('iteminformation')->where('id',$id)->update(['status' => 1]); 
        else
            DB::table('iteminformation')->where('id',$id)->update(['status' => 0]); 

        return response()->json();
    }


    public function itemdelete($id)
    {
        $check = DB::table('iteminformation')->where('id',$id)->first();
        if (isset($check->image)) 
        {
            unlink($check->image);
            DB::table('iteminformation')->where('id',$id)->delete();
        }

        else
        {
            DB::table('iteminformation')->where('id',$id)->delete();
        }
    }


    public function itemedit($id)
    {
        $Data = DB::table('iteminformation')->where('id',$id)->first();
        return view('backend.item.updateitem',compact('Data'));
    }


    public function itemupdate(Request $request, $id)
    {
        $data = array(
            'item_name' => $request->item_name,
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
            Image::make($Picture)->save('public/image/itemimage/'.$image_one_name,80);
            $data['image']='public/image/itemimage/'.$image_one_name;
            DB::table('iteminformation')->where('id',$id)->update($data);

        }   

        else
        {
            DB::table('iteminformation')->where('id',$id)->update($data);
        }
    }






}
