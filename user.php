<?php
session_start();

// تحقق من وجود اسم المستخدم
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 200px;
            background-color:rgb(63, 126, 133);
            color: white;
            padding-top: 20px;
            height: 100%;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 15px;
            text-decoration: none;
           
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        .main-content {
            flex-grow: 1;
            padding: 30px;
            background-color: #ecf0f1;
        }

        h1 {
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="add-task.php">➕ Add Task</a>
        <a href="viewtasks.php">📋 My Tasks</a>
        <a href="forgetpassword.php">🔒 Update Password</a>
        <a href="analyze.php">📊 Analyze Your Tasks</a>

    </div>

    <div class="main-content">
        <h1>👋 Welcome, <?= htmlspecialchars($username) ?>!</h1>
        <p>This is your dashboard. Use the menu on the left to navigate.</p>
    </div>
</body>
</html>

