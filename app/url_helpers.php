<?php

function p($msg)
{
    echo "$msg<br />\n";
}

/**
 * Print URL schema information.
 */
function url_schema()
{
    echo "<h3>URL schema information</h3>";

    $info = [
        'PHP Version' => phpversion(),
        'Server Software' => $_SERVER['SERVER_SOFTWARE'] ?? 'N/A',
        'Server Protocol' => $_SERVER['SERVER_PROTOCOL'] ?? 'N/A',
        'Scheme' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http',
        'Port' => $_SERVER['SERVER_PORT'] ?? 'N/A',
        'Path' => $_SERVER['REQUEST_URI'] ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : 'N/A',
        'Query String' => $_SERVER['QUERY_STRING'] ?? 'N/A',
    ];

    echo "<pre>";
    print_r($info);
    echo "</pre>";

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
}


function downward_api_info()
{
    echo "<h3>Downward API Information</h3>";

    $info = [
        'pod_name' => getenv('POD_NAME') ?? 'N/A',
        'pod_namespace' => getenv('POD_NAMESPACE') ?? 'N/A',
        'pod_ip' => getenv('POD_IP') ?? 'N/A',
        'node_name' => getenv('NODE_NAME') ?? 'N/A',
        'pod_service_account' => getenv('POD_SERVICE_ACCOUNT') ?? 'N/A',
    ];

    $info['annotations'] = parsePodInfoFile('/etc/podinfo/annotations');
    $info['labels']      = parsePodInfoFile('/etc/podinfo/labels');

    echo "<pre>";
    print_r($info);
    echo "</pre>";
}

function parsePodInfoFile(string $filePath): array
{
    // Check if the file exists and is readable
    if (!file_exists($filePath) || !is_readable($filePath)) {
        // Return an empty array or throw an exception if the file isn't accessible
        return [];
    }

    // Read the entire file content into a string
    $fileContent = file_get_contents($filePath);

    // Split the content by newline characters into an array of lines
    $lines = explode("\n", $fileContent);

    $result = [];
    foreach ($lines as $line) {
        // Skip empty lines
        $trimmedLine = trim($line);
        if (empty($trimmedLine)) {
            continue;
        }

        // Split each line at the first '=' to separate the key and value
        // The limit parameter ensures that only the first '=' is used for splitting
        $parts = explode("=", $trimmedLine, 2);

        // A valid line should have a key and a value
        if (count($parts) === 2) {
            $key = trim($parts[0]);
            $value = trim($parts[1], '"'); // Remove surrounding quotes from the value

            // Add the key-value pair to the result array
            $result[$key] = $value;
        }
    }

    return $result;
}
