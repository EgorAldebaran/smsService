<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Caller;
use App\Entity\SmsSender;
use App\Facade\FacadeAbonement;

class AbonementController extends AbstractController
{
    #[Route('/abonement', name: 'app_abonement')]
    public function index(): Response
    {
        $caller = new Caller;
        $smser = new SmsSender;
        $abonement = new FacadeAbonement;

        $jacke = 'Jacke';
        $queen = 'Queen';
        $textSMS = "In the evening there was a thunderstorm";

        $abonement->call($jacke, $queen);
        $abonement->sendSms($textSMS, $jacke, $queen);

        
        return $this->render('abonement/index.html.twig', [
            'controller_name' => 'AbonementController',
        ]);
    }
}
