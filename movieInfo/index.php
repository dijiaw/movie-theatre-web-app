<?php 
    include "../dbconnect.php";
    $query = "select * from movie where name='".$_GET['movie']."'";
    $matched = $db->query($query);
    if (!$matched) {
        echo "Error occurred when retrieving movie information!";
    } else {
        $movie = $matched->fetch_assoc();
        $movieid = $movie['movieid'];
    }
    $matched->free();
    $query = "select * from showtime where movieid=".$movieid;
    $matched = $db->query($query);
    $showdate = [];
    $slot = [];
    if (!$matched) {
        echo "Error occurred when retrieving show time information.";
    } else {
        $count = $matched->num_rows;
        for($i=0; $i<$count; $i++) {
            $s = $matched->fetch_assoc();
            $slotid[$i] = $s['slotid'];
            $date[$i] = $s['dateofshow'];
            $slot[$i] = $s['slot']; 
        }
    }
    $matched->free();
    $db->close();
?>

<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hogwarts Village</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="./info.css" />
</head>
<body>
    <?php include "../header.php" ?>
    <div class="mainbody">
        <div class="info">
           <h3 class="title"><?php echo $movie['name'] ?></h3>
           <div class="pic">
                <img class="image" alt="Movie Poster" src="<?php echo '..'.$movie['poster'] ?>">
           </div>
           <div class="attributes">
               <table class="movie-attributes">
                   <th>Details</th>
                   <tr>
                       <td><strong>Cast: </strong><?php echo $movie['cast'] ?></td>
                    </tr>
                    <tr>
                       <td><strong>Director: </strong><?php echo $movie['director'] ?></td>
                       <td><strong>Length: </strong><?php echo $movie['length'] ?> mins</td>
                    </tr>
                    <tr>
                       <td><strong>Genre: </strong><?php echo $movie['genre'] ?></td>
                       <td><strong>Language: </strong><?php echo $movie['language'] ?></td>
                    </tr>
                   <tr><td colspan='2'><strong>Synopsis: </strong><?php echo $movie['synopsis'] ?></td></tr>
               </table>
               <form action="<?php echo $movie['trailer'] ?>">
                   <input type="submit" class="button" value="trailer">
                </form>
           </div>
        </div>

        <div class="slots">
            <h3>Available Time Slots</h3>
            <table class='slots-available' align='center'>
            <?php 
                if (!empty($slot)){
                    for($i=0; $i<sizeof($slot); $i++){
                        echo "<tr><td><a href='../seating/index.php?slotid=".$slotid[$i]."'><span>".$date[$i]." ".$slot[$i]."</span></a></td></tr>";
                    }
                } else {
                    echo "<tr>The movie is coming soon!</tr>";
                }
            ?>
            </table>
        </div>
        
    </div>

<?php include '../footer.php' ?>