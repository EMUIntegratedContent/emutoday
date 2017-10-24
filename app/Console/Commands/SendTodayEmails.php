<?php

namespace Emutoday\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Snowfire\Beautymail\Beautymail;
use Emutoday\Email;
use Emutoday\Story;
use Emutoday\Imagetype;
use Mail;

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
      /**
       * Emails must be:
       * 1) Approved
       * 2) Ready
       * 3) Not already sent
       * 4) Marked with a send time in the past
       */
      $emails = Email::where([ ['is_approved', '=', 1], ['is_ready', '=', 1], ['is_sent', '=', 0], ['send_at', '<=', date('Y-m-d H:i')] ])->get();

      foreach($emails as $email){
        $mainStory = Story::findOrFail($email->mainstory_id);
        $emailImageTypeIds = Imagetype::select('id')->where('type', 'email')->get(); // get email image types
        $mainStoryImage = $mainStory->storyImages()->select('image_path','filename','title','caption','teaser','moretext','link','link_text')->whereIn('imagetype_id', $emailImageTypeIds)->first(); // get email image for the main story

        // Send one email to each recipient/mailing list
        foreach($email->recipients  as $recipient){
          /*
          $beautymail = app()->make(Beautymail::class);
          $beautymail->send('public.todayemail.email', ['email' => $email, 'mainStory' => $mainStory, 'mainStoryImage' => $mainStoryImage], function($message) use($email, $recipient)
          {
              $message
            ->from('postmaster@todaytest.emich.edu')
            ->to($recipient->email_address, $recipient->description)
            ->subject("EMU Today: " . $email->title);
          });
          */
          Mail::send('public.todayemail.email0', ['email' => $email, 'mainStory' => $mainStory, 'mainStoryImage' => $mainStoryImage], function ($message) use ($email, $recipient){
              $message->from(env('MAIL_USERNAME', 'noreply@today.emich.edu'), 'EMU Today');
              $message->subject($email->title);
              $message->to($recipient->email_address);

              // IMPORTANT: tag this email as an EMU Today mailer!
              // Mailgun Docs: http://mailgun-documentation.readthedocs.io/en/latest/api-sending.html#sending
              // Tutuorial: https://stackoverflow.com/questions/35848266/using-laravels-mailgun-driver-how-do-you-gracefully-send-custom-data-and-tag
              $headers = $message->getHeaders();
              $headers->addTextHeader('X-Mailgun-Tag', 'today-mailer');
              $headers->addTextHeader('X-Mailgun-Variables', '{"today-email-id":"'.$email->id.'"}'); //custom variable. Allows email ID in today to be linked to Mailgun's email ID via webhooks.
          });
        }
        // IMPORTANT! Mark this email as sent!
        $email->is_sent = 1;
        $email->save();
      }
    }
}
