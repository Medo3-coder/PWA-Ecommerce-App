<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationSettings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'email_enabled',
        'sms_enabled',
        'realtime_enabled',
        'notification_types',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_enabled'     => 'boolean',
        'sms_enabled'       => 'boolean',
        'realtime_enabled'  => 'boolean',
        'notification_types' => 'json',
    ];

    /**
     * Get the user that owns these settings
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if a specific notification type is enabled
     */
    public function isTypeEnabled($type)
    {
        $types = $this->notification_types ?? [];
        return $types[$type] ?? false;
    }

    /**
     * Enable a specific notification type
     */
    public function enableType($type)
    {
        $types = $this->notification_types ?? [];
        $types[$type] = true;
        $this->update(['notification_types' => $types]);
    }

    /**
     * Disable a specific notification type
     */
    public function disableType($type)
    {
        $types = $this->notification_types ?? [];
        $types[$type] = false;
        $this->update(['notification_types' => $types]);
    }

    /**
     * Enable all notification types
     */
    public function enableAll()
    {
        $this->update([
            'email_enabled'    => true,
            'sms_enabled'      => true,
            'realtime_enabled' => true,
        ]);
    }

    /**
     * Disable all notifications
     */
    public function disableAll()
    {
        $this->update([
            'email_enabled'    => false,
            'sms_enabled'      => false,
            'realtime_enabled' => false,
        ]);
    }
}
