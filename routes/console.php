<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:get-video-stats')->hourly();
