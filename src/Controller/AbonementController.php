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

class AbonementController extends AbstractController
{
    private $smsSender;
    public function __construct(SmsSender $smsSender)
    {
        $this->smsSender = $smsSender;
    }
    
    #[Route('/sms', name: 'sms')]
    public function sms(Request $request, EntityManagerInterface $entityManager, SmsSender $smsSender): Response
    {
        $form = $this->createForm(SMSType::class, $this->smsSender);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $smsSender = $form->getData();
            $entityManager->persist($this->smsSender);
            $entityManager->flush();

            return new JsonResponse([
                'message' => 'ok',
            ]);
        }
        
        return $this->render('abonement/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
