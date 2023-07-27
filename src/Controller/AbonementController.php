<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Caller;
use App\Entity\SmsSender;

class AbonementController extends AbstractController
{
    #[Route('/abonement', name: 'app_abonement')]
    public function index(): Response
    {
        $caller = new Caller;
        $smser = new SmsSender;

        $jacke = 'Jacke';
        $queen = 'Queen';
        $textSMS = "In the evening there was a thunderstorm";

        echo $caller->startCall($jacke, $queen);
        echo '<br>';
        echo $smser->sendSMS($textSMS, $jacke, $queen);
        
        return $this->render('abonement/index.html.twig', [
            'controller_name' => 'AbonementController',
        ]);
    }
}
