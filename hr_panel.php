<?php
session_start();
include('config.php');

// Check if the user is logged in and has the HR role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'HR') {
    header("Location: login.php");
    exit();
}

$hr_name = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
   <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.navbar {
    background-color: navy;
    color: #fff;
    padding: 10px 20px;
}

.navbar-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar-brand {
    font-size: 1.5em;
    font-weight: bold;
}

.navbar-motivation {
    font-size: 1em;
    font-style: italic;
}

.heading{
    margin:20px;
    font-size:50px;
    text-align: center;
}
.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    margin-top: 100px;
}

.box {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 10px;
    flex: 1 1 calc(33% - 40px);
    box-sizing: border-box;
    transition: transform 0.2s;
}

.box:hover {
    transform: scale(1.05);
}

.box h2 {
    margin-top: 0;
    font-size: 1.5em;
    color: #333;
}

.box p {
    color: #666;
}

.button {
    display: inline-block;
    padding: 10px 15px;
    margin-top: 15px;
    font-size: 1em;
    color: #fff;
    background-color: #007BFF;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s;
}

.button:hover {
    background-color: #0056b3;
}
.logout-button {
    padding: 10px 20px;
    background-color: #dc3545;
    color: #ffffff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
}
.logout-button:hover {
     background-color: #c82333;
}

    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <span class="navbar-brand">EmployeeEasy</span>
            <span class="navbar-motivation">"The only way to do great work is to love what you do." - Steve Jobs</span>
        </div>
    </nav>

    <div class="heading">
        <h2>Welcome HR, <?php echo htmlspecialchars($hr_name); ?></h2>
    </div>

    <div class="container">
        <div class="box" id="attendance">
            <h2>Attendance</h2>
            <p>Details about attendance.</p>
            <a href="index.html" class="button">View Details</a>
        </div>
        <div class="box" id="department-details">
            <h2>Department Details</h2>
            <p>Details about the department.</p>
            <a href="index.php" class="button">View Details</a>
        </div>
        <div class="box" id="project-details">
            <h2>Project Details</h2>
            <p>Details about the project.</p>
            <a href="project.php" class="button">View Details</a>
        </div>
        <div class="box" id="manager-details">
            <h2>Employee Details</h2>
            <p>Details about the employee.</p>
            <a href="employee_list.php" class="button">View Details</a>
        </div>
        <div class="box" id="meeting">
            <h2>Meeting</h2>
            <p>Details about meetings.</p>
            <a href="meeting.php" class="button">View Details</a>
        </div>
    </div>
    <div >
        <button class="logout-button" onclick="window.location.href='logout.php'">Logout</button>
    </div>
</body>
</html>

