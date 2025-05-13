<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - Daily Task Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <section class="auth-section">
            <h2>Sign Up</h2>
            <form action="register.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" id="confirmpassword" name="confirmpassword" required>
                </div>
                <button type="submit" class="button primary"  name="signup">Sign Up</button>
            </form>
            <div class="auth-links">
                <p>Already have an account? <a href="login.html">Log In</a></p>
            </div>
        </section>
    </div>
<script src="script.js"></script>
</body>
</html>

<?php
if (isset($_POST['signup'])) 
{
    require_once 'connection.php';

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmpassword = trim($_POST['confirmpassword']); // انتبهي لاسم الحقل!

    // تحقق من تطابق كلمتي المرور
    if ($password !== $confirmpassword) {
        echo "<script>alert('كلمة المرور وتأكيدها غير متطابقين'); window.history.back();</script>";
        exit;
    }

    // تشفير كلمة المرور
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // إعداد الاستعلام
    $stmt = $link->prepare("INSERT INTO signup (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashedPassword);

    if ($stmt->execute()) {
        // إعادة التوجيه بعد نجاح التسجيل
    session_start(); // بدء الجلسة
    $_SESSION['username'] = $username; 
    header("Location:user.php");
        exit;
    } 
    else {
        echo "حدث خطأ أثناء التسجيل: " . $stmt->error;
    }

    $stmt->close();
}
?>

