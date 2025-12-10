<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\API\ApiSliderRepositoryInterface;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function __construct(private ApiSliderRepositoryInterface $sliderRepository)
    {
    }

    /**
     * Get all active sliders (paginated)
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $sliders = $this->sliderRepository->index($perPage);

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

    /**
     * Get active sliders for homepage
     */
    public function getActive()
    {
        $sliders = $this->sliderRepository->getActive();

        if ($sliders->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No active sliders available'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'sliders' => $sliders
            ]
        ]);
    }

    /**
     * Get a slider by ID
     */
    public function show($id)
    {
        $slider = $this->sliderRepository->getById($id);

        if (!$slider) {
            return response()->json([
                'status' => 'error',
                'message' => 'Slider not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'slider' => $slider
            ]
        ]);
    }

    /**
     * Search sliders
     */
   



}
