<?php
require_once 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $department_name = $_POST['department_name'];
    $manager_name = $_POST['manager_name'];
    $employee_count = $_POST['employee_count'];
    $project_submission_date = $_POST['project_submission_date'];
    $manager_phone = $_POST['manager_phone'];

    $query = "INSERT INTO departments (department_name, manager_name, employee_count, project_submission_date, manager_phone) 
              VALUES ('$department_name', '$manager_name', '$employee_count', '$project_submission_date', '$manager_phone')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Department added successfully'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Error adding department'); window.location.href = 'index.php';</script>";
    }
}
?>