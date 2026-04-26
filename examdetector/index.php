<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Predictor </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        
        /* body {
        min-width: 1200px;
    }

    .main {
        width: 1200px;
        margin: auto;
    } */
    .main{
        display:flex;
        justify-content: space-between;
        gap: 5px;
        width:100%;
        
    }
    .explore{  
        flex: 1;
        color:#12457b;
        background-color: white;
        border-radius: 10px;
        margin: 10px;
        
        padding: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .card-container2{
        text-align: center;
        justify-content: space-between;
        background-color: rgb(255, 255, 255);
        border-radius:10px;
        margin:10px;
        flex: 2;
        padding: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        gap: 10px;
        color:#12457b;
    }
    
    .card1{
        display: flex;
        justify-content: space-between;  
        align-items: center; 
    }
    .txt{
        text-align: justify;
        max-width: 70%;
    }
    .btn{
        padding: 8px 16px;
        background-color:#12457b;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        font-size:large;
    }
    .btn:hover{
        background-color: #2980b9;
    }
    .card2{
        align-items: center; 
        border: solid 1px #12457b;
        border-radius: 10px;
        margin: 5px;
        padding: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .upload-area{
        background-color:#d0e2f6;
        color:#12457b;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        margin: 5px;
        padding: 5px;
    }
    .select-file{
        
        display: flex;
    }
    .upload-txt{
        text-align: justify;
        max-width: 50%;
    }
    .row {
        display: flex;
        gap: 20px;
        margin-top: 15px;
        flex-wrap: wrap;
    }
    .col {
        flex: 1;
        min-width: 250px;
    }
    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    select, input {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        margin-bottom: 5px;
    }
    .or-text {
        text-align: center;
        font-size: 12px;
        color: #888;
        margin: 5px 0;
    }
    
    .submit-btn {
        background-color: #12457b;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 16px;
        display: block;
        margin: 25px auto;
        cursor:not-allowed;
        transition: background-color 0.3s;
    }
    .submit-btn:hover {
        background-color: #2980b9;
    }    
</style>
</head>

<body>
    <div class="main">
        <div class="explore">
            
            <div class="demo">
                <h3><b><u>How It Works</u></b></h3>
                <video width="500px" autoplay muted loop>
                    <source src="video/demo.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <p>Upload your documents containing questions. Our system will analyze them and extract all questions, identifying common ones across multiple documents.</p>
            </div>
            <br><br>
            <hr width="100%" height="2px" color="#12457b">
            <br><br>
                <div class="card1">
                    <div class="txt">
                        <h3><b><u>Browse Questions</u></b></h3><br>
                        <p>You can Explore all available questions</p>
                    </div>
                    <!-- <button class="btn">Explore</button> -->
                     <a href="explore.php" class="browse-btn">Explore</a>
                </div>
            
        </div>
        <div class="card-container2">
            <div class="card2">
                <h3><b><u><i class="fas fa-cloud-upload-alt imperfection-1"></i> Upload Documents for Question Extraction</u></b></h3>
        
                <form action="upload_handler.php" method="POST" enctype="multipart/form-data">
                    <div class="upload-area">
                        <h3>Add Details</h3>
                        <div class="row">
                            <!--subject selection-->
                            <div class="col">
                                <label>Select Subject:</label>
                                <select>
                                    <option>-- Select Subject --</option>
                                    <option>Java</option>
                                    <option>DBMS</option>
                                    <option>Python</option>
                                    <option>Other</option>
                                </select>
                                <p class="or-text">OR</p>
                                <input type="text" placeholder="Enter other subject">
                            </div>

                            <!-- UNIVERSITY -->
                            <div class="col">
                                <label>Select University *</label>
                                <select>
                                    <option>-- Select University --</option>
                                    <option>GTU</option>
                                    <option>Mumbai University</option>
                                    <option>Pune University</option>
                                    <option>Other</option>
                                </select>
                                <p class="or-text">OR</p>
                                <input type="text" placeholder="Enter other university">
                            </div>

                            
                        </div>

                        
                        <div class="row">
                            <!-- COURSE -->
                            <div class="col">
                                <label>Select Course *</label>
                                <select>
                                    <option>-- Select Course --</option>
                                    <option>BCA</option>
                                    <option>B.Tech</option>
                                    <option>BSc IT</option>
                                    <option>Other</option>
                                </select>
                                <p class="or-text">OR</p>
                                <input type="text" placeholder="Enter other course">
                            </div>
                            <!-- YEAR -->
                            <div class="col">
                                <label>Year / Year Range *</label>
                                <input type="text" placeholder="e.g. 2005-2007 or 2010">
                            </div>
                        </div>
                        <hr width="100%" color=" #12457b"><br>
                        <div class="select-file">
                            <div class="upload-txt">
                                <h4><u>Select Your Files</u></h4><br>
                                <p>Drag & drop files here or click to browse</p>
                            </div>
                            <button disabled class="submit-btn">Login Required</button>
                        </div>
                    </div>
                    <div class="important">
                            <h4><i class="fas fa-info-circle"></i> Important</h4>
                            <p>Only <strong>PDF</strong> and <strong>TXT</strong> files are supported. 
                            Please do not upload Word documents, images, or other file types.</p>
                    </div>
                    
                    
                </form>
            </div>
        </div> 
    </div>

    <?php
    include 'footer.php';  
    ?>
</body>

</html>