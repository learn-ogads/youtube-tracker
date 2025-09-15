<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VideoStatistic extends Model
{
    /** @use HasFactory<\Database\Factories\VideoStatisticFactory> */
    use HasFactory;

    protected $fillable = [
        'video_id',
        'views',
        'likes',
        'favorites',
        'comments',
    ];

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
}
