<?php
    include "variables.php";
    include "check.php";
    include "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
  
    <?php
        title("Escoge tu Quiz!");
    ?>
      
    <body>
        
        <?php
            navbar(1);
            
            echo '
            <h3 align="center">Elige una unidad a evaluar</h3>
            <br><br>
            <div class="container">
                <div class="row">
            ';
            
            $sql1 = 'SELECT name, id_unit FROM units;';
            $rs1 = $conn->query($sql1);
            while($record1 = $rs1->fetch_array(MYSQLI_ASSOC)){
                echo '<div class="col-md-offset-1 col-md-2">
                        <a href="quiz-now.php?unit='.$record1['id_unit'].'&name='.$record1['name'].'" class="thumbnail">
                          <img src="graphics/'.$record1['id_unit'].'.png" >
                        </a>
                    </div>
                ';
            }
            
            echo'
                </div>
            </div>
            ';
            
        ?>
      
    </body>
    
</html>