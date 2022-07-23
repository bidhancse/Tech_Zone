<?php

namespace App\Http\Controllers\Backend;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Image;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function category()
    {
        $Item = DB::table('iteminformation')->where('status',1)->get();
        return view ('backend.category.category',compact('Item'));
    }


    public function categoryinsert(Request $request)
    {
        $id = IdGenerator::generate(['table' => 'categoryinformation', 'length' => 10, 'prefix' =>'CATE-']);

        $data = array(
            'id'        => $id,
            'category_name' => $request->category_name,
            'item_id' => $request->item_id,
            'status'    => $request->status,
            'admin_id'  => Auth()->user()->id,
        );

        $Picture = $request->file('image');

        if ($Picture)
        {
            $image_one_name= hexdec(uniqid()).'.'.$Picture->getClientOriginalExtension();
            Image::make($Picture)->save('public/image/categoryimage/'.$image_one_name,80);
            $data['image']='public/image/categoryimage/'.$image_one_name;
            DB::table('categoryinformation')->insert($data);
        }

        else
        {
            DB::table('categoryinformation')->insert($data);
        }
    }


    public function managecategory()
    {
        $Category = DB::table('categoryinformation')
        ->leftjoin('iteminformation','iteminformation.id','categoryinformation.item_id')
        ->select('categoryinformation.*','iteminformation.item_name')
        ->get();
        return view ('backend.category.managecategory',compact('Category'));
    }


    public function categorystatus(Request $request, $id)
    {
        $data=DB::table('categoryinformation')->where('id',$id)->first();
        if($data->status == 0)
            DB::table('categoryinformation')->where('id',$id)->update(['status' => 1]); 
        else
            DB::table('categoryinformation')->where('id',$id)->update(['status' => 0]); 

        return response()->json();
    }


    public function categorydelete($id)
    {
        $check = DB::table('categoryinformation')->where('id',$id)->first();
        if (isset($check->image)) 
        {
            unlink($check->image);
            DB::table('categoryinformation')->where('id',$id)->delete();
        }

        else
        {
            DB::table('categoryinformation')->where('id',$id)->delete();
        }
    }


    public function categoryedit($id)
    {
        $Item = DB::table('iteminformation')->where('status',1)->get();
        $Data = DB::table('categoryinformation')->where('categoryinformation.id',$id)
        ->leftjoin('iteminformation','iteminformation.id','categoryinformation.item_id')
        ->select('categoryinformation.*','iteminformation.item_name')
        ->first();
        return view('backend.category.updatecategory',compact('Item','Data'));
    }


    public function categoryupdate(Request $request, $id)
    {
        $data = array(
            'category_name' => $request->category_name,
            'item_id' => $request->item_id,
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
            Image::make($Picture)->save('public/image/categoryimage/'.$image_one_name,80);
            $data['image']='public/image/categoryimage/'.$image_one_name;
            DB::table('categoryinformation')->where('id',$id)->update($data);

        }   

        else
        {
            DB::table('categoryinformation')->where('id',$id)->update($data);
        }
    }



    
}
