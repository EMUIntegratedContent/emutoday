<?php

namespace Emutoday\Console\Commands;

use Emutoday\Http\Resources\EmailPostStoryResource;
use Emutoday\Http\Resources\EmailResource;
use Emutoday\Http\Resources\InsideemuPostEmailResource;
use Emutoday\Http\Resources\StoryResource;
use Emutoday\InsideemuPost;
use Emutoday\Story;
use Illuminate\Console\Command;
use Emutoday\Email;
use Emutoday\Imagetype;
use Illuminate\Support\Facades\Mail;

class SendTodayEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'todayemails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an EMU Today Email blast.';

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
      \Log::info("Email command executed.");

      /**
       * Emails must be:
       * 1) Approved
       * 2) Ready
       * 3) Not already sent
       * 4) Marked with a send time in the past
       */
      $emails = Email::where([ ['is_approved', '=', 1], ['is_ready', '=', 1], ['is_sent', '=', 0], ['send_at', '<=', date('Y-m-d H:i')] ])->get();

      foreach($emails as $email){
				// Combine the main stories and main Inside EMU posts (CP 10/2/24)
				$mainStories = $email->mainstories()->get();
				$mainInsideemuPosts = $email->maininsideemuposts()->get();
				$combinedMainStories = $mainStories->merge($mainInsideemuPosts);
				// Reorder by the 'order' field
				$combinedMainStories = $combinedMainStories->sortBy('pivot.order');
				// Reset the keys on the sorted collection
				$sortedCombinedMainStories = $combinedMainStories->values()->all();

        $emailImageTypeIds = Imagetype::select('id')->where('type', 'email')->get(); // get email image types
        $smallImageTypeIds = Imagetype::select('id')->where('type', 'small')->get(); // get small image types (for sub-main stories)

        $mainStoryImages = array(); // collect email story images
        $smallStoryImages = array(); // collect small story images (for sub-main stories)
        foreach($sortedCombinedMainStories as $mainStory){
					$storyImage = null;
					$smallStoryImage = null;
					if ($mainStory instanceof Story) {
						$storyImage = $mainStory->storyImages()->whereIn('imagetype_id', $emailImageTypeIds)->first(); // get email image for the main story
						$smallStoryImage = $mainStory->storyImages()->whereIn('imagetype_id', $smallImageTypeIds)->first(); // get email image for the main story
					} elseif ($mainStory instanceof InsideemuPost) {
						$storyImage = $mainStory->images()->whereIn('imagetype_id', $emailImageTypeIds)->first(); // get email image for the main story
						$smallStoryImage = $mainStory->images()->whereIn('imagetype_id', $smallImageTypeIds)->first(); // get email image for the main story
					}

          $mainStoryImages[] = $storyImage;
          $smallStoryImages[] = $smallStoryImage;
        }

        $events = $email->events()->get();

        // Send one email to each recipient/mailing list
        foreach($email->recipients as $recipient){
          Mail::send('public.todayemail.email',
						['email' => $email, 'events' => $events, 'mainStories' => $sortedCombinedMainStories, 'mainStoryImages' => $mainStoryImages, 'smallStoryImages' => $smallStoryImages],
						function ($message) use ($email, $recipient){
							//$message->from('test@emich.edu', 'The Week at EMU');
              $message->from(env("MAIL_USERNAME", "postmaster@today.emich.edu"), 'The Week at EMU');
              $message->replyTo('emu_today@emich.edu', 'EMU Today Admin');
              $message->subject($email->title);
              $message->to($recipient->email_address);

              // IMPORTANT: tag this email as an EMU Today mailer!
              // Mailgun Docs: http://mailgun-documentation.readthedocs.io/en/latest/api-sending.html#sending
              // Tutuorial: https://stackoverflow.com/questions/35848266/using-laravels-mailgun-driver-how-do-you-gracefully-send-custom-data-and-tag
              $headers = $message->getHeaders();
              $headers->addTextHeader('X-Mailgun-Tag', env('MAILGUN_GROUP'));
              $headers->addTextHeader('X-Mailgun-Variables', '{"today-email-id":"'.$email->id.'"}'); //custom variable. Allows email ID in today to be linked to Mailgun's email ID via webhooks.
          });

        }
        // IMPORTANT! Mark this email as sent!
        $email->is_sent = 1;
        $email->save();
      }
    }
}
