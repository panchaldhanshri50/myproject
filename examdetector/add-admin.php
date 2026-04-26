<?php
include 'valid_conn.php';


$hashed_password = password_hash("admin123", PASSWORD_DEFAULT);

$conn->query("INSERT INTO admins (name, password) VALUES ('mahima', '$hashed_password')");
echo "Admin inserted";
?>
