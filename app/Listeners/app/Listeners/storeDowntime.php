<?php

namespace App\Listeners\app\Listeners;

use App\Events\app\Events\DowntimeCaptured;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class storeDowntime
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\app\Events\DowntimeCaptured  $event
     * @return void
     */
    public function handle(DowntimeCaptured $event)
    {
        //
        dd($event);
        // $datas = [
        //     ''
        // ]
    }
}
