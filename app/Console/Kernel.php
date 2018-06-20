<?php

namespace Emutoday\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
        Commands\SendTodayEmails::class,
        Commands\SendStoryIdeaEmail::class,
        Commands\SendIndividualStoryIdeaEmail::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(Commands\SendTodayEmails::class, ['--force'])->cron('*/5 * * * *');
        $schedule->command(Commands\SendStoryIdeaEmail::class, ['--force'])->cron('0 8 * * 3');
        $schedule->command(Commands\SendIndividualStoryIdeaEmail::class, ['--force'])->cron('0 8 * * 0-6');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
