<?php

$mysqli = new mysqli("localhost", "root", "ready1234", "common_question_finder");

if($mysqli->connect_error){
    die("Connection failed: " . $mysqli->connect_error);
}

$tables = [

    "CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(100)
)",


"CREATE TABLE IF NOT EXISTS admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    password VARCHAR(100)
)",

"CREATE TABLE IF NOT EXISTS uploads (
    upload_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    file_name VARCHAR(255),
    upload_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
)",

"CREATE TABLE IF NOT EXISTS extracted_ques (
    question_id INT AUTO_INCREMENT PRIMARY KEY,
    upload_id INT,
    question_text VARCHAR(1000),
    UNIQUE (upload_id, question_text), 
    FOREIGN KEY (upload_id) REFERENCES uploads(upload_id)
)",

"CREATE TABLE IF NOT EXISTS upload_details (
    upload_detail_id INT AUTO_INCREMENT PRIMARY KEY,
    upload_id INT,
    sub VARCHAR(255),
    uni VARCHAR(255),
    course VARCHAR(255),
    year_range VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (upload_id) REFERENCES uploads(upload_id) ON DELETE CASCADE
)",
];

foreach ($tables as $tb) {
    if ($mysqli->query($tb) === TRUE) {
        echo "Table created successfully.<br>";
    } else {
        echo "Error creating table: " . $mysqli->error . "<br>";
    }
}









?>
