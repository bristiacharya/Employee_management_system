<?php
session_start();
include('config.php');

// Check if the user is logged in and has the admin role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> <!-- Link to Google Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> <!-- Link to Font Awesome -->
</head>
<style>
/* General Styles */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    max-width: 90%;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

h1 {
    color: #333;
    margin-bottom: 30px;
    font-size: 2em;
}

/* Admin Boxes Styles */
.admin-boxes {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.admin-box {
    background: linear-gradient(135deg, #72EDF2 10%, #5151E5 100%);
    color: #fff;
    border-radius: 10px;
    width: 200px;
    padding: 20px;
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
    position: relative;
    overflow: hidden;
}

.admin-box a {
    color: #fff;
    text-decoration: none;
    display: block;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.admin-box i {
    font-size: 2.5em;
    margin-bottom: 10px;
}

.admin-box h2 {
    margin: 0;
    font-size: 1.2em;
    margin-bottom: 10px;
}

.admin-box p {
    margin: 0;
    font-size: 0.9em;
}

.admin-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* Responsive Design */
@media (max-width: 768px) {
    .admin-box {
        width: 45%;
    }
}

@media (max-width: 480px) {
    .admin-box {
        width: 90%;
    }

    h1 {
        font-size: 1.5em;
    }
}

</style>
<body>
    <div class="container">
        <h1>Welcome, Admin</h1>
        <div class="admin-boxes">
            <div class="admin-box">
                <a href="attendance.php">
                    <i class="fas fa-calendar-check"></i>
                    <h2>Check Attendance</h2>
                </a>
            </div>
            <div class="admin-box">
                <a href="admin_panel.php">
                    <i class="fas fa-user-clock"></i>
                    <h2>Check Leave Requests</h2>
                </a>
            </div>
            <div class="admin-box">
                <a href="project.php">
                    <i class="fas fa-project-diagram"></i>
                    <h2>Project Details</h2>
                </a>
            </div>
            <div class="admin-box">
                <a href="index.php">
                    <i class="fas fa-building"></i>
                    <h2>Department Details</h2>
                </a>
            </div>
            <div class="admin-box">
                <a href="admin_employee_details.php">
                    <i class="fas fa-users"></i>
                    <h2>Employee Details</h2>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
