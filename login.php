<?php
session_start();
require 'connection.php'; // تأكد أن ملف db.php يحتوي على الاتصال بقاعدة البيانات

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // التحقق من وجود بيانات
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // جلب المستخدم من قاعدة البيانات بناءً على اسم المستخدم
        $stmt = $link->prepare("SELECT * FROM signup WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // التحقق من كلمة المرور (مشفرة أو عادية)
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                header("Location: user.php");
                exit();
            } else {
                $error = "كلمة المرور غير صحيحة.";
            }
        } else {
            $error = "اسم المستخدم غير موجود.";
        }
    } else {
        $error = "الرجاء إدخال اسم المستخدم وكلمة المرور.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log In - Daily Task Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <section class="auth-section">
            <h2>Log In</h2>
            
            <!-- عرض الخطأ إذا كان موجوداً -->
            <?php if ($error): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="username">Username or Email:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="button primary">Log In</button>
            </form>
            <div class="auth-link">
                <p>Don't have an account? <a href="register.php">Sign Up</a></p>
                <p><a href="forgetpassword.php">Forgot Password?</a></p>
            </div>
        </section>
    </div>
<script src="script.js"></script>
</body>
</html>
