<?php

namespace App\Controller;

use App\Service\AuthService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(Request $request): Response
    {
        // Initialize test user if needed
        AuthService::initializeTestUser();
        
        $errors = [];
        $email = '';
        
        if ($request->getMethod() === 'POST') {
            $email = $request->request->get('email');
            $password = $request->request->get('password');
            
            // Simple validation
            if (empty($email)) {
                $errors['email'] = 'Email is required';
            }
            
            if (empty($password)) {
                $errors['password'] = 'Password is required';
            }
            
            if (empty($errors)) {
                $user = AuthService::authenticate($email, $password);
                if ($user) {
                    AuthService::createSession($user);
                    return $this->redirectToRoute('dashboard');
                } else {
                    $errors['general'] = 'Invalid email or password';
                }
            }
        }
        
        return $this->render('login.html.twig', [
            'errors' => $errors,
            'last_username' => $email
        ]);
    }
    
    #[Route('/logout', name: 'logout')]
    public function logout(): Response
    {
        AuthService::clearSession();
        return $this->redirectToRoute('landing');
    }
}