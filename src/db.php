<?php
    $conn = mysqli_connect('localhost', 'root', '', 'movies');
    if(!$conn) mysqli_error($conn);