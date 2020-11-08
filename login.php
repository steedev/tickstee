<?php ob_start() ?>
<?php include 'src/db.php' ?>
<?php session_start() ?>

<?php
function logs($info, $user) {
    global $conn;
    if(!$user) {
        if(isset($_SESSION['username'])) {$user = $_SESSION['username'];} else { $user = 'anonymous';}
    }
    $ip = $_SERVER['REMOTE_ADDR'];
    $query = "INSERT INTO logs(ip, username, activity) VALUES('$ip', '$user', '$info')";
    $result = mysqli_query($conn, $query);
    if(!$result) die("QUERY FIELD " . mysqli_error($conn));
}

logs('page refresh', null);

if(isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $result = mysqli_query($conn, $query);
    if(!$result) die("QUERY FIELD " . mysqli_error($conn));

    while($row = mysqli_fetch_array($result)) {
        $user = $row['username'];
        $pass = $row['password'];
    }

    if(!isset($user)) {
        $user = '';
    }

    if(!$user) {
        $user = '__';
        $pass = '__';
    }

    $errors = [];

    if (password_verify($password, $pass)) { 
        if($username !== $user) {
            logs('invalid login', $username);
            array_push($errors, "Incorrect login or password");
        }
        else if($username === $user) {
            $_SESSION['username'] = $user;
            logs('valid login', $username);
            header("Location: index.php");
        }
    } else {
        logs('invalid login', $username);
        array_push($errors, "Incorrect login or password");
    }   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <style><?php include './src/css/login.css' ?></style>
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
    </nav>
    
    <div class="wrapper">
    <h1 class="headerMovie"><i class="fas fa-sign-in-alt"></i> Log In</h1>
        <div class="form">
            <?php if(isset($_POST['login'])) {
                    foreach($errors as $error) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $error; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            <?php }} ?>
            <form action="login.php" autocomplete="off" method="post">
                <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter Username" />
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password" />
                    </div>

                    <input type="text" name="id" hidden id="hiddenInp" />
                    <input type="submit" class="btn btn-secondary" name="login" value="Log In" />
            </form>
            <div class="text-center">
                <a href="register.php" class="btn btn-success mt-5 center-block">Create New Account</a>
            </div>
        </div>
    </div>
    <?php include 'src/footer.php' ?>
</body>
</html>