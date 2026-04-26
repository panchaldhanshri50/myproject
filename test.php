
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Access Denied</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            body {

                font-family: Arial, sans-serif;
// background: linear-gradient(135deg, #1e3c72, #2a5298);
  background-color: #f0f4f8;
                margin: 0;
                padding: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                color: #fff;
            }
            .error-box {
                background: #fff;
                color: #333;
                padding: 30px;
                border-radius: 12px;
                text-align: center;
                box-shadow: 0 6px 20px rgba(0,0,0,0.2);
                max-width: 400px;
                width: 100%;
            }
            .error-box i {
                font-size: 60px;
                color: #e63946;
                margin-bottom: 15px;
            }
            .error-box h1 {
                font-size: 24px;
                margin-bottom: 10px;
            }
            .error-box p {
                font-size: 16px;
                margin-bottom: 20px;
            }
            .error-box a {
                display: inline-block;
                padding: 10px 20px;
                background: #1a73e8;
                color: #fff;
                text-decoration: none;
                border-radius: 6px;
                transition: background 0.3s;
            }
            .error-box a:hover {
                background: #155ab6;
            }
        </style>
    </head>
    <body>
        <div class="error-box">
            <i class="fas fa-exclamation-triangle"></i>
            <h1>Access Denied</h1>
            <p>You must be logged in to upload files.</p>
            <a href="login.php"><i class="fas fa-sign-in-alt"></i> Go to Login</a>
        </div>
    </body>
    </html>
    ';
    exit; // stop execution after showing error page
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Files - Common Question Detector</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
       
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: #f0f4f8;
            color: #333;
            line-height: 1.5;
            padding-bottom: 40px;
                        /* background-image: url('images/background.png'); */

        }
        
        
        .container {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }
        
        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eaeaea;
        }
        
        .upload-area {
            border: 2px dashed #bdc3c7;
            border-radius: 6px;
            padding: 30px 20px;
            text-align: center;
            margin: 20px 0;
            background-color: #f9f9f9;
            transition: all 0.3s;
        }
        
        .upload-area:hover {
            border-color: #3498db;
            background-color: #edf7fd;
        }
        
        .upload-icon {
            font-size: 40px;
            color: #3498db;
            margin-bottom: 15px;
        }
        
        .file-input {
            margin: 20px auto;
            display: block;
            width: 100%;
            max-width: 400px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .submit-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 16px;
            display: block;
            margin: 25px auto;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .submit-btn:hover {
            background-color: #2980b9;
        }
        
        .info-box {
            background-color: #e8f4fc;
            border-left: 4px solid #3498db;
            padding: 15px;
            margin: 25px 0;
            border-radius: 0 4px 4px 0;
        }
        
        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 30px;
        }
        
        .feature {
            width: 220px;
            text-align: center;
            margin: 15px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 6px;
        }
        
        .feature-icon {
            font-size: 32px;
            color: #3498db;
            margin-bottom: 12px;
        }
        
        .file-types {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 15px 0;
        }
        
        .file-type {
            display: inline-flex;
            align-items: center;
            background-color: #e8f4fc;
            padding: 6px 12px;
            border-radius: 20px;
        }
        
        .file-type i {
            margin-right: 6px;
            color: #3498db;
        }
        
        
        
        
        @media (max-width: 768px) {
            .container {
                margin: 20px 15px;
                padding: 20px;
            }
            
            .features {
                flex-direction: column;
                align-items: center;
            }
            
            .navbar-nav {
                flex-wrap: wrap;
            }
            
            .nav-item {
                margin: 5px 10px;
            }
        }
        
        
        .imperfection-1 {
            margin-left: 3px; 
        }
        
        .imperfection-2 {
            border-radius: 5px; 
        }
         .admin-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
            margin-top: 150px;
        }
        
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e0e0e0;
            
        }
        
        .welcome-message {
            font-size: 1.5rem;
            /* color: #4b6cb7; */
            font-weight: 600;
            color: #4b6cb7
        }
    </style>
</head>
<body>
   
    <?php
    include 'upload-nav.php';
    ?>
     <div class="admin-container">
                        <div class="admin-header">
                            <h4 class="welcome-message">Welcome, <?php echo $_SESSION['name']; ?>!</h4>
                        </div>
<center>
   <h1>Welcome to user dashboard</h1>
   
</center>
    <div class="container">
        <h2><i class="fas fa-cloud-upload-alt imperfection-1"></i> Upload Documents for Question Extraction</h2>
        
        <div class="info-box">
            <h4><i class="fas fa-info-circle"></i> How It Works</h4>
            <p>Upload your documents containing questions. Our system will analyze them and extract all questions, identifying common ones across multiple documents.</p>
        </div>
        
        <form action="upload_handler.php" method="POST" enctype="multipart/form-data">
            <div class="upload-area imperfection-2">
                <div class="upload-icon">
                    <i class="fas fa-file-upload"></i>
                </div>
                <h4>Select Your Files</h4>
                <p>Drag & drop files here or click to browse</p>
                
                <div class="file-types">
                    <div class="file-type">
                        <i class="fas fa-file-pdf"></i> PDF Files
                    </div>
                  
                </div>
                
                <input type="file" class="file-input" name="documents[]" accept=".pdf,.txt" multiple required>

                <div class="info-box">
    <h4><i class="fas fa-info-circle"></i> Important</h4>
    <p>Only <strong>PDF</strong> and <strong>TXT</strong> files are supported. 
       Please do not upload Word documents, images, or other file types.</p>
</div>
            </div>
            
            <button type="submit" class="submit-btn">
                <i class="fas fa-bolt"></i> Upload and Extract Questions
            </button>
        </form>
        
        <!-- <div class="features">
            <div class="feature">
                <div class="feature-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h4>Smart Detection</h4>
                <p>Identifies common questions across documents</p>
            </div>
            <div class="feature">
                <div class="feature-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h4>Secure Processing</h4>
                <p>Your documents are processed securely</p>
            </div>
            <div class="feature">
                <div class="feature-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <h4>Detailed Reports</h4>
                <p>Get comprehensive analysis reports</p>
            </div>
        </div> -->
    </div>
    
   <?php
   include 'footer.php';
   ?>
</body>
</html>