<?php

namespace Emutoday\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Snowfire\Beautymail\Beautymail;
use Emutoday\Email;

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
      /*
      $email_id = $this->argument('email');

      $email = Email::findOrFail($email_id);

      $beautymail = app()->make(Beautymail::class);
      $beautymail->send('public.todayemail.email', [], function($message) use($email)
      {
          $message
        ->from('noreply@today.emich.edu')
        ->to('cpuzzuol@emich.edu', 'Chris Puzzuoli')
        ->subject($email->title);
      });
      */
      /*
      approved => 1
      is_ready => 1
      send_at is now or in the past
      stop_at is new or in the future
      */

      $emails = Email::where([ ['is_approved', '=', 1], ['send_at', '<=', date('Y-m-d H:i')], ['stop_at', '>=', date('Y-m-d H:i')] ])->get();

      foreach($emails as $email){
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('public.todayemail.email', [], function($message) use($email)
        {
            $message
          ->from('noreply@today.emich.edu')
          ->to('cpuzzuol@emich.edu', 'Chris Puzzuoli')
          ->subject($email->title);
        });
      }
    }
}
