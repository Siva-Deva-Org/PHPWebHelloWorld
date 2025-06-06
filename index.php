<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$userInput = $_POST['username'] ?? '';

function renderHeader($title)
{
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1' />
        <title>$title</title>
        <!-- Bootstrap CSS CDN -->
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
        <style>
            body {
                background: linear-gradient(135deg, #667eea, #764ba2);
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                color: #fff;
                margin: 0;
            }
            .login-card {
                background: rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(10px);
                padding: 2rem;
                border-radius: 1rem;
                box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
                max-width: 400px;
                width: 100%;
                text-align: center;
            }
            .login-card h1 {
                margin-bottom: 1.5rem;
                font-weight: 700;
            }
            label {
                font-weight: 600;
            }
            .btn-primary {
                background-color: #6c63ff;
                border: none;
            }
            .btn-primary:hover {
                background-color: #5751d9;
            }
            .alert {
                margin-top: 1rem;
                color: #ffdddd;
                background-color: rgba(255, 0, 0, 0.3);
                border-radius: 5px;
                padding: 0.75rem 1rem;
            }
            form {
                margin-top: 1rem;
                text-align: left;
            }
        </style>
    </head>
    <body>
    <div class='login-card'>";
}

function renderFooter()
{
    echo "</div> <!-- .login-card -->
    <!-- Bootstrap JS Bundle -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>
    </body>
    </html>";
}

renderHeader('Login Page');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Intentional XSS vulnerability: echoing unsanitized user input
    echo "<p>Hello, <strong>$userInput</strong>!</p>";
} else {
    echo "<p>Please enter your username and password to login.</p>";
}
?>

<form method="post" action="">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Enter username" required autofocus>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Login</button>
</form>

<?php
renderFooter();
?>
