<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Facade\CheapSmsAndCalls;

class AbonementController extends AbstractController
{
    private CheapSmsAndCalls $abonement;
    
    public function __construct(CheapSmsAndCalls $abonement)
    {
        $this->abonement = new CheapSmsAndCalls;
    }
    
    #[Route('/call', name: 'app_abonement')]
    public function call(): Response
    {
        $jacke = "Jacke";
        $queen = 'Queen';
        
        $this->abonement->call($jacke, $queen);
        
        return $this->render('abonement/index.html.twig');
    }

    #[Route('/sms', name: 'sms')]
    public function sms(): Response
    {
        $text = 'In the evening there was a thunderstorm';
        $jacke = "Jacke";
        $queen = 'Queen';

        $this->abonement->sendSms($text, $jacke, $queen);

        return $this->render('abonement/index.html.twig');
    }
}
