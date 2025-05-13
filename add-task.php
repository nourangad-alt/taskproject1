<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Task</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body class="add-task-page">
    <h1>Add New Task</h1>

<form id="addTaskForm"  action="add-task.php" method="post"   >

<?php if (isset($_GET['edit_id'])): ?>
    <input type="hidden" name="edit_id" value="<?= htmlspecialchars($_GET['edit_id']) ?>">
<?php endif; ?>


        <div>
            <label for="title">Task Title:</label>
            <input type="text" id="title" name="title" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>
        </div>

        <div>
            <label for="dueDate">Due Date:</label>
            <input type="date" id="dueDate" name="dueDate">
        </div>

        <div>
            <label for="priority">Priority:</label>
            <select id="priority" name="priority">
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select>
        </div>
        <div>
    <!-- <label for="status">Status:</label> 
    <select id="status" name="status" required>
        <option value="New">New</option>
        <option value="in-progress">in-progress</option>
        <option value="Completed">Completed</option>
    </select>
       </div>-->
 


     <input type="submit" name="update"  value="update"  >

        <input type="submit" name="AddTask"  value="Add Task"  >

        <style>
           input[type="submit"] {
            padding: 0.3em 0.6em;
            border-radius: 5px;
            font-size: 0.8em;
            color: #173;
            background-color: #4CAF50; /* يمكنك إضافة لون الخلفية هنا */
            border: none; /* لإزالة الحدود إن أردت */
           }
    </style>
        
</form>
<button id="back" onclick="window.location.href='user.php'" class="back" padding: 0.3em 0.6em;
    border-radius: 5px;
    font-size: 0.8em;
    color: #173; >← Go Back</button>




<!-- <button id="backBtn" onclick="window.location.href='user.php'" class="back-button">← Go Back</button> -->
<script src="script.js"></script>
</body>
</html>





<?php
session_start(); 
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // أو أي صفحة تسجيل دخول
    exit;
}
if(isset($_POST['AddTask']))
{
$title=$_POST['title'];
$description=$_POST['description'];
$dueDate=$_POST['dueDate'];
$priority=$_POST['priority'];
//$status = $_POST['status']; // استلام الحالة
$title = trim($_POST['title']);
$description = trim($_POST['description']);
$dueDate = trim($_POST['dueDate']);
$priority = trim($_POST['priority']);
$status = 'uncompleted'; // ← هذا هو السطر الجديد
 $username = $_SESSION['username']; // ← أخذ اسم المستخدم من الجلسة


require_once 'connection.php';
$result=mysqli_query ($link  , "insert into task (tasktitle , description , duedate , priority ,status ,username) values ('$title' , '$description' , '$dueDate' , '$priority' , ' $status' , '$username')");



}

/*$username = $_SESSION['username'] ?? '';

$taskData = [
    'tasktitle' => '',
    'description' => '',
    'duedate' => '',
    'priority' => '',
    'status' => ''
];

$isEdit = false;

// جلب بيانات المهمة للتعديل
if (isset($_GET['edit_id'])) {
    $id = intval($_GET['edit_id']);
    $isEdit = true;

    $query = "SELECT * FROM task WHERE id = $id AND username = '$username'";
    $result = mysqli_query($link, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $taskData = $row;
    } else {
        echo "لم يتم العثور على المهمة.";
        exit;
    }
}

// حفظ التعديلات أو إضافة جديدة
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tasktitle = mysqli_real_escape_string($link, $_POST['tasktitle']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $duedate = $_POST['duedate'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];

    if (isset($_POST['edit_id'])) {
        // تعديل مهمة
        $id = intval($_POST['edit_id']);
        $update = "UPDATE task SET 
            tasktitle = '$tasktitle',
            description = '$description',
            duedate = '$duedate',
            priority = '$priority',
            status = '$status'
            WHERE id = $id AND username = '$username'";
        mysqli_query($link, $update);
        header("Location: view-tasks.php");
        exit;
    } else {
        // إضافة جديدة
        $insert = "INSERT INTO task (tasktitle, description, duedate, priority, status, username)
            VALUES ('$tasktitle', '$description', '$duedate', '$priority', '$status', '$username')";
        mysqli_query($link, $insert);
        header("Location: view-tasks.php");
        exit;
    }
}
*/


// edit button 

if (isset($_POST['update']) && isset($_POST['edit_id'])) {
    require_once 'connection.php';


if (!isset($_POST['edit_id']) || empty($_POST['edit_id'])) {
        echo "الرجاء تحديد مهمة لتعديلها";
        exit;
}

    $id = intval($_POST['edit_id']);
    $tasktitle = $_POST['title'];
    $description = $_POST['description'];
    $duedate = $_POST['dueDate'];
    $priority = $_POST['priority'];

    $sql = "UPDATE task SET 
                tasktitle = '$tasktitle',
                description = '$description',
                duedate = '$duedate',
                priority = '$priority'
            WHERE id = $id";

    $result = mysqli_query($link, $sql);

    if ($result) {
        header("Location: add-task.php");
        exit;
    } else {
        echo "حدث خطأ أثناء التحديث: " . mysqli_error($link);
    }

    mysqli_close($link);
}




















?>


