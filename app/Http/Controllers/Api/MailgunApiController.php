<?php

namespace Emutoday\Http\Controllers\Api;

use Log;
use Emutoday\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Input;
use Carbon\Carbon;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;

class MailgunApiController extends ApiController
{
  function __construct()
  {
  }

  /**
   * Mailgun Webhook for tracking opening of an email.
   */
  public function postOpen(Request $request){
    $mailgun_post_data = $request->all();

    // Secure the Webhook endpoint (Note: API key comes from .env file)
    if($this->verify(env('MAILGUN_SECRET'), $mailgun_post_data['token'], $mailgun_post_data['timestamp'], $mailgun_post_data['signature'])){
      if(!$this->incrementMailgunStat($mailgun_post_data['today-email-id'], 'open')){
        return $this->setStatusCode(400)
        ->respond('Email not found.');
      }
      return $this->setStatusCode(200)
      ->respond('Email open counted.');
    }
    return $this->setStatusCode(401)
    ->respond('Unauthenticated usage of this route!');
  }

  /**
   * Mailgun Webhook for tracking clicking of a link in an email.
   */
  public function postClick(Request $request){
    $mailgun_post_data = $request->all();

    // Secure the Webhook endpoint (Note: API key comes from .env file)
    if($this->verify(env('MAILGUN_SECRET'), $mailgun_post_data['token'], $mailgun_post_data['timestamp'], $mailgun_post_data['signature'])){
      if(!$this->incrementMailgunStat($mailgun_post_data['today-email-id'], 'click')){
        return $this->setStatusCode(400)
        ->respond('Email not found.');
      }
      return $this->setStatusCode(200)
      ->respond('Email click counted.');
    }
    return $this->setStatusCode(401)
    ->respond('Unauthenticated usage of this route!');
  }

  /**
   * Mailgun Webhook for tracking marking of an email as spam.
   */
  public function postSpam(Request $request){
    $mailgun_post_data = $request->all();

    // Secure the Webhook endpoint (Note: API key comes from .env file)
    if($this->verify(env('MAILGUN_SECRET'), $mailgun_post_data['token'], $mailgun_post_data['timestamp'], $mailgun_post_data['signature'])){
      if(!$this->incrementMailgunStat($mailgun_post_data['today-email-id'], 'spam')){
        return $this->setStatusCode(400)
        ->respond('Email not found.');
      }
      return $this->setStatusCode(200)
      ->respond('Email click counted.');
    }
    return $this->setStatusCode(401)
    ->respond('Unauthenticated usage of this route!');
  }

  /**
   * Increase the number of times this email has been opened, clicked, or marked as spam by incrementing the mailgun_opens field
   * @param int $email_id   The EMU Today database ID of the email
   * @param String $action  "open", "click", "spam"
   * @return boolean
   */
  private function incrementMailgunStat($email_id, $action){
    $email = Email::find($email_id);

    if($email){
      switch($action){
        case 'open':
          $email->mailgun_opens += 1;
          break;
        case 'click':
          $email->mailgun_clicks += 1;
          break;
        case 'spam':
          $email->mailgun_spam += 1;
          break;
      }

      if($email->save()){
        return true;
      }
    }
    return false;
  }

  /**
   * To ensure the authenticity of event requests, Mailgun signs them and posts the signature along with other webhook parameters:
   * DOCS: https://documentation.mailgun.com/en/latest/user_manual.html#webhooks
   * @param String token      "token" property sent in mailgun POST request
   * @param String timestamp  "timestamp" property sent in mailgun POST request
   * @param String signature  "signature" property sent in mailgun POST request
   *
   * @return boolean
   */
  private function verify($apiKey, $token, $timestamp, $signature){
    //check if the timestamp is fresh
    if (abs(time() - $timestamp) > 15) {
        return false;
    }

    //returns true if signature is valid
    return hash_hmac('sha256', $timestamp.$token, $apiKey) === $signature;
  }
}
