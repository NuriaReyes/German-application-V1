<?php
    include "variables.php";
    include "check.php";
    include "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
  
    <?php
        title("Hacer quiz!!");
    ?>
      
    <body>
        
        <?php
            navbar(1);
            
            if((isset($_GET['name'], $_GET['unit']))){
                $_SESSION['unitName'] = $_GET['name'];
                $_SESSION['unit'] = $_GET['unit'];
                $_SESSION['quizdata'] = NULL;
            }
            
            $nombre = $_SESSION['unitName'];
            
            $sql1 = 'select spanish, german
                    from words inner join lessons using(lesson)
                               inner join units using(id_unit)
                    where id_unit = '.$_SESSION['unit'].';';
            
            $rs1 = $conn->query($sql1);
            
            
            /*foreach ($arrayWords as $key => $spanish) {
                echo '<br>'.$key.' significa '.$spanish;
            }*/
            
            echo '
            <h3 align="center">Quiz de la unidad <u>'.$nombre.'</u></h3>
            <br>';
            
            //página test
            if(!(isset($_GET['done']))){
                
                $j = 0;
                while($record1 = $rs1->fetch_array(MYSQLI_ASSOC)){
                    if( (rand(0, 1)) && ($j<10) ){
                        $arrayWords[$record1['german']] = $record1['spanish'];
                        $j++;
                    }
                }
                
                echo '
                <h4 align="center">Escribe el significado de la palabra en español usando solo minúsculas, no olvides los acentos!!</h4>
                <br><br>';
                
                echo '
                <div class="container">
                    <div class="col-md-offset-2 col-md-8">
                        <form class="form-horizontal" action="quiz-now.php?done=1" method="post" style="text-align:center" >
                            <fieldset>
                                <legend>Beantworten Sie die Fragen</legend>';
                $i = 0;                
                foreach ($arrayWords as $key => $spanish) {
                    $i++; 
                    echo'
                                <div class="form-group">
                                    <label for="inputEmail" class="col-lg-3 control-label">'.$key.': </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="inputEmail" placeholder="traduce '.$key.'" name="answer'.$i.'">
                                    </div>
                                </div>
                        ';
                }                
                                
                echo'
                                <div class="form-group">
                                    <div>
                                        <button type="submit" class="btn btn-primary">Enviar respuesta</button>
                                    </div>
                                </div>
                            </fieldset>
                          </form>
                    </div>
                </div>
                ';
                
                $_SESSION['quizdata'] = serialize($arrayWords);
            }
            
            //página resultados
            if((isset($_GET['done']))){
                
                $arrayWords = unserialize($_SESSION['quizdata']);
                $correct_answers = 0;
                $i = 0;
                foreach ($arrayWords as $key => $spanish) {
                    $i++;
                    if($_POST['answer'.$i] == $spanish){
                        $correct_answers++;
                    }else{
                        
                        echo '<div class="container" align="center">
                                <br><h3 class="text-warning">Tuviste un error al traducir <strong>'.$key.'</strong>, significa <strong>'.$spanish.'</strong></h3>
                            </div>
                            ';
                    }
                }
                
                $average = 10*$correct_answers/$i;
                $average = round($average, 2);
                
                switch($average){
                    case ($average === 0):
                        $texto = 'warning';
                        $message = 'Estudia en la seccion de contenidos para mejorar';
                        break;
                    case ($average < 6.0):
                        $texto = 'warning';
                        $message = 'Necesitas practicar un poco más';
                        break;
                    case ($average < 9.0):
                        $texto = 'primary';
                        $message = 'Sigue así!';
                        break;
                    default:
                    $texto = 'success';
                    $message = 'Excelente, tu esfuerzo está dando frutos!';
                        
                }
                
                if($average == 10){
                    $trofeo = '<img src="graphics/trophy.png" >';
                }
                      
                echo '
                <div class="container col-md-offset-3 col-md-6">
                    <div class="panel panel-'.$texto.'">
                        <div class="panel-heading">
                            <h1 class="panel-title" align="center">Calificación: <u>'.$average.'</u></h1>
                        </div>
                        <div class="panel-body" align="center">
                            <h4>'.$message.'</h4>';
                            
                if(isset($trofeo)){
                    echo '
                            <div align="center">
                                '.$trofeo.'
                            </div>
                    ';
                }
                echo'
                        </div>
                    </div>
                </div>
                ';
                
                $unit = $_SESSION['unit'];
                $user = $_SESSION['user'];
            
                $sql1 = 'select user, id_unit
                        from units_users
                        where user = "'.$user.'" and id_unit = '.$unit.';';
                
                $rs1 = $conn->query($sql1);
                $num_reg = $rs1->num_rows;
                
                if($num_reg > 0){
                    
                    $sql2 = 'UPDATE units_users SET grade = '.$average.' WHERE user = "'.$user.'" and id_unit = '.$unit.' ;';
                    
                    $rs2 = $conn->query($sql2);
                    
                    if(!$rs2){
                        echo $errorInsertar;
                    }
                    
                }else{
                    
                    $sql3 = 'INSERT INTO units_users (user, id_unit, grade) VALUES ("'.$user.'", '.$unit.', '.$average.');';
                    
                    $rs3 = $conn->query($sql3);
                    
                    if(!$rs3){
                        echo $errorInsertar;
                    }
                }
            }
            
        ?>
        
    </body>
    
</html>