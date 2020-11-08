<?php
$query = "SELECT * FROM movies";
$result = mysqli_query($conn, $query);
if(!$result) die("QUERY FIELD " . mysqli_error($conn));
while($row = mysqli_fetch_assoc($result)) {
$nameURL = trim(strtolower($row['name']));
$nameURL = explode(" ", $nameURL);
$nameURL = join("-", $nameURL); ?>
    <div class="movie">
        <a href="movie.php?v=<?php echo $nameURL ?>"><h2><?php echo $row['name'] ?></h2></a> 
        <div class="content">
            <a href="movie.php?v=<?php echo $nameURL ?>"><img class="movieImg" src="<?php echo $row['img'] ?>" alt="<?php echo $row['name'] ?>"></a>
            <p><?php echo $row['description'] ?></p>
        </div>
    </div>
<?php } ?>