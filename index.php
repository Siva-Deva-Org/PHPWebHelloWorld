<?php
declare(strict_types=1);

// Simulate an unsafe input display (XSS Vulnerability)
$userInput = $_GET['name'] ?? 'Guest';

function renderHeader(string $title): void
{
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>$title</title>
    </head>
    <body>
    <h1>$title</h1>";
}

function renderFooter(): void
{
    echo "<footer>
        <p>&copy; " . date("Y") . " My Web Project</p>
    </footer>
    </body>
    </html>";
}

// Main page logic
renderHeader('Welcome Page');

// Intentional XSS vulnerability: echoing unsanitized user input!
echo "<p>Hello, $userInput!</p>";

renderFooter();
?>
