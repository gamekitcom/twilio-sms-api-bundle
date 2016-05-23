<?php

namespace OCSoftwarePL\TwilioSmsApiBundle\Sms;

use OCSoftwarePL\EsendexSmsApiBundle\Sms\DTO\Sms;
use Services_Twilio;

class TwilioSmsApiSender
{
    private $config = [];
    private $senderName;
    private $api = null;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->senderName = $config['sender'];
    }

    protected function getApi()
    {
        if (null === $this->api) {
            $this->api = new Services_Twilio($this->config['account'], $this->config['token']);
        }
        return $this->api;
    }

    /**
     * @param Sms $sms
     * @throws \Exception
     */
    public function sendSms(Sms $sms)
    {
        try {
            $twilioSms = [
                'From' => $this->senderName,
                'To' => $sms->phone,
                'Body' => $sms->msg
            ];

            return $this->getApi()->account->messages->create($twilioSms);

        } catch (\Exception $e) {
            throw $e;
        }
    }
}