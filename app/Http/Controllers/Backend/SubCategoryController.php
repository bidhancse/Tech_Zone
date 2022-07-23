<?php

namespace App\Http\Controllers\Backend;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Image;

class SubCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function subcategory()
    {
        $Item = DB::table('iteminformation')->where('status',1)->get();
        return view ('backend.category.subcategory',compact('Item'));
    }

    public function categoryget($item_id) {

      $data = DB::table('categoryinformation')->where('item_id',$item_id)->get();
      return json_encode($data);
    }


    public function subcategoryinsert(Request $request)
    {
        $id = IdGenerator::generate(['table' => 'subcategoryinformation', 'length' => 11, 'prefix' =>'SUBCAT-']);

        $data = array(
            'id'        => $id,
            'item_id' => $request->item_id,
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'status'    => $request->status,
            'admin_id'  => Auth()->user()->id,
        );

        $Picture = $request->file('image');

        if ($Picture)
        {
            $image_one_name= hexdec(uniqid()).'.'.$Picture->getClientOriginalExtension();
            Image::make($Picture)->save('public/image/subcategoryimage/'.$image_one_name,80);
            $data['image']='public/image/subcategoryimage/'.$image_one_name;
            DB::table('subcategoryinformation')->insert($data);
        }

        else
        {
            DB::table('subcategoryinformation')->insert($data);
        }
    }


    public function managesubcategory()
    {

        $SubCategory = DB::table('subcategoryinformation')
       ->leftjoin('iteminformation','iteminformation.id','subcategoryinformation.item_id')
       ->leftjoin('categoryinformation','categoryinformation.id','subcategoryinformation.category_id')
       ->select('subcategoryinformation.*','iteminformation.item_name','categoryinformation.category_name')
       ->get();
        return view ('backend.category.managesubcategory',compact('SubCategory'));
    }


    public function subcategorystatus(Request $request, $id)
    {
        $data=DB::table('subcategoryinformation')->where('id',$id)->first();
        if($data->status == 0)
            DB::table('subcategoryinformation')->where('id',$id)->update(['status' => 1]); 
        else
            DB::table('subcategoryinformation')->where('id',$id)->update(['status' => 0]); 

        return response()->json();
    }


    public function subcategorydelete($id)
    {
        $check = DB::table('subcategoryinformation')->where('id',$id)->first();
        if (isset($check->image)) 
        {
            unlink($check->image);
            DB::table('subcategoryinformation')->where('id',$id)->delete();
        }

        else
        {
            DB::table('subcategoryinformation')->where('id',$id)->delete();
        }
    }


    public function subcategoryedit($id)
    {
        $Item = DB::table('iteminformation')->where('status',1)->get();
        $Category = DB::table('categoryinformation')->where('status',1)->get();

        $Data = DB::table('subcategoryinformation')->where('subcategoryinformation.id',$id)
        ->leftjoin('iteminformation','iteminformation.id','subcategoryinformation.item_id')
        ->leftjoin('categoryinformation','categoryinformation.id','subcategoryinformation.category_id')
        ->select('subcategoryinformation.*','iteminformation.item_name','categoryinformation.category_name')
        ->first();
        return view ('backend.category.updatesubcategory',compact('Item','Category','Data'));
    }


    public function subcategoryupdate(Request $request, $id)
    {
        $data = array(
            'item_id' => $request->item_id,
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
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
                Image::make($Picture)->save('public/image/subcategoryimage/'.$image_one_name,80);
                $data['image']='public/image/subcategoryimage/'.$image_one_name;
                DB::table('subcategoryinformation')->where('id',$id)->update($data);
        }   

        else
        {
            DB::table('subcategoryinformation')->where('id',$id)->update($data);
        }
    }




}
