<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hogwarts Village</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="./movies.css" />
</head>
<body>
    <?php include "../header.php" ?>
    <div class="mainbody">
        <div class="nowshowing">
            <h3>Now Showing</h3>
            <table>
                <tr>
                <?php 
                    include "../dbconnect.php";
                    $query = "select * from movie where status='nowshowing'";
                    $matched = $db->query($query);
                    if (!$matched) {
                        echo "Error occurred when retrieving poster information from database!";
                    } else {
                        $count = $matched->num_rows;
                        $rows_on_page = ceil($count / 4);
                        for ($i = 0; $i < $rows_on_page; $i ++) {
                            echo "<tr>";
                            for($j = 0; $j < 4; $j++) {
                                if (i == $rows_on_page - 1 && j >= $count % 4 - 1) break;
                                $movie = $matched->fetch_assoc();
                                if(isset($movie)) {
                                    echo "<td><a href='../movieInfo/index.php?movie=".$movie['name']."'><img class='poster' 
                                    src='..".$movie['poster']."'></a><br><br>
                                                <span>Name: ".$movie['name']."</span><br>
                                                <span>PG Rating: ".$movie['pgrating']."</span><br>
                                                <span>Genre: ".$movie['genre']."</span><br>
                                                <span>Rating: ".$movie['rating']."/100</span>
                                        </td>";
                                }
                            }
                            echo "</tr>";
                        }
                        
                    }
                    $matched->free();
                    $db->close();
                ?>
                </tr>
            </table>
        </div>
        <div class="upcoming">
            <h3>Coming Soon</h3>
            <table>
                <tr>
                <?php 
                    include "../dbconnect.php";
                    $query = "select * from movie where status='comingsoon'";
                    $matched = $db->query($query);
                    if (!$matched) {
                        echo "Error occurred when retrieving poster information from database!";
                    } else {
                        $count = $matched->num_rows;
                        for($i=0; $i<$count; $i++) {
                            if($i>5) break;
                            $movie = $matched->fetch_assoc();
                            echo "<td><a href='../movieInfo/index.php?movie=".$movie['name']."'><img class='poster' src='..".$movie['poster']."'></a><br><br>
                                        <span>Name: ".$movie['name']."</span><br>
                                        <span>PG Rating: ".$movie['pgrating']."</span><br>
                                        <span>Genre: ".$movie['genre']."</span><br>
                                        <span>Rating: ".$movie['rating']."/100</span>
                                </td>";
                        }
                    }
                    $matched->free();
                    $db->close();
                ?>
                </tr>
            </table>
        </div>

    </div>

<?php include '../footer.php' ?>