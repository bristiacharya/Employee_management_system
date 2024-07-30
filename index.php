<?php
require_once 'config.php'; // Ensure this file connects to your database

// Fetch department details
$result = mysqli_query($conn, "SELECT * FROM departments");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('background-image.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: rgba(173, 216, 230, 0.8); /* Light blue with 80% opacity */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            max-width: 900px;
            width: 100%;
            margin: 20px auto;
            animation: fadeIn 1s ease-in-out;

        }

        h1 {
            color: #333;
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 15px;
            text-align: left;
            font-size: 1.1em;
            
        }
        th {
            background-color: #FFFF00;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #FFC0CB;
        }
        .button {
            display: block;
            width: 220px;
            margin: 30px auto 0;
            padding: 15px;
            background: linear-gradient(135deg, #28a745, #218838);
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1.2em;
            transition: background 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .button:hover {
            background: linear-gradient(135deg, #218838, #28a745);
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
    <script>
        function addDepartment() {
            var department_name = prompt("Enter Department Name:");
            var manager_name = prompt("Enter Manager Name:");
            var employee_count = prompt("Enter Number of Employees:");
            var project_submission_date = prompt("Enter Project Submission Date (YYYY-MM-DD):");
            var manager_phone = prompt("Enter Manager Phone Number:");

            if (department_name && manager_name && employee_count && project_submission_date && manager_phone) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'add_department.php';

                var dn = document.createElement('input');
                dn.type = 'hidden';
                dn.name = 'department_name';
                dn.value = department_name;
                form.appendChild(dn);

                var mn = document.createElement('input');
                mn.type = 'hidden';
                mn.name = 'manager_name';
                mn.value = manager_name;
                form.appendChild(mn);

                var ec = document.createElement('input');
                ec.type = 'hidden';
                ec.name = 'employee_count';
                ec.value = employee_count;
                form.appendChild(ec);

                var psd = document.createElement('input');
                psd.type = 'hidden';
                psd.name = 'project_submission_date';
                psd.value = project_submission_date;
                form.appendChild(psd);

                var mp = document.createElement('input');
                mp.type = 'hidden';
                mp.name = 'manager_phone';
                mp.value = manager_phone;
                form.appendChild(mp);

                document.body.appendChild(form);
                form.submit();
            } else {
                alert("All fields are required.");
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Department Details</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Department Name</th>
                    <th>Manager Name</th>
                    <th>Employee Count</th>
                    <th>Project Submission Date</th>
                    <th>Manager Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['department_name']; ?></td>
                    <td><?php echo $row['manager_name']; ?></td>
                    <td><?php echo $row['employee_count']; ?></td>
                    <td><?php echo $row['project_submission_date']; ?></td>
                    <td><?php echo $row['manager_phone']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="javascript:void(0);" class="button" onclick="addDepartment()">Add Department</a>
    </div>
</body>
</html>