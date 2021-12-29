<?php

namespace App\Controller;

use App\Repository\PinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{
    /**
     * @Route("/", name="app_page")
     */
    public function index(PinRepository $pinRepository): Response
    {
        $pins=$pinRepository->findAll();
        
        return $this->render('pins/show_pins_front.html.twig', [
              'pins'=>$pins,
        ]);
    }
}