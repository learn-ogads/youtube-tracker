<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Video extends Model
{
    /** @use HasFactory<\Database\Factories\VideoFactory> */
    use HasFactory;

    protected $fillable = [
        'thumbnail',
        'title',
        'url',
        'shortcode',
        'status',
        'keyword',
        'category_id'
    ];

    public function latestStatistics(): ?VideoStatistic
    {
        return $this->statistics()->latest()->first();
    }

    public function statistics(): HasMany
    {
        return $this->hasMany(VideoStatistic::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function ranks(): HasMany
    {
        return $this->hasMany(VideoRank::class);
    }

    public function mostRecentRank(): ?VideoRank
    {
        return $this->ranks()->latest()->first();
    }
}
