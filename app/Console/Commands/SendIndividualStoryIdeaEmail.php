<?php

namespace Emutoday\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use Emutoday\StoryIdea;
use Carbon\Carbon;

class SendIndividualStoryIdeaEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storyindividualideaemails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a reminder of a story ideas when that idea is within 24 hours of its due date. Send to the assignee.';

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
      \Log::info("Individual story idea email command executed.");

      // differentiate between development and production environments
      if(env('APP_DEBUG') === true){
        // dev
        $recipients = array(
          array(
            'first_name' => 'Chris',
            'last_name' => 'Puzzuoli',
            'email' => 'cpuzzuol@emich.edu',
          ),
          array(
            'first_name' => 'Brian',
            'last_name' => 'Koscielniak',
            'email' => 'bkosciel@emich.edu',
          ),
        );
      } else {
        // prod
        $recipients = array(
          array(
            'first_name' => 'Chris',
            'last_name' => 'Puzzuoli',
            'email' => 'cpuzzuol@gmail.com',
          ),
        );
      }


      /**
       * Gather any story ideas which are:
       * 1) Not archived
       * 2) Not completed
       * 3) Not marked has having been previously sent out in a reminder email
       * 4) Are due within the next week from now
       */
      $upcomingStories = StoryIdea::where([ ['is_archived', '=', 0], ['is_completed', '=', 0], ['is_notified', '=', 0] ])->whereNotNull('assignee')->whereBetween('deadline', [Carbon::now(), Carbon::today()->addDay()])->orderBy('deadline', 'asc')->get();

      if(count($upcomingStories) > 0){
        // Send one email to each recipient/mailing list
        foreach($upcomingStories as $idea){
            \Log::info($idea->title);
          // only send this email if there is somebody assigned to it
          if($idea->assignee()->first()){
            Mail::send('admin.storyideas.emailindividual', ['idea' => $idea], function ($message) use ($idea){
                $message->from(env('MAIL_USERNAME', 'emu_today@emich.edu'), 'EMU Today Admin');
                $message->replyTo('emu_today@emich.edu', 'EMU Today Admin');
                $message->subject('Story Idea "'. $idea->title . '" Deadline Near');
                $message->to($idea->assignee()->first()->email);
            });
          }
        }
        // Set the is_notified field of each story idea to prevent it being sent again.
        foreach($upcomingStories as $idea){
          $idea->is_notified = 1;
          $idea->save();
        }
      }
    }
}
