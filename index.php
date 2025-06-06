<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
                padding: 0.75rem 1rem;
                border-radius: 5px;
                font-weight: 600;
            }
            .alert-error {
                color: #ffdddd;
                background-color: rgba(255, 0, 0, 0.3);
            }
            .alert-success {
                color: #ddffdd;
                background-color: rgba(0, 128, 0, 0.3);
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

// Intentionally hardcoded credentials (Bad practice — SonarQube will flag)
$validUsername = 'admin';
$validPassword = 'password123';

// Simulate database connection (vulnerable to SQL Injection!)
function fakeDatabaseCheck($username, $password)
{
    // Simulated vulnerable query — DO NOT USE in real apps
    $conn = new mysqli("localhost", "root", "password", "mydb");
$result = $conn->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");

    
    // Simulate query execution (SonarQube will flag this as injection risk)
    if ($username === 'admin' && $password === 'password123') {
        return true;
    }
    return false;
}

$errorMessage = '';
$successMessage = '';
$userInput = $_POST['username'] ?? '';
$passwordInput = $_POST['password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Weak password comparison (should use password_hash and password_verify)
    if (fakeDatabaseCheck($userInput, $passwordInput)) {
        // Unsafe XSS vulnerability (unsanitized echo)
        $successMessage = "Welcome, <b>$userInput</b>! You have successfully logged in.";
    } else {
        $errorMessage = "Invalid username or password.";
    }
}

renderHeader('Login Page');

if ($errorMessage) {
    echo "<div class='alert alert-error'>$errorMessage</div>";
}

if ($successMessage) {
    echo "<div class='alert alert-success'>$successMessage</div>";
}

// No CSRF token — another vulnerability

if (!$successMessage) {
    ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <!-- No input validation on the username field -->
            <input type="text" id="username" name="username" class="form-control" placeholder="Enter username" required autofocus
                   value="<?php echo $userInput; ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <?php
}

renderFooter();
?>
