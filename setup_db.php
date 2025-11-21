<?php
$servername = "localhost";
$username = "root";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS portfolio";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

$conn->select_db("portfolio");

// Users Table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255)
)";
$conn->query($sql);

// Insert default admin
$stmt = $conn->prepare("INSERT IGNORE INTO users (username, password) VALUES (?, ?)");
$admin_user = "admin";
$admin_pass = password_hash("admin123", PASSWORD_DEFAULT);
$stmt->bind_param("ss", $admin_user, $admin_pass);
$stmt->execute();

// Settings Table
$sql = "CREATE TABLE IF NOT EXISTS settings (
    key_name VARCHAR(50) PRIMARY KEY,
    value TEXT
)";
$conn->query($sql);

// Insert settings
$settings = [
    'site_title' => 'Gokul Jayakumar - Portfolio',
    'header_logo_part1' => 'Gokul',
    'header_logo_part2' => 'Jayakumar',
    'hero_title_prefix' => "Hi, I'm",
    'hero_title_name' => 'Gokul Jayakumar',
    'hero_description' => 'Python Backend Developer with 4.5 years of experience specializing in Flask, Django, RESTful APIs, and database management. Passionate about designing scalable, secure, and high-performance backend solutions.',
    'about_title' => 'About Me',
    'about_subtitle' => 'IT professional with expertise in Python backend development, system administration, and technical leadership.',
    'about_detailed_title' => 'Python Backend Developer & Technical Leader',
    'about_detailed_text' => "I'm a seasoned IT professional with 4.5 years of experience in Python backend development, system administration, and technical leadership. Currently working as a Python Backend Developer at TCS, I specialize in Flask, Django, RESTful APIs, and database management with PostgreSQL, MySQL, and MongoDB.<br><br>During my career break (2022-2024) to pursue an MCA, I remained actively engaged in industry projects, technical leadership, and innovation initiatives as the Chief Technical Officer (CTO) at IEDC SNIT Kollam. I'm passionate about designing scalable, secure, and high-performance backend solutions while mentoring and leading development teams.<br><br>Currently learning Docker and Kubernetes to enhance deployment and scalability strategies.",
    'contact_email' => 'hellogokuljayakumar@gmail.com',
    'contact_phone' => '+91 7678-659-691',
    'contact_linkedin' => 'http://www.linkedin.com/in/gokul-jayakumar',
    'contact_github' => 'https://github.com/higokul99',
    'contact_whatsapp' => 'https://wa.me/917678659691',
    'footer_text' => 'Python Backend Developer with expertise in Flask, Django, and database management. Passionate about designing scalable, secure, and high-performance backend solutions.',
    'footer_copyright' => '&copy; 2025 Gokul Jayakumar. All Rights Reserved.'
];

$stmt = $conn->prepare("INSERT INTO settings (key_name, value) VALUES (?, ?) ON DUPLICATE KEY UPDATE value = VALUES(value)");
foreach ($settings as $key => $value) {
    $stmt->bind_param("ss", $key, $value);
    $stmt->execute();
}

// Experience Table
$sql = "CREATE TABLE IF NOT EXISTS experience (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_range VARCHAR(100),
    title VARCHAR(100),
    company VARCHAR(100),
    description TEXT,
    order_index INT DEFAULT 0
)";
$conn->query($sql);

// Insert Experience
$experiences = [
    [
        'date_range' => 'October 2024 – Present',
        'title' => 'Python Backend Developer',
        'company' => 'Tata Consultancy Services (TCS)',
        'description' => '<ul>
                                <li>Developed and maintained scalable backend solutions using Flask, ensuring high performance, security, and maintainability.</li>
                                <li>Developed packages to support backend solutions, ensuring service availability.</li>
                                <li>Optimized backend systems with PostgreSQL, MySQL, improving query efficiency and data integrity.</li>
                                <li>Designed and maintained secure RESTful APIs, implementing JWT authentication and RBAC.</li>
                                <li>Currently learning Docker and Kubernetes to implement containerized deployments for enhanced scalability.</li>
                                <li>Led and mentored junior developers, ensuring best coding practices and efficient team collaboration.</li>
                            </ul>',
        'order_index' => 1
    ],
    [
        'date_range' => 'October 2022 – September 2024',
        'title' => 'Chief Technical Officer (CTO)',
        'company' => 'IEDC SNIT Kollam',
        'description' => '<ul>
                                <li>Took a career break (2022–2024) to pursue MCA but remained actively involved in industry projects and technical leadership.</li>
                                <li>Spearheaded technology initiatives as part of Kerala Startup Mission\'s (KSUM) IEDC program.</li>
                                <li>Designed and developed scalable Django-based applications, increasing business efficiency by 30%.</li>
                                <li>Led 2 full-stack projects, showcasing expertise in backend logic, API development, and system optimization.</li>
                                <li>Established strategic partnerships with tech firms and research institutions to drive innovation.</li>
                                <li>Won 2nd and 3rd place in IEDC hackathons and coding competitions.</li>
                            </ul>',
        'order_index' => 2
    ],
    [
        'date_range' => 'October 2020 – September 2022',
        'title' => 'System Administrator',
        'company' => 'Tata Consultancy Services (TCS)',
        'description' => '<ul>
                                <li>Managed client applications and cloud infrastructure using Microsoft Azure.</li>
                                <li>Developed Python scripts to automate log analysis and system monitoring, reducing manual effort.</li>
                                <li>Utilized Azure Virtual Machines, Azure SQL Database, and Azure Monitor to enhance system reliability.</li>
                                <li>Coordinated incident management and automation using ServiceNow and Azure Portal.</li>
                            </ul>',
        'order_index' => 3
    ]
];

$conn->query("TRUNCATE TABLE experience"); // Clear table to prevent duplicates on re-run
$stmt = $conn->prepare("INSERT INTO experience (date_range, title, company, description, order_index) VALUES (?, ?, ?, ?, ?)");
foreach ($experiences as $exp) {
    $stmt->bind_param("ssssi", $exp['date_range'], $exp['title'], $exp['company'], $exp['description'], $exp['order_index']);
    $stmt->execute();
}

// Education Table
$sql = "CREATE TABLE IF NOT EXISTS education (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_range VARCHAR(100),
    degree VARCHAR(100),
    school VARCHAR(100),
    score VARCHAR(50),
    order_index INT DEFAULT 0
)";
$conn->query($sql);

$education = [
    [
        'date_range' => 'September 2022 - September 2024',
        'degree' => 'Master of Computer Applications (MCA)',
        'school' => 'University of Kerala, Kerala',
        'score' => 'Score: 81%',
        'order_index' => 1
    ],
    [
        'date_range' => 'July 2017 - July 2020',
        'degree' => 'Bachelor\'s Degree in Computer Science',
        'school' => 'University of Kerala, Kerala',
        'score' => 'Score: 71%',
        'order_index' => 2
    ]
];

$conn->query("TRUNCATE TABLE education");
$stmt = $conn->prepare("INSERT INTO education (date_range, degree, school, score, order_index) VALUES (?, ?, ?, ?, ?)");
foreach ($education as $edu) {
    $stmt->bind_param("ssssi", $edu['date_range'], $edu['degree'], $edu['school'], $edu['score'], $edu['order_index']);
    $stmt->execute();
}

// Achievements Table
$sql = "CREATE TABLE IF NOT EXISTS achievements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    description TEXT,
    order_index INT DEFAULT 0
)";
$conn->query($sql);

$achievements = [
    [
        'title' => 'Star of the Month at TCS',
        'description' => 'Received the Star of the Month award at TCS for outstanding performance and contributions to team success.',
        'order_index' => 1
    ],
    [
        'title' => 'On-the-Spot Awards (5x) at TCS',
        'description' => 'Recognized five times with On-the-Spot Awards for exceptional problem-solving and technical contributions.',
        'order_index' => 2
    ],
    [
        'title' => 'National Chess Player',
        'description' => 'Represented KV School as a National Chess Player, demonstrating strategic thinking and competitive excellence.',
        'order_index' => 3
    ],
    [
        'title' => 'IEDC Hackathon Recognition',
        'description' => 'Won 2nd and 3rd place in IEDC hackathons and coding competitions during my time as CTO at IEDC SNIT Kollam.',
        'order_index' => 4
    ]
];

$conn->query("TRUNCATE TABLE achievements");
$stmt = $conn->prepare("INSERT INTO achievements (title, description, order_index) VALUES (?, ?, ?)");
foreach ($achievements as $ach) {
    $stmt->bind_param("ssi", $ach['title'], $ach['description'], $ach['order_index']);
    $stmt->execute();
}

// Certifications Table
$sql = "CREATE TABLE IF NOT EXISTS certifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    issuer VARCHAR(100),
    description TEXT,
    image_url VARCHAR(255),
    order_index INT DEFAULT 0
)";
$conn->query($sql);

$certifications = [
    [
        'title' => 'Microsoft Azure AZ-900 Certified',
        'issuer' => 'Issuer: Microsoft',
        'description' => 'Fundamental understanding of cloud concepts, Azure services, Azure workloads, security, privacy, pricing, and support.',
        'image_url' => '/api/placeholder/80/80',
        'order_index' => 1
    ]
];

$conn->query("TRUNCATE TABLE certifications");
$stmt = $conn->prepare("INSERT INTO certifications (title, issuer, description, image_url, order_index) VALUES (?, ?, ?, ?, ?)");
foreach ($certifications as $cert) {
    $stmt->bind_param("ssssi", $cert['title'], $cert['issuer'], $cert['description'], $cert['image_url'], $cert['order_index']);
    $stmt->execute();
}

// Skills Table
$sql = "CREATE TABLE IF NOT EXISTS skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    order_index INT DEFAULT 0
)";
$conn->query($sql);

$skills = [
    'Python', 'PHP', 'Django', 'Flask', 'REST APIs', 'MySQL', 'PostgreSQL', 'MongoDB',
    'Microsoft Azure', 'GitHub Actions', 'Postman', 'Swagger', 'cURL', 'Azure Monitor',
    'PyCharm', 'VS Code', 'Colab Notebook', 'Docker (Learning)', 'Kubernetes (Learning)'
];

$conn->query("TRUNCATE TABLE skills");
$stmt = $conn->prepare("INSERT INTO skills (name, order_index) VALUES (?, ?)");
$i = 1;
foreach ($skills as $skill) {
    $stmt->bind_param("si", $skill, $i);
    $stmt->execute();
    $i++;
}

echo "Database setup completed successfully.";
$conn->close();
?>
