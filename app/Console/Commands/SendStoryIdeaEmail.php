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
      \Log::info("Story idea email command executed.");

      $recipients = array(
        'cpuzzuol@emich.edu',
        'cpuzzuol@gmail.com'
      );

      $upcomingStories = StoryIdea::where([ ['is_archived', '=', 0], ['is_completed', '=', 0], ['deadline', '>=', Carbon::now()->addWeek()] ])->orderBy('deadline', 'desc')->get();
      // Send one email to each recipient/mailing list
      if(count($upcomingStories) > 0){
        foreach($recipients as $recipient){
          Mail::send('admin.storyideas.email', ['upcomingStories' => $upcomingStories], function ($message) use ($recipient){
              $message->from(env('MAIL_USERNAME', 'emu_today@emich.edu'), 'EMU Today Admin');
              $message->replyTo('emu_today@emich.edu', 'EMU Today Admin');
              $message->subject('Story Tracking Deadline Near');
              $message->to($recipient);
          });
        }
      }
    }
}
