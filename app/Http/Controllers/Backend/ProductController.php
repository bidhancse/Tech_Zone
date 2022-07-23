<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Image;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function product()
    {
        $Item = DB::table('iteminformation')->where('status',1)->get();
        $Category = DB::table('categoryinformation')->where('status',1)->get();
        $Brand = DB::table('brandinformation')->where('status',1)->get();
        return view ('backend.product.product', compact('Item','Category','Brand'));
    }


    public function categoryget($item_id) {

        $Data = DB::table('categoryinformation')->where('item_id',$item_id)->get();
        return json_encode($Data);
    }


    public function subcategoryget($category_id) {

        $Data = DB::table('subcategoryinformation')->where('category_id',$category_id)->get();
        return json_encode($Data);
    }


    public function productinsert(Request $request)
    {
        $data = array(
            'product_code'       =>   $request->product_code,
            'product_name'       =>   $request->product_name,
            'item_id'            =>   $request->item_id,
            'category_id'        =>   $request->category_id,
            'subcategory_id'     =>   $request->subcategory_id,
            'brand_id'           =>   $request->brand_id,
            'purchase_price'     =>   $request->purchase_price,
            'sale_price'         =>   $request->sale_price,
            'discount_price'     =>   $request->discount_price,
            'quentity'           =>   $request->quentity,
            'measurement_type'   =>   $request->measurement_type,
            'short_details'      =>   $request->short_details,
            'full_details'       =>   $request->full_details,
            'product_size'       =>   $request->product_size,
            'product_color'      =>   $request->product_color,
            'stock_status'       =>   $request->stock_status,
            'status'             =>   $request->status,
            'admin_id'           =>   Auth()->user()->id,
        );

        $Picture = $request->file('image');

        if ($Picture) {
            $image_one_name= hexdec(uniqid()).'.'.$Picture->getClientOriginalExtension();
            Image::make($Picture)->save('public/image/productimage/'.$image_one_name,80);
            $data['image']='public/image/productimage/'.$image_one_name;
            DB::table('Productinformation')->insert($data);

        }

        else {
            DB::table('Productinformation')->insert($data);
        }
    }


    public function manageproduct(){
        $Data = DB::table('productinformation')
        ->leftjoin('iteminformation','iteminformation.id','productinformation.item_id')
        ->leftjoin('brandinformation','brandinformation.id','productinformation.brand_id')
        ->select('productinformation.*','iteminformation.item_name','brandinformation.brand_name')
        ->get();
        return view('backend.product.manageproduct', compact('Data'));
    }


    public function stockstatus(Request $request, $id)
    {
        $Data=DB::table('productinformation')->where('id',$id)->first();
        if($Data->stock_status == 0)
            DB::table('productinformation')->where('id',$id)->update(['stock_status' => 1]); 
        else
            DB::table('productinformation')->where('id',$id)->update(['stock_status' => 0]); 

        return response()->json();
    }


    public function productstatus(Request $request, $id)
    {
        $Data=DB::table('productinformation')->where('id',$id)->first();
        if($Data->status == 0)
            DB::table('productinformation')->where('id',$id)->update(['status' => 1]); 
        else
            DB::table('productinformation')->where('id',$id)->update(['status' => 0]); 

        return response()->json();
    }


    public function productdelete($id)
    {
        $check = DB::table('productinformation')->where('id',$id)->first();
        if (isset($check->image)) 
        {
            unlink($check->image);
            DB::table('productinformation')->where('id',$id)->delete();
        }

        else
        {
            DB::table('productinformation')->where('id',$id)->delete();
        }
    }


    public function productedit($id)
    {
        $Item = DB::table('iteminformation')->where('status',1)->get();
        $Category = DB::table('categoryinformation')->where('status',1)->get();
        $SubCategory = DB::table('subcategoryinformation')->where('status',1)->get();
        $Brand = DB::table('brandinformation')->where('status',1)->get();

        $Data = DB::table('productinformation')->where('productinformation.id',$id)
       ->leftjoin('iteminformation','iteminformation.id','productinformation.item_id')
       ->leftjoin('categoryinformation','categoryinformation.id','productinformation.category_id')
       ->leftjoin('subcategoryinformation','subcategoryinformation.id','productinformation.subcategory_id')
       ->leftjoin('brandinformation','brandinformation.id','productinformation.brand_id')
       ->select('productinformation.*','iteminformation.item_name','categoryinformation.category_name','subcategoryinformation.subcategory_name','brandinformation.brand_name')
       ->first();
        return view('backend.product.updateproduct',compact('Item','Category','SubCategory','Brand','Data'));
    }


    public function productupdate(Request $request, $id)
    {
        $data = array(
            'product_code'       =>   $request->product_code,
            'product_name'       =>   $request->product_name,
            'item_id'            =>   $request->item_id,
            'category_id'        =>   $request->category_id,
            'subcategory_id'     =>   $request->subcategory_id,
            'brand_id'           =>   $request->brand_id,
            'purchase_price'     =>   $request->purchase_price,
            'sale_price'         =>   $request->sale_price,
            'discount_price'     =>   $request->discount_price,
            'quentity'           =>   $request->quentity,
            'measurement_type'   =>   $request->measurement_type,
            'short_details'      =>   $request->short_details,
            'full_details'       =>   $request->full_details,
            'product_size'       =>   $request->product_size,
            'product_color'      =>   $request->product_color,
            'stock_status'       =>   $request->stock_status,
            'status'             =>   $request->status,
            'admin_id'           =>   Auth()->user()->id,
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
            Image::make($Picture)->save('public/image/productimage/'.$image_one_name,80);
            $data['image']='public/image/productimage/'.$image_one_name;
            DB::table('productinformation')->where('id',$id)->update($data);

        }   

        else
        {
            DB::table('productinformation')->where('id',$id)->update($data);
        }
    }


    public function viewallproduct()
    {
        $ProductData = DB::table('productinformation')->orderBy('id','DESC')
        ->leftjoin('iteminformation','iteminformation.id','productinformation.item_id')
        ->leftjoin('categoryinformation','categoryinformation.id','productinformation.category_id')
        ->leftjoin('subcategoryinformation','subcategoryinformation.id','productinformation.subcategory_id')
        ->leftjoin('brandinformation','brandinformation.id','productinformation.brand_id')
        ->select('productinformation.*','iteminformation.item_name','categoryinformation.category_name','subcategoryinformation.subcategory_name','brandinformation.brand_name')
        ->get();

        return view('backend.product.viewallproduct',compact('ProductData'));
    }

    
}
