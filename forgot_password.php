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
        $message = "請輸入您的電郵地址。";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "請輸入有效的電郵地址。";
    } else {
        $sql = "SELECT id FROM users WHERE email = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $reset_token = bin2hex(random_bytes(50));
                    $reset_token_expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

                    $sql_update = "UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?";
                    if ($stmt_update = mysqli_prepare($link, $sql_update)) {
                        mysqli_stmt_bind_param($stmt_update, "sss", $reset_token, $reset_token_expiry, $email);
                        if (mysqli_stmt_execute($stmt_update)) {
                            $mail = new PHPMailer(true);
                            try {
                                $mail->isSMTP();
                                
                                $mail->Host = 'smtp-mail.outlook.com';
                                $mail->SMTPAuth = true;
                                $mail->Username = 'xxx@outlook.com'; // 填你的 Outlook 郵箱
                                $mail->Password = 'xxx'; // 填你的 Outlook 密碼或應用程式密碼
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                $mail->Port = 587;

                                $mail->setFrom('xxx@outlook.com', 'China Travel Starter Pack');
                                
                                $mail->addAddress($email);
                                $mail->Subject = '密碼重置請求 - China Travel Starter Pack';
                                $reset_link = "http://" . $_SERVER['HTTP_HOST'] . "/reset_password.php?token=" . $reset_token;
                                $mail->Body = "您好,\n\n請點擊以下連結重置您的密碼：\n" . $reset_link . "\n\n此連結將在1小時後失效。\n\n謝謝,\nChina Travel Starter Pack 團隊";
                                $mail->AltBody = "請複製以下連結到瀏覽器重置密碼：$reset_link";

                                $mail->send();
                                $message = "已發送密碼重置連結到您的電郵，請檢查收件箱（包括垃圾郵件）。";
                                $status = "success";
                            } catch (Exception $e) {
                                $message = "發送郵件失敗，請稍後再試。錯誤：{$mail->ErrorInfo}";
                            }
                        } else {
                            $message = "更新重置令牌失敗，請稍後再試。";
                        }
                        mysqli_stmt_close($stmt_update);
                    }
                } else {
                    $message = "已發送密碼重置連結到您的電郵，請檢查收件箱（包括垃圾郵件）。";
                    $status = "success";
                }
            } else {
                $message = "查詢電郵時出錯，請稍後再試。";
            }
            mysqli_stmt_close($stmt);
        } else {
            $message = "準備查詢時出錯，請稍後再試。";
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