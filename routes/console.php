<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:get-video-stats')->hourly();
Schedule::command('app:get-video-ranks')->daily();
