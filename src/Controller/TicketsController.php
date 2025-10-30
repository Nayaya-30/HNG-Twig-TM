<?php
namespace App\Controller;

use App\Service\AuthService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketsController extends AbstractController
{
    #[Route('/tickets', name: 'app_tickets')]
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

    #[Route('/tickets/new', name: 'app_tickets_new')]
    public function new(): Response
    {
        if (!AuthService::isAuthenticated()) {
            return $this->redirectToRoute('app_login');
        }
        
        return $this->render('tickets/new.html.twig');
    }

    #[Route('/tickets/{id}/edit', name: 'app_tickets_edit')]
    public function edit(int $id): Response
    {
        if (!AuthService::isAuthenticated()) {
            return $this->redirectToRoute('app_login');
        }
        
        // In a real app, fetch the ticket from database
        $ticket = null; // Replace with actual ticket fetch
        
        if (!$ticket) {
            throw $this->createNotFoundException('Ticket not found');
        }
        
        return $this->render('tickets/edit.html.twig', [
            'ticket' => $ticket
        ]);
    }

    #[Route('/tickets/{id}/delete', name: 'app_tickets_delete', methods: ['GET'])]
    public function delete(int $id): Response
    {
        if (!AuthService::isAuthenticated()) {
            return $this->redirectToRoute('app_login');
        }
        
        // In a real app, delete the ticket from database
        
        $this->addFlash('success', 'Ticket deleted successfully');
        return $this->redirectToRoute('app_tickets');
    }
}