<?php
declare(strict_types=1);

// Basic Routing Example
$page = $_GET['page'] ?? 'home';

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

function homePage(): void
{
    echo "<p>Welcome to the home page.</p>";
}

function aboutPage(): void
{
    echo "<p>This is a sample PHP project to test SonarQube scanning.</p>";
}

function contactPage(): void
{
    echo "<p>Contact us at example@example.com.</p>";
}

// Main page logic
renderHeader(ucfirst($page));

switch ($page) {
    case 'home':
        homePage();
        break;
    case 'about':
        aboutPage();
        break;
    case 'contact':
        contactPage();
        break;
    default:
        echo "<p>404 - Page not found</p>";
}

renderFooter();
?>
