<?php
    if(!(isset($_SESSION['user'], $_SESSION['pass']))){
        header("Location: index.php?error=2");
        exit();
    }
?>