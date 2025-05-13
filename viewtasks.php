<?php
require_once 'connection.php';

session_start();

// تحقق من أن المستخدم مسجل الدخول
if (!isset($_SESSION['username'])) {
    header("Location: user.php");
    exit;
}

$username = $_SESSION['username'];
// الاحتفاظ بالقيمة الأصلية للفيلتر
$original_filter = isset($_GET['filter-status']) ? $_GET['filter-status'] : 'all';
echo "Filter Status: " . htmlspecialchars($original_filter);

if ($original_filter === 'all') {
     $query = "SELECT * FROM task WHERE username = '$username'";
} elseif ($original_filter === 'uncompleted') {
    $query = "SELECT * FROM task WHERE status != 'completed' AND  username = '$username'";
} else {
    $safe_filter = mysqli_real_escape_string($link, $original_filter);
    $query = "SELECT * FROM task WHERE status = '$safe_filter' AND  username = '$username' ";
}

// حذف المهمة
if (isset($_POST['delete-btn'])) {
    $tasktitle = mysqli_real_escape_string($link, $_POST['tasktitle']); 
    $username = $_SESSION['username']; // لا تأخذه من الفورم لأنه معروف من الجلسة
    $sql = "DELETE FROM task WHERE tasktitle = '$tasktitle' AND username='$username'";

    if ($link->query($sql) === TRUE) {
        echo "تم حذف البيان بنجاح.";
    } else {
        echo "حدث خطأ أثناء الحذف: " . $link->error;
    }
}

// تحديث حالة المهمة إلى "Completed"
if (isset($_POST['complete-btn'])) {
    $taskid = intval($_POST['taskid']);
    $update_query = "UPDATE task SET status = 'completed' WHERE id = $taskid AND username = '$username'";
    if ($link->query($update_query) === TRUE) {
        echo "تم تحديث الحالة إلى Completed.";
    } else {
        echo "حدث خطأ أثناء التحديث: " . $link->error;
    }
}

$result = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Tasks</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="view-tasks-page">
    <div class="container">
        <header>
            <h1>My Tasks</h1>
            <button class="logout-btn">Logout</button>
        </header>

        <div class="actions-bar">
            <a href="add-task.php">
                <button class="add-task-btn">New Task</button>
            </a>

            <form method="get" action="" style="display: inline;">
                <label for="filter-status">Filter by Status:</label>
                <select id="filter-status" name="filter-status" onchange="this.form.submit()">
                    <option value="all" <?= $original_filter === 'all' ? 'selected' : '' ?>>All</option>
                    <option value="uncompleted" <?= $original_filter === 'uncompleted' ? 'selected' : '' ?>>Uncompleted</option>
                    <option value="completed" <?= $original_filter === 'completed' ? 'selected' : '' ?>>Completed</option>
                </select>
            </form>
        </div>
    </div>
   
    <div class="task-list">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="task-card" style="border:1px solid black;margin-bottom:20px;padding:10px; background-color:white;color:black;border-radius:10px; display:block; width:80% ; margin:10px auto;height:150px">
                    <div class="task-title" style="font-weight:bold;"><?= htmlspecialchars($row['tasktitle']) ?></div>
                    <div class="task-desc"><?= nl2br(htmlspecialchars($row['description'])) ?></div>
                    <div class="task-meta">
                        Due: <?= htmlspecialchars($row['duedate']) ?> |
                        Priority: <?= ucfirst(htmlspecialchars($row['priority'])) ?> |
                        Status: <?= ucfirst(htmlspecialchars($row['status'])) ?>
                    </div>
                    <div class="actions">
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="tasktitle" value="<?= htmlspecialchars($row['tasktitle']) ?>">
                            <button type="submit" name="delete-btn" class="delete-btn">Delete</button>
                        </form>
                        <button class="edit-btn" onclick="window.location.href='add-task.php?edit_id=<?= $row['id'] ?>'">Edit</button>

                        <!-- زر لتحديث الحالة إلى Completed -->
                        <?php if ($row['status'] !== 'completed'): ?>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="taskid" value="<?= $row['id'] ?>">
                                <button type="submit" name="complete-btn" class="complete-btn">Mark as Completed</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No tasks found for the selected filter.</p>
        <?php endif; ?>
    </div>
</body>
</html>









