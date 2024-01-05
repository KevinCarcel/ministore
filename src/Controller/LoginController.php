<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Never_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login', methods: ['GET','POST'])]
    public function index(AuthenticationUtils $authenticationUtils,EntityManagerInterface $manager): Response
    {
        //get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        //last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/login.html.twig', [
            'last_username' => $lastUsername,
            'error'=> $error,
        ]);
    }

    #[Route('/deconnexion',name:'app_logout')]
    public function logout(): never
    {
        //controller can be blank: it will never be called
        throw new Exception('Don\'t forget to activate logout in security.yaml');

    }
}