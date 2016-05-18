<?php
    include "variables.php";
    include "check.php";
    include "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
  
    <?php
        title("Ver contenidos");
    ?>
      
    <body>
        
        <?php
            navbar(1);
            
            echo'
                <div class="container">
                    <div class="col-md-2">
                        <br><h4>Unidades:</h4>
                        <ul class="nav nav-pills nav-stacked">
            ';
            $sql1 = 'SELECT name, id_unit FROM units;';
            $rs1 = $conn->query($sql1);
            while($record1 = $rs1->fetch_array(MYSQLI_ASSOC)){
                echo        '<li><a onclick="displayUnit('.$record1['id_unit'].')" href="#">'.$record1['name'].'</a></li>';
            }
            
            echo '
                        </ul>
                    </div>';
                    
            $rs1-> data_seek(0);
            while($record1 = $rs1->fetch_array(MYSQLI_ASSOC)){
                echo '<div class="col-md-offset-1 col-md-6" id="unit'.$record1['id_unit'].'" hidden>
                        <br><h4>Lecciones:</h4>
                        <ul class="nav nav-tabs nav-justified">
                ';
            
                $sql2 = 'SELECT name, id_unit, lesson FROM lessons WHERE id_unit = '.$record1['id_unit'].';';
                $rs2 = $conn->query($sql2);
                while($record2 = $rs2->fetch_array(MYSQLI_ASSOC)){
                    echo        '<li class=""><a onclick="displayLesson('.$record1['id_unit'].','.$record2['lesson'].')" href="#unit'.$record1['id_unit'].'lesson'.$record2['lesson'].'" data-toggle="tab" aria-expanded="" id="#unit'.$record1['id_unit'].'lesson'.$record2['lesson'].'">'.$record2['name'].'</a></li>';
    
                }
                $rs2->data_seek(0);
                while($record2 = $rs2->fetch_array(MYSQLI_ASSOC)){
                    $sql3 = 'SELECT spanish, german, lesson FROM words WHERE lesson='.$record2['lesson'].';';
                    $rs3 = $conn->query($sql3);
                    echo'
                                </ul>
                                <div id="lessonContent" class="tab-content col-md-offset-3 col-md-6">
                                    <div id="unit'.$record1['id_unit'].'lesson'.$record2['lesson'].'" class="tab-pane fade in">
                                    
                                    <table class="table table-striped table-hover ">
                                        <thead>
                                          <tr>
                                            <th>Español</th>
                                            <th>Alemán</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        
                                    
                    ';
                    
                    while($record3 = $rs3->fetch_array(MYSQLI_ASSOC)){
                        echo        '
                                    <tr>
                                        <td>'.$record3['spanish'].'</td>
                                        <td>'.$record3['german'].'</td>
                                    </tr>
                        ';
                        //echo            '<p text-align: center> '.$record3['spanish'].' que significa '.$record3['german'].'</p><br>';
                    }
                    echo '          </tbody>
                                </table>
                            </div>
                        </div>';
                }
                
            
            echo '</div>';
            }
                
                echo '</div>
            ';
            
            
        ?>
        
        <script type="text/javascript">
            var visibleContainer = 1;
            var visibleLesson = 1;
            $( document ).ready(function() {
                displayUnit(1);
                displayLesson(1,1);
            });
            var displayLesson = function (unitNumber, lessonNumber){
                var prevContaier = '#unit' + visibleContainer + 'lesson' + visibleLesson;
                var container = '#unit' + unitNumber + 'lesson' + lessonNumber;
                $('.active').toggleClass('active', false);
                $(container).toggleClass('active', true);
            }
            var displayUnit = function(unitNumber){
                $('#unit'+visibleContainer).hide('slow');
                $('#unit'+unitNumber).show('slow');
                visibleContainer = unitNumber;
            }
        </script>
        
      
    </body>
    
</html>