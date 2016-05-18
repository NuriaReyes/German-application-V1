<?php
    include "variables.php";
    include "check.php";
    include "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
  
    <?php
        title("A practicar!!");
    ?>
      
    <body>
        
        <?php
            navbar(1);
            
            if((isset($_GET['lesson'], $_GET['unit'], $_GET['uname'], $_GET['lname']))){
                $_SESSION['lesson'] = $_GET['lesson'];
                $_SESSION['uname'] = $_GET['uname'];
                $_SESSION['lname'] = $_GET['lname'];
                $_SESSION['unit'] = $_GET['unit'];
                $_SESSION['quizdata'] = NULL;
            }
            
            $lesson = $_SESSION['lesson'];
            $unit = $_SESSION['unit'];
            $uname = $_SESSION['uname'];
            $lname = $_SESSION['lname'];
            
            $sql1 = 'select spanish, german
                    from words inner join lessons using(lesson)
                               inner join units using(id_unit)
                    where id_unit = '.$unit.' and lesson = '.$lesson.';';
            
            $rs1 = $conn->query($sql1);
            
            echo '
            <h3 align="center">Práctica de la unidad <u>'.$uname.'</u> y la lección <u>'.$lname.'</u></h3>
            <br>';
            
            //página test
            if(!(isset($_GET['done']))){
                
                while($record1 = $rs1->fetch_array(MYSQLI_ASSOC)){
                    $arrayWords[$record1['german']] = $record1['spanish'];
                }
                
                echo '
                <h4 align="center">Escribe el significado de la palabra en español usando solo minúsculas, no olvides los acentos!!</h4>
                <br><br>';
                
                echo '
                <div class="container">
                    <div class="col-md-offset-2 col-md-8">
                        <form class="form-horizontal" action="practicar.php?done=1" method="post" style="text-align:center" >
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
                
            }
            
        ?>
        
    </body>
    
</html>