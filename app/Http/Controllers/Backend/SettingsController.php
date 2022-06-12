<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Image;
use App\SiteInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit(Request $request){
        $site_info = SiteInfo::first();
        if ($request->isMethod('post')) {
            $site_info->site_name = $request->site_name;
            $site_info->short_about = $request->short_about;
            $site_info->phone = $request->phone;
            $site_info->email = $request->email;
            $site_info->address = $request->address;
            $site_info->map_embed = $request->map_embed;
            $site_info->user_id = Auth::user()->id;

            if ($request->hasFile('header_logo')) {
                // header_logo
                if (file_exists('images/logo/'.$site_info->header_logo) && !empty($site_info->header_logo)) {
                    @unlink('images/logo/'.$site_info->header_logo);
                }
                $extension = strtolower($request->file('header_logo')->getClientOriginalExtension());
                $file_name = time().'.'.$extension;
                $header_logo = Image::make($request->header_logo)->resize(180, 56);
                $header_logo->save('images/logo/'.$file_name);
                $site_info->header_logo = $file_name;
            }
            if ($request->hasFile('footer_logo')) {
                // footer_logo
                if (file_exists('images/logo/'.$site_info->footer_logo) && !empty($site_info->footer_logo)) {
                    @unlink('images/logo/'.$site_info->footer_logo);
                }
                $extension = strtolower($request->file('footer_logo')->getClientOriginalExtension());
                $file_name = time().'1.'.$extension;
                $footer_logo = Image::make($request->footer_logo)->resize(180, 56);
                $footer_logo->save('images/logo/'.$file_name);
                $site_info->footer_logo = $file_name;
            }
            $site_info->save();
            return redirect(route('site-info'))->with('flash_success','
                <script>
                Toast.fire({
                  icon: `success`,
                  title: `Site information successfully added`
                })
                </script>
                ');
        }
        return view("settings.site_info")->with(compact('site_info'));
    }
}
