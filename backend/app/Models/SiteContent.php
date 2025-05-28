<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * SiteContent Model
 *
 * This model handles the storage and retrieval of different types of site content
 * such as About Us, Privacy Policy, Terms and Conditions, etc.
 */
class SiteContent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',      // The type of content (e.g., 'about', 'privacy')
        'content',   // The actual HTML content
        'version'    // Unique version identifier for content tracking
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'content' => 'string'  // Ensure content is always treated as a string
    ];

    /**
     * Get the latest version of content by type
     *
     * @param string $type
     * @return SiteContent|null
     */
    public static function getLatestByType($type)
    {
        return static::where('type', $type)
            ->latest()
            ->first();
    }

    /**
     * Check if content has been updated
     *
     * @param string $version
     * @return bool
     */
    public function isUpdated($version)
    {
        return $this->version !== $version;
    }
}
