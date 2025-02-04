<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $siteContent = SiteContent::first();
        return view('admin.settings.index',compact('siteContent'));
    }

    public function UpdateSetting(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die();
        $siteContent = SiteContent::first();
        if(!$siteContent) {
            $siteContent = new SiteContent();
        }
        if($request->type == 'social') {

            $siteContent->instagram_link = $request->instagram;
            $siteContent->facebook_link = $request->facebook;
            $siteContent->linkedin_link = $request->linkedin;
            $siteContent->about_team = $request->about_team;
            // $siteContent->company_address = $request->company_address;


        } else if($request->type == 'general'){

            $siteContent->site_email = $request->comp_email;
            $siteContent->site_number = $request->comp_number;
            $siteContent->site_copyrights = $request->comp_copyright;
            $siteContent->site_message = $request->comp_message;
            $siteContent->company_address = $request->company_address;
            $siteContent->subscribe_sec_heading = $request->sub_sec_heading;
            $siteContent->subscribe_sec_text = $request->sub_sec_text;

            if ($request->hasFile('site_logo')) {
                $sfile = $request->file('site_logo');
                $site_logo = 'logo_' . time() . '.' . $sfile->extension();
                $sfile->move(public_path('lure/images'), $site_logo);
                $siteContent->site_logo = $site_logo;
            }

            if ($request->hasFile('footer_logo')) {
                $ffile = $request->file('footer_logo');
                $footer_logo = 'logoFooter_' . time() . '.' . $ffile->extension();
                $ffile->move(public_path('lure/images'), $footer_logo);
                $siteContent->footer_logo = $footer_logo;
            }
            
        } else {

            $siteContent->site_email = $request->comp_email ?? $siteContent->site_email;
            $siteContent->site_number = $request->comp_number ?? $siteContent->site_number;
            $siteContent->site_copyrights = $request->comp_copyright ?? $siteContent->site_copyrights;
            $siteContent->site_message = $request->comp_message ?? $siteContent->site_message;
            $siteContent->company_address = $request->company_address ?? $siteContent->company_address;
            $siteContent->instagram_link = $request->instagram ?? $siteContent->instagram_link;
            $siteContent->facebook_link = $request->facebook ?? $siteContent->facebook_link;
            $siteContent->linkedin_link = $request->linkedin ?? $siteContent->linkedin_link;
            $siteContent->about_team = $request->about_team ?? $siteContent->about_team;
            $siteContent->subscribe_sec_heading = $request->sub_sec_heading ?? $siteContent->subscribe_sec_heading;
            $siteContent->subscribe_sec_text = $request->sub_sec_text ?? $siteContent->subscribe_sec_text;

            if ($request->hasFile('footer_logo')) {
                $ffile = $request->file('footer_logo');
                $footer_logo = 'logoFooter_' . time() . '.' . $ffile->extension();
                $ffile->move(public_path('lure/images'), $footer_logo);
                $siteContent->footer_logo = $footer_logo;
            }

            if ($request->hasFile('site_logo')) {
                $sfile = $request->file('site_logo');
                $site_logo = 'logo_' . time() . '.' . $sfile->extension();
                $sfile->move(public_path('lure/images'), $site_logo);
                $siteContent->site_logo = $site_logo;
            }
        }

        $siteContent->save();

        return redirect()->back()->with('success','Data Updated Successfully');

    }

}
