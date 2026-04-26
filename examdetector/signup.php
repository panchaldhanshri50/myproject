<?php //include 'navbar.php' 
include 'header.php'
?>
<?php
include 'valid_conn.php';

// $message = "";

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $name = trim($_POST['name'] ?? '');
//     $email = trim($_POST['email'] ?? '');
//     $password = trim($_POST['password'] ?? '');


//     if (empty($email) || empty($password)) {
//         $message = "<p class='error'>Please fill in all fields.</p>";
//     } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         $message = "<p class='error'>Please enter a valid email address.</p>";
//     } else {

//         $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
//         if (!$stmt) {
//             die("Prepare failed (SELECT): " . $conn->error);
//         }
//         $stmt->bind_param("s", $email);
//         $stmt->execute();
//         $stmt->store_result();

//         if ($stmt->num_rows > 0) {
//             $message = "<p class='error'>User already exists.</p>";
//         } else {
//             $hashed_password = password_hash($password, PASSWORD_DEFAULT);

//             $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
//             if (!$stmt) {
//                 die("Prepare failed (INSERT): " . $conn->error);
//             }
//             $stmt->bind_param("sss", $name, $email, $hashed_password);

//             if ($stmt->execute()) {
//                 header("Location: login.php?msg=registered");
//                 exit();
//             } else {
//                 $message = "<p class='error'>Something went wrong: " . $stmt->error . "</p>";
//             }
//         }
//         $stmt->close();
//     }
// }

class User {
    public $name;
    public $email;
    public $password;
    public $conn;
    public $message = "";

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function register($name, $email, $password) {
        $this->name = trim($name);
        $this->email = trim($email);
        $this->password = trim($password);

        if (empty($this->email) || empty($this->password)) {
            $this->message = "<p class='error'>Please fill in all fields.</p>";
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->message = "<p class='error'>Please enter a valid email address.</p>";
        } else {
            $stmt = $this->conn->prepare("SELECT user_id FROM users WHERE email = ?");
            $stmt->bind_param("s", $this->email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $this->message = "<p class='error'>User already exists.</p>";
            } else {
                $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
                $stmt = $this->conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $this->name, $this->email, $hashed_password);
                if ($stmt->execute()) {
                    header("Location: login.php?msg=registered");
                    exit();
                } else {
                    $this->message = "<p class='error'>Something went wrong: " . $stmt->error . "</p>";
                }
            }
            $stmt->close();
        }
        return $this->message;
    }
}
?>
<?php
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User($conn);   // object creation
    $message = $user->register($_POST['name'], $_POST['email'], $_POST['password']);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Predictor - <?php echo isset($_GET['reset']) ? 'Reset Password' : 'Signup'; ?></title>
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4cc9f0;
            --dark-color: #2b2d42;
            --light-color: #f8f9fa;
            --success-color: #4bb543;
            --error-color: #f72585;
            --border-radius: 8px;
            --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        /* * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }


        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);


        }

        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            overflow-x: hidden;
        } */

        .main-content {


            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;

            margin-bottom: 80px;
            margin-top: 80px;

            /* min-height: 150vh; */
        }



        .container {
            width: 100%;
            max-width: 500px;
            background: white;
            padding: 40px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        }

        h2 {
            color: var(--dark-color);
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            position: relative;
            padding-bottom: 15px;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--accent-color);
            border-radius: 3px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e2e8f0;
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: var(--transition);
            background-color: var(--light-color);
        }

        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="text"]:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: white;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        button[type="submit"] {
            width: 100%;
            padding: 14px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        button[type="submit"]:hover {
            background: linear-gradient(to right, var(--secondary-color), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        .message {
            text-align: center;
            margin: 20px 0;
            padding: 15px;
            border-radius: var(--border-radius);
            background-color: rgba(75, 181, 67, 0.1);
            color: var(--success-color);
            font-weight: 500;
        }

        .message-link {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
        }

        .message-link:hover {
            text-decoration: underline;
        }

        .exam-icon {
            text-align: center;
            margin-bottom: 20px;
            color: var(--primary-color);
            font-size: 48px;
        }

        @media (max-width: 576px) {
            .container {
                padding: 30px 20px;
            }

            h2 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    
    <div class="main-content">
        <div class="container">
            <div class="exam-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>

            <h2><?php echo isset($_GET['reset']) ? 'Reset Password' : 'Create Account'; ?></h2>

            <?php if (isset($message)): ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email Address" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="<?php echo isset($_GET['reset']) ? 'New Password' : 'Create Password'; ?>" required>
                </div>
                <button type="submit"><?php echo isset($_GET['reset']) ? 'Reset Password' : 'Sign Up'; ?></button>
            </form>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<?php    
include 'footer.php';
?>
</body>

</html>