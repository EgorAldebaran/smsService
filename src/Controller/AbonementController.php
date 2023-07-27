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
use App\Facade\FacadeAbonement;

class AbonementController extends AbstractController
{
    private $smsSender;
    private $caller;
    private $SMSService;
    private $callService;
    private $facadeAbonement;
    
    public function __construct(
        SmsSender $smsSender,
        SMSService $SMSService,
        CallService $callService,
        Caller $caller,
        FacadeAbonement $facadeAbonement
    )
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
    public function call(
        EntityManagerInterface $entityManager,
        Caller $caller,
        CallService $callService, 
        Request $request
    ): Response
    {
        $form = $this->createForm(CallerType::class, $this->caller);
        $form->handleRequest($request);
        $choiceForm = "caller";
        
        if ($form->isSubmitted() && $form->isValid()) {
            $callService->handleRequest($request, $choiceForm);
            $callService->startCall($caller, $entityManager);

            return new JsonResponse([
                'message' => 'ok'
            ]);
        }
        

        return $this->render('abonement/caller.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/facade', name: 'facade')]
    public function facade(Request $request, FacadeAbonement $facadeAbonement): JsonResponse
    {
        dd($facadeAbonement);
        
        return new JsonResponse([
            'message' => 'successfully',
        ]);
    }
}
