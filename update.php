<?php
if (isset($_POST['mark_completed'])) {
    $title = trim($_POST['title']);

    require_once 'connection.php';

    // تحديث حالة المهمة بناءً على العنوان
    $stmt = $link->prepare("UPDATE task SET status = 'completed' WHERE tasktitle = ?");
    $stmt->bind_param("s", $title);
    $stmt->execute();
    $stmt->close();

    // إعادة التوجيه لصفحة المهام
    header("Location: viewtasks.php");
    exit;
}
?>
