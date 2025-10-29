<?php

// Simple router for our Twig application
$request_uri = $_SERVER['REQUEST_URI'];
$script_name = $_SERVER['SCRIPT_NAME'];

// Remove query string
if (($pos = strpos($request_uri, '?')) !== false) {
    $request_uri = substr($request_uri, 0, $pos);
}

// Remove base path
$base_path = dirname($script_name);
if ($base_path !== '/') {
    $request_uri = str_replace($base_path, '', $request_uri);
}

// Default to landing page
if ($request_uri === '/' || empty($request_uri)) {
    $template = 'landing.html.twig';
    $params = [];
} 
// Handle other routes
elseif ($request_uri === '/dashboard') {
    $template = 'dashboard.html.twig';
    $params = [
        'currentUser' => ['name' => 'John Doe'],
        'tickets' => [
            ['id' => 1, 'title' => 'Urgent Bug Fix', 'description' => 'Critical bug in production', 'status' => 'open', 'priority' => 'high', 'createdAt' => new DateTime()],
            ['id' => 2, 'title' => 'Feature Request', 'description' => 'New feature for dashboard', 'status' => 'in_progress', 'priority' => 'medium', 'createdAt' => new DateTime('-1 day')],
            ['id' => 3, 'title' => 'UI Enhancement', 'description' => 'Improve mobile responsiveness', 'status' => 'closed', 'priority' => 'low', 'createdAt' => new DateTime('-2 days')]
        ],
        'openTickets' => 1,
        'inProgressTickets' => 1,
        'closedTickets' => 1,
    ];
} 
elseif ($request_uri === '/tickets') {
    $template = 'tickets.html.twig';
    $params = [
        'tickets' => [
            ['id' => 1, 'title' => 'Urgent Bug Fix', 'description' => 'Critical bug in production', 'status' => 'open', 'priority' => 'high', 'createdAt' => new DateTime()],
            ['id' => 2, 'title' => 'Feature Request', 'description' => 'New feature for dashboard', 'status' => 'in_progress', 'priority' => 'medium', 'createdAt' => new DateTime('-1 day')],
            ['id' => 3, 'title' => 'UI Enhancement', 'description' => 'Improve mobile responsiveness', 'status' => 'closed', 'priority' => 'low', 'createdAt' => new DateTime('-2 days')]
        ]
    ];
} 
elseif ($request_uri === '/login') {
    $template = 'login.html.twig';
    $params = [];
} 
elseif ($request_uri === '/signup') {
    $template = 'signup.html.twig';
    $params = [];
} 
else {
    // 404 page
    http_response_code(404);
    $template = 'base_public.html.twig';
    $params = ['content' => '<h1 class="text-3xl font-bold text-center mt-20">404 - Page Not Found</h1>'];
}

// Set up Twig
require_once __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/php-twig/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
    'debug' => true,
]);

// Render template
try {
    echo $twig->render($template, $params);
} catch (Exception $e) {
    echo "Error rendering template: " . $e->getMessage();
}