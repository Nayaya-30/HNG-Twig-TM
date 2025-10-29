<?php
namespace App\Controller;

use App\Service\AuthService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
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
        
        $openTickets = count(array_filter($tickets, fn($t) => $t['status'] === 'open'));
        $inProgressTickets = count(array_filter($tickets, fn($t) => $t['status'] === 'in_progress'));
        $closedTickets = count(array_filter($tickets, fn($t) => $t['status'] === 'closed'));
        
        return $this->render('dashboard.html.twig', [
            'currentUser' => $currentUser,
            'tickets' => $tickets,
            'openTickets' => $openTickets,
            'inProgressTickets' => $inProgressTickets,
            'closedTickets' => $closedTickets
        ]);
    }
}