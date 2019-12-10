<?php
    session_start();
    $currentuser = $_SESSION['user'];
?>
<div class="body-wrapper">
    <div class="wrapper">
        <header>
            <div class="logoclass">
                <img class="logo" src="../database/logo.jpg"> 
            </div>
            <nav class="navclass">
                <?php if(!isset($_SESSION['user'])): ?>
                    <button type='button' class='buttons' onclick="location.href='../member/login.php'">Login / Join Us</button>
                <?php endif; ?>
                <?php if(isset($_SESSION['user'])): ?>
                    <button type='button' class='buttons' onclick="location.href='../member/logout.php'">Logout</button>
                    <p class='buttonswords'>Welcome back to Hogwarts Village <?php echo $_SESSION['user'] ?>!</p>
                <?php endif; ?>
                <ul class="nav-bar">
                    <li class="links"><a href="../index.php">Home</a></li>
                    <li class="links"><a href="../movies/index.php">Movies</a></li>
                    <li class="links"><a href="../cart/index.php">Cart</a></li>
                    <li class="links"><a href="../bookings/index.php">My Bookings</a></li>
                    <li class="links"><a href="../contactUs/index.php">Contact Us</a></li>
                </ul>
            </nav>     
        </header>
    </div>