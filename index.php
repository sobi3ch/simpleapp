<?php

require_once __DIR__ . '/url_helpers.php';

// Navbar
echo '<nav style="margin-bottom:20px;">';
echo '<a href="/">Home</a> | ';
echo '<a href="/about   ">About</a> | ';
echo '<a href="/contact">Contact</a>';
echo '</nav>';

function renderPage($path)
{
    $titles = [
        '' => 'Home',
        'about' => 'About',
        'contact' => 'Contact'
    ];

    $title = $titles[$path] ?? 'Home';
    echo "<h1>$title</h1>";
    url();
}

$page = $_GET['page'] ?? '';
renderPage($page);
