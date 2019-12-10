<?php 
ini_set('display_errors',1);
    $name = $_POST['feedback-name'];
    $email = $_POST['feedback-email'];
    $feedback = $_POST['feedback-content'];

    if (!$name || !$email || !$feedback) {
        echo "You have not entered all the required details. <br>";
        echo "Please try again.";
        exit();
    }

    if (!get_magic_quotes_gpc()) {
        $name = addslashes($name);
        $email = addslashes($email);
        $feedback = addslashes($feedback);
    }

    include "../dbconnect.php";
    $query = "insert into feedback values (NULL,'".$name."','".$email."','".$feedback."')";
    $db->query($query);
    $db->close();

    ini_set('display_errors',1);
    header('location: index.php');
    exit();
?>