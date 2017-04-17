<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit()
    {   
        return view('admin.settings.edit');
    }

    public function update(Request $request)
    {
        SettingService::sync($request->input('settings', []));
        
        return redirect()
            ->route('settings')
            ->with('notice', trans('settings.notices.updated'));
    }
}
