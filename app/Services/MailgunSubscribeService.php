<?php

namespace Emutoday\Services;

use Mailgun\Mailgun;
use Psr\Http\Client\ClientExceptionInterface;
use Mailgun\Exception\HttpClientException;

/**
 * Class MailgunSubscribeService
 * @package Emutoday\Services
 *
 * This class is used to handle the business logic for "Double Opt-In" subscribing to EMU Today via the Mailgun API.
 * It was created in response to all the spam subscriptions we were receiving.
 * https://www.mailgun.com/blog/email/double-opt-in-with-php-mailgun/#chapter-2
 */
class MailgunSubscribeService {
	private Mailgun $mgClient;
	private string $uniqueKey;
	private string $mailingList;
	private string $domain;

	public function __construct() {
		$this->mgClient = Mailgun::create(env('MAILGUN_SECRET'));
		$this->uniqueKey = env('MAILGUN_DBLOPT_STR');
		$this->mailingList = env('MAILGUN_DBLOPT_LIST');
		$this->domain = env('MAILGUN_DOMAIN');
	}

	/**
	 * @throws ClientExceptionInterface
	 */
	public function sendConfirmationEmail($recipientAddress, $subjectText, $recipientName) {
		$hashedUnique = $this->makeConfirmationHash($recipientAddress, $this->uniqueKey);

		$this->mgClient->messages()->send($this->domain, array(
			'from'    => 'confirmation@'.$this->domain,
			'to'      => $recipientAddress,
			'subject' => $subjectText,
			'html'    => '<p>Hello, please confirm you want to subscribe to EMU Today emails by clicking on the link below.</p><p><a href="'.env('APP_URL').'/mailgun/subscribe?c='.$hashedUnique.'&e='.$recipientAddress.'&n='.$recipientName.'">Confirm My Subscription</a></p>'
		));
	}

	public function addMemberToList($recipientAddress, $recipientName) {
		try {
			$this->mgClient->mailingList()->member()->create($this->mailingList, $recipientAddress, $recipientName);
			return ['success' => true, 'message' => 'You have been successfully subscribed to EMU Today!'];
		} catch (HttpClientException  $e) {
			if(str_contains($e->getMessage(), 'Address already exists')) {
				return ['success' => false, 'message' => 'You are already subscribed to EMU Today.'];
			}
			return ['success' => false, 'message' => 'There was an error confirming your subscription. Please try again later.'];
		}
	}

	public function sanitizeInputs($var) {
		return htmlspecialchars($var, ENT_QUOTES);
	}

	public function sanitizeEmail ($var) {
		$sane =  htmlspecialchars($var, ENT_QUOTES);
		$pattern = "/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/";
		preg_match($pattern, $sane, $res);
		return $res[0] ?: false;
	}

	function makeConfirmationHash($confEmail, $confCode) {
		return md5($confEmail.$confCode);
	}

	public function checkConfirmationHash($confEmail, $confCode) {
		if (md5($confEmail.$this->uniqueKey) === $confCode) { return true; }
		else { return false; }
	}
}
