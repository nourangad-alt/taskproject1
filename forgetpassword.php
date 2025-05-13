<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    // تحقق من وجود الإيميل في جدول المستخدمين
    $stmt = $link->prepare("SELECT * FROM signup WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // توليد رمز فريد
        $token = bin2hex(random_bytes(32));
        $url = "http://localhost/taskproject/reset.php?token=$token"; // غير العنوان حسب مشروعك

        // احذف أي رمز سابق لنفس الإيميل
        $link->query("DELETE FROM password_resets WHERE email = '$email'");

        // أدخل الرمز في جدول password_resets
        $stmt = $link->prepare("INSERT INTO password_resets (email, token) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $token);
        $stmt->execute();

        // إرسال الإيميل (بشكل بسيط)
        $subject = "رابط استعادة كلمة المرور";
        $message = "انقر على الرابط التالي لإعادة تعيين كلمة المرور:\n$url";
        $headers = "From: no-reply@taskmanager.com";

        if (mail($email, $subject, $message, $headers)) {
            $success = "تم إرسال رابط إعادة التعيين إلى بريدك الإلكتروني.";
        } else {
            $error = "حدث خطأ أثناء إرسال البريد.";
        }
    } else {
        $error = "البريد الإلكتروني غير مسجل.";
    }
}
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password - Daily Task Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <section class="auth-section">
            <h2>Forgot Your Password?</h2>
            <p>Enter your email address and we'll send you a link to reset your password.</p>
            <form action="forgetpassword.php" method="POST">
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <button type="submit" class="button primary">Send Reset Link</button>
            </form>
            <div class="auth-links">
                <p><a href="login.html">Back to Log In</a></p>
            </div>
        </section>
    </div>
    <script src="script.js"></script>
</body>
</html>

