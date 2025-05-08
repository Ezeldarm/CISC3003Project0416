<?php
require_once 'db_config.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = "";
$message = "";
$status = "error";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);

    if (empty($email)) {
        $message = "Please enter your email address.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
    } else {
        $sql = "SELECT id FROM users WHERE email = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $reset_token = bin2hex(random_bytes(50));
                    $reset_token_expiry = date('Y-m-d H:i:s', strtotime('+24 hour'));

                    $sql_update = "UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?";
                    if ($stmt_update = mysqli_prepare($link, $sql_update)) {
                        mysqli_stmt_bind_param($stmt_update, "sss", $reset_token, $reset_token_expiry, $email);
                        if (mysqli_stmt_execute($stmt_update)) {
                            $mail = new PHPMailer(true);
                            try {
                                $mail->isSMTP();
                                
                                $mail->Host = 'smtp.163.com'; // 163 Mail SMTP Host
                                $mail->SMTPAuth = true;
                                $mail->Username = 'cowmeat1122@163.com'; // Your 163 Mail
                                $mail->Password = 'BTiWT354sUVpzeH5'; // Your 163 Mail Authorization Code
                                $mail->SMTPSecure = 'ssl'; // Use SSL
                                $mail->Port = 465; // Recommended port 465

                                $mail->setFrom('cowmeat1122@163.com', 'China Travel Starter Pack');
                                $mail->addAddress($email);
                                $mail->Subject = 'Password Reset Request - China Travel Starter Pack';
                                $reset_link = "http://" . $_SERVER['HTTP_HOST'] . "/cisc3003-dc326264/CISC3003Project0416/reset_password.php?token=" . $reset_token;
                                $mail->Body = "Hello,\n\nPlease click the following link to reset your password:\n" . $reset_link . "\n\nThis link will expire in 1 hour.\n\nThank you,\nChina Travel Starter Pack Team";
                                $mail->AltBody = "Please copy this link to your browser to reset password: $reset_link";

                                $mail->send();
                                $message = "Password reset link has been sent to your email. Please check your inbox (including spam folder).";
                                $status = "success";
                            } catch (Exception $e) {
                                $message = "Failed to send email. Please try again later. Error: {$mail->ErrorInfo}";
                            }
                        } else {
                            $message = "Failed to update reset token. Please try again later.";
                        }
                        mysqli_stmt_close($stmt_update);
                    }
                } else {
                    $message = "If this email exists in our system, a password reset link has been sent. Please check your inbox (including spam folder).";
                    $status = "success";
                }
            } else {
                $message = "Error while checking email. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        } else {
            $message = "Error preparing query. Please try again later.";
        }
    }

    mysqli_close($link);
    header("location: forgot_password.html?message=" . urlencode($message) . "&status=" . $status);
    exit();
} else {
    header("location: forgot_password.html");
    exit();
}
?>