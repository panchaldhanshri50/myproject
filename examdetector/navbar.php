<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Predictor Pro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
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
             padding-top: 80px;
        }

        .exam-navbar {
            height: 100px;
            background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
            padding: 0 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            
        }


        .nav-container {

            width: 100%;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-sizing: border-box;
        }

        .nav-brand {
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .nav-brand i {
            margin-right: 10px;
            font-size: 1.8rem;
        }

        .nav-brand img {
            height: 100px;
            width: auto;
            background: transparent;
        }

        .nav-menu {
            display: flex;
            list-style: none;
        }

        .nav-item {
            margin-left: 1.5rem;
            position: relative;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 0;
            position: relative;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .nav-link i {
            margin-left: 5px;
        }

        .nav-link:hover {
            color: #f8f9fa;
        }

        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: #f8f9fa;
            bottom: 0;
            left: 0;
            transition: width 0.3s ease;
        }

        .nav-link:hover:after {
            width: 100%;
        }

        .active-link {
            color: #f8f9fa;
        }

        .active-link:after {
            width: 100%;
        }

        .predict-btn {
            background-color: #ff6b6b;
            color: white;
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .predict-btn:hover {
            background-color: #ff5252;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .predict-btn:after {
            display: none;
        }

        #nav-toggle {
            display: none;
        }

        .mobile-menu-btn {
            display: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }


        @media (max-width: 768px) {
            .nav-container {
                flex-wrap: wrap;
            }

            .mobile-menu-btn {
                display: block;
            }

            .nav-menu {
                display: none;
                width: 100%;
                flex-direction: column;
                padding-top: 1rem;
            }

            .nav-item {
                margin: 0.5rem 0;
            }

            #nav-toggle:checked~.nav-menu {
                display: flex;
            }
        }

        .text-logo {
            display: flex;
            flex-direction: column;
            line-height: 1;
            color: white;
            font-family: 'Arial', sans-serif;
        }

        .logo-line1 {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .logo-line2 {
            font-size: 1.4rem;
            font-weight: 400;
            margin-top: -5px;
            letter-spacing: 3px;
            text-align: center;
        }

        .nav-brand .text-logo {
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }


        .nav-brand:hover .text-logo {
            opacity: 0.9;
        }

        /* footer {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            color: #6c757d;
            font-size: 14px;
            background-color: #e9ecef;
            position: fixed;
            top: 700px;
            width: 100%;
        } */
        /* footer {
            height: 60px;
            background-color: #e9ecef;
            color: #6c757d;
           
            font-size: 14px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 100px;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
        } */
    </style>
</head>

<body>
    <nav class="exam-navbar">
        <div class="nav-container">
            <a href="#" class="nav-brand">
                <img src="images/logo33.png" alt="logo">
                <!--                 
                <div class="text-logo">
            <span class="logo-line1">CommonQ</span>
            <span class="logo-line2">Finder</span>
        </div> -->
            </a>

            <input type="checkbox" id="nav-toggle">
            <label for="nav-toggle" class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </label>

            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="index.php" class="nav-link active-link">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="signup.php" class="nav-link">
                        Register
                    </a>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="nav-link">
                        Login
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="upload.php" class="nav-link">
                        Predictor-Questions
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin-log.php" class="nav-link predict-btn">
                        Admin
                    </a>
                </li> -->
            </ul>
        </div>
    </nav>
