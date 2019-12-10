<?php 
    session_start();
    if (!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
    $tmid = [];
    $seats = [[],[]];
    foreach ($_SESSION['cart'] as $key => $id){
        $tmid[] = $key;
        if(is_array($id)){
            foreach($id as $key2 => $s){
                $seats[$key][] = $s;
            }
        }
    }

    $slotid = $_GET['slotid'];
    $empty = $_GET['empty'];
    $empty_all = $_GET['empty_all'];

    if ($empty){
        unset($_SESSION['cart'][$slotid]);
        $empty = 0;
        header('location: ' . $_SERVER['PHP_SELF']. '?' . SID);
        exit();
    }

    if ($empty_all){
        unset($_SESSION['cart']);
        $empty_all = 0;
        header('location: ' . $_SERVER['PHP_SELF']. '?' . SID);
        exit();
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
    <link rel="stylesheet" type="text/css" media="screen" href="./cart.css" />
    <script src="index.js"></script>
</head>
<body>
    <?php include "../header.php" ?>
    <div class="mainbody">
        <table class="items-in-cart" border="0">
            <thead>
               <tr id="title">
                   <th colspan="2" id="title-text">Items in your shopping cart</th>
                   <?php echo "<th class='clear-cart' align='right'>";
                            if($_SESSION['cart']){
                                echo "<a href='".$_SERVER['PHP_SELF']."?&empty_all=1'>";
                                    echo "<button class='clear_cart_button'>Clear all items</button>";
                                echo "</a>";
                            }
                            else{
                                echo "<button class='clear_cart_button' disabled>Clear all items</button>";
                            }
                            
                        echo "</th>";
                    ?>
               </tr>
            </thead>
            <tbody>
                <?php include "cart_print.php" ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" align='right'>Price in total:</th><br>
                    <th align='center'>$ <?php 
                    if ($sum) {
                        echo number_format($sum, 2); 
                    }
                    else{
                        echo '0.00';
                    }
                    ?>
                    </th>
                </tr>
                <tr id="confirmation">
                    <th colspan="2" align='right'>
                        <a href="../movies/index.php">
                            <button id="buy_more">Buy more tickets</button>
                        </a>
                    </th>
                    <th align='right'>
                        <?php
                        if ($_SESSION['cart']){
                            if(!isset($_SESSION['user'])){
                                echo '<button id="confirm" onclick="popup()">Confirm</button>';
                            }
                            else {
                                echo '<a href="bought.php">
                                        <button id="confirm" >Confirm</button>
                                    </a>';
                            }
                        }
                        else {
                            echo '<button id="confirm" disabled>Confirm</button>';
                        }
                        ?>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>

    <?php include '../footer.php' ?>