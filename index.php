<?php
    include "variables.php";
    
    if(isset($_GET['out'])){
        session_unset();  
        session_destroy();
    }
?>
<!DOCTYPE html>
<html lang="en">
  
    <?php
        title("Deutsch ASAP!");
    ?>
      
    <body>
        
        <?php
            
            if(!(isset($_SESSION['user'], $_SESSION['pass']))){
                navbar(0);
            }else{
                navbar(1);
                saludo($_SESSION['user']);
            }
            
            modal();
        ?>
        
        <?php
            include "errors.php";  
        ?>
        
        <div class="container">
            <div class="col-md-offset-2 col-md-6">
                <img src="graphics/brandenburger.jpg" >
            </div>
        </div>
        
        
    </body>
    
</html>