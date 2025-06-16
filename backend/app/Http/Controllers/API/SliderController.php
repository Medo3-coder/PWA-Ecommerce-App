<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Support\Facades\Cache;

class SliderController extends Controller
{
    public function index()
    {
        // Cache the sliders for 1 hour
        $sliders = Cache::remember('api.sliders', 3600, function () {
            return Slider::active()
                ->latest()
                ->get();
        });

        if ($sliders->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No sliders available'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'sliders' => $sliders
            ]
        ]);
    }
}
