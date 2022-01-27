<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsersController extends AbstractController
{
    /**
     * @Route("/add-users", name="add_users")
     */
    public function AddNewUser(Request $request, EntityManagerInterface $em): Response
    {
        $user = new User;

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
/* dd( $form->createView()); */
        return $this->render('users/add_users.html.twig', [
            "createForm" => $form->createView(),
        ]);
    }
}