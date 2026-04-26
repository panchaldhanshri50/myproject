<?php
// session_start();
//  include 'valid_conn.php';

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $name = $_POST['name'];
//     $password = $_POST['password'];

//     $stmt = $conn->prepare("SELECT * FROM admins WHERE name = ?");
//     $stmt->bind_param("s", $name);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $admin = $result->fetch_assoc();

//     if ($admin && password_verify($password, $admin['password'])) {
//         $_SESSION['admin_name'] = $admin['name'];
//         header("Location: admin-panel.php");
//         exit();
//     } else {
//         $error = "Invalid name or password";
//     }
// }
?>

<!-- <!DOCTYPE html>
<html>
<head><title>Admin Login</title></head>
<body>
<h2>Admin Login</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
</form> -->
<?php
// if (isset($error)) echo "<p style='color:red;'>$error</p>";
?>
<!-- </body> -->
<!-- </html> -->



<?php
session_start();
include 'valid_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_name'] = $admin['name'];
        header("Location: admin-panel.php");
        exit();
    } else {
        $error = "Invalid name or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Common Question finder</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            /* min-height: 100vh;*/
            overflow-x: hidden;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            overflow-x: hidden;
        }


        /* .navbar {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            color: white;
            font-weight: bold;
            font-size: 1.4rem;
            text-decoration: none;
        }

        .navbar-nav {
            display: flex;
            list-style: none;
        }

        .nav-item {
            margin-left: 20px;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            font-size: 1rem;
            transition: opacity 0.3s;
        }

        .nav-link:hover {
            opacity: 0.8;
        } */


        .login-wrapper {
         
            /* min-height: 100vh; */
            flex: 1;
             display: flex;
             justify-content: center;
             align-items: center;
             padding: 20px;
             margin-bottom: 60px;
             margin-top: 80px;
        }

        .login-container {
            background: white;
            width: 100%;
            max-width: 400px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #667eea;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #5a67d8;
        }

        .error {
            color: #e53e3e;
            text-align: center;
            margin-top: 15px;
            padding: 10px;
            background: #fed7d7;
            border-radius: 5px;
            border-left: 4px solid #e53e3e;
        }

        .admin-icon {
            text-align: center;
            margin-bottom: 15px;
            font-size: 40px;
            color: #667eea;
        }

        /* @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 10px;
            }

            .navbar-nav {
                width: 100%;
                justify-content: space-around;
                margin-top: 10px;
            }

            .nav-item {
                margin-left: 0;
            }
        } */
    </style>
</head>

<body>
    <?php
    include 'navbar.php';
    ?>

    <div class="login-wrapper">
        <div class="login-container">
            <div class="admin-icon">
                <i class="fas fa-lock"></i>
            </div>
            <h2>Admin Login</h2>
            <form method="POST" autocomplete="off">
                <div class="form-group">
                    <input type="text" name="name" placeholder="admin-name" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" autocomplete="new-password">
                </div>
                <button type="submit">Login</button>
            </form>
            <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <?php
    include 'footer.php';
    ?>
</body>

</html>