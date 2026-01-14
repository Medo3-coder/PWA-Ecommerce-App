<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationTemplate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'subject',
        'body',
        'type',
        'variables',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'variables' => 'json',
    ];

    /**
     * Get notifications using this template
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'type', 'type');
    }

    /**
     * Render template with variables
     */
    public function render(array $data = [])
    {
        $subject = $this->subject;
        $body = $this->body;

        foreach ($data as $key => $value) {
            $placeholder = '{{' . $key . '}}';
            $subject = str_replace($placeholder, $value, $subject);
            $body = str_replace($placeholder, $value, $body);
        }

        return [
            'subject' => $subject,
            'body'    => $body,
        ];
    }

    /**
     * Scope: Get templates by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}
