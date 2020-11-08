<?php ob_start() ?>
<?php include 'src/db.php' ?>
<?php session_start() ?>

<?php

function logs($info) {
    global $conn;
    if(isset($_SESSION['username'])) {$usr = $_SESSION['username'];} else { $usr = 'anonymous';}
    $ip = $_SERVER['REMOTE_ADDR'];
    $query = "INSERT INTO logs(ip, username, activity) VALUES('$ip', '$usr', '$info')";
    $result = mysqli_query($conn, $query);
    if(!$result) die("QUERY FIELD " . mysqli_error($conn));
}

logs('page refresh');

if(isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $result = mysqli_query($conn, $query);
    if(!$result) die("QUERY FIELD " . mysqli_error($conn));

    while($row = mysqli_fetch_array($result)) {
        $user = $row['username'];
    }

    $errors = [];

    if(isset($user)) {
        $alert_status = 'danger';
        logs('invalid register');
        array_push($errors, "User is already registered");
    }
    else {
        if($username && $password && $password2) {
            if($password !== $password2) {
                $alert_status = 'warning';
                logs('invalid register');
                array_push($errors, "Incorrect password");
            }
            else if($password === $password2) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO users(username, password) VALUES('$username', '$password')";
                $result = mysqli_query($conn, $query);
                if(!$result) die("QUERY FIELD " . mysqli_error($conn));
                logs('valid register');
                header("Location: login.php");
            }
        }
        else {
            $alert_status = 'warning';
            logs('invalid register');
            array_push($errors, "Please fill in all fields");
        }
    }
}

if(isset($_SESSION['username'])) {
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
    <h1 class="headerMovie"><i class="fas fa-user-plus"></i> Register</h1>
        <div class="form">
            <?php if(isset($_POST['register'])) {
                    foreach($errors as $error) { ?>
                    <div class="alert alert-<?php echo $alert_status; ?> alert-dismissible fade show" role="alert">
                        <?php echo $error; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            <?php }} ?>
            <form action="register.php" autocomplete="off" method="post">
                <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter Username" />
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Create Password" />
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" name="password2" placeholder="Confirm Password" />
                    </div>

                    <input type="text" name="id" hidden id="hiddenInp" />
                    <input type="submit" class="btn btn-secondary" name="register" value="Register" />
            </form>
            <div class="text-center">
                <a href="login.php" class="btn btn-success mt-4 center-block">Log In</a>
            </div>
        </div>
    </div>
    <?php include 'src/footer.php' ?>
</body>
</html>