<?php
// Call session_start() only at the beginning of the file
session_start();

// If user is already logged in, redirect to homepage
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

// Include database configuration file
require_once 'db_config.php';

// Define variables and initialize with empty values
$login_identifier = $password = "";
$login_identifier_err = $password_err = $login_err = "";
$error_message = "";

// Process POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if login identifier (username or email) is empty
    if (empty(trim($_POST["login_identifier"]))) {
        $login_identifier_err = "Please enter username or email.";
    } else {
        $login_identifier = trim($_POST["login_identifier"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // If all inputs are valid
    if (empty($login_identifier_err) && empty($password_err)) {
        // Prepare a select statement to find user by username or email
        $sql = "SELECT id, username, email, password_hash, email_verified FROM users WHERE username = ? OR email = ?";
        
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_identifier, $param_identifier);
            
            // Set parameters
            $param_identifier = $login_identifier;
            
            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if user exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $email, $hashed_password, $email_verified);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, start a new session
                            session_regenerate_id(); // Prevent session fixation attacks
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["email"] = $email;
                            $_SESSION["email_verified"] = $email_verified;
                            $_SESSION["user_id"] = $id;
                            
                            // Check for redirect URL
                            if (isset($_SESSION['redirect_after_login'])) {
                                $redirect_url = $_SESSION['redirect_after_login'];
                                unset($_SESSION['redirect_after_login']);
                                header("location: " . $redirect_url);
                            } else {
                                header("location: index.php");
                            }
                            exit();
                        } else {
                            // Password is not valid
                            $login_err = "Invalid username/email or password.";
                        }
                    }
                } else {
                    // User doesn't exist
                    $login_err = "Invalid username/email or password.";
                }
            } else {
                $login_err = "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // If there are errors, update $error_message
    if (!empty($login_identifier_err) || !empty($password_err) || !empty($login_err)) {
        $error_message = trim($login_identifier_err . " " . $password_err . " " . $login_err);
    }
}

// Close connection
mysqli_close($link);

// Display login page
require_once 'login_view.php';
exit();
?>