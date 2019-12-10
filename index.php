<?php
    session_start();
    $currentuser = $_SESSION['user'];
?>
<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hogwarts Village</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
</head>
<body>
    <div class="body-wrapper">
        <div class="wrapper">
            <header>
                <div class="logoclass">
                    <img class="logo" src="./database/logo.jpg"> 
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
                    <li class="links"><a href="./index.php">Home</a></li>
                    <li class="links"><a href="./movies/index.php">Movies</a></li>
                    <li class="links"><a href="./cart/index.php">Cart</a></li>
                    <li class="links"><a href="./bookings/index.php">My Bookings</a></li>
                    <li class="links"><a href="./contactUs/index.php">Contact Us</a></li>
                </ul>
            </nav>     
            </header>
        </div>
    <div class="main-body">
        <div class="filter">
            <form class="filterform" action="./movies/filter.php" method="post">
                <label>Select Movie</label>
                <select name="mymovie">
                <option value=0>select a movie</option>
                <?php
                        include "dbconnect.php";
                        $query = "select * from movie where status='nowshowing'";
                        $matched = $db->query($query);
                        if (!$matched) {
                            echo "Error occurred when retrieving movie information!";
                        } else {
                            $count = $matched->num_rows;
                            for($i = 0; $i < $count; $i ++) {
                                $movie = $matched->fetch_assoc();
                                echo "<option value='".$movie['name']."'>".$movie['name']."</option>";
                            }
                        }
                        $matched->free();
                        $db->close();
                    ?>
                </select><br>
                <label>Select Genre</label>
                    <select name="mygenre">
                    <option value=0>select a category</option>
                    <?php 
                        include "dbconnect.php";
                        $query = "select distinct genre from movie";
                        $matched = $db->query($query);
                        if (!$matched) {
                            echo "Error occurred when retrieving movie information!";
                        } else {
                            $count = $matched->num_rows;
                            for($i = 0; $i < $count; $i ++) {
                                $movie = $matched->fetch_assoc();
                                echo "<option value='".$movie['genre']."'>".$movie['genre']."</option>";
                            }
                        }
                        $matched->free();
                        $db->close();
                    ?>
                    </select><br>
                    <label>Select Language</label>
                    <select name="mylanguage">
                    <option value=0>select a language</option>
                    <?php 
                        include "dbconnect.php";
                        $query = "select distinct language from movie";
                        $matched = $db->query($query);
                        if (!$matched) {
                            echo "Error occurred when retrieving movie information!";
                        } else {
                            $count = $matched->num_rows;
                            for($i = 0; $i < $count; $i ++) {
                                $movie = $matched->fetch_assoc();
                                echo "<option value='".$movie['language']."'>".$movie['language']."</option>";
                            }
                        }
                        $matched->free();
                        $db->close();
                    ?>
                    </select><br>
                    <input type="submit" class="search" value="Search Now">
            </form>
        </div>
            <div class="movies">
                <table border="1" class="pics">
                    <tr>
                    <?php 
                        include "dbconnect.php";
                        $query = "select * from movie where movieid <= 8";
                        $matched = $db->query($query);
                        if (!$matched) {
                            echo "Error occurred when retrieving movie information!";
                        } else {
                            $count = $matched->num_rows;
                            for($i = 0; $i < $count; $i ++) {
                                if($i > 7) break;
                                $movie = $matched->fetch_assoc();
                                echo "<td><a href='./movieInfo/index.php?movie=".$movie['name']."'><img class='poster' 
                                src='.".$movie['poster']."'></a><br><br><span>".$movie['name']."</span></td>";
                                if($i == 3) echo "</tr><tr>";
                            }
                        }
                        $matched->free();
                        $db->close();
                    ?>
                    </tr>
                </table>
                <input type="button" value="Previous" class="previous" onClick="document.location.href='./index.php'" />
                <input type="button" value="Next" class="next" id="nextButton" onClick="document.location.href='./homenextpage.php'" />
            </div>
        </div>
</div>

    <?php include 'footer.php' ?>