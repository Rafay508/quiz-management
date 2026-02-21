<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Http\Requests\Admin\UpdateSiteSettingRequest;
use App\Http\Requests\Admin\UpdateQuizSettingRequest;

class SiteSettingsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $records = SiteSetting::find(1);
 
        return view('admin.site-settings', compact('records'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateSiteSettingRequest $request, $id)
    {
        // check logo if exists
        if ($request->hasfile('logo')) {

            //move | upload file on server
            $file      = $request->file('logo');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename  = 'logo-'.time() . '.' . $extension;
            $file->move(uploadsDir('front'), $filename);

            //check if upload successfully
            if (file_exists(uploadsDir('front') . $filename)
                && !empty($request->previous_logo && file_exists(uploadsDir('front').$request->previous_logo))
            ) {
                unlink(uploadsDir('front') . $request->previous_logo);
            }
        } else {
            $filename = $request->previous_logo;
        }

        // check favicon if exists
        if ($request->hasfile('favicon')) {

            //move | upload file on server
            $file      = $request->file('favicon');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $favicon   = 'favicon-'.time() . '.' . $extension;
            $file->move(uploadsDir('front'), $favicon);

            //check if upload successfully
            if (file_exists(uploadsDir('front') . $favicon)
                && !empty($request->previous_favicon && file_exists(uploadsDir('front').$request->previous_favicon))
            ) {
                unlink(uploadsDir('front') . $request->previous_favicon);
            }
        } else {
            $favicon = $request->previous_favicon;
        }

        // check home banner if exists
        if ($request->hasfile('home_banner')) {

            //move | upload file on server
            $file      = $request->file('home_banner');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $home_banner = 'home_banner-'.time() . '.' . $extension;
            $file->move(uploadsDir('front'), $home_banner);

            //check if upload successfully
            if (file_exists(uploadsDir('front') . $home_banner)
                && !empty($request->previous_home_banner && file_exists(uploadsDir('front').$request->previous_home_banner))
            ) {
                unlink(uploadsDir('front') . $request->previous_home_banner);
            }
        } else {
            $home_banner = $request->previous_home_banner;
        }

        $data = $request->except([
            '_token',
            '_method',
            'previous_logo',
            'previous_favicon',
            'previous_small_logo',
            'previous_home_banner',
            'home_banner'
        ]);

        $data['logo']        = $filename;
        $data['favicon']     = $favicon;
        $data['home_banner'] = $home_banner;

        SiteSetting::where('id', $id)->update($data);

        return redirect()
            ->route('admin.site-settings.index')
            ->with('success', 'Site settings has been updated successfully!');
    }

    public function addSetting()
    {
        $records = SiteSetting::find(1);

        return view('admin.adds-settings', compact('records'));
    }

    public function addSettingUpdate(Request $request, $id)
    {
        $data = $request->except([
            '_token',
            '_method',
        ]);

        SiteSetting::where('id', $id)->update($data);

        return redirect()
            ->route('admin.adds.settings')
            ->with('success', 'Adds settings has been updated successfully!');
    }

    /**
     * Display quiz settings page.
     *
     * @return Response
     */
    public function quizSettings()
    {
        $records = SiteSetting::find(1);

        return view('admin.quiz-settings', compact('records'));
    }

    /**
     * Update quiz settings.
     *
     * @param  UpdateQuizSettingRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function updateQuizSettings(UpdateQuizSettingRequest $request, $id)
    {
        $data = $request->except([
            '_token',
            '_method',
        ]);

        // Convert checkbox values to boolean
        $data['shuffle_questions'] = $request->has('shuffle_questions') ? true : false;
        $data['shuffle_options'] = $request->has('shuffle_options') ? true : false;
        $data['show_result_immediately'] = $request->has('show_result_immediately') ? true : false;

        SiteSetting::where('id', $id)->update($data);

        return redirect()
            ->route('admin.quiz-settings.index')
            ->with('success', 'Quiz settings has been updated successfully!');
    }
}
