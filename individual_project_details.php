<?php
// Example project data
$project = [
    'name' => 'Innovative Web Platform',
    'description' => 'The Innovative Web Platform is a state-of-the-art solution designed to transform the way businesses operate by leveraging cutting-edge technology. It integrates advanced features such as artificial intelligence and machine learning to provide real-time analytics and automation capabilities. The platform offers a comprehensive suite of tools including project management, customer relationship management, and data visualization, all within a unified interface. With an emphasis on user experience, the platform is built with a responsive design to ensure seamless functionality across various devices, from desktops to mobile phones. Security is a cornerstone of this project, with robust measures including end-to-end encryption, multi-factor authentication, and regular security audits. The platform is designed to be highly scalable, accommodating businesses of all sizes and adapting to their evolving needs. It provides customizable dashboards and reports, allowing users to tailor the system to their specific requirements. Additionally, the platform supports integration with other enterprise systems, facilitating smooth data flow and interoperability. The development process includes thorough testing and validation to ensure high performance and reliability. Comprehensive documentation and user training are provided to facilitate smooth adoption and effective use of the platform. With its innovative features and user-centric design, the Innovative Web Platform aims to set a new standard in business technology and drive organizational efficiency.',
    'client_requirements' => [
        'The platform should have a responsive design that works well on both desktop and mobile devices.',
        'It must support integration with third-party services such as CRM systems and data analytics tools.',
        'Security is a top priority; the platform should include encryption for data transmission and storage, as well as role-based access control.',
        'The user interface should be intuitive and easy to navigate, with customizable dashboards and reports.',
        'The system should be scalable to handle increasing volumes of data and user activity without performance degradation.',
        'Real-time notifications and alerts for important events and updates must be implemented.',
        'Detailed documentation and user training should be provided to ensure smooth adoption and utilization of the platform.'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007bff;
        }
        .project-name {
            font-size: 24px;
            font-weight: bold;
            color: #333333;
        }
        .description, .requirements {
            margin-top: 20px;
            font-size: 16px;
            color: #333333;
        }
        .requirements ul {
            list-style-type: disc;
            margin-left: 20px;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
            text-align: center;
            display: block;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Project Details</h1>
        <div class="project-name"><?php echo htmlspecialchars($project['name']); ?></div>
        <div class="description">
            <h2>Project Description</h2>
            <p><?php echo nl2br(htmlspecialchars($project['description'])); ?></p>
        </div>
        <div class="requirements">
            <h2>Client Requirements</h2>
            <ul>
                <?php foreach ($project['client_requirements'] as $requirement): ?>
                <li><?php echo htmlspecialchars($requirement); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    
    </div>
</body>
</html>