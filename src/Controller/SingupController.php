<?php

namespace App\Controller;

use App\Service\AuthService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignupController extends AbstractController
{
    #[Route('/signup', name: 'signup')]
    public function index(Request $request): Response
    {
        $errors = [];
        $formData = [
            'name' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => ''
        ];
        
        if ($request->getMethod() === 'POST') {
            $formData['name'] = trim($request->request->get('name'));
            $formData['email'] = trim($request->request->get('email'));
            $formData['password'] = $request->request->get('password');
            $formData['confirmPassword'] = $request->request->get('confirmPassword');
            
            // Validation
            if (empty($formData['name'])) {
                $errors['name'] = 'Name is required';
            }
            
            if (empty($formData['email'])) {
                $errors['email'] = 'Email is required';
            } elseif (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Enter a valid email';
            } elseif (AuthService::findUser($formData['email'])) {
                $errors['email'] = 'Email is already registered';
            }
            
            if (empty($formData['password'])) {
                $errors['password'] = 'Password is required';
            } elseif (strlen($formData['password']) < 6) {
                $errors['password'] = 'Password must be at least 6 characters';
            }
            
            if (empty($formData['confirmPassword'])) {
                $errors['confirmPassword'] = 'Please confirm your password';
            } elseif ($formData['password'] !== $formData['confirmPassword']) {
                $errors['confirmPassword'] = 'Passwords do not match';
            }
            
            if (empty($errors)) {
                $newUser = [
                    'id' => time(),
                    'name' => $formData['name'],
                    'email' => $formData['email'],
                    'password' => $formData['password'],
                    'createdAt' => date('c'),
                ];
                
                AuthService::registerUser($newUser);
                $this->addFlash('success', 'Account created successfully! Please log in.');
                return $this->redirectToRoute('login');
            }
        }
        
        return $this->render('signup.html.twig', [
            'errors' => $errors,
            'name' => $formData['name'],
            'email' => $formData['email']
        ]);
    }
}