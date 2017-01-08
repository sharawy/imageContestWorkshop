<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
      $schedule->call(function() {
        // check that the queue listener is running and restart it if it isn't
        $run_command = false;
        echo __DIR__;
        if (file_exists(__DIR__ . '/queue.pid')) {
            $pid = file_get_contents(__DIR__ . '/queue.pid');
            $result = exec("ps -p $pid --no-heading | awk '{print $1}'");
            if ($result == '') {
                $run_command = true;
            }
        } else {
            $run_command = true;
        }
        if($run_command)
        {
            $command = 'php-cli artisan queue:listen > /dev/null & echo $!';
            $number = exec($command);
            file_put_contents(__DIR__ . '/queue.pid', $number);
        }
    });
    }
}
