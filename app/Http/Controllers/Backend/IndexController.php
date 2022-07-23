<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class IndexController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view ('backend.home');
    }


    public function customermessage()
    {
        $Data = DB::table('customermessage')->get();
        return view('backend.customer.customermessage',compact('Data'));
    }
}
