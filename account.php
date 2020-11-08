<?php ob_start() ?>
<?php include 'src/db.php' ?>
<?php session_start() ?>
<?php include 'src/functions.php' ?>

<?php

if(isset($_SESSION['username'])) {
}
else {
    http_response_code(404);
    include 'src/403.php';
    return;
}

function getAccountData() {
    logs('get acc data');
    global $conn, $m_sId, $m_sMovie, $m_sTel, $m_sPlaces;
    $query = "SELECT * FROM reservations WHERE username ='{$_SESSION['username']}'";
    $result = mysqli_query($conn, $query);
    if(!$result) die("QUERY FIELD " . mysqli_error($conn));

    $m_sId = [];
    $m_sMovie = [];
    $m_sTel = [];
    $m_sPlaces = [];

    while($row = mysqli_fetch_array($result)) {
        $m_id = $row['id'];
        $m_movie = $row['movie'];
        $m_tel = $row['tel'];
        $m_places = $row['places'];

        array_push($m_sId, $m_id);
        array_push($m_sMovie, $m_movie);
        array_push($m_sTel, $m_tel);
        array_push($m_sPlaces, $m_places);
    }
}
getAccountData();
?>

<?php
    if(isset($_POST['delete'])) {
        $id = mysqli_real_escape_string($conn, $_POST['delete']);
        $query = "DELETE FROM reservations WHERE id = '{$id}'";
        $result = mysqli_query($conn, $query);
        if(!$result) die("QUERY FIELD " . mysqli_error($conn));
        logs('cancel purchase');
        getAccountData();
    }

    if(isset($_POST['details'])) {
        logs('show purchase details');
        $id = mysqli_real_escape_string($conn, $_POST['details']);
        header("Location: details.php?m=$id");
        echo $id;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <style><?php include './src/css/account.css' ?></style>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
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
    <div class="container-fluid">
        <div class="wrapper">
            <div class="loginInfo">
                <img src="http://unsplash.it/200/200" alt="user">
                <h1><?php echo $_SESSION['username'] ?></h1>
            </div>
            <div class="movie">
                <div class="movies">
                    <div class="movieHeader">
                        <?php if(!$m_sId) { ?>
                            <a href="index.php"><h2>No tickets have been bought yet</h2></a> 
                        <?php } ?>
                    </div>
                    <form action="account.php" method="post">
                        <ul class="list-group">
                            <?php renderAccountData($m_sId, $m_sMovie, $m_sTel, $m_sPlaces ) ?>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'src/footer.php' ?>
</body>
</html>