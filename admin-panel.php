
<?php
include 'valid_conn.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CommonQ Finder - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
       
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
             
             padding-top: 80px;
        }
        
        
        .exam-navbar {
            background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            height: 100px;
            display: flex;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
        
        .nav-container {
            /* max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center; */
             width: 100%;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-sizing: border-box;
        }
        
        .nav-brand {
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        
        .text-logo {
            display: flex;
            flex-direction: column;
            line-height: 1;
            color: white;
            font-family: 'Arial', sans-serif;
        }
        
        .logo-line1 {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 1px;
        }
        
        .logo-line2 {
            font-size: 1.4rem;
            font-weight: 400;
            margin-top: -5px;
            letter-spacing: 3px;
            text-align: center;
        }
        
        .logout-btn {
            background-color: #ff6b6b;
            color: white;
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .logout-btn:hover {
            background-color: #ff5252;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
       
        .admin-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }
        
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .welcome-message {
            font-size: 1.5rem;
            color: #4b6cb7;
            font-weight: 600;
        }
        
        .section {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .section-title {
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            color: #182848;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-title i {
            color: #4b6cb7;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        
        th {
            background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
            color: white;
            padding: 12px 15px;
            text-align: left;
        }
        
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        tr:hover {
            background-color: #f1f3ff;
        }
        
        .action-btn {
            color: #4b6cb7;
            margin-right: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .action-btn:hover {
            color: #182848;
        }
        
        .delete-btn {
            color: #ff6b6b;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .delete-btn:hover {
            color: #ff5252;
        }
        
        
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background-color: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        .stat-icon {
            font-size: 2rem;
            color: #4b6cb7;
            margin-bottom: 0.5rem;
        }
        
        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: #182848;
            margin-bottom: 0.25rem;
        }
        
        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }
         .nav-brand img {
            height: 100px;
            width: auto;
            background: transparent;
        }
        
       
        @media (max-width: 768px) {
            .admin-container {
                padding: 0 1rem;
            }
            
            table {
                font-size: 0.9rem;
            }
            
            th, td {
                padding: 8px 10px;
            }
            
            .stats-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="exam-navbar">
        <div class="nav-container">
            <a href="#" class="nav-brand">
                <!-- <div class="text-logo">
                    <span class="logo-line1">CommonQ</span>
                    <span class="logo-line2">Finder</span>
                </div> -->
                 <img src="images/logo33.png" alt="logo">
            </a>
            <a href="logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </nav>
    
    <div class="admin-container">
        <div class="admin-header">
            <h1 class="welcome-message">Welcome, <?php echo $_SESSION['admin_name']; ?>!</h1>
        </div>
        
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <?php $userCount = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count']; ?>
                <div class="stat-value"><?php echo $userCount; ?></div>
                <div class="stat-label">Total Users</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-file-upload"></i></div>
                <?php $uploadCount = $conn->query("SELECT COUNT(*) as count FROM uploads")->fetch_assoc()['count']; ?>
                <div class="stat-value"><?php echo $uploadCount; ?></div>
                <div class="stat-label">Uploaded Files</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-question-circle"></i></div>
                <?php $questionCount = $conn->query("SELECT COUNT(*) as count FROM extracted_ques")->fetch_assoc()['count']; ?>
                <div class="stat-value"><?php echo $questionCount; ?></div>
                <div class="stat-label">Extracted Questions</div>
            </div>
        </div>
        
        <div class="section">
            <h3 class="section-title"><i class="fas fa-users"></i> User List</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $users = $conn->query("SELECT * FROM users ORDER BY name DESC");
                    
                    if (!$users) {
                        die("Query Failed: " . $conn->error);
                    }
                    while ($user = $users->fetch_assoc()) {
                        echo "<tr>
                            <td>{$user['user_id']}</td>
                            <td>{$user['name']}</td>
                            <td>{$user['email']}</td>
                            <td>
                                <a href='delete_user.php?id={$user['user_id']}; 
                                ?>' 
                                class='delete-btn' 
                                onclick=\"return confirm('Are you sure you want to delete this user?');\">
                                 <i class='fas fa-trash-alt'></i>
                                </a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <div class="section">
            <h3 class="section-title"><i class="fas fa-file-upload"></i> Uploaded Files</h3>
            <table>
                <thead>
                    <tr>
                        <th>Upload ID</th>
                        <th>User ID</th>
                        <th>File Name</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $uploads = $conn->query("SELECT * FROM uploads ORDER BY upload_time DESC");
                    while ($upload = $uploads->fetch_assoc()) {
                        $formattedDate = date('M d, Y H:i', strtotime($upload['upload_time']));
                        echo "<tr>
                            <td>{$upload['upload_id']}</td>
                            <td>{$upload['user_id']}</td>
                            <td>{$upload['file_name']}</td>
                            <td>{$formattedDate}</td>
                            <td>
                            
                                <a href='delete_user.php?id={$upload['upload_id']}; 
                                ?>' 
                                class='delete-btn' 
                                onclick=\"return confirm('Are you sure you want to delete this user?');\">
                                 <i class='fas fa-trash-alt'></i>
                                </a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <div class="section">
            <h3 class="section-title"><i class="fas fa-question-circle"></i> Extracted Questions</h3>
            <table>
                <thead>
                    <tr>
                        <th>Question ID</th>
                        <th>Upload ID</th>
                        <th>Question Text</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $questions = $conn->query("SELECT * FROM extracted_ques ORDER BY question_id");
                    while ($question = $questions->fetch_assoc()) {
                        $shortText = strlen($question['question_text']) > 50 ? 
                            substr($question['question_text'], 0, 50) . '...' : 
                            $question['question_text'];
                        echo "<tr>
                            <td>{$question['question_id']}</td>
                            <td>{$question['upload_id']}</td>
                            <td title='{$question['question_text']}'>{$shortText}</td>
                            <td>
                                <a href='delete_user.php?id={$question['question_id']}; 
                                ?>' 
                                class='delete-btn' 
                                onclick=\"return confirm('Are you sure you want to delete this user?');\">
                                 <i class='fas fa-trash-alt'></i>
                                </a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>