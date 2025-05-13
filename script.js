//register.html
document.querySelector('form').addEventListener('submit', function(e) {
    const password = document.getElementById("password").value;
    const confirm = document.getElementById("confirmPassword").value;

    if (password !== confirm) {
        e.preventDefault(); 
        alert("Passwords do not match!");
    }
});



// forgitpassward.html
document.querySelector('form').addEventListener('submit', function(e) {
    const email = document.getElementById("email").value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(email)) {
        e.preventDefault();
        alert("Please enter a valid email address.");
    }
});


document.addEventListener('DOMContentLoaded', function () {

    //add-task.html
    const addTaskForm = document.getElementById('addTaskForm');
    const dueDateInput = document.getElementById('dueDate');

    if (addTaskForm) {
        
        if (dueDateInput) {
            const today = new Date().toISOString().split('T')[0];
            dueDateInput.value = today;
        }
    }

    //viewtasks.html
    const filterStatus = document.getElementById('filter-status');

    if (filterStatus) {
        filterStatus.addEventListener('change', function () {
            const selectedStatus = this.value;
            // هتعيد توجيه الصفحة مع باراميتر الحالة
            window.location.href = `view_tasks.php?status=${selectedStatus}`;
        });
    }

});

document.getElementById('backBtn').addEventListener('click', function () {
    window.location.href = 'viewtasks.html'; 
});

