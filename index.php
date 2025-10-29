<?php
require_once __DIR__ . '/vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// Load templates from the templates directory
$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader, [
    'cache' => false, // or __DIR__ . '/cache' if you want caching
    'debug' => true,
]);

// Example data
$data = [
    'title' => 'HNG Twig Ticket Management',
    'message' => 'Welcome to Twig-powered version!',
];

// Render your main template
echo $twig->render('index.html.twig', $data);
