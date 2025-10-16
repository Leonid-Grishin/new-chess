<?php

use App\Console\Commands\UpdateClassicCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

\Illuminate\Support\Facades\Schedule::command(\App\Console\Commands\UpdateClassicCommand::class)->monthlyOn(1, '06:00');
\Illuminate\Support\Facades\Schedule::command(\App\Console\Commands\UpdateRapidCommand::class)->monthlyOn(1, '06:05');
