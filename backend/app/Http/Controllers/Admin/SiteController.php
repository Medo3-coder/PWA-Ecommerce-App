<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use App\Models\SiteSetting;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class SiteController extends Controller
{
    use ResponseTrait;

    /**
     * Get content by type
     */
    public function getContent($type)
    {
        $content = Cache::remember("content.{$type}", 3600, function() use ($type) {
            return SiteContent::where('type', $type)
                ->latest()
                ->first();
        });

        if (!$content) {
            return $this->response('error', 'Content not found');
        }

        return $this->successReturn(
            'Content retrieved successfully',
            [
                'content' => $content->content,
                'version' => $content->version
            ]
        );
    }

    /**
     * Update content by type
     */
    public function updateContent(Request $request, $type)
    {
        $request->validate([
            'content' => 'required|string|max:10000',
            'type' => 'required|in:about,refund,privacy,purchase_guide'
        ]);

        $content = SiteContent::updateOrCreate(
            ['type' => $type],
            [
                'content' => $request->content,
                'version' => Str::random(10)
            ]
        );

        Cache::forget("content.{$type}");

        return $this->successReturn(
            'Content updated successfully',
            $content
        );
    }

    /**
     * Get all settings
     */
    public function getSettings()
    {
        $settings = Cache::remember('site_settings', 3600, function() {
            return SiteSetting::pluck('value', 'key')->toArray();
        });

        return $this->successReturn(
            'Settings retrieved successfully',
            $settings
        );
    }

    /**
     * Update settings
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'required|string'
        ]);

        foreach ($request->settings as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Cache::forget('site_settings');

        return $this->successReturn(
            'Settings updated successfully',
            $request->settings
        );
    }
}
