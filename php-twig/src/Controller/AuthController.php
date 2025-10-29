<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(): Response
    {
        return $this->render('pages/auth/login.html.twig');
    }

    #[Route('/signup', name: 'signup')]
    public function signup(): Response
    {
        return $this->render('pages/auth/signup.html.twig');
    }
}