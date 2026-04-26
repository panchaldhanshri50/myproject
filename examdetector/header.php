<?php
session_start();
?>
<!-- <header style="
                background-color: #12457b;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 5px 30px;
            ">
        <a href="#" style="
                            height: 100px;
                            width: auto;
                            background: transparent;
                        ">
                <img src="img/Picture1.png" alt="logo">
            </a>
        <nav style="
                    display: flex;
                    align-items: center;
                ">
            <div style="
                        display: flex;
                        gap: 70px; 
                        margin-top: 70px;">
                <a href="#" style="
                                    color: white;
                                    text-decoration: none;
                                    font-size: 18px;
                                    font-weight: 500;"><i class="fas fa-home"></i>Home</a>

                
                    <a href="#" style="
                                        color: white;
                                        text-decoration: none;
                                        font-size: 18px;
                                        font-weight: 500;">My Saved</a>
                    <a href="#" style="
                                        color: white;
                                        text-decoration: none;
                                        font-size: 18px;
                                        font-weight: 500;">Logout</a>
                
                    <a href="#" style="
                                        color: white;
                                        text-decoration: none;
                                        font-size: 18px;
                                        font-weight: 500;">Register</a>
                    <a href="#" style="
                                        color: white;
                                        text-decoration: none;
                                        font-size: 18px;
                                        font-weight: 500;">Login</a>
                
                
            </div>
            </div>
        </nav>
    </header>  -->


<style>
    nav a:link{
        text-decoration: none;
    }
    nav a:hover{
        text-decoration: underline;
    }
    nav a:active{
        text-decoration: underline;
    }
</style>

<header style="background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%); color:white; padding:5px 40px; display:flex; justify-content:space-between;">
    
    
    <img src="img/Picture1.png" alt="logo" style="height: 80px; width: auto;">
            

    <nav style="display: flex; align-items: center; gap: 70px; margin-top: 30px;">
        <a href="index.php" style="color:white; margin-left:20px;"><i class="fas fa-home"></i>Home</a>

        <?php if(isset($_SESSION['user_id'])): ?>
            <!-- USER PANEL LINKS -->
            <a href="mysaved.php" style="color:white; margin-left:20px;">My Saved</a>
            <a href="logout.php" style="color:white; margin-left:20px;">Logout</a>

        <?php else: ?>
            <!-- VISITOR LINKS -->
            <a href="signup.php" style="color:white; margin-left:20px;">Register</a>
            <a href="login.php" style="color:white; margin-left:20px;">Login</a>
        <?php endif; ?>
    </nav>

</header>