<?php 
    include "../dbconnect.php";
    session_start();
    $query = "select * from member where username ='".$_SESSION['user']."'";
    $matched = $db->query($query);
    if (!$matched) {
        echo "An error occurred when retriving member information!";
    } else {
        $member = $matched->fetch_assoc();
        $memberid = $member['memberid'];
    }
    $matched->free();
    
    $date = date("Y-m-d");
    foreach ($_SESSION['cart'] as $key => $id){
        if(is_array($id)){
            $seats = '';
            foreach($id as $key2 => $s){
                $seats = $seats.','.$s;
            }
            $seats = substr($seats,1);
            $reference = mt_rand(100000000,999999999);
            $query = "insert into booking values (NULL,".intval($key).",".$memberid.",'".$seats."','".$date."', '".$reference."')";
            $db->query($query);
        }  
    }
    $db->close();
    header('location: ../output/index.php?memberid='.$memberid.'&reference='.$reference);
    exit();
?>