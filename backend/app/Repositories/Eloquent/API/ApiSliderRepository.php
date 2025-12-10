<?php

namespace App\Repositories\Eloquent\API;

use App\Models\Slider;
use App\Repositories\Contracts\API\ApiSliderRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class ApiSliderRepository implements ApiSliderRepositoryInterface
{
    protected $model;

    public function __construct(Slider $model)
    {
        $this->model = $model;
    }

    /**
     * Get all active sliders, paginated
     */
    public function index($perPage = 15)
    {
        return Cache::remember('api.sliders.paginated', 3600, function () use ($perPage) {
            return $this->model
                ->active()
                ->latest()
                ->paginate($perPage);
        });
    }

    /**
     * Get active sliders for homepage display (cached, no pagination)
     */
    public function getActive()
    {
        return Cache::remember('api.sliders.active', 3600, function () {
            return $this->model
                ->active()
                ->latest()
                ->get();
        });
    }

    /**
     * Get a slider by ID
     */
    public function getById($id)
    {
        return Cache::remember("api.slider.{$id}", 3600, function () use ($id) {
            return $this->model->find($id);
        });
    }

    /**
     * Search sliders by title or description
     */
    // public function search($query, $limit = 10)
    // {
    //     return $this->model
    //         ->where('is_active', true)
    //         ->where(function ($q) use ($query) {
    //             $q->where('title', 'like', "%{$query}%")
    //                 ->orWhere('description', 'like', "%{$query}%");
    //         })
    //         ->latest()
    //         ->limit($limit)
    //         ->get();
    // }

    /**
     * Get sliders by position (hero, featured, etc)
     */
    // public function getByPosition($position)
    // {
    //     return Cache::remember("api.sliders.position.{$position}", 3600, function () use ($position) {
    //         return $this->model
    //             ->where('position', $position)
    //             ->where('is_active', true)
    //             ->latest()
    //             ->get();
    //     });
    // }

    /**
     * Get featured sliders
     */
    // public function getFeatured()
    // {
    //     return Cache::remember('api.sliders.featured', 3600, function () {
    //         return $this->model
    //             ->where('is_featured', true)
    //             ->where('is_active', true)
    //             ->latest()
    //             ->limit(5)
    //             ->get();
    //     });
    // }

    /**
     * Invalidate all slider caches
     */
    private function invalidateCache($id = null)
    {
        Cache::forget('api.sliders.paginated');
        Cache::forget('api.sliders.active');
        Cache::forget('api.sliders.featured');

        if ($id) {
            Cache::forget("api.slider.{$id}");
        }
    }
}
