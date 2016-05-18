<?php
    include "variables.php";
    include "check.php";
    include "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
  
    <?php
        title("Aprender!");
    ?>
      
    <body>
        
        <?php
            navbar(1);
            
            echo '
            <h3 align="center">Elige una lección a practicar</h3>
            <br><br>
            <div class="container">
                <div class="row">
            ';
            
            $sql1 = 'SELECT name, id_unit FROM units;';
            $rs1 = $conn->query($sql1);
            while($record1 = $rs1->fetch_array(MYSQLI_ASSOC)){
                echo '<div class="col-md-offset-1 col-md-2">
                        <div class="thumbnail">
                          <img src="graphics/'.$record1['id_unit'].'.png" >
                              <div class="caption">
                                <h5>'.$record1['name'].'</h5>
                                <ul>';
                
                $sql2 = 'SELECT name, id_unit, lesson FROM lessons WHERE id_unit = '.$record1['id_unit'].';';
                $rs2 = $conn->query($sql2);
                
                while($record2 = $rs2->fetch_array(MYSQLI_ASSOC)){
                    echo '<li><a href="practicar.php?unit='.$record2['id_unit'].'&lesson='.$record2['lesson'].'&uname='.$record1['name'].'&lname='.$record2['name'].'">'.$record2['name'].'</a></li>';
                }
                
                echo '
                                </ul>
                            </div>
                        </div>
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