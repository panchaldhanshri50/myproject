 <?php
include 'header.php';
include 'valid_conn.php';    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows === 1) {
            $user = $res->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['name'] = $user['name'];

                //after login redirect to upload page
                header("Location: upload.php");
                exit();
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "User not found.";
        }
    }
    ?>


 <!DOCTYPE html>
 <html>

 <head>
     <title>Login</title>
     <link rel="stylesheet" href="style.css">
     <style>
         :root {
             --primary-color: #4361ee;
             --primary-hover: #3a56d4;
             --error-color: #f72585;
             --success-color: #4cc9f0;
             --text-color: #2b2d42;
             --light-gray: #f8f9fa;
             --border-radius: 8px;
             --box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
             --transition: all 0.3s ease;
         }

         /* * {
             margin: 0;
             padding: 0;
             box-sizing: border-box;


         }

         html,
         body {
             margin: 0;
             padding: 0;
             height: 100%;
             width: 100%;
             overflow-x: hidden;

         }


         body {
             font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
             background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
             color: var(--text-color);
             margin: 0;
             min-height: 100vh;
             display: flex;
             flex-direction: column;
         } */


         .main-content {
             flex: 1;
             display: flex;
             justify-content: center;
             align-items: center;
             padding: 20px;
             margin-bottom: 60px;
             margin-top: 80px;
             /* min-height: 100vh; */


         }


         .container {
             width: 100%;
             max-width: 400px;
             background: white;
             padding: 40px;
             border-radius: var(--border-radius);
             box-shadow: var(--box-shadow);
             transform: translateY(0);
             transition: var(--transition);
             animation: fadeIn 0.6s ease-out;
         }

         .container:hover {
             box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
             transform: translateY(-5px);
         }

         @keyframes fadeIn {
             from {
                 opacity: 0;
                 transform: translateY(20px);
             }

             to {
                 opacity: 1;
                 transform: translateY(0);
             }
         }

         h2 {
             text-align: center;
             margin-bottom: 30px;
             color: var(--primary-color);
             font-size: 28px;
             font-weight: 600;
         }

         .form-group {
             margin-bottom: 25px;
             position: relative;
         }

         label {
             display: block;
             margin-bottom: 8px;
             font-weight: 500;
             color: var(--text-color);
         }

         input[type="email"],
         input[type="password"] {
             width: 100%;
             padding: 14px 16px;
             border: 2px solid #e9ecef;
             border-radius: var(--border-radius);
             font-size: 16px;
             transition: var(--transition);
             background-color: var(--light-gray);
         }

         input[type="email"]:focus,
         input[type="password"]:focus {
             outline: none;
             border-color: var(--primary-color);
             background-color: white;
             box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
         }

         input[type="submit"] {
             width: 100%;
             padding: 14px;
             background-color: var(--primary-color);
             color: white;
             font-size: 16px;
             font-weight: 600;
             border: none;
             border-radius: var(--border-radius);
             cursor: pointer;
             transition: var(--transition);
             text-transform: uppercase;
             letter-spacing: 0.5px;
         }

         input[type="submit"]:hover {
             background-color: var(--primary-hover);
             transform: translateY(-2px);
         }

         input[type="submit"]:active {
             transform: translateY(0);
         }

         .error {
             color: var(--error-color);
             text-align: center;
             margin-bottom: 20px;
             padding: 12px;
             background-color: rgba(247, 37, 133, 0.1);
             border-radius: var(--border-radius);
             animation: shake 0.5s;
         }

         @keyframes shake {

             0%,
             100% {
                 transform: translateX(0);
             }

             20%,
             60% {
                 transform: translateX(-5px);
             }

             40%,
             80% {
                 transform: translateX(5px);
             }
         }

         .forgot-password {
             text-align: center;
             margin-top: 20px;
         }

         .forgot-password a {
             color: var(--primary-color);
             text-decoration: none;
             font-size: 14px;
             transition: var(--transition);
         }

         .forgot-password a:hover {
             text-decoration: underline;
         }

         .logo {
             text-align: center;
             margin-bottom: 10px;
         }

         .logo img {
             height: 150px;
             width: 150px;
         }


         @media (max-width: 480px) {
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
             <h2>Welcome Back</h2>

             <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

             <form method="POST" action="" autocomplete="off">
                 <div class="form-group">
                     <label for="email">Email Address</label>
                     <input type="email" name="email" id="email" placeholder="Enter your email" autocomplete="off" required>
                 </div>

                 <div class="form-group">
                     <label for="password">Password</label>
                     <input type="password" name="password" id="password" placeholder="Enter your password" autocomplete="new-password" required>
                 </div>

                 <input type="submit" value="Sign In">

                 <a href="reset-password.php">Forgot Password?</a>

             </form>

         </div>

     </div>
<?php
include "footer.php";
?>     
 </body>

 </html>