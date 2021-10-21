<?php
    include_once "function/helper.php";
    session_start();

    unset($_SESSION['user_id']);
    unset($_SESSION['level']);
    unset($_SESSION['nama']);

    header("location: " . BASE_URL);
    
?>