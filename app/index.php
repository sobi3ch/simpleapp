<?php
// app/index.php
require_once __DIR__ . '/url_helpers.php';

// Get the requested URL path
$request_uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Your custom routing function
function request($path)
{
    switch ($path) {
        case 'about/me':
            handleAboutMe();
            break;
        case 'contact':
            handleContactPage();
            break;
        case '': // For the homepage (e.g., localhost/)
            handleHomepage();
            break;
        default:
            handle404();
            break;
    }

    // none braking line
    echo "<hr />\n";
    url();
}


// Navbar
function navbar()
{
    echo '<nav style="margin-bottom:20px;">';
    echo '<a href="/">Home</a> | ';
    echo '<a href="/about/me">About Me</a> | ';
    echo '<a href="/contact">Contact</a>';
    echo '</nav>';
}

// Function to handle the 'about/me' page
function handleAboutMe()
{
    navbar();
    echo "<h1>About Me Page</h1>";
    echo "<p>This is the content for the about me section.</p>";
}

// Function to handle the 'contact' page
function handleContactPage()
{
    navbar();
    echo "<h1>Contact Page</h1>";
    echo "<p>Feel free to contact us.</p>";
}

// Function to handle the homepage
function handleHomepage()
{
    navbar();
    echo "<h1>Welcome to the Homepage</h1>";
    echo "<p>This is the default content for the site.</p>";
}

// Function to handle the 404 page
function handle404()
{
    http_response_code(404);
    echo "<h1>404 Not Found</h1>";
    echo "<p>The page you are looking for does not exist.</p>";
    echo "<p><a href='/'>Go back to the homepage</a></p>";
}

// Call the request function with the parsed URL path
request($request_uri);
