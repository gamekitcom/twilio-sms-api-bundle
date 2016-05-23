<?php

namespace OCSoftwarePL\TwilioSmsApiBundle\Sms\DTO;

class Sms
{
    public $phone;
    public $msg;
    public $sender;

    public function __construct($phone, $msg, $sender = null)
    {
        $this->phone = $phone;
        $this->msg = $msg;
        $this->sender = $sender;
    }
}