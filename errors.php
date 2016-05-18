<?php

    if(isset($_GET['error'])){
        switch($_GET['error']){
            case 0:
                echo $error1; //usuario o contrase–a incorrecta 
                break;
            case 1:
                echo $error2; //error de registro contrase–a
                break;
            case 2:
                echo $error3; //intentar entrar sin haberse logeado
                break;
            case 3:
                echo $error4; //registrarse con user ya ocupado
        }   
    }
    
    if(isset($_GET['success'])){
        switch($_GET['success']){
            case 1:
                echo $success1; //registro exitoso
        } 
    }
?>