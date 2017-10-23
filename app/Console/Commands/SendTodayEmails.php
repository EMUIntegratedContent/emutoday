<?php

namespace Emutoday\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Snowfire\Beautymail\Beautymail;
use Emutoday\Email;
use Emutoday\Story;
use Emutoday\Imagetype;
//use Mail;

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
          $beautymail = app()->make(Beautymail::class);
          $beautymail->send('public.todayemail.email', ['email' => $email, 'mainStory' => $mainStory, 'mainStoryImage' => $mainStoryImage], function($message) use($email, $recipient)
          {
              $message
            ->from('noreply@today.emich.edu')
            ->to($recipient->email_address, $recipient->description)
            ->subject("EMU Today: " . $email->title);
          });
        }
        // IMPORTANT! Mark this email as sent!
        $email->is_sent = 1;
        $email->save();
      }
    }
}
