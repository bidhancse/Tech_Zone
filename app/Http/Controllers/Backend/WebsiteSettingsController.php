<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Image;

class WebsiteSettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function about()
    {
        $Data = DB::table('aboutinformation')->first();
        return view ('backend.website_setting.about', compact('Data'));
    }


    public function aboutupdate(Request $request, $id) {

        $Data = array(

            'details' => $request->details,
            'admin_id' => Auth()->user()->id,
        );

        DB::table('aboutinformation')->where('id',$id)->update($Data);

    }


    public function settings()
    {
        $Data = DB::table('settinginformation')->first();
        return view ('backend.website_setting.setting', compact('Data'));
    }


    public function settingsupdate(Request $request, $id) {
        $data = array(
            'admin_id'  => Auth()->user()->id,
            'title'     => $request->title,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'facebook'  => $request->facebook,
            'twitter'   => $request->twitter,
            'instagram' => $request->instagram,
            'youtube'   => $request->youtube,
        );

        $newimage = $request->file('image');
        $faviconimage = $request->file('favicon');
        $oldimage = DB::table('settinginformation')->first();


        if ($newimage) {
            if ($oldimage->image) {
                unlink($oldimage->image);
            }

            $image_one_name= hexdec(uniqid()).'.'.$newimage->getClientOriginalExtension();
            Image::make($newimage)->save('public/image/settingimage/'.$image_one_name,100);
            $data['image']='public/image/settingimage/'.$image_one_name;
            DB::table('settinginformation')->where('id',$id)->update($data);
        }

        else{
            DB::table('settinginformation')->where('id',$id)->update($data);
        }

        if ($faviconimage) {
            if ($oldimage->favicon) {
                unlink($oldimage->favicon);
            }

            $image_one_name= hexdec(uniqid()).'.'.$faviconimage->getClientOriginalExtension();
            Image::make($faviconimage)->save('public/image/settingimage/'.$image_one_name,100);
            $data['favicon']='public/image/settingimage/'.$image_one_name;
            DB::table('settinginformation')->where('id',$id)->update($data);
        }

        else{
            DB::table('settinginformation')->where('id',$id)->update($data);
        }

    }


    public function contact()
    {
        $Data = DB::table('contactinformation')->first();
        return view ('backend.website_setting.contact', compact('Data'));
    }


    public function contactupdate(Request $request, $id) {

        $Data = array(

            'details' => $request->details,
            'admin_id' => Auth()->user()->id,
        );

        DB::table('contactinformation')->where('id',$id)->update($Data);

    }


    public function privacypolicy()
    {
        $Data = DB::table('privacypolicy')->first();
        return view ('backend.website_setting.privacypolicy', compact('Data'));
    }


    public function privacypolicyupdate(Request $request, $id) {

        $Data = array(

            'details' => $request->details,
            'admin_id' => Auth()->user()->id,
        );

        DB::table('privacypolicy')->where('id',$id)->update($Data);

    }


    public function termcondition()
    {
        $Data = DB::table('termcondition')->first();
        return view ('backend.website_setting.termcondition', compact('Data'));
    }


    public function termconditionupdate(Request $request, $id) {

        $Data = array(

            'details' => $request->details,
            'admin_id' => Auth()->user()->id,
        );

        DB::table('termcondition')->where('id',$id)->update($Data);

    }


    public function howtobuy()
    {
        $Data = DB::table('howtobuy')->first();
        return view ('backend.website_setting.howtobuy', compact('Data'));
    }


    public function howtobuyupdate(Request $request, $id) {

        $Data = array(

            'details' => $request->details,
            'admin_id' => Auth()->user()->id,
        );

        DB::table('howtobuy')->where('id',$id)->update($Data);

    }


    public function faq()
    {
        return view ('backend.website_setting.faq');
    }


    public function faqinsert(Request $request)
    {
        $Data = array(
            'question'        => $request->question,
            'details' => $request->details,
            'admin_id'  => Auth()->user()->id,
        );

        DB::table('faq')->insert($Data);
    }


    public function managefaq(){
        $Data = DB::table('faq')->get();
        return view('backend.website_setting.managefaq', compact('Data'));
    }


    public function faqdelete($id) {

        DB::table('faq')->where('id',$id)->delete();

    }


    public function faqedit($id) {
        $Data = DB::table('faq')->where('id',$id)->first();
        return view('backend.website_setting.updatefaq', compact('Data'));
    }


    public function faqupdate(Request $request, $id) {

        $Data = array(
            'question'        => $request->question,
            'details' => $request->details,
            'admin_id'  => Auth()->user()->id,
        );

        DB::table('faq')->where('id',$id)->update($Data);

    }



}
