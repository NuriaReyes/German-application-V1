<?php
    //conexionBD, consultar tabla users
    include"conexion.php";
    
    $user = $_POST['ruser'];
    $pass = $_POST['rpass'];
    $conf = $_POST['cpass'];
    
    if($pass === $conf){
        $sql = 'INSERT INTO users VALUES ("'.$user.'", "'.$pass.'");';
        $rs=$conn->query($sql);
        
        if($rs){
            header("Location:  index.php?success=1"); //se pudo registrar el usuario exitosamente
        }else{
            header("Location:  index.php?error=3"); //usuario ocupado
        }
        
        
    }else{
        header("Location:  index.php?error=1"); //contraseña no checa
    }
    
?>