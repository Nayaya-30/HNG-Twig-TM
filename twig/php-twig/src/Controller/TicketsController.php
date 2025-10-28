<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    #[Route('/tickets', name: 'tickets')]
    public function index(): Response
    {
        return $this->render('pages/tickets/ticket_management.html.twig');
    }
}