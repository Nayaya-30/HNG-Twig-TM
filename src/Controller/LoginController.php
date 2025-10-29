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
        // Make sure the test user file exists
        AuthService::initializeTestUser();

        $errors = [];
        $email = '';
        $isSubmitting = false;

        // Handle form submission
        if ($request->isMethod('POST')) {
            $isSubmitting = true;
            $email = trim($request->request->get('email', ''));
            $password = trim($request->request->get('password', ''));

            // --- Validation ---
            if (empty($email)) {
                $errors['email'] = 'Email is required';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Enter a valid email address';
            }

            if (empty($password)) {
                $errors['password'] = 'Password is required';
            } elseif (strlen($password) < 6) {
                $errors['password'] = 'Password must be at least 6 characters';
            }

            // --- Authentication ---
            if (empty($errors)) {
                $user = AuthService::authenticate($email, $password);

                if ($user) {
                    // Create session and redirect to dashboard
                    AuthService::createSession($user);
                    $this->addFlash('success', 'Login successful! Redirecting...');
                    return $this->redirectToRoute('dashboard');
                } else {
                    $errors['general'] = 'Invalid email or password';
                }
            }
        }

        // --- Render view ---
        return $this->render('login.html.twig', [
            'errors' => $errors,
            'last_username' => $email,
            'isSubmitting' => $isSubmitting
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout(): Response
    {
        AuthService::clearSession();
        $this->addFlash('success', 'You have been logged out successfully.');
        return $this->redirectToRoute('landing');
    }
}