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

    if(isset($_POST['sugg'])) {
        $name = $_POST['sugg'];
        
        foreach($name as $id) {
            echo "$id ";
        }
    }