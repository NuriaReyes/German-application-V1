<?php
    include "variables.php";
    include "check.php";
    include "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
  
    <?php
        title("Mis avances");
    ?>
      
    <body>
        
        <?php
            navbar(1);
            
            echo '
            <h3 align="center">Hallo '.$_SESSION['user'].'!</h3>
            <br>
            <h4 align="center">Estas son tus calificaciones hasta ahora</h4>
            <br><br>';
            
            $sql1 = 'select name "Unidad", grade
                    from units_users inner join units using(id_unit)
                    where user = "'.$_SESSION['user'].'";';
                    
            $rs1 = $conn->query($sql1);
            $num_reg = $rs1->num_rows;
            
            if($num_reg > 0){
                
                echo '
                <div class="container col-md-offset-3 col-md-6">
                    <table class="table table-striped table-hover ">
                        <thead>
                          <tr>
                            <th>Unidad</th>
                            <th>Calificación</th>
                          </tr>
                        </thead>
                        <tbody>
                ';
                
                while($record1 = $rs1->fetch_array(MYSQLI_ASSOC)){
                    echo'
                            <tr>
                                <td>'.$record1['Unidad'].'</td>
                                <td>'.$record1['grade'].'</td>
                            </tr>
                    ';        
                }
                
                echo'   </tbody>
                    </table>
                </div>
                ';
            
            }else{
                echo '
                    <br>
                    <h4 align="center">Ooops, aun no tienes ninguna calificacion registrada<br>Haz un quiz para tener calificaciones</h4>
                    <br><br>';
            }
            
        ?>
        
    </body>
    
</html>