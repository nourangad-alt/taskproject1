<?php
// الاتصال بقاعدة البيانات
require_once 'connection.php';

// جلب محتوى سياسة الخصوصية من قاعدة البيانات
$query = "SELECT * FROM task WHERE title = 'Privacy Policy'";
$result = mysqli_query($link, $query);
$page = mysqli_fetch_assoc($result);

// التحقق مما إذا كانت الصفحة موجودة
if (!$page) {
    echo "لم يتم العثور على سياسة الخصوصية.";
    exit;
}

$page_title = $page['title'];
$page_content = $page['content'];
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1><?php echo htmlspecialchars($page_title); ?></h1>
    </header>

    <main>
        <div class="content">
            <p><?php echo nl2br(htmlspecialchars($page_content)); ?></p>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Your Website. All rights reserved.</p>
    </footer>
</body>
</html>

