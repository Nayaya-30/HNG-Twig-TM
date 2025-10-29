<?php

// Simple PHP router to serve Twig templates

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

// Set up the Twig environment
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);

// Define a simple route handler
$request = Request::createFromGlobals();

// Simple routing
$path = $request->getPathInfo() ?: '/';

switch ($path) {
    case '/':
        $template = 'landing.html.twig';
        $params = [];
        break;
    case '/dashboard':
        $template = 'dashboard.html.twig';
        $params = [
            'currentUser' => ['name' => 'John Doe'],
            'tickets' => [
                ['id' => 1, 'title' => 'Urgent Bug Fix', 'description' => 'Critical bug in production', 'status' => 'open', 'priority' => 'high', 'createdAt' => new \DateTime()],
                ['id' => 2, 'title' => 'Feature Request', 'description' => 'New feature for dashboard', 'status' => 'in_progress', 'priority' => 'medium', 'createdAt' => new \DateTime('-1 day')],
                ['id' => 3, 'title' => 'UI Enhancement', 'description' => 'Improve mobile responsiveness', 'status' => 'closed', 'priority' => 'low', 'createdAt' => new \DateTime('-2 days')]
            ],
            'openTickets' => 1,
            'inProgressTickets' => 1,
            'closedTickets' => 1,
        ];
        break;
    case '/tickets':
        $template = 'tickets.html.twig';
        $params = [
            'tickets' => [
                ['id' => 1, 'title' => 'Urgent Bug Fix', 'description' => 'Critical bug in production', 'status' => 'open', 'priority' => 'high', 'createdAt' => new \DateTime()],
                ['id' => 2, 'title' => 'Feature Request', 'description' => 'New feature for dashboard', 'status' => 'in_progress', 'priority' => 'medium', 'createdAt' => new \DateTime('-1 day')],
                ['id' => 3, 'title' => 'UI Enhancement', 'description' => 'Improve mobile responsiveness', 'status' => 'closed', 'priority' => 'low', 'createdAt' => new \DateTime('-2 days')]
            ]
        ];
        break;
    case '/login':
        $template = 'security/login.html.twig';
        $params = [];
        break;
    case '/signup':
        $template = 'signup.html.twig';
        $params = [];
        break;
    default:
        $template = 'base.html.twig';
        $params = ['content' => '<h1>404 Not Found</h1><p>The requested page could not be found.</p>'];
}

// Render the template
try {
    $content = $twig->render($template, $params);
    $response = new Response($content);
} catch (\Twig\Error\LoaderError | \Twig\Error\RuntimeError | \Twig\Error\SyntaxError | \Twig\Error\CacheError $e) {
    $response = new Response('Error rendering template: ' . $e->getMessage(), 500);
}

$response->send();