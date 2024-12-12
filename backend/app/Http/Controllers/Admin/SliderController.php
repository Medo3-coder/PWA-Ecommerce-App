<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function sliders()
    {
        $sliders = Slider::limit(3)->get();

        if($sliders->isEmpty()){
            return response()->json(['message'=> 'No sliders available now'] , 404);
        }

        return response()->json(['sliders' => $sliders], 200);
    }
}
