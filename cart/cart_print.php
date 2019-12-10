<?php 
    if (!($_SESSION['cart'])){
        echo "<tr><td colspan='3' id='empty'>Empty!</td></tr>";
    }
    else{
        $sum = 0;
        include "../dbconnect.php";
        $query = "select * from ticket Order by ticketpriceid DESC limit 1";
        $matched = $db->query($query);
        if (!$matched) {
            echo "Error occured when retrieving ticket information!";
        } else {
            $ticket = $matched->fetch_assoc();
            $price = $ticket['ticketprice'];
        }
        $matched->free();

        foreach($tmid as $slotid){
            $cur = 0;
            $query = "select * from showtime where slotid=".$slotid;
            $matched = $db->query($query);
            if (!$matched) {
                echo "Error occured when retrieving show time information!";
            } else {
                $s = $matched->fetch_assoc();
                $movieid = $s['movieid'];
                $date = $s['dateofshow'];
                $hall = $s['hall'];
                $slot = $s['slot'];
            }
            $matched->free();

            $query = "select * from movie where movieid=".$movieid;
            $matched = $db->query($query);
            if (!$matched) {
                echo "Error occured when retrieving movie information!";
            } else {
                $movie = $matched->fetch_assoc();
                $name = $movie['name'];
                $poster = $movie['poster'];
            }
            $matched->free();

            echo "<tr>";
                echo "<td class='poster-row'><img class='poster' src='..".$poster."'></td>";
                echo "<td class='ticket'>";
                    echo "<table class='secondary-table' border = 0>";
                        echo "<tr>";
                            echo "<td>Name:&nbsp;</td>";
                            echo "<td>".$name."<td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td>Date:&nbsp;&nbsp;</td>";
                            echo "<td>".$date."<td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td>Time:&nbsp;&nbsp;</td>";
                            echo "<td>".$slot."<td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td>Hall:&nbsp;&nbsp;</td>";
                            echo "<td>".$hall."<td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td>Seat:&nbsp;&nbsp;</td>";
                            echo "<td>";
                                foreach($seats[$slotid] as $seat){
                                    echo $seat." ";
                                    $cur = $cur + $price;
                                }
                            echo "<td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td>Total Price:&nbsp;&nbsp;</td>";
                            echo "<td>$ ".number_format($cur,2)."</td>";
                        echo "</tr>";
                    echo "</table>";
                echo "</td>";
                echo "<td class='delete'>";
                    echo "<a href='".$_SERVER['PHP_SELF']."?slotid=".$slotid."&empty=1'>";
                        echo "<button class='delete_button'>Delete Item</button>";
                    echo "</a>";
                echo "</td>";
            echo "</tr>";
            $sum = $sum + $cur;
        }

        $db->close();
    }
?>