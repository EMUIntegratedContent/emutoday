<?php

namespace Emutoday\Console\Commands;

use Carbon\Carbon;
use Emutoday\Event;
use Illuminate\Console\Command;

class ArchiveEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cea_events:archive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archive any events that ended more than two years.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
			\Log::info("Archive events command executed.");

			/**
			 * Gather any events that ended more than two years ago
			 */
			$oldEvents = Event::where([ ['end_date', '<', Carbon::today()->subYears(2)] ])->get();
			if(count($oldEvents) > 0){
				// Set the is_archived field of each event.
				foreach($oldEvents as $oldEvent){
					$oldEvent->is_archived = 1;
					$oldEvent->save();
				}
			}
    }
}
