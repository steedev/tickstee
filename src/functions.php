<?php

if(isset($_SESSION['username'])) {
}
else {
    http_response_code(403);
    include './403.php';
    return;
}

?>

<?php include 'db.php'; ?>

<?php

function getData($movie) {
    logs('get data');
    global $conn;
    global $tabStr;
    $nameDATABASE = encodeURL($movie);
    $query = "SELECT places FROM reservations WHERE movie = '{$nameDATABASE}'";
    $result = mysqli_query($conn, $query);
    if(!$result) die("QUERY FIELD " . mysqli_error($conn));
    $tabStr = '';
    while($row = mysqli_fetch_assoc($result)) {
        $tabStr .= $row['places'];
    }
}

function logs($info) {
    global $conn;
    if(isset($_SESSION['username'])) {$usr = $_SESSION['username'];} else { $usr = 'anonymous';}
    $ip = $_SERVER['REMOTE_ADDR'];
    $query = "INSERT INTO logs(ip, username, activity) VALUES('$ip', '$usr', '$info')";
    $result = mysqli_query($conn, $query);
    if(!$result) die("QUERY FIELD " . mysqli_error($conn));
}

function encodeURL($movie) {
    $nameDATABASE;
    $nms = explode("-", $movie);
    $nameDATABASE = '';
    foreach($nms as $name) {
        $nameDATABASE .= strtoupper($name[0]) . substr($name, 1, strlen($name) - 1) . " ";
    }

    return $nameDATABASE;
}

function addData($movie, $tabStr) {
    global $conn;
    global $errors;
    global $alert_status;

    $username = mysqli_real_escape_string($conn, $_SESSION['username']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel']);
    $places = mysqli_real_escape_string($conn, $_POST['id']);

    $errors = [];

    $tab = explode(" ", $tabStr);
    $placesTab = explode(" ", $places);

    $tab = array_slice($tab, 0,  count($tab) - 1);
    $placesTab = array_slice($placesTab, 0,  count($placesTab) - 1);
    $q = true;

    foreach($placesTab as $pl) {
        if(in_array($pl, $tab)) {
            $q = false;
        }
    }

    if($q == true) {
        if($username && $tel && $places) {
            $alert_status = 'success';
            array_push($errors, "Successful purchase");
            $movieENCODED = encodeURL($movie);
            $query = "INSERT INTO reservations(movie, username, tel, places) VALUES ('$movieENCODED', '$username', '$tel', '$places')";
            logs('valid purchase');
            $result = mysqli_query($conn, $query);
            if(!$result) die("QUERY FIELD " . mysqli_error($conn));
            else getData($movie);
        } else {
           $alert_status = 'warning';
           logs('invalid purchase');
           array_push($errors, "Please fill in all fields");
    
           if(!$places) {
            logs('invalid purchase');
            array_push($errors, "No place was chosen");
           }
        }
    }
    else if($q == false) {
        $alert_status = 'danger';
        logs('invalid purchase');
        array_push($errors, "These places have been sold");
    }
}
?>

<?php function renderAccountData($id_tab, $movie_tab, $tel_tab, $places_tab) {
    foreach($id_tab as $value => $id) { ?>
        <li class="list-group-item">
            <span style="margin-right:5%" class="badge badge-dark p-2"><?php echo $value + 1 ?></span>
            <span style="width:30%; margin-right:5%" class="badge badge-info p-2"><?php echo $movie_tab[$value] ?></span>
            <span style="width:20%; margin-right:5%" class="badge badge-success p-2"><?php echo $tel_tab[$value] ?></span>
            <button type="submit" name="details" value="<?php echo $id ?>" class="btn btn-dark btn-sm">View places</button>
            <button type="submit" name="delete" value="<?php echo $id ?>" style="float:right" class="btn btn-danger btn-sm">Cancel</button>
        </li>
<?php }} ?>