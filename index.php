<?php

function p($msg)
{
    echo "$msg<br />\n";
}


p("URL:");
p("<ul>");

$server_software = $_SERVER['SERVER_SOFTWARE'] ?? 'N/A';
p("<li>Server Software: <b>$server_software</b></li>");

$server_protocol = $_SERVER['SERVER_PROTOCOL'] ?? 'N/A';
p("<li>Server Protocol: <b>$server_protocol</b></li>");

$scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
p("<li>Scheme: <b>$scheme</b></li>");

$port = $_SERVER['SERVER_PORT'] ?? 'N/A';
p("<li>Port: <b>$port</b></li>");

$path = $_SERVER['REQUEST_URI'] ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : 'N/A';
p("<li>Path: <b>$path</b></li>");

$query_string = $_SERVER['QUERY_STRING'] ?? 'N/A';
p("<li>Query String: <b>$query_string</b></li>");

p("</ul>");

// Extract fragment (anchor) from REQUEST_URI if present
$fragment = null;
if (isset($_SERVER['REQUEST_URI'])) {
    $parsed = parse_url($_SERVER['REQUEST_URI']);
    if (isset($parsed['fragment'])) {
        $fragment = $parsed['fragment'];
    }
}


// To further break down the parameters, you can use parse_str()
if (!empty($_SERVER['QUERY_STRING'])) {
    parse_str($_SERVER['QUERY_STRING'], $params);
    echo "\nParsed Query String:\n";
    print_r($params);
}
