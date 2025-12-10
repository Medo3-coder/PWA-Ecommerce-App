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
    public function search(Request $request)
    {
        $query = $request->get('query', '');

        if (empty($query)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Search query required'
            ], 400);
        }

        $sliders = $this->sliderRepository->search($query);

        return response()->json([
            'status' => 'success',
            'data' => [
                'sliders' => $sliders
            ]
        ]);
    }

    /**
     * Get sliders by position
     */
    public function getByPosition($position)
    {
        $sliders = $this->sliderRepository->getByPosition($position);

        if ($sliders->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No sliders found for this position'
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
     * Get featured sliders
     */
    public function getFeatured()
    {
        $sliders = $this->sliderRepository->getFeatured();

        if ($sliders->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No featured sliders available'
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
