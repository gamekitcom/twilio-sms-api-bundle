<?php

namespace OCSoftwarePL\TwilioSmsApiBundle\Sms;


class TwilioSendResponse
{
    const STATUS_ACCEPTED = 'accepted'; //Twilio has received your API request to send a message with a Messaging Service and a From number is being dynamically selected. This is still the initial status when sending with a Messaging Service and the From parameter.
    const STATUS_QUEUED = "queued"; //The API request to send a message was successful and the message is queued to be sent out. This is the initial status when you are not using a Messaging Service.
    const STATUS_SENDING = "sending"; // 	Twilio is in the process of dispatching your message to the nearest upstream carrier in the network.
    const STATUS_SENT = "sent"; // 	The message was successfully accepted by the nearest upstream carrier.
    const STATUS_RECEIVING = "receiving"; //The inbound message has been received by Twilio and is currently being processed.
    const STATUS_RECEIVED = "received"; //On inbound messages only. The inbound message was received by one of your Twilio numbers.
    const STATUS_DELIVERED = "delivered"; //Twilio has received confirmation of message delivery from the upstream carrier, and, where available, the destination handset.
    const STATUS_UNDELIVERED = "undelivered"; //Twilio has received a delivery receipt indicating that the message was not delivered. This can happen for a number of reasons including carrier content filtering, availability of the destination handset, etc.
    const STATUS_FAILED = "failed"; // The message could not be sent. This can happen for various reasons including queue overflows, account suspensions and media errors (in the case of MMS). Twilio does not charge you for failed messages.

    public $smsId;
    public $status;
    public $errorCode;
    public $errorMessage;
    public $uri;

    public function __construct($smsId, $status, $errorCode, $errorMessage, $uri)
    {
        $this->smsId = $smsId;
        $this->status = $status;
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
        $this->uri = $uri;
    }

    /**
     * @return bool
     */
    public function isOk()
    {
        return !$this->failed();
    }

    /**
     * @return bool
     */
    public function failed()
    {
        return in_array($this->status, [self::STATUS_UNDELIVERED, self::STATUS_FAILED]);
    }

}