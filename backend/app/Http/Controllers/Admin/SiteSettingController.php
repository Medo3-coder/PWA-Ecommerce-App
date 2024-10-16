<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Traits\ResponseTrait;

class SiteSettingController extends Controller
{
    use ResponseTrait;
    public function siteSetting(){
            $siteInfo = SiteSetting::all();
            return response()->json($siteInfo, 200);

    }
}
