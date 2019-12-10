<?php
    $mygenre = $_POST['mygenre'];
    $mymovie = $_POST['mymovie'];
    $mylanguage = $_POST['mylanguage'];
     if ($mygenre) {
        $filter = "genre";
        $value = $mygenre;
    } else if ($mymovie) {
        $filter = "name";
        $value = $mymovie;
    } else {
        $filter = "language";
        $value = $mylanguage;
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
    <link rel="stylesheet" type="text/css" media="screen" href="./movies.css" />
</head>
<body>
    <?php include "../header.php" ?>
    <div class="mainbody">
        <h2>Your search result: Movie <?php echo ucfirst($filter)." -> ".$value; ?></h2>
        <div class="search-nowshowing">
            <table>
                <tr>
                <?php 
                    include "../dbconnect.php";
                    $query = "select * from movie where status='nowshowing' and ".$filter."='".$value."'";
                    $matched = $db->query($query);
                    if (!$matched) {
                        echo "Error occurred when retrieving the poster!";
                    } else {
                        $count = $matched->num_rows;
                        if ($count > 0) echo "<h3>Now Showing</h3>";
                        for($i=0; $i<$count; $i++) {
                            if($i>5) break;
                            $movie = $matched->fetch_assoc();
                            echo "<td><a href='../movieInfo/index.php?movie=".$movie['name']."'><img class='poster' src='..".$movie['poster']."'></a><br><br>
                                        <span>Name: ".$movie['name']."</span><br>
                                        <span>Genre: ".$movie['genre']."</span><br>
                                        <span>Movie Length: ".$movie['length']."minutes</span><br>
                                        <span>Rating: ".$movie['rating']."/100</span><br>
                                        <span>PG Rating: ".$movie['pgrating']."</span><br>
                                </td>";
                        }
                    }
                    $matched->free();
                    $db->close();
                ?>
                </tr>
            </table>
        </div>
        <div class="search-comingsoon">
            <table>
                <tr>
                <?php 
                    include "../dbconnect.php";
                    $query = "select * from movie where status='comingsoon' and ".$filter."='".$value."'";
                    $matched = $db->query($query);
                    if (!$matched) {
                        echo "Error occurred when retrieving the poster!";
                    } else {
                        $count = $matched->num_rows;
                        if ($count > 0) echo "<h3>Coming Soon</h3>";
                        for($i=0; $i<$count; $i++) {
                            if($i>5) break;
                            $movie = $matched->fetch_assoc();
                            echo "<td><a href='../movieInfo/index.php?movie=".$movie['name']."'><img class='poster' src='..".$movie['poster']."'></a><br><br>
                                        <span>Name: ".$movie['name']."</span><br>
                                        <span>Genre: ".$movie['genre']."</span><br>
                                        <span>Movie Length: ".$movie['length']."minutes</span><br>
                                        <span>Rating: ".$movie['rating']."/100</span>
                                        <span>PG Rating: ".$movie['pgrating']."</span><br>
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