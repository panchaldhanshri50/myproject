<?php
session_start();
?>
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
        <?php endif; ?>
        
    </nav>

</header>