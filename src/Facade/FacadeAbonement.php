<?php

namespace App\Facade;

use App\Service\CallService;
use App\Service\SMSService;

class FacadeAbonement
{
    private CallService $callService;
    private SMSService $smsSender;

    public function __construct(
        CallService $callService,
        SMSService $smsSender
    )
    {
        $this->callService = $callService;
        $this->smsSender = $smsSender;
    }
}
