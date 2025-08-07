<?php

require_once __DIR__ . '/url_helpers.php';

// Navbar
echo '<nav style="margin-bottom:20px;">';
echo '<a href="/">Home</a> | ';
echo '<a href="/about   ">About</a> | ';
echo '<a href="/contact">Contact</a>';
echo '</nav>';

function home()
{
    echo '<h1>Home</h1>';
    url();
}

function about()
{
    echo '<h1>About</h1>';
    url();
}

function contact()
{
    echo '<h1>Contact</h1>';
    url();
}

$page = $_GET['page'] ?? '';
switch ($page) {
    case 'about':
        about();
        break;
    case 'contact':
        contact();
        break;
    default:
        home();
        break;
}
