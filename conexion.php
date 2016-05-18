<?php

    $DBServer = 'localhost'; 
    $DBUser   = 'root';
    $DBPass   = 'root';
    $DBName   = 'deutschDB';
    $port     = 3307;
    
    $conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName, $port);
 
    // check connection
    if ($conn->connect_error) {
      trigger_error('La conexi—n a la base de datos fall—: '  . $conn->connect_error, E_USER_ERROR);
    }
    
    if (!$conn->set_charset("utf8")) {
        trigger_error("Error cargando el conjunto de caracteres utf8:".$mysqli->error);
        exit();
    }
    
?>