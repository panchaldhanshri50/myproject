



    <?php
    session_start();
    include 'valid_conn.php';

    if (!isset($_SESSION['user_id'])) {
        die("Error: You must be logged in to upload files.");
    }

    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $statusMsg = "";
    $file_paths = [];
    $upload_ids = [];

    if (isset($_FILES['documents'])) {
       // GET FORM DATA new added code { 
        $subject = !empty($_POST['subject']) ? $_POST['subject'] : $_POST['other_subject'];
        $university = !empty($_POST['uni']) ? $_POST['uni'] : $_POST['other_uni'];
        $course = !empty($_POST['course']) ? $_POST['course'] : $_POST['other_course'];
        $year = $_POST['year'];

        // VALIDATION

        if(empty($subject) || empty($university) || empty($course) || empty($year)){
             die("<p class='error-msg'>Please fill all required fields before uploading!</p>");

        }
       
        $total_files = count($_FILES['documents']['name']);

        for ($i = 0; $i < $total_files; $i++) {
            $file_name = basename($_FILES['documents']['name'][$i]);
            $file_tmp = $_FILES['documents']['tmp_name'][$i];
            $target_path = $upload_dir . $file_name;
            $file_type = pathinfo($target_path, PATHINFO_EXTENSION);

            if (strtolower($file_type) === 'pdf') {
                if (move_uploaded_file($file_tmp, $target_path)) {
                    
                    $user_id = $_SESSION['user_id'];
                    $stmt = $conn->prepare("INSERT INTO uploads (user_id, file_name, upload_time) VALUES (?, ?, NOW())");
                    $stmt->bind_param("is", $user_id, $file_name);

                    if ($stmt->execute()) {
                        // $upload_ids[] = $stmt->insert_id;
                        // $file_paths[] = escapeshellarg($target_path);

                      //new added code {    
                        $upload_id = $stmt->insert_id;
                        $upload_ids[] = $upload_id;

                        // INSERT INTO upload_details
                        $stmt2 = $conn->prepare("INSERT INTO upload_details 
                            (upload_id, sub, uni, course, year_range) 
                            VALUES (?, ?, ?, ?, ?)");

                        $stmt2->bind_param("issss", $upload_id, $subject, $university, $course, $year);
                        $stmt2->execute();
                        $stmt2->close();

                        $file_paths[] = escapeshellarg($target_path);
                      //}  

                    } else {
                        $statusMsg .= "<p class='error-msg'>DB error: " . $stmt->error . "</p>";
                    }
                    $stmt->close();
                } else {
                    $statusMsg .= "<p class='error-msg'>Failed to upload $file_name</p>";
                }
            } else {
                $statusMsg .= "<p class='error-msg'>Only PDF files allowed: $file_name</p>";
            }
        } 
    include 'header_user.php';
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload Results - Common Question Detector</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="style.css">
        <style>
            // * {
            //     margin: 0;
            //     padding: 0;
            //     box-sizing: border-box;
            // }
            
            // body {
            //     font-family: \"Segoe UI\", Tahoma, Geneva, Verdana, sans-serif;
            //     background-color: #f5f7fa;
            //     color: #333;
            //     line-height: 1.5;
            //     padding-top: 90px;

            // }
            
            .container {
                max-width: 1000px;
                margin: 20px auto;
                background: white;
                border-radius: 8px;
                padding: 25px;
                box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            }
            
            // .header {
            //     text-align: center;
            //     margin-bottom: 25px;
            //     padding-bottom: 15px;
            //     border-bottom: 2px solid #eaeaea;
            // }
            
            h1 {
                color: #2c3e50;
                font-size: 28px;
                margin-bottom: 10px;
            }
            
            .status-box {
                margin: 20px 0;
                padding: 15px;
                border-radius: 6px;
                background-color: #f8f9fa;
            }
            
            .success-msg {
                color: #27ae60;
                margin: 10px 0;
                padding: 8px 12px;
                background-color: #e8f8ef;
                border-left: 4px solid #2ecc71;
                border-radius: 3px;
            }
            
            .error-msg {
                color: #c0392b;
                margin: 10px 0;
                padding: 8px 12px;
                background-color: #fdedec;
                border-left: 4px solid #e74c3c;
                border-radius: 3px;
            }
            
            .results-box {
            
                margin: 25px 0;
                padding: 20px;
                background-color: #e8f4fc;
                border-radius: 6px;
                border-left: 4px solid #3498db;
            }
            
            .results-box h2 {
                color: #2c3e50;
                margin-bottom: 15px;
                font-size: 22px;
            }
            
            .question-list {
                background: white;
                padding: 15px;
                border-radius: 5px;
                border: 1px solid #ddd;
                max-height: 400px;
                overflow-y: auto;
            }
            
            .question-item {
                padding: 10px;
                border-bottom: 1px solid #eee;
                margin-bottom: 8px;
            }
            
            .question-item:last-child {
                border-bottom: none;
                margin-bottom: 0;
            }
            
            .actions {
                margin-top: 25px;
                text-align: center;
            }
                footer {
            text-align: center;
            margin-top: 40px;
            color: #7f8c8d;
            font-size: 14px;
        }
            
            .btn {
                display: inline-block;
                padding: 10px 20px;
                background-color: #3498db;
                color: white;
                text-decoration: none;
                border-radius: 4px;
                margin: 0 10px;
                transition: background-color 0.3s;
            }
            
            .btn:hover {
                background-color: #2980b9;
            }
            
            .icon {
                margin-right: 8px;
            }
            
            .no-files {
                text-align: center;
                padding: 30px;
                color: #7f8c8d;
            }
            
            @media (max-width: 768px) {
                .container {
                    padding: 15px;
                    margin: 10px;
                }
                
                .actions {
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                }
                
                .btn {
                    margin: 5px 0;
                }
                    
            }
        </style>
    </head>
    <body>';
    // include "upload-nav.php";
    
      echo'<div class="container">
            <div class="header">
                <h1><i class="fas fa-file-upload icon"></i>Upload Results</h1>
                
            </div>';
   
    if (!empty($statusMsg)) {
        echo '<div class="status-box">' . $statusMsg . '</div>';
    }

    if (!empty($file_paths)) {
        $file_args = implode(" ", $file_paths);
        $command = escapeshellcmd("python extract_que.py $file_args");
        $output = shell_exec($command);
        $questions = explode("\n", trim($output));
        
        $first_uid = $upload_ids[0] ?? null;

        //new added code {
            $details = null;

            if ($first_uid) {
                $stmt = $conn->prepare("SELECT sub, uni, course, year_range 
                                        FROM upload_details 
                                        WHERE upload_id = ?");
                $stmt->bind_param("i", $first_uid);
                $stmt->execute();
                $result = $stmt->get_result();
                $details = $result->fetch_assoc();
                $stmt->close();
            }
        //}
        if ($first_uid) {
            foreach ($questions as $q) {
                $q = trim($q);
                if ($q !== '') {
                    $stmt = $conn->prepare("INSERT IGNORE INTO extracted_ques (upload_id, question_text) VALUES (?, ?)");
                    $stmt->bind_param("is", $first_uid, $q);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }
        
        //new added code {
        // if ($details) {
        //     echo '<div class="results-box" style="background:#fff3cd; border-left:4px solid #f39c12;">
        //             <h2><i class="fas fa-info-circle icon"></i>Upload Details</h2>
        //             <p><b>' . htmlspecialchars($details['sub']) . '</b> | 
        //             <b> ' . htmlspecialchars($details['uni']) . '</b> | 
        //             <b> ' . htmlspecialchars($details['course']) . '</b> | 
        //             <b> ' . htmlspecialchars($details['year_range']) . '</b></p> | 
        //         </div>';
        // }
        //}

        echo '<div class="results-box">
                <h2><i class="fas fa-list-alt icon"></i>Common Questions Found</h2>
                <div class="question-list">';
        
        if (!empty(trim($output))) {
            foreach ($questions as $index => $question) {
                if (!empty(trim($question))) {
                    echo '<div class="question-item"><i class="fas fa-question-circle" style="color:#3498db; margin-right:8px;"></i> ' . 
                         htmlspecialchars($question) . '</div>';
                }
            }
        } else {
            echo '<p class="no-files">No common questions found across the uploaded documents.</p>';
        }
        
        echo '</div></div>';
        
    } else {
        echo '<div class="no-files">
                <i class="fas fa-exclamation-circle" style="font-size:48px; color:#e74c3c; margin-bottom:15px;"></i>
                <p>No valid files were uploaded for processing.</p>
              </div>';
    }
    
    
    echo '<div class="actions">
            <a href="upload.php" class="btn"><i class="fas fa-upload icon"></i>Upload More Files</a>
            <a href="index.php" class="btn"><i class="fas fa-tachometer-alt icon"></i>Return to Dashboard</a>
            <a href="logout.php" class="btn"><i class="fas fa-sign-out-alt"></i>logout</a>
          </div>
        </div>
    </body>
    </html>';

    // echo '<footer>
    //     <p>Common Question Detector &copy; 2023</p>
    // </footer>';
}
include 'footer.php';
?>












































































<!-- 
//  session_start();
// $upload_dir = "uploads/";
// if (!is_dir($upload_dir)) {
//     mkdir($upload_dir, 0777, true);
// }

// if (isset($_FILES['documents'])) {
//     $total_files = count($_FILES['documents']['name']);
//     $file_paths = [];

//     for ($i = 0; $i < $total_files; $i++) {
//         $file_name = $_FILES['documents']['name'][$i];
//         $file_tmp = $_FILES['documents']['tmp_name'][$i];
//         $file_path = $upload_dir . basename($file_name);

//         if (move_uploaded_file($file_tmp, $file_path)) {
//             $file_paths[] = escapeshellarg($file_path);
//         } else {
//             echo "<p style='color:red;'>Failed to upload $file_name</p>";
//         }
//     }

//     if (!empty($file_paths)) {
//         $file_args = implode(" ", $file_paths);
//         $command = escapeshellcmd("python extract_que.py $file_args");
//         $output = shell_exec($command);
       
//         echo "<h2>Common Questions Across Files:</h2><pre>$output</pre>";
//     } else {
//         echo "<p>No valid files uploaded.</p>";
//     }
// }
// ?>  