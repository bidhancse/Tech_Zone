<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class IndexController extends Controller
{


    public function index()
    {
        $Slider = DB::table('sliderinformation')->orderBy('id', 'DESC')->get();
        $Item = DB::table('iteminformation')->where('status', 1)->skip(1)->limit('8')->get();
        $Category = DB::table('categoryinformation')->where('status', 1)->get();
        $SubCategory = DB::table('subcategoryinformation')->where('status', 1)->get();
        $Brand = DB::table('brandinformation')->where('status', 1)->limit(16)->inRandomOrder()->get();
        return view('frontend.home', compact('Slider', 'Item', 'Category', 'SubCategory', 'Brand'));
    }


    public function product($id)
    {
        $ProductDetails = DB::table('productinformation')->where('productinformation.id', $id)
            ->leftjoin('iteminformation', 'iteminformation.id', 'productinformation.item_id')
            ->leftjoin('categoryinformation', 'categoryinformation.id', 'productinformation.category_id')
            ->leftjoin('subcategoryinformation', 'subcategoryinformation.id', 'productinformation.subcategory_id')
            ->select('productinformation.*', 'iteminformation.item_name', 'categoryinformation.category_name', 'subcategoryinformation.subcategory_name')
            ->first();
        $ProductColor = explode(',', $ProductDetails->product_color);
        $ReletedProduct = DB::table('productinformation')->where('item_id', $ProductDetails->item_id)->get();
        return view('frontend.pages.productdetails', compact('ProductDetails', 'ProductColor', 'ReletedProduct'));
    }


    public function allbrands()
    {
        $Brand = DB::table('brandinformation')->where('status', 1)->inRandomOrder()->get();
        return view('frontend.pages.brands', compact('Brand'));
    }


    public function Item($id, $item_name)
    {
        $ItemProduct = DB::table('productinformation')->where('item_id', $id)->paginate(8);
        $ItemName = DB::table('iteminformation')->where('id', $id)->first();
        $CategoryName = DB::table('categoryinformation')->where('item_id', $id)->get();
        $BrandName = DB::table('productinformation')->where('item_id', $id)
            ->leftjoin('brandinformation', 'brandinformation.id', 'productinformation.brand_id')
            ->select('productinformation.*', 'brandinformation.brand_name')
            ->groupby('productinformation.brand_id')
            ->get();

        return view('frontend.pages.item', compact('ItemProduct', 'ItemName', 'CategoryName', 'BrandName'));
    }


    public function category($id, $category_name)
    {
        $CategoryProduct = DB::table('productinformation')->where('category_id', $id)->paginate(8);
        $ItemCateName = DB::table('categoryinformation')->where('categoryinformation.id', $id)
            ->leftjoin('iteminformation', 'iteminformation.id', 'categoryinformation.item_id')
            ->select('categoryinformation.*', 'iteminformation.item_name')
            ->first();
        $SubCategoryName = DB::table('subcategoryinformation')->where('category_id', $id)->get();
        return view('frontend.pages.category', compact('CategoryProduct', 'ItemCateName', 'SubCategoryName'));
    }


    public function subcategory($id, $subcategory_name)
    {
        $SubCategoryProduct = DB::table('productinformation')->where('subcategory_id', $id)->paginate(8);
        $ItemCateName = DB::table('subcategoryinformation')->where('subcategoryinformation.id', $id)
            ->leftjoin('iteminformation', 'iteminformation.id', 'subcategoryinformation.item_id')
            ->leftjoin('categoryinformation', 'categoryinformation.id', 'subcategoryinformation.category_id')
            ->select('subcategoryinformation.*', 'iteminformation.item_name', 'categoryinformation.category_name')
            ->first();
        return view('frontend.pages.subcategory', compact('SubCategoryProduct', 'ItemCateName'));
    }


    public function serachproduct(Request $request)
    {
        $search = $request->searchdata;
        $ProductSearch = DB::table('productinformation')
            ->where('product_name', 'like', '%' . $search . '%')
            ->where('status', 1)->orderBy('id', 'DESC')
            ->get();
        return view('frontend.pages.serachproduct', compact('ProductSearch'));
    }


    public function brandproduct($id)
    {
        $BrandProduct = DB::table('productinformation')->where('brand_id', $id)->orderBy('id', 'DESC')->paginate(12);
        $BrandName = DB::table('brandinformation')->where('id', $id)->first();
        return view('frontend.pages.brandproduct', compact('BrandProduct', 'BrandName'));
    }


    public function aboutus()
    {
        $About = DB::table('aboutinformation')->first();
        return view('frontend.pages.aboutus', compact('About'));
    }


    public function faq()
    {
        $FAQ = DB::table('faq')->get();
        return view('frontend.pages.faq', compact('FAQ'));
    }


    public function contactus()
    {
        $ContactInfo = DB::table('settinginformation')->first();
        $Address = DB::table('contactinformation')->first();
        return view('frontend.pages.contact', compact('ContactInfo', 'Address'));
    }


    public function privacypolicy()
    {
        $PrivacyPolicy = DB::table('privacypolicy')->first();
        return view('frontend.pages.privacypolicy', compact('PrivacyPolicy'));
    }


    public function termconditions()
    {
        $TermConditions = DB::table('termcondition')->first();
        return view('frontend.pages.termconditions', compact('TermConditions'));
    }


    public function buyingprocess()
    {
        $BuyingProcess = DB::table('howtobuy')->first();
        return view('frontend.pages.buyingprocess', compact('BuyingProcess'));
    }
}