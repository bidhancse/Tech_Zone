<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use DB;
Use Image;
Use Auth;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function allorderinfo()
    {
        $AllOrder=DB::table('invoiceinformation')->get();
        return view('backend.orderinformation.orderinformation',compact('AllOrder'));
    }


    public function pendingorder()
    {
        $PendingOrder=DB::table('invoiceinformation')->where('status',0)->get();
        return view('backend.orderinformation.pendingorder',compact('PendingOrder'));
    }


    public function processingorder()
    {
        $ProcessingOrder=DB::table('invoiceinformation')->where('status',1)->get();
        return view('backend.orderinformation.processingorder',compact('ProcessingOrder'));
    }


    public function shippingorder()
    {
        $ShippingOrder=DB::table('invoiceinformation')->where('status',2)->get();
        return view('backend.orderinformation.shippingorder',compact('ShippingOrder'));
    }


    public function completeorder()
    {
        $CompletdOrder=DB::table('invoiceinformation')->where('status',3)->get();
        return view('backend.orderinformation.completdorder',compact('CompletdOrder'));
    }


    public function changeorderstatus(Request $request, $id)
    {
        DB::table('invoiceinformation')->where('id',$id)->update(['status' => $request->status ]);
        return redirect()->back();
    }


    public function orderreport()
    {
        return view('backend.orderinformation.orderreport');
    }


    public function orderreportshowing(Request $request)
    {
        $dataForm = $request->fromdate;
        $dataTo = $request->todate;
 
        $OrderReportInfo = DB::table('invoiceinformation')
           ->where('order_date', '>=', $dataForm)
           ->where('order_date', '<=', $dataTo)
           ->leftjoin('orderdetails','orderdetails.invoice_id','invoiceinformation.id')
           ->select('invoiceinformation.*','orderdetails.total_price','orderdetails.invoice_id')
           ->get();

           return view('backend.orderinformation.searchorderreport', compact('OrderReportInfo'));
    }


    public function invoice($id)
    {
        $CustomerInfo = DB::table('invoiceinformation')->where('id',$id)->first();
        $OrderProductInfo = DB::table('orderdetails')->where('orderdetails.invoice_id',$id)
        ->leftjoin('productinformation','productinformation.id','orderdetails.product_id')
        ->select('orderdetails.*','productinformation.product_name')
        ->get();

        return view('backend.orderinformation.invoice', compact('CustomerInfo','OrderProductInfo'));
    }


}
