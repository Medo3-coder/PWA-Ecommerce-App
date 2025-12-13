<?php
namespace App\Repositories\Contracts\API;

interface ApiProductRepositoryInterface
{
    /**
     * Search products by title or brand
     */
    public function search($query, $limit = 20);

    /**
     * Get all published products (paginated)
     */
    public function getAllPublished($perPage = 15);

    /**
     * Get a single product by ID with relations
     */
    public function getById($id);

    /**
     * Get products by category
     */
    public function getByCategory($categoryId, $perPage = 12);

    /**
     * Get products by remark/tag
     */
    public function getByRemark($remark, $limit = 20);

    /**
     * Get homepage sections with products
     */
    public function getHomepageSections();

    /**
     * Get products by section
     */
    public function getBySection($sectionId, $limit = 8);

    /**
     * Get featured/top rated products
     */
    public function getFeatured($limit = 10);

    /**
     * Get new/latest products
     */
    public function getLatest($limit = 10);
    /**
     * Get best-selling products
     */
    public function getBestSellers($limit = 10);
    /**
     * Get related products based on category
     */
    public function getRelatedProducts($productId, $limit = 6);


    public function getBySectionName($sectionName, $limit = 8);
    /**
     * Clear cache for a specific product
     */
    public function clearProductCache($productId);
    /**
     * Clear all product-related caches
     */
    public function clearAllProductCaches();

}
