<?php

    //conexionBD, consultar tabla users
    include"conexion.php";
    
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    
    $sql='SELECT pass FROM users WHERE user = "'.$user.'"';
    
    $rs=$conn->query($sql);
    
    $record = $rs->fetch_array(MYSQLI_ASSOC);
    

    if($pass === $record['pass']){
        session_start();
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        header("Location:  index.php"); 
        exit();
    }else{
        header("Location:  index.php?error=0"); //not valid pass
        exit();
    }
    
?>
