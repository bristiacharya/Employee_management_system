<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software Company Projects</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.navbar {
    background-color: #007BFF;
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

.image-container {
    text-align: center;
    margin: 20px 0;
}

.company-image {
    max-width: 100%;
    height: auto;
}

.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    margin: 20px;
}

.box {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 10px;
    flex: 1 1 calc(30% - 40px);
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

.box h3 {
    margin: 10px 0;
    font-size: 1.2em;
    color: #555;
}

.box p {
    color: #666;
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
    <div class="container">
        <?php
        $projects = [
            [
                "name" => "Project A",
                "manager" => "Nita Mukherjee",
                "project name" => "Healthcare App",
                "details" => "This project involves developing a new mobile application for healthcare. The application aims to provide remote consultation and health monitoring. It is designed to be user-friendly and highly secure."
            ],
            [
                "name" => "Project B",
                "manager" => "Barun Deol",
                "project name" => "Inventory Management System",
                "details" => "This project focuses on creating a cloud-based inventory management system. It helps businesses track their inventory in real-time. The system is scalable and can handle large volumes of data efficiently."
            ],
            [
                "name" => "Project C",
                "manager" => "Liza Acharya",
                "project name" => "Predictive Analytics Model",
                "details" => "This project is about building a machine learning model for predictive analytics. The model will help predict market trends and customer behavior. It leverages big data and advanced algorithms for accurate predictions."
            ],
            [
                "name" => "Project D",
                "manager" => "Jay Dutta",
                "project name" => "Employee Management System",
                "details" => "This project includes designing a new user interface for the company's main product. The goal is to improve usability and accessibility. The design will follow modern UI/UX principles to enhance user satisfaction."
            ],
            [
                "name" => "Project E",
                "manager" => "Oishik Mukherjee",
                "project name" => "Cybersecurity Solution",
                "details" => "This project involves developing a cybersecurity solution for small businesses. It provides comprehensive protection against various cyber threats. The solution is easy to deploy and manage, making it ideal for small enterprises."
            ],
            [
                "name" => "Project F",
                "manager" => "Kathakali Bose",
                "project name" => "Financial Data Visualization Tool",
                "details" => "This project is about creating a data visualization tool for financial data. It allows users to create interactive charts and graphs. The tool supports multiple data sources and offers powerful analytics features."
            ],
            [
                "name" => "Project G",
                "manager" => "Meghna Ganguly",
                "project name" => "CRM Software Enhancement",
                "details" => "This project focuses on enhancing the company's CRM software. New features include advanced customer segmentation and automated workflows. The updates aim to improve customer engagement and sales performance."
            ],
            [
                "name" => "Project H",
                "manager" => "Suvankar Roy",
                "project name" => "AI Integration",
                "details" => "This project involves integrating AI features into the existing software suite. AI will be used for predictive maintenance and customer support. The integration aims to increase efficiency and reduce operational costs."
            ],
            [
                "name" => "Project I",
                "manager" => "Sudipa Dey",
                "project name" => "E-Commerce Platform",
                "details" => "This project includes developing a new e-commerce platform. The platform supports multiple payment methods and seamless checkout processes. It is designed to provide a smooth shopping experience for users."
            ],
            [
                "name" => "Project J",
                "manager" => "Iran Khan",
                "project name" => "Smart Home IoT Solution",
                "details" => "This project is about building an IoT solution for smart homes. The solution allows users to control and monitor home devices remotely. It focuses on security, ease of use, and energy efficiency."
            ],
            [
                "name" => "Project K",
                "manager" => "Agniswar Roy",
                "project name" => "Customer Feedback System",
                "details" => "This project focuses on developing a system for collecting and analyzing customer feedback. The system will provide real-time insights and generate actionable reports. It aims to improve customer satisfaction and enhance service quality."
            ],
            [
                "name" => "Project L",
                "manager" => "Jaya Ahuja",
                "project name" => "Automated HR Onboarding",
                "details" => "This project involves creating an automated onboarding system for new hires. It will streamline the onboarding process, including document submission and training. The system is designed to reduce manual effort and improve new hire integration."
            ],
            [
                "name" => "Project M",
                "manager" => "Namita Tah",
                "project name" => "Virtual Reality Training Program",
                "details" => "This project is about developing a virtual reality-based training program. It will provide immersive training experiences for employees in various scenarios. The goal is to enhance training effectiveness and engagement."
            ],
            [
                "name" => "Project N",
                "manager" => "Olivia Sen",
                "project name" => "Mobile Payment Integration",
                "details" => "This project involves integrating mobile payment solutions into the company’s existing platform. It aims to enable secure and convenient transactions via mobile devices. The integration will support various payment methods and enhance user experience."
            ],
            [
                "name" => "Project O",
                "manager" => "Pauli Roy",
                "project name" => "AI-Powered Chatbot",
                "details" => "This project focuses on developing an AI-powered chatbot for customer support. The chatbot will handle common inquiries and provide instant responses. It aims to improve customer service efficiency and reduce response times."
            ],
            [
                "name" => "Project P",
                "manager" => "Koruna Das",
                "project name" => "Business Intelligence Dashboard",
                "details" => "This project involves creating a business intelligence dashboard for data visualization. The dashboard will offer interactive charts, graphs, and analytics. It is designed to help stakeholders make informed decisions based on data insights."
            ],
            [
                "name" => "Project Q",
                "manager" => "Ronit Roy",
                "project name" => "Cloud-Based Collaboration Tool",
                "details" => "This project includes developing a cloud-based tool for team collaboration. It will support features like document sharing, real-time editing, and task management. The tool aims to enhance teamwork and productivity across distributed teams."
            ],
        ];

        foreach ($projects as $project) {
            echo '<div class="box">';
            echo '<h2>' . $project["project name"] . '</h2>';
            echo '<h3>Managed by: ' . $project["manager"] . '</h3>';
            echo '<p>' . $project["details"] . '</p>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
