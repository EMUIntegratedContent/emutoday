<?php

namespace Emutoday\Services;

use Mailgun\Mailgun;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * Class MailgunSubscribeService
 * @package Emutoday\Services
 *
 * This class is used to handle the business logic for "Double Opt-In" subscribing to EMU Today via the Mailgun API.
 * It was created in response to all of the spam subscriptions we were receiving.
 * https://www.mailgun.com/blog/email/double-opt-in-with-php-mailgun/#chapter-2
 */
class MailgunSubscribeService {
	private $mgClient;
	private $siteURL;
	private $uniqueKey;
	private $mailingList;
	private $domain;

	public function __construct() {
		$this->mgClient = Mailgun::create(env('MAILGUN_SECRET'));
		$this->siteURL = env('APP_URL')."/confsubscribe";
		$this->uniqueKey = env('MAILGUN_DBLOPT_STR');
		$this->mailingList = env('MAILGUN_DBLOPT_LIST');
		$this->domain = env('MAILGUN_DOMAIN');
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

	/**
	 * @throws ClientExceptionInterface
	 */
	public function sendConfirmationEmail($recipientAddress, $subjectText, $recipientName) {
		$hashedUnique = $this->makeConfirmationHash($recipientAddress, $this->uniqueKey);

		$this->mgClient->messages()->send($this->domain, array(
			'from'    => 'confirmation@'.$this->domain,
			'to'      => $recipientAddress,
			'subject' => $subjectText,
			'html'    => '<p>Hello, please confirm you want to receive marketing emails from '.$this->domain.' by clicking on the below link <p><a href="$siteURL/confsubscribe?c='.$hashedUnique.'&e='.$recipientAddress.'&n='.$recipientName.'">CONFIRMATION</a></p></p><p> This email was sent to'.$recipientName.', at the speed of a bullet, by Mailgun!</a>'
		));
	}

	function makeConfirmationHash($confEmail, $confCode) {
		return md5($confEmail.$confCode);
	}

	public function checkConfirmationHash($confEmail, $confCode) {
		if (md5($confEmail.$this->uniqueKey) === $confCode) { return true; }
		else { return false; }
	}

	/**
	 * @throws ClientExceptionInterface
	 */
	public function addMemberToList($recipientAddress, $recipientName) {
		$this->mgClient->mailingList()->member()->create($this->mailingList, $recipientAddress, $recipientName);
	}
}
