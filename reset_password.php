<?php
require_once 'db_config.php';

$token = $new_password = $confirm_password = "";
$message = "";
$status = "error";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = trim($_POST["token"]);
    $new_password = trim($_POST["new_password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if (empty($token)) {
        $message = "無效的重置令牌。";
    } elseif (empty($new_password)) {
        $message = "請輸入新密碼。";
    } elseif (strlen($new_password) < 6) {
        $message = "密碼至少需要6個字元。";
    } elseif ($new_password !== $confirm_password) {
        $message = "兩次輸入的密碼不一致。";
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
                            $message = "密碼已成功重置！請使用新密碼登錄。";
                            $status = "success";
                            mysqli_stmt_close($stmt_update);
                            mysqli_close($link);
                            header("location: login.php");
                            exit();
                        } else {
                            $message = "更新密碼失敗，請稍後再試。";
                        }
                        mysqli_stmt_close($stmt_update);
                    }
                } else {
                    $message = "無效或已過期的重置連結，請重新申請。";
                }
            } else {
                $message = "查詢令牌時出錯，請稍後再試。";
            }
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
    header("location: reset_password.html?message=" . urlencode($message) . "&status=" . $status);
    exit();
} else {
    if (isset($_GET['token']) && !empty($_GET['token'])) {
        $token = $_GET['token'];
        $sql = "SELECT id FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $token);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) != 1) {
                    $message = "無效或已過期的重置連結，請重新申請。";
                    $status = "error";
                    mysqli_stmt_close($stmt);
                    mysqli_close($link);
                    header("location: forgot_password.html?message=" . urlencode($message) . "&status=" . $status);
                    exit();
                }
                mysqli_stmt_close($stmt);
            } else {
                $message = "驗證連結時出錯，請稍後再試。";
                $status = "error";
                mysqli_stmt_close($stmt);
                mysqli_close($link);
                header("location: forgot_password.html?message=" . urlencode($message) . "&status=" . $status);
                exit();
            }
        }
        mysqli_close($link);
    } else {
        $message = "缺少重置令牌，請通過忘記密碼頁面申請。";
        $status = "error";
        mysqli_close($link);
        header("location: forgot_password.html?message=" . urlencode($message) . "&status=" . $status);
        exit();
    }
}
?>