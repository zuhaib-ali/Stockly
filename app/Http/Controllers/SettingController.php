<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function update(Request $request){
        $settings = Setting::find(1);
        $settings->filler = $request->filler;
        $settings->non_filler = $request->non_filler;
        $settings->update();
        return back();
    }
}
