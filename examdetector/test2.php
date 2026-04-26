<?php
include 'valid_conn.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuestionFinder -Exam Analysis</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7f9;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 20px;
        }

        header {
            grid-column: 1 / -1;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .subtitle {
            color: #7f8c8d;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2c3e50;
            padding-bottom: 8px;
            border-bottom: 1px solid #eaecef;
        }

        .navigation {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            height: fit-content;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            margin-bottom: 8px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .nav-item:hover {
            background-color: #f0f5ff;
        }

        .nav-item.active {
            background-color: #e6f7ff;
            color: #1890ff;
            font-weight: 500;
        }

        .nav-item input[type="checkbox"] {
            margin-right: 10px;
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .recent-papers,
        .quick-stats,
        .common-questions {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .common-questions {
            grid-column: 1 / -1;
        }

        .paper-item {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid #eaecef;
            transition: all 0.2s;
        }

        .paper-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .paper-title {
            font-weight: 600;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }

        .paper-title input[type="checkbox"] {
            margin-right: 10px;
        }

        .paper-meta {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 8px;
        }

        .paper-stats {
            font-size: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .status {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            background-color: #e6f7ff;
            color: #1890ff;
        }

        .stats-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid #eaecef;
        }

        .stats-item input[type="checkbox"] {
            margin-right: 10px;
        }

        .no-questions {
            text-align: center;
            padding: 40px 20px;
            color: #7f8c8d;
        }

        @media (max-width: 900px) {
            .container {
                grid-template-columns: 1fr;
            }

            .main-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>QuestionFinder</h1>
            <div class="subtitle">Exam Analysis</div>
        </header>

        <aside class="navigation">
            <div class="section-title">NAVIGATION</div>
            <div class="nav-item">
                <input type="checkbox" id="dashboard" onclick="window.location.href='index.php'">
                <label for="dashboard">Dashboard</label>
            </div>
            <div class="nav-item active">
                <input type="checkbox" id="upload" checked>
                <label for="upload">Uploaded Papers
                     </label>
            </div>
            <div class="nav-item">
                <input type="checkbox" id="common-questions" onclick="window.location.href='upload.php'">
                <label for="common-questions">Upload more Questions

                    </label>
            </div>
        </aside>

        <main class="main-content">
            <section class="recent-papers">
                <div class="section-title">Recent Papers</div>
                <?php
                $uploads = $conn->query("SELECT * FROM uploads ORDER BY upload_time DESC");
                while ($upload = $uploads->fetch_assoc()) {
                    $formattedDate = date('M d, Y H:i', strtotime($upload['upload_time']));
                    echo '
            <div class="paper-item">
                <div class="paper-title">
                    <input type="checkbox" id="paper' . $upload['upload_id'] . '">
                    <label for="paper' . $upload['upload_id'] . '">' . $upload['file_name'] . '</label>
                </div>
                <div class="paper-meta">2025 • computer security • ' . $formattedDate . '</div>
                <div class="paper-stats">
                    <span>2 questions extracted</span>
                    <span class="status">completed</span>
                </div>
            </div>';
                }
                ?>
            </section>




            <section class="common-questions">
                <div class="section-title">Common Questions</div>
                <?php
                $questions = $conn->query("SELECT * FROM extracted_ques ORDER BY question_id");
                while ($question = $questions->fetch_assoc()) {
                    echo '
            <div class="question-item">
                <label for="paper' . $question['question_id'] . '">' . $question['question_text'] . '</label>
            </div>
        ';
                }
                ?>
            </section>
        </main>
    </div>


</body>

</html>