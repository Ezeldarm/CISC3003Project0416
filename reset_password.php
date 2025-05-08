<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db_config.php';

if (!$link) {
    die("Database connection failed: " . mysqli_connect_error());
}

$token = $new_password = $confirm_password = "";
$message = "";
$status = "error";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = trim($_POST["token"]);
    $new_password = trim($_POST["new_password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if (empty($token)) {
        $message = "Invalid reset token.";
    } elseif (empty($new_password)) {
        $message = "Please enter a new password.";
    } elseif (strlen($new_password) < 6) {
        $message = "Password must be at least 6 characters.";
    } elseif ($new_password !== $confirm_password) {
        $message = "Passwords do not match.";
    } else {
        $sql = "SELECT id FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $token);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $user_id);
                    mysqli_stmt_fetch($stmt);
                    mysqli_stmt_close($stmt);

                    $sql_update = "UPDATE users SET password_hash = ?, reset_token = NULL, reset_token_expiry = NULL WHERE id = ?";
                    if ($stmt_update = mysqli_prepare($link, $sql_update)) {
                        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt_update, "si", $hashed_password, $user_id);
                        if (mysqli_stmt_execute($stmt_update)) {
                            $message = "Password has been reset successfully! Please login with your new password.";
                            $status = "success";
                            mysqli_stmt_close($stmt_update);
                            mysqli_close($link);
                            header("location: login.php");
                            exit();
                        } else {
                            $message = "Failed to update password, please try again later.";
                        }
                        mysqli_stmt_close($stmt_update);
                    }
                } else {
                    $message = "Invalid or expired reset link, please request a new one.";
                }
            } else {
                $message = "Error verifying token, please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
    header("location: reset_password.html?message=" . urlencode($message) . "&status=" . $status);
    exit();
} else {
    if (isset($_GET['token']) && !empty($_GET['token'])) {
        $token = trim($_GET['token']);
        $sql = "SELECT id FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $token);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Validation passed, redirect to reset_password.html with token
                    mysqli_stmt_close($stmt);
                    mysqli_close($link);
                    header("location: reset_password.html?token=" . urlencode($token));
                    exit();
                } else {
                    $message = "Invalid or expired reset link, please request a new one.";
                    $status = "error";
                    mysqli_stmt_close($stmt);
                    mysqli_close($link);
                    header("location: forgot_password.html?message=" . urlencode($message) . "&status=" . $status);
                    exit();
                }
            } else {
                $message = "Error verifying link, please try again later.";
                $status = "error";
                mysqli_stmt_close($stmt);
                mysqli_close($link);
                header("location: forgot_password.html?message=" . urlencode($message) . "&status=" . $status);
                exit();
            }
        }
        mysqli_close($link);
    } else {
        $message = "Missing reset token, please request through the forgot password page.";
        $status = "error";
        mysqli_close($link);
        header("location: forgot_password.html?message=" . urlencode($message) . "&status=" . $status);
        exit();
    }
}
?>