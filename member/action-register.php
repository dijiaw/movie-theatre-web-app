<?php
    include "../dbconnect.php";
    $name = $_POST['newname'];
    $username = $_POST['newusername'];
    $email = $_POST['newemail'];
    $password = $_POST['newpassword'];

    $password = md5($password);

    $query = "select * from member where username='".$username."' or email='".$email."';";
    $matched = $db->query($query);
    if (!$matched) {
        echo "Error occurred when retrieving member information!";
    } else {
        $count = $matched->num_rows;
        if($count>0){
            echo "The username or email you chose already have a record in our system, please try with another one.";
            $matched->free();
            echo "<br><a href='login.php'>Back To Registration Page..</a>";
            exit;
        } else {
            $query = "insert into member values(NULL,'".$name."','".$username."','".$email."','".$password."')";
            $matched = $db->query($query);
            if(!$matched)
                echo "Error occurred when executing the query for registration";
            else 
                echo "<p>Dear ".$username.", welcome to Hogwarts Village! It's our great pleasure to onboard you as our new member<br>
                        You will be auto-directed to our login page in <span id='count'>3</span> seconds.<br>
                        It the page didn't direct you automatically, please kindly click <a href='login.php'>here</a>.</p>";
                echo " <script type='text/javascript' src='../login_direct.js'></script>";
        }
    }
    $matched->free();
    $db->close();
?>