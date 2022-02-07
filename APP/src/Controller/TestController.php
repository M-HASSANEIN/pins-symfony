<?php
namespace App\Controller;
use App\Service\MessageGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;





class TestController extends AbstractController
{
    /**
     * @Route("/products/new", name ="test")
     */
    public function Getbook(MessageGenerator $messageGenerator): Response
    {
        // thanks to the type-hint, the container will instantiate a
        // new MessageGenerator and pass it to you!
        // ...

        
        $message = $messageGenerator->getHappyMessage();
        dd($message);
       dd($this->addFlash('success', $message)) ;
        // ...
    }
}