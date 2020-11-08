<?php

if(isset($_SESSION['username'])) {
}
else {
    http_response_code(403);
    include './403.php';
    return;
}

?>
            <h1>Ticket area</h1>
            <div class="alert_errors">
            <?php if(isset($_POST['submit'])) {
                    foreach($errors as $error) { ?>
                    <div class="alert alert-<?php echo $alert_status; ?> alert-dismissible fade show" role="alert">
                        <?php echo $error; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php }} ?>
            </div>