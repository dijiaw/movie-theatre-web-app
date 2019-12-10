<?php
    $selected_movie = $_POST['selected-movie'];
    $selected_genre = $_POST['selected-genre'];
    $selected_language = $_POST['selected-language'];
     if ($selected_movie) {
        $filter = "name";
        $value = $selected_movie;
    } else if ($selected_genre) {
        $filter = "genre";
        $value = $selected_genre;
    } else {
        $filter = "language";
        $value = $selected_language;
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

    <div class="main-body">
        <h2>Based On Your Search: Movie <?php echo ucfirst($filter)." -> ".$value; ?></h2>
        <div class="now-showing">
            <h3>Now Showing</h3>
            <table>
                <tr>
                <?php 
                    include "../dbconnect.php";
                    $query = "select * from movie where status='nowshowing' and ".$filter."='".$value."'";
                    $matched = $db->query($query);
                    if (!$matched) {
                        echo "Error occurred when retrieving poster information!";
                    } else {
                        $count = $matched->num_rows;
                        for($i=0; $i<$count; $i++) {
                            if($i>5) break;
                            $movie = $matched->fetch_assoc();
                            echo "<td><a href='../movieInfo/index.php?movie=".$movie['name']."'><img class='poster' 
                            src='..".$movie['poster']."'></a><br><br>
                                        <span>Name: ".$movie['name']."</span><br>
                                        <span>Class: ".$movie['pgrating']."</span><br>
                                        <span>Genre: ".$movie['genre']."</span><br>
                                        <span>Running Time: ".$movie['length']."mins</span><br>
                                        <span>Rating: ".$movie['rating']."/10</span>
                                </td>";
                        }
                    }
                    $matched->free();
                    $db->close();
                ?>
                </tr>
            </table>
        </div>
        <div class="comingsoon">
            <h3>Coming Soon</h3>
            <table>
                <tr>
                <?php 
                    include "../dbconnect.php";
                    $query = "select * from movie where status='comingsoon' and ".$filter."='".$value."'";
                    $matched = $db->query($query);
                    if (!$matched) {
                        echo "Error occurred when retrieving poster information!";
                    } else {
                        $count = $matched->num_rows;
                        for($i=0; $i<$count; $i++) {
                            if($i>5) break;
                            $movie = $matched->fetch_assoc();
                            echo "<td><a href='../movieInfo/index.php?movie=".$movie['name']."'><img class='poster' src='..".$movie['poster']."'></a><br><br>
                                        <span>Name: ".$movie['name']."</span><br>
                                        <span>Class: ".$movie['pgrating']."</span><br>
                                        <span>Genre: ".$movie['genre']."</span><br>
                                        <span>Running Time: ".$movie['length']."mins</span><br>
                                        <span>Rating: ".$movie['rating']."/10</span>
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