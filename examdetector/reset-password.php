<?php
// header("Location: signup.php?reset=1");
// exit();
?>
<?php
// include 'valid_conn.php';

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $email = trim($_POST['email']);
//     $new_password = trim($_POST['password']);

//     if (empty($email) || empty($new_password)) {
//         $message = "Both fields are required.";
//     } else {
//         // Check if email exists
//         $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
//         $stmt->bind_param("s", $email);
//         $stmt->execute();
//         $stmt->store_result();

//         if ($stmt->num_rows > 0) {
//             // Update password
//             $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
//             $update = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
//             $update->bind_param("ss", $hashed_password, $email);

//             if ($update->execute()) {
//                 header("Location: login.php?msg=password_reset");
//                 exit();
//             } else {
//                 $message = "Failed to update password. Try again.";
//             }
//         } else {
//             $message = "No account found with that email.";
//         }
//     }
// }
?>

<!-- <h2>Reset Password</h2>
<form method="POST">
    <input type="email" name="email" placeholder="Enter your registered email" required>
    <input type="password" name="password" placeholder="Enter new password" required>
    <button type="submit">Update Password</button>
</form> -->

<?php
//  if (!empty($message)) echo "<p style='color:red;'>$message</p>";
 ?>

 <?php
include 'valid_conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $new_password = trim($_POST['password']);

    if (empty($email) || empty($new_password)) {
        $message = "Both fields are required.";
    } else {
        // Check if email exists
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Update password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            $update->bind_param("ss", $hashed_password, $email);

            if ($update->execute()) {
                header("Location: login.php?msg=password_reset");
                exit();
            } else {
                $message = "Failed to update password. Try again.";
            }
        } else {
            $message = "No account found with that email.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - CommonQ Finder</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* body {
            background: linear-gradient(135deg, #e6f7ff 0%, #b3e0ff 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .reset-container {
            background: white;
            width: 100%;
            max-width: 450px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        } */
        body {
    background: linear-gradient(135deg, #e6f7ff 0%, #b3e0ff 100%);
    min-height: 100vh;
    padding: 0;
    display: block; 
}
 html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            overflow-x: hidden;
        }

.reset-container {
     background: white;
    width: 100%;
    max-width: 450px;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
    margin: 40px auto; 
    margin-top: 100px; 
    

}
        .reset-header {
            text-align: center;
            margin-bottom: 25px;
             background: white;
            width: 100%;
            max-width: 400px;
            padding: 30px;
            border-radius: 10px;
            /* box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2); */
        }
        
        .reset-icon {
            font-size: 50px;
            color: #3498db;
            margin-bottom: 15px;
        }
        
        h2 {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .reset-subtitle {
            color: #7f8c8d;
            font-size: 15px;
            line-height: 1.5;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        
        button {
            width: 100%;
            padding: 14px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        button:hover {
            background: #2980b9;
        }
        
        .message {
            padding: 12px;
            border-radius: 6px;
            margin-top: 20px;
            text-align: center;
            font-size: 15px;
        }
        
        .error {
            background: #ffeaea;
            color: #e74c3c;
            border-left: 4px solid #e74c3c;
        }
        
        .back-link {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: #3498db;
            text-decoration: none;
            font-size: 15px;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 480px) {
            .reset-container {
                padding: 25px 20px;
            }
            
            .reset-icon {
                font-size: 40px;
            }
            
            h2 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <?php
    include 'navbar.php';
    ?>
    <div class="reset-container">
        <div class="reset-header">
            <div class="reset-icon">
                <i class="fas fa-key"></i>
            </div>
            <h2>Reset Password</h2>
            <p class="reset-subtitle">Enter your email and a new password to regain access to your account</p>
        </div>
        
        <form method="POST">
            <div class="form-group">
                <input type="email" name="email" placeholder="Enter your registered email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Enter new password" required>
            </div>
            <button type="submit">Update Password</button>
        </form>
        
        <?php if (!empty($message)) echo "<div class='message error'>$message</div>"; ?>
        
        <a href="login.php" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Login
        </a>
    </div>

    <?php
    include 'footer.php';
    ?>
</body>
</html>

