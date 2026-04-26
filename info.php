<?php
include 'valid_conn.php';
session_start();
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>all</title>
</head>
<body>
    <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-question-circle"></i></div>
                <?php 
                // $questionCount = $conn->query("SELECT COUNT(*) as count FROM extracted_ques")->fetch_assoc()['count']; 
                ?>
                <div class="stat-value"><?php 
                // echo $questionCount; 
                ?></div>
                <div class="stat-label">Extracted Questions</div>
            </div>
        </div>

        <?php


// $questions = $conn->query("SELECT * FROM extracted_ques ORDER BY question_id");
// while ($question = $questions->fetch_assoc()) {
//     $shortText = strlen($question['question_text']) > 50 ?
//         substr($question['question_text'], 0, 50) . '...' :
//         $question['question_text'];
//     echo "<tr>
//                             <td>{$question['question_id']}</td>
//                             <td>{$question['upload_id']}</td>
//                             <td title='{$question['question_text']}'>{$shortText}</td>
//                             <td>
//                                 <a href='#' class='action-btn'><i class='fas fa-search'></i></a>
//                                 <a href='#' class='delete-btn'><i class='fas fa-trash-alt'></i></a>
//                             </td>
//                         </tr>";
// }

//                     $uploads = $conn->query("SELECT * FROM uploads ORDER BY upload_time DESC");
//                     while ($upload = $uploads->fetch_assoc()) {
//                         $formattedDate = date('M d, Y H:i', strtotime($upload['upload_time']));
//                         echo "<tr>
//                             <td>{$upload['upload_id']}</td>
//                             <td>{$upload['user_id']}</td>
//                             <td>{$upload['file_name']}</td>
//                             <td>{$formattedDate}</td>
//                             <td>
//                                 <a href='#' class='action-btn'><i class='fas fa-download'></i></a>
//                                 <a href='#' class='delete-btn'><i class='fas fa-trash-alt'></i></a>
//                             </td>
//                         </tr>";
//                     }
                    ?>
</body>
</html> -->



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Data</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    /* Global Styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Segoe UI", sans-serif;
    }

    body {
      background: linear-gradient(135deg, #1f1c2c, #928dab);
      color: #fff;
      min-height: 100vh;
      padding: 40px;
    }

    h1 {
      text-align: center;
      margin-bottom: 40px;
      font-size: 2rem;
      letter-spacing: 1px;
    }

    /* Container */
    .container {
      display: grid;
      grid-template-columns: 1fr;
      gap: 30px;
      max-width: 1000px;
      margin: 0 auto;
    }

    
    .stat-box {
      background: rgba(255,255,255,0.1);
      border-radius: 15px;
      padding: 20px;
      text-align: center;
      backdrop-filter: blur(12px);
      transition: transform 0.3s ease, background 0.3s ease;
    }

    .stat-box:hover {
      transform: translateY(-5px);
      background: rgba(255,255,255,0.2);
    }

    .stat-icon {
      font-size: 2.5rem;
      margin-bottom: 15px;
      color: #ffcc70;
    }

    .stat-value {
      font-size: 2rem;
      font-weight: bold;
    }

    .stat-label {
      font-size: 1rem;
      opacity: 0.8;
    }

    /* Data List */
    .data-list {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .data-item {
      background: rgba(255,255,255,0.1);
      border-radius: 12px;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      backdrop-filter: blur(10px);
      transition: background 0.3s ease;
    }

    .data-item:hover {
      background: rgba(255,255,255,0.2);
    }

    .data-text {
      flex: 1;
      margin-right: 15px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    .data-actions a {
      margin-left: 12px;
      color: #fff;
      text-decoration: none;
      transition: color 0.2s ease;
    }

    .data-actions a:hover {
      color: #ffcc70;
    }
  </style>
</head>
<body>
  <h1>Dashboard</h1>

  <div class="container">
    <!-- Stat Section -->
    <div class="stat-box">
      <div class="stat-icon"><i class="fas fa-question-circle"></i></div>
      <div class="stat-value">
        <?php 
        // $questionCount = $conn->query("SELECT COUNT(*) as count FROM extracted_ques")->fetch_assoc()['count']; 
        // echo $questionCount; 
        ?>
      </div>
      <div class="stat-label">Extracted Questions</div>
    </div>

    <!-- Questions List -->
    <div class="data-list">
      <?php
      $questions = $conn->query("SELECT * FROM extracted_ques ORDER BY question_id");
      while ($question = $questions->fetch_assoc()) {
          $shortText = strlen($question['question_text']) > 50 ?
              substr($question['question_text'], 0, 50) . '...' :
              $question['question_text'];
          echo "<div class='data-item'>
                  <div class='data-text' title='{$question['question_text']}'>
                    {$shortText}
                  </div>
                  <div class='data-actions'>
                    <a href='#'><i class='fas fa-search'></i></a>
                    <a href='#'><i class='fas fa-trash-alt'></i></a>
                  </div>
                </div>";
      
      }
      ?>
    </div>

    <!-- Uploads List -->
    <div class="data-list">
      <?php
      $uploads = $conn->query("SELECT * FROM uploads ORDER BY upload_time DESC");
      while ($upload = $uploads->fetch_assoc()) {
          $formattedDate = date('M d, Y H:i', strtotime($upload['upload_time']));
          echo "<div class='data-item'>
                  <div class='data-text'>
                    {$upload['file_name']} <small>({$formattedDate})</small>
                  </div>
                  <div class='data-actions'>
                    <a href='#'><i class='fas fa-download'></i></a>
                    <a href='#'><i class='fas fa-trash-alt'></i></a>
                  </div>
                </div>";
      }
      ?>
    </div>
  </div>
</body>
</html>
