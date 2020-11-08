<?php include 'src/db.php' ?>
<?php session_start() ?>
<?php include 'src/functions.php' ?>

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
    getData($_GET['v']);
    if(isset($_POST['submit'])) {
        addData($_GET['v'], $tabStr);
    }
?>

<div id="target" style="display: none;"><?php echo htmlspecialchars($tabStr); ?></div>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'src/header.php'?>
    <style><?php include './src/css/global.css' ?></style>
    <script><?php include './src/js/click.js' ?></script>
</head>
<body>
<?php include 'src/nav.php' ?>
<?php include 'src/table.php' ?>
    <div class="wrapper">
        <h1 class="headerMovie"><?php echo encodeURL($_GET['v']) ?></h1>
            <table>
                <?php print_r($table); ?>
            </table>
        <div class="form">
            <?php include 'src/form.php' ?>
                <form action="movie.php?v=<?php echo $_GET['v'] ?>" autocomplete="off" method="post">
                    <?php include 'src/form_2.php' ?>
                </form>
        </div>
    </div>
    <?php include 'src/footer.php' ?>
</body>
</html>