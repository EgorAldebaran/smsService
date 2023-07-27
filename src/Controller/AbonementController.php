<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\SmsSender;
use App\Entity\Caller;
use App\Form\SMSType;
use App\Form\CallerType;
use App\Service\SMSService;
use App\Service\CallService;

class AbonementController extends AbstractController
{
    private $smsSender;
    private $caller;
    private $SMSService;
    private $callService;
    
    public function __construct(SmsSender $smsSender, SMSService $SMSService, CallService $callService, Caller $caller)
    {
        $this->smsSender = $smsSender;
        $this->SMSService = $SMSService;
        $this->callService = $callService;
        $this->caller = $caller;
    }
    
    #[Route('/sms', name: 'sms')]
    public function sms(
        Request $request,
        EntityManagerInterface $entityManager,
        SmsSender $smsSender,
        SMSService $SMSService
    ): Response
    {
        $form = $this->createForm(SMSType::class, $this->smsSender);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $SMSService->handleRequest($request);
            $SMSService->sendSMS($smsSender, $entityManager);

            return new JsonResponse([
                'message' => 'ok',
            ]);
        }
        
        return $this->render('abonement/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('call', name: 'call')]
    public function info(
        EntityManagerInterface $entityManager, 
        CallService $callService, 
        Request $request
    ): Response
    {
        //dd($callService);
        $form = $this->createForm(CallerType::class, $this->caller);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            dd($callService->handleRequest($request, "caller"));
            dd($callService);
        }
        

        return $this->render('abonement/caller.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
