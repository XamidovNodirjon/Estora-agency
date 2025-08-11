<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use \Illuminate\Support\Facades\Schedule;
use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Carbon;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    DB::table('product_views')
        ->where('created_at', '<',Carbon::now()->subHours(24))
        ->delete();
})->daily();
