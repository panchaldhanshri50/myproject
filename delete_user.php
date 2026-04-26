<?php
session_start();
include 'valid_conn.php';


if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // execute delete query
    $stmt1 = $conn->prepare("DELETE FROM uploads WHERE user_id = ?");
    $stmt1->bind_param("i", $user_id);
     $stmt1->execute();

      $stmt2 = $conn->prepare("
        DELETE FROM extracted_ques 
        WHERE upload_id IN (SELECT upload_id FROM uploads WHERE user_id = ?)
    ");
    $stmt2->bind_param("i", $user_id);
    $stmt2->execute();

     $stmt3 = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt3->bind_param("i", $user_id);

    if ($stmt3->execute() ) {

        header("Location: admin-panel.php?msg=User deleted successfully");
        exit();
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    echo "Invalid Request!";
}
