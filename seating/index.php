<?php 
    include "../dbconnect.php";
    $slotid = $_GET['slotid'];
    $strslotid = strval($slotid);

    $query = "select * from showtime where slotid=".$slotid;
    $matched = $db->query($query);
    if (!$matched) {
        echo "Error occurred when retrieving show time information!";
    } else {
        $s = $matched->fetch_assoc();
        $movieid = $s['movieid'];
        $dateofshow = $s['dateofshow'];
        $hall = $s['hall'];
        $slot = $s['slot'];
    }
    $matched->free();

    $query = "select * from movie where movieid=".$movieid;
    $matched = $db->query($query);
    if (!$matched) {
        echo "Error occurred when retrieving movie information!";
    } else {
        $movie = $matched->fetch_assoc();
        $name = $movie['name'];
        $poster = $movie['poster'];
    }
    $matched->free();

    $query = "select * from booking where slotid=".$slotid;
    $matched = $db->query($query);
    if (!$matched) {
        echo "Error occurred when retrieving booking information!";
    } else {
        $count = $matched->num_rows;
        $myseats = [];
        for($i=0; $i<$count; $i++) {
            $booking = $matched->fetch_assoc();
            $s = $booking['seats'];
            $seats = explode(',', $s);
            $myseats[] = $seats;
        }
    }
    $matched->free();

    $query = "select * from ticket Order by ticketpriceid DESC limit 1";
    $matched = $db->query($query);
    if (!$matched) {
        echo "Error occurred when retrieving ticket price!";
    } else {
        $ticket = $matched->fetch_assoc();
        $price = $ticket['ticketprice'];
    }
    $matched->free();
    $db->close();

    session_start();
    if (!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }

    if (isset($_GET['seat'])) {
        $seatarray = explode(",", $_GET['seat']);
        
        $strslot = strval($slotid);
        foreach($seatarray as $seatid){
            $_SESSION['cart'][$strslot][] = $seatid;
        }
        header('location: ' . $_SERVER['PHP_SELF']. '?' . SID.'&slotid='.$slotid);
        exit();
    }

    if (isset($_GET['seats_chosen'])) {
        $seatarray = explode(",", $_GET['seats_chosen']);
        if (empty($_GET['seats_chosen'])){

            header('location: ../cart/index.php?'.SID);
            exit();
        }else{
            $strslot = strval($slotid);
            foreach($seatarray as $seatid){
                $_SESSION['cart'][$strslot][] = $seatid;
            }
            header('location: ../cart/index.php?'.SID);
            exit();
        }
    }

?>

<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hogwarts Village</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="./seats.css" />
    <script src="index.js"></script>
</head>
<body onload="pageLoad()">
    <?php include "../header.php" ?>

    <div class="mainbody">

        <div class="pic">
            <img alt="poster" class="image" src="<?php echo '..'.$poster ?>">
        </div>

        <div class="information">
            <h3>Ticket Information</h3>
            <ul>
                <li>Movie: <?php echo $name ?></li>
                <?php echo "<li id='infoli'>".$slotid."</li>" ?>
                <li>Date and Time:    <?php echo $dateofshow." ".$slot ?></li>
                <li>Ticket Price:   $ <?php echo "<span id='ticket_price'>".$price."</span>" ?></li>
                <li>Seats:       <span id="choice"></span></li>
                <li>Total Cost:   $ <span id="cost"></span></li>
            </ul>
            

            <button id="add" onclick="add()" disabled>Add to cart</button>           
            <div>
                <button id="confirm" onclick="confirm()">Confirm</button>        
                <a href="../movies/index.php">
                    <button id="cancel">Cancel</button>
                </a>
            </div>  
        </div>

        <div class="details">
            <div class="hallandtime">
                <h3><?php echo "Movie: $name" ?></h3>
                <ul>
                    <li>Hall:  <?php echo "Hogwarts $hall"?> </li>
                    <li>Date and Time: <?php echo $dateofshow." ".$slot ?></li>
                </ul>
            </div>
            <div class="selection-table">
                <h3>Select your seat(s)</h3>
                <div class="status">
                    <div class="block available"></div><span>Available</span>
                    <div class="block sold"></div><span>Sold</span>
                    <div class="block reserved"></div><span>Reserved</span>
                    <div class="block selected"></div><span>Selected</span>
                </div>
                <div class="seating">
                    <hr class="screen">
                    <p class="text-screen">
                        Screen
                    </p>
                    <table>
                    <?php 
                    for($i=0;$i<5;$i++) {
                        echo "<tr class='row'>";
                        for($j=0;$j<10;$j++){
                            foreach($myseats as $key => $value){
                                foreach ($value as $key2 => $block_seat){
                                    if ($block_seat == chr($i+65).$j ) {
                                        echo "<td><input type='checkbox' value='".chr($i+65).$j."' id='".chr($i+65).$j."'disabled>";
                                        echo "<label for='".chr($i+65).$j."'>".chr($i+65).$j."</label>";
                                        echo "</td>";
                                        $disabled = 1;
                                        break;   
                                    }
                                }
                            }
                            if ($disabled == 1){
                                $disabled = 0;
                                continue;
                            }
                            if ($_SESSION['cart']){
                                if (array_key_exists($strslotid,$_SESSION['cart'])){
                                    foreach($_SESSION['cart'][$strslotid] as $reserve){
                                        if ($reserve == chr($i+65).$j){
                                            echo "<td><input type='checkbox' name='reserved' value='".chr($i+65).$j."' id='".chr($i+65).$j."'disabled>";
                                            echo "<label for='".chr($i+65).$j."'>".chr($i+65).$j."</label>";
                                            echo "</td>";
                                            $disabled = 1;
                                            break; 
                                        }
                                    }
                                }
                                if ($disabled == 1){
                                    $disabled = 0;
                                    continue;
                                }
                            }
                            echo "<td><input type='checkbox' onclick='seatClick()' class='chked' value='".chr($i+65).$j."' id='".chr($i+65).$j."'>";
                            echo "<label for='".chr($i+65).$j."'>".chr($i+65).$j."</label>";
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                        echo '<script src="index.js"></script>'
                    ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include '../footer.php' ?>