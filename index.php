<?php

session_start();

// Include the database configuration file
require_once 'config.php';

// Initialize error messages from session, if any
$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];

// Determine which form should be active (login or register)
$activeForm = $_SESSION['active_form'] ?? 'login';

// Clear session variables after retrieving them to avoid showing old errors on refresh
session_unset();

/**
 * Function to display error messages.
 *
 * @param string $error The error message to display.
 * @return string HTML paragraph with error message if not empty, otherwise empty string.
 */
function showError($error) {
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

/**
 * Function to determine if a form should be active.
 *
 * @param string $formName The name of the form (e.g., 'login', 'register').
 * @param string $activeForm The currently active form.
 * @return string 'active' class if the form matches the active form, otherwise empty string.
 */
function isActiveForm($formName, $activeForm) {
    return $formName === $activeForm ? 'active' : '';
}

// Handle registration form submission
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email= $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
    $role = $_POST['role'];

    // Check if email already exists
    $checkEmail = $conn->query("SELECT email FROM users WHERE email ='$email'");

    if ($checkEmail->num_rows > 0) {
        $_SESSION['register_error'] = 'Email is already registered!';
        $_SESSION['active_form'] = 'register';
    } else {
        // Insert new user into the database
        $conn->query("INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')");
    }

    // Redirect back to index.php to show messages or active form
    header("Location: index.php");
    exit();
}

// Handle login form submission
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database for the user
    $result = $conn->query("SELECT * FROM users WHERE email= '$email'");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables upon successful login
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];

            // Redirect to educationintern.php for both admin and user roles
            header("Location: educationintern.php"); // Corrected redirection to .php
            exit();

        } else {
            // Invalid password
            $_SESSION['login_error'] = 'Invalid password!';
            $_SESSION['active_form'] = 'login';
        }

    } else {
        // No user found with that email
        $_SESSION['login_error'] = 'No user found with that email!';
        $_SESSION['active_form'] = 'login';
    }

    // Redirect back to index.php to show error messages
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full-Stack Login & Register Form With User & Admin Page | Codehal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-box <?= isActiveForm('login',$activeForm); ?>" id="login-form">
            <form action="login_register.php" method="post">
                <h2>Login</h2>
                <?= showError($errors['login']);?>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
                <p>Don't have an account? <a href="#" onclick="ShowForm('register-form')">Register</a></p>
            </form>
        </div>

        <div class="form-box <?= isActiveForm('register',$activeForm); ?>" id="register-form">
            <form action="login_register.php" method="post">
                <h2>Register</h2>
                <?= showError($errors['register']);?>
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role" required>
                    <option value="">--Select Role--</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit" name="register">Register</button>
                <p>Already have an account? <a href="#" onclick="ShowForm('login-form')">Login</a></p>
            </form>
        </div>
    </div>

    <!-- Script for toggling forms -->
    <script src="script.js"></script>
</body>
</html>