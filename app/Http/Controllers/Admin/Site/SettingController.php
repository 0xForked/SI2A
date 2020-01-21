<?php

namespace App\Http\Controllers\Admin\Site;

use App\Models\Setting;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = app_settings();
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $files = $disk->files(config('backup.backup.name'));
        $backups = [];
        foreach ($files as $k => $f) {
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => $disk->lastModified($f),
                ];
            }
        }
        $backups = array_reverse($backups);
        $roles = Role::all();
        return view('admin.settings.app-setting', compact('settings', 'backups', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateGeneralData(Request $request)
    {
        $data = (Object)$request->only(
            'site_title',
            'site_description',
            'site_logo',
            'site_favicon'
        );
        foreach ($data as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($value != NULL) {
                if ($setting->value != $value) {
                    if ($key == 'site_logo') {
                        $this->validate($request, [
                            'site_logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                        ]);
                    }
                    if ($key == 'site_favicon') {
                        $this->validate($request, [
                            'site_favicon' => 'required|image|mimes:jpeg,png,jpg,svg,ico|max:128',
                        ]);
                    }
                    if (is_file($value)) {
                        $file_name = time()."_{$key}.{$value->getClientOriginalExtension()}";
                        $file_path = 'assets/img/sites';
                        $value->move($file_path, $file_name);
                        $value = $file_name;
                    }
                    $setting->value = $value;
                    $setting->save();
                }
            }
        }
        return redirect()->back()->with('success', 'Action success with out errors');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateContactData(Request $request)
    {
        $data = (Object)$request->only(
            'site_address',
            'site_phone',
            'site_email',
            'site_facebook_link',
            'site_twitter_link',
            'site_instagram_link',
            'site_address_coordinate'
        );
        foreach ($data as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($value != NULL) {
                if ($key == 'site_address_coordinate')
                    $value = json_encode([$request->site_lat, $request->site_lng]);
                $setting->value = $value;
                $setting->save();
            }
        }
        return redirect()->back()->with('success', 'Action success with out errors');
    }

    public function updateAuthData(Request $request)
    {
        $data = (Object)$request->only(
            'site_auth_password_reset',
            'site_auth_registration',
            'site_auth_email_verify',
            'site_new_user_role'
        );

        if(isset($data->site_auth_password_reset)) {
            $setting = Setting::where('key', 'site_auth_password_reset')->first();
            $setting->value = 1;
            $setting->save();
        } else {
            $setting = Setting::where('key', 'site_auth_password_reset')->first();
            $setting->value = 0;
            $setting->save();
        }

        if(isset($data->site_auth_registration)) {
            $setting = Setting::where('key', 'site_auth_registration')->first();
            $setting->value = 1;
            $setting->save();
        } else {
            $setting = Setting::where('key', 'site_auth_registration')->first();
            $setting->value = 0;
            $setting->save();
        }

        if(isset($data->site_auth_email_verify)) {
            $setting = Setting::where('key', 'site_auth_email_verify')->first();
            $setting->value = 1;
            $setting->save();
        } else {
            $setting = Setting::where('key', 'site_auth_email_verify')->first();
            $setting->value = 0;
            $setting->save();
        }

        if (isset($data->site_new_user_role)) {
            $setting = Setting::where('key', 'site_new_user_role')->first();
            $setting->value = $data->site_new_user_role;
            $setting->save();
        } else {
            $setting = Setting::where('key', 'site_new_user_role')->first();
            $setting->value = 3;
            $setting->save();
        }

        return redirect()->back()->with('success', 'Action success with out errors');
    }

    public function updateTransactionTable(Request $request)
    {
        $data = (Object)$request->only(
            'site_tax_purchase',
            'site_tax_selling',
        );

        foreach ($data as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($value != NULL) {
                if ($setting->value != $value) {
                    $setting->value = $value;
                    $setting->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Action success with out errors');
    }

}
