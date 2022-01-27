<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Form\PinType;
use App\Repository\PinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{
    /**
     * @Route("/", name="app_page",methods="GET")
     */
    public function index(PinRepository $pinRepository): Response
    {
        $pins = $pinRepository->findBy([], ["createdAt" => "DESC"]);
        /*   dd($pins); */
        return $this->render('pins/show_pins_front.html.twig', [
            'pins' => $pins,
        ]);
    }

    /**
     * @Route("/pins/{id<[0-9]+>}", name="app_pin_show_datails",methods="GET")
     */

    public function ShowPinsDetails(Pin $pin): Response
    {
        return $this->render('pins/show_pin_details.html.twig', [
            'pin' => $pin,
        ]);
    }

    /**
     * @Route("/pinscreate", name="add_new_pin" ,methods="GET|POST")
     */

    public function ShowAddPage(Request $request, EntityManagerInterface $em): Response
    {
        $pin = new Pin;
        $form = $this->createForm(PinType::class, $pin);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        
            $em->persist($pin);
            $em->flush();
            $this->addFlash(
                'success',
                'Your pin has been created!'
            );
            return $this->redirectToRoute("app_page");
        }
        return $this->render('pins/add_new_pin.html.twig', [
            "createForm" => $form->createView(),
        ]);
    }
    /**
     * @Route("/pins/{id<[0-9]+>}/edit", name="edit_pin" ,methods={"GET","PUT"})
     */
    public function EditPin(Pin $pin, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PinType::class, $pin, [
            'method' => 'PUT'
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash(
                'info',
                'Your pin has been upated!'
            );
            return $this->redirectToRoute("app_pin_show_datails", ['id' => $pin->getId()]);
        }

        return $this->render('pins/edit_pin.html.twig', [
            "pin" => $pin,
            "createForm" => $form->createView(),
        ]);
    }

    /**
     * @Route("/pins/{id<[0-9]+>}", name="delete_pin" ,methods={"DELETE"})
     */
    public function DeletePin(Pin $pin, Request $request, EntityManagerInterface $em): Response
    {
        /* dd($request->request->get("token")); */
        if ($this->isCsrfTokenValid("pin_delete" . $pin->getId(), $request->request->get("token"))) {
            $em->remove($pin);
            $em->flush();
            $this->addFlash(
                'warning',
                'Your pin has been deleted!'
            );
        }
        return $this->redirectToRoute("app_page");
    }

    
}