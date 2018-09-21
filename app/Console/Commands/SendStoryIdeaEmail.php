<?php

namespace Emutoday\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use Emutoday\StoryIdea;
use Carbon\Carbon;

class SendStoryIdeaEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storyideaemails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a reminder of upcoming story ideas.';

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
      \Log::info("Group story idea email command executed.");

      // differentiate between development and production environments
      if(env('APP_DEBUG') === true){
        // dev
        $recipients = array(
          array(
            'first_name' => 'Chris',
            'last_name' => 'Puzzuoli',
            'email' => 'cpuzzuol@emich.edu',
          ),
        );
      } else {
        // prod
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
          array(
            'first_name' => 'Darcy',
            'last_name' => 'Gifford',
            'email' => 'dgiffor2@emich.edu',
          ),
          array(
            'first_name' => 'Geoff',
            'last_name' => 'Larcom',
            'email' => 'glarcom@emich.edu',
          ),
          array(
            'first_name' => 'Deb',
            'last_name' => 'Burke',
            'email' => 'dburke15@emich.edu',
          ),
          array(
            'first_name' => 'Sue',
            'last_name' => 'Shine',
            'email' => 'sshine@emich.edu',
          ),
          array(
            'first_name' => 'Walter',
            'last_name' => 'Kraft',
            'email' => 'wkraft@emich.edu',
          ),
          array(
            'first_name' => 'TaQuinda',
            'last_name' => 'Johnson',
            'email' => 'tjohnson9@emich.edu',
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
      $upcomingStories = StoryIdea::where([ ['is_archived', '=', 0], ['is_completed', '=', 0] ])->whereBetween('deadline', [Carbon::now(), Carbon::today()->addWeek()])->orderBy('deadline', 'asc')->get();

      if(count($upcomingStories) > 0){
        // Send one email to each recipient/mailing list
        foreach($recipients as $recipient){
          Mail::send('admin.storyideas.emailgroup', ['upcomingStories' => $upcomingStories, 'recipient' => $recipient], function ($message) use ($recipient){
              $message->from(env('MAIL_USERNAME', 'emu_today@emich.edu'), 'EMU Today Admin');
              $message->replyTo('emu_today@emich.edu', 'EMU Today Admin');
              $message->subject('Story Tracking Weekly Roundup');
              $message->to($recipient['email']);
          });
        }
      }
    }
}
