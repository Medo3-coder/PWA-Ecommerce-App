<?php

namespace App\Repositories\Contracts\API;

interface ApiSliderRepositoryInterface
{
    /**
     * Get all active sliders, paginated
     */
    public function index($perPage = 15);

    /**
     * Get active sliders for homepage display
     */
    public function getActive();

    /**
     * Get a slider by ID
     */
    public function getById($id);

   
}
