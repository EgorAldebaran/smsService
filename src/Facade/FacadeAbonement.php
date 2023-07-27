<?php

namespace App\Facade;

use App\Entity\Caller;
use App\Entity\SmsSender;

class FacadeAbonement
{
    private $caller;
    private $smsSender;
    
    public function __construct() {
        $this->caller = new Caller;
        $this->smsSender = new SmsSender;
    }

    public function call($from, $to): void
    {
        echo $this->caller->startCall($from, $to)." ";
    }

    public function sendSms($text, $from, $to): void
    {
        echo $this->smsSender->sendSMS($text, $from, $to);
    }
}
