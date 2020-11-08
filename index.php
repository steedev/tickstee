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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <style><?php include './src/css/index.css' ?></style>
    <link rel="stylesheet" href="./src/css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style><?php include './src/css/global.css' ?></style>
    
</head>
<body>
<?php include 'src/nav.php' ?>
    <div class="wrapper">
        <?php include 'src/movies.php' ?>
    </div>
    <?php include 'src/footer.php' ?>
</body>
</html>