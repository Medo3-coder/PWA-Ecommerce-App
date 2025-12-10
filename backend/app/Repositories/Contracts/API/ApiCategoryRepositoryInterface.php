<?php

namespace App\Repositories\Contracts\API;

interface ApiCategoryRepositoryInterface
{
    public function index();
    public function show($slug);
    public function products($slug, $perPage = 12);
    public function breadcrumb($slug);
    public function search($query, $limit = 10);
}
