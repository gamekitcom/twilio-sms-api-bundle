<?php

namespace OCSoftwarePL\TwilioSmsApiBundle\Sms;

use OCSoftwarePL\TwilioSmsApiBundle\Sms\DTO\Sms;
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
     * @param bool $forceDelivery omit checking is phone number valid
     * @throws \Exception
     */
    public function sendSms(Sms $sms, $forceDelivery = false)
    {
        try {
            $twilioSms = [
                'From' => $this->senderName,
                'To' => $sms->phone,
                'Body' => $sms->msg,
                'StatusCallback' => $this->config['callback_url']
            ];

            if ($forceDelivery) {
                $twilioSms['ForceDelivery'] = true;
            }

            $response = $this->getApi()->account->messages->create($twilioSms);

            return new TwilioSendResponse(
                $response->sid,
                $response->status,
                $response->error_code,
                $response->error_message,
                $response->uri
            );

        } catch (\Exception $e) {
            throw $e;
        }
    }
}
