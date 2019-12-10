<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hogwarts Village</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="./output.css" />
</head>
<body>
    <?php include "../header.php" ?>
    <div class="mainbody">
        <h2>Review booking</h2>
        <?php 
        $msg = "Your booking with Hogwarts Village is successful! You can now review the booking.";
        $reference = $_GET['reference'];
        foreach ($_SESSION['cart'] as $first => $id){
            if(is_array($id)){
                $seats = '';
                foreach($id as $second => $s){
                    $seats = $seats.','.$s;
                }
                $seats = substr($seats,1);
                $slotid = intval($first);

                include "../dbconnect.php";
                $query = "select * from showtime where slotid=".$slotid;
                $matched = $db->query($query);
                if (!$matched) {
                    echo "Error occurred when retrieving show time information!.";
                } else {
                    $s = $matched->fetch_assoc();
                }
                $matched->free();

                $query = "select name from movie where movieid=".$s['movieid'];
                $matched = $db->query($query);
                if (!$matched) {
                    echo "Error occurred when retrieving movie information!";
                } else {
                    $movie = $matched->fetch_assoc();
                }
                $matched->free();

                $query = "select name from movie where movieid=".$s['movieid'];
                $matched = $db->query($query);
                if (!$matched) {
                    echo "Error occurred when retrieving movie information!";
                } else {
                    $movie = $matched->fetch_assoc();
                }
                $matched->free();

                $db->close();
                
                echo "<div class='ticket'>
                        <h4>Ticket Information</h4>
                        <table>
                            <tr><td class='left-col'>Booking Reference:</td><td>".$reference."</td></tr>
                            <tr><td class='left-col'>Movie:</td><td>".$movie['name']."</td></tr>
                            <tr><td class='left-col'>Date and Time:</td><td>".$s['dateofshow']." ".$s['slot']."</td></tr>
                            <tr><td class='left-col'>Hall:</td><td>".$s['hall']."</td></tr>
                            <tr><td class='left-col'>Seat(s):</td><td>".$seats."</td></tr>
                        </table>
                    </div>";

                $msg = "Booking Reference: ".$reference."; Movie: ".$movie['name']."; Hall: ".$s['hall']."; Date and Time: ".$s['dateofshow']." ".$s['slot']."; Seat(s): ".$seats.".";
            }
        }

        $memberid = $_GET['memberid'];
        include "../dbconnect.php";
        $query = "select email from member where memberid=".$memberid;
        $matched = $db->query($query);
        if (!$matched) {
            echo "Error occurred when retrieving member information!";
        } else {
            $member = $matched->fetch_assoc();
            $emailRes = 'From: f36ee@localhost' . "\r\n" .
                'Reply-To: f36ee@localhost' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            mail($member['email'], "Movie Ticket Confirmation Letter", $msg, $emailRes,'-ff36ee@localhost');
            echo "<p>A confirmation email has been sent to your email address ".$member['email'].".</p>";
        }
        $matched->free();
        $db->close();
        unset($_SESSION['cart']);
        ?>
    </div>

<?php include '../footer.php' ?>