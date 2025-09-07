<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Entry extends Model
{
    protected $fillable = [
        'user_id',
        'team_id',
        'title',
        'description',
        'slug',
        'content',
    ];

    protected static function booted()
    {
        static::creating(function ($entry) {
            if (empty($entry->slug)) {
                $entry->slug = Str::slug($entry->title);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
