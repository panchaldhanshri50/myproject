<?php
session_start();

include "valid_conn.php";

// GET ALL DATA (JOIN)

$query = "
SELECT 
    d.sub,
    d.uni,
    d.course,
    d.year_range,
    u.upload_id as upload_id,
    q.question_text
FROM upload_details d
JOIN uploads u ON d.upload_id = u.upload_id
LEFT JOIN extracted_ques q ON q.upload_id = u.upload_id
ORDER BY d.sub, u.upload_id
";

$result = mysqli_query($conn, $query);
if(!$result){
    die("SQL Error: " . mysqli_error($conn));
}

// GROUP DATA
$data = [];

while($row = mysqli_fetch_assoc($result)){
    $subject = $row['sub'];
    $upload_id = $row['upload_id'];

    if(!isset($data[$subject])){
        $data[$subject] = [];
    }

    if(!isset($data[$subject][$upload_id])){
        $data[$subject][$upload_id] = [
            "details" => $row,
            "questions" => []
        ];
    }

    if(!empty($row['question_text'])){
        $data[$subject][$upload_id]["questions"][] = $row['question_text'];
    }
}
if(isset($_SESSION['user_id'])) {
    include 'header_user.php';
} else {
    include 'header.php';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Explore Questions</title>
    <link rel="stylesheet" href="style.css">

    <style>
        /* body {
            font-family: Arial;
            background:#f5f7fa;
            padding:20px;
        } */
        .box{
            height:100%;
        }
        .main{
            background-color:white;
            margin:5px;
            padding: 5px;
            
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            /* flex: 1 0 auto; */
            flex-grow: 1 !important;
        }
        .subject {
            background:#182848;
            color:white;
            padding:10px;
            margin-top:15px;
            cursor:pointer;
            margin:10px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .details {
            margin-left:20px;
            display:none;
        }

        .detail-item {
            background:#bbd0fa;
            margin:10px;
            padding:10px;
            cursor:pointer;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .questions {
            margin-left:20px;
            display:none;
            background:white;
            padding:10px;
            border-left:3px solid #3498db;
        }

        .question {
            padding:5px 0;
            border-bottom:1px solid #ddd;
        }
    </style>

    <script>
        function toggle(id){
            var el = document.getElementById(id);
            el.style.display = (el.style.display === "none") ? "block" : "none";
        }
    </script>
</head>

<body>
<div class="box">
<div class="main">
    <h2>📚 Explore Questions</h2>

    <?php
    $subIndex = 0;

    foreach($data as $subject => $uploads){
        $subId = "sub_" . $subIndex;

        echo "<div class='subject' onclick=\"toggle('$subId')\">$subject</div>";
        echo "<div class='details' id='$subId'>";

        $detIndex = 0;

        foreach($uploads as $upload_id => $info){
            $d = $info['details'];
            $detailId = "det_".$subIndex."_".$detIndex;

            $label = "{$d['sub']} | {$d['uni']} | {$d['course']} | {$d['year_range']}";

            echo "<div class='detail-item' onclick=\"toggle('$detailId')\">$label</div>";

            echo "<div class='questions' id='$detailId'>";

            if(!empty($info['questions'])){
                foreach($info['questions'] as $q){
                    echo "<div class='question'>• ".htmlspecialchars($q)."</div>";
                }
            } else {
                echo "<div>No questions found</div>";
            }

            echo "</div>";

            $detIndex++;
        }

        echo "</div>";

        $subIndex++;
    }
    ?>
</div>
</div>
<?php
include 'footer.php';
?>
</body>
</html>