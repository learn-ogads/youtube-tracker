<?php

use App\Models\Video;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('video_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Video::class)->constrained()->cascadeOnDelete();
            $table->integer('views');
            $table->integer('likes');
            $table->integer('favorites');
            $table->integer('comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_statistics');
    }
};
