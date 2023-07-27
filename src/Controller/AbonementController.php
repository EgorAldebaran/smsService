<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\SmsSender;
use App\Form\SMSType;
use App\Service\SMSService;

class AbonementController extends AbstractController
{
    private $smsSender;
    private $SMSService;
    public function __construct(SmsSender $smsSender, SMSService $SMSService)
    {
        $this->smsSender = $smsSender;
        $this->SMSService = $SMSService;
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

    #[Route('info')]
    public function info(EntityManagerInterface $entityManager): JsonResponse
    {
        $smsSender = new SmsSender;
        $sms = new SMSService($smsSender);
        $sms->sendSMS('from', 'to', 'text', $smsSender, $entityManager);

        return new JsonResponse([
            'message' => 'ok'
        ]);
    }
}
