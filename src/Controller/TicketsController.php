<?php
namespace App\Controller;

use App\Service\AuthService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketsController extends AbstractController
{
    #[Route('/tickets', name: 'tickets')]
    public function index(): Response
    {
        // Check if user is authenticated
        if (!AuthService::isAuthenticated()) {
            return $this->redirectToRoute('login');
        }
        
        $currentUser = AuthService::getCurrentUser();
        
        // Sample ticket data (in a real app, this would come from a database)
        $tickets = [
            ['id' => 1, 'title' => 'Urgent Bug Fix', 'description' => 'Critical bug in production', 'status' => 'open', 'priority' => 'high', 'createdAt' => date('c')],
            ['id' => 2, 'title' => 'Feature Request', 'description' => 'New feature for dashboard', 'status' => 'in_progress', 'priority' => 'medium', 'createdAt' => date('c', strtotime('-1 day'))],
            ['id' => 3, 'title' => 'UI Enhancement', 'description' => 'Improve mobile responsiveness', 'status' => 'closed', 'priority' => 'low', 'createdAt' => date('c', strtotime('-2 days'))]
        ];
        
        return $this->render('tickets.html.twig', [
            'currentUser' => $currentUser,
            'tickets' => $tickets
        ]);
    }
}