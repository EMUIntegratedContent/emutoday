<?php

namespace Emutoday\Console\Commands;

use Emutoday\InsideemuPost;
use Emutoday\Story;
use Illuminate\Console\Command;
use Emutoday\StudentEmail;
use Emutoday\Imagetype;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendStudentEmails extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'studentemails:send';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Send a "The Week at EMU: Students" email blast.';

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
    Log::info("Student email command executed.");

    /**
     * Emails must be:
     * 1) Approved
     * 2) Ready
     * 3) Not already sent
     * 4) Marked with a send time in the past
     */
    $emails = StudentEmail::where([['is_approved', '=', 1], ['is_ready', '=', 1], ['is_sent', '=', 0], ['send_at', '<=', date('Y-m-d H:i')]])->get();

    foreach ($emails as $email) {
      // The single featured item is either a Story or a Campus Life (Inside EMU) post
      $featured = $email->mainstories()->get()->merge($email->maininsideemuposts()->get())->first();

      $emailImageTypeIds = Imagetype::select('id')->where('type', 'email')->get(); // featured image type

      $featuredImage = null;
      if ($featured instanceof Story) {
        $featuredImage = $featured->storyImages()->whereIn('imagetype_id', $emailImageTypeIds)->first();
      } elseif ($featured instanceof InsideemuPost) {
        $featuredImage = $featured->images()->whereIn('imagetype_id', $emailImageTypeIds)->first();
      }

      $events = $email->events()->get();

      // Send one email to each recipient/mailing list
      foreach ($email->recipients as $recipient) {
        Mail::send(
          'public.studentemail.email',
          ['email' => $email, 'events' => $events, 'featured' => $featured, 'featuredImage' => $featuredImage],
          function ($message) use ($email, $recipient) {
            $message->from(env("MAIL_USERNAME", "postmaster@today.emich.edu"), 'The Week at EMU');
            $message->replyTo('emu_today@emich.edu', 'EMU Today Admin');
            $message->subject($email->title);
            $message->to($recipient->email_address);

            // Tag this email for Mailgun. Falls back to the shared group if no student-specific tag is set.
            $headers = $message->getHeaders();
            $headers->addTextHeader('X-Mailgun-Tag', env('STUDENT_MAILGUN_GROUP', env('MAILGUN_GROUP')));
            $headers->addTextHeader('X-Mailgun-Variables', '{"student-email-id":"' . $email->id . '"}');
          }
        );
      }
      // IMPORTANT! Mark this email as sent!
      $email->is_sent = 1;
      $email->save();
    }
  }
}
