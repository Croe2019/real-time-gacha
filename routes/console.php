<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Schedule;
use App\Events\DashboardUpdated;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {

    $totalDraws = Cache::get('total_draws', 0);

    $ssrCount = Cache::get('ssr_count', 0);

    $connections = Cache::get('connections', 0);

    $responseTime = Cache::get('response_time', 0);

    $rps = Redis::get('requests_current_second') ?? 0;

    event(
        new DashboardUpdated(
            $totalDraws,
            $ssrCount,
            $connections,
            $rps,
            $responseTime
        )
    );

})->everySecond();
