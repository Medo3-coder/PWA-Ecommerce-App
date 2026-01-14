<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'data',
        'status',
        'is_read',
        'read_at',
        'sent_at',
        'channel',
        'notifiable_id',
        'notifiable_type',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data'     => 'json',
        'read_at'  => 'datetime',
        'sent_at'  => 'datetime',
        'is_read'  => 'boolean',
    ];

    /**
     * Get the notifiable entity (polymorphic relation)
     */
    public function notifiable()
    {
        return $this->morphTo();
    }

    /**
     * Get the user that owns the notification
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the logs for this notification
     */
    public function logs()
    {
        return $this->hasMany(NotificationLogs::class);
    }

    /**
     * Get the template used for this notification
     */
    public function template()
    {
        return $this->belongsTo(NotificationTemplate::class, 'type', 'type');
    }

    /**
     * Scope: Get unread notifications
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope: Get read notifications
     */
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    /**
     * Mark as read
     */
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }

    /**
     * Mark as unread
     */
    public function markAsUnread()
    {
        $this->update([
            'is_read' => false,
            'read_at' => null,
        ]);
    }
}
