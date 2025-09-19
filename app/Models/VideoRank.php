<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VideoRank extends Model
{
    /** @use HasFactory<\Database\Factories\VideoRankFactory> */
    use HasFactory;

    protected $fillable = [
        'rank',
        'video_id'
    ];

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }

}
