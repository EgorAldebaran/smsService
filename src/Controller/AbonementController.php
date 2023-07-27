<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AbonementController extends AbstractController
{
    #[Route('/abonement', name: 'app_abonement')]
    public function index(): Response
    {
        return $this->render('abonement/index.html.twig');
    }
}
