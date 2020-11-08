<?php include 'src/db.php' ?>
<?php session_start() ?>

<?php

if(isset($_SESSION['username'])) {
}
else {
    http_response_code(403);
    include 'src/403.php';
    return;
}
?>

<?php
    $query = "SELECT * FROM reservations WHERE id = '{$_GET['m']}'";
    $result = mysqli_query($conn, $query);
    if(!$result) die("QUERY FIELD " . mysqli_error($conn));
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $username = $row['username'];
        $movie = $row['movie'];
        $places = $row['places'];
    }

    if($username !== $_SESSION['username']){
        http_response_code(403);
        include 'src/403.php';
        return;
    }

    $l_places = explode(" ", $places);
    $l_places = count($l_places) - 1;
?>

<div id="target" style="display: none;"><?php echo htmlspecialchars($places); ?></div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <style><?php include './src/css/details.css' ?></style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script><?php include './src/js/noclick.js' ?></script>
    <style><?php include './src/css/global.css' ?></style>
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php"><b>TickStee</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            <a class="nav-link active" href="account.php">Account <span class="sr-only">(current)</span></a>
            <a class="nav-link" href="logout.php">Logout <span class="sr-only">(current)</span></a>
        </div>
    </div>
</nav>
<?php 
    $table = '';
         for($i = 0; $i < 15; $i++) {
            $rowLine = '<tr>';
            for($j = 0; $j < 20; $j++) {
                $rowLine .= "<td class='note'><button disabled value='$i" . "x" . "$j' id='$i" . "x" . "$j' class='btnFree'></button></td>";
            }
             $table .= "$rowLine</tr>";
        } ?>
    <div class="wrapper">
        <h1 class="headerMovie"><?php echo $movie ?></h1>
        <table>
            <?php print_r($table); ?>
        </table>
        <h2 style="text-align:center; margin-top:30px;"><?php echo $l_places ?> places</h2>
    </div>
    <?php include 'src/footer.php' ?>
</body>
</html>