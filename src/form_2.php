<?php

if(isset($_SESSION['username'])) {
}
else {
    http_response_code(403);
    include './403.php';
    return;
}

?>

<div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" value="<?php echo $_SESSION['username'] ?>" disabled />
</div>

<div class="form-group">
    <label for="tel">Phone number</label>
    <input type="tel" class="form-control" name="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" placeholder="111-222-333" />
</div>

<input type="text" name="id" hidden id="hiddenInp" />
<input type="submit" class="btn btn-secondary" name="submit" value="Submit" />