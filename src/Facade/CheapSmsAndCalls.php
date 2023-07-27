<?php

namespace App\Facade;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use App\Service\CallService;
use App\Service\SMSService;
use App\Entity\Caller;
use App\Entity\SmsSender;

class CheapSmsAndCalls
{
    private Caller $caller;
    private SmsSender $smsSender;
    private CallService $callService;
    private SMSService $SMSService;

    public function __construct(
        Caller $caller,
        SmsSender $smsSender,
        CallService $callService,
        SMSService $SMSService
    )
    {
        $this->caller = $caller;
        $this->SMSService = $SMSService;
        $this->callService = $callService;
        $this->smsSender = $smsSender;
    }

    public function getCall(
        Caller $caller,
        CallService $callService,
        EntityManagerInterface $entityManager,
        Request $request
    )
    {
        //$callService->handleRequest($request, $choiceForm);
        $callService->startCall($caller, $entityManager);
    }

    public function getSms(Request $request,
                           SmsSender $smsSender,
                           SMSService $SMSService,
                           EntityManagerInterface $entityManager
    )
    {
        ///$SMSService->handleRequest($request, $choiceForm);
        $SMSService->sendSMS($smsSender, $entityManager);
    }
  
}
