<?php
    session_start();

    //head
    function title($title){
        echo '
            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>'.$title.'</title>
                <link rel="icon" href="graphics/favicon.png" type="image/gif" >
                <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
                <link href="bootstrap/css/bootstrap-custom.css" rel="stylesheet">
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                <script src="bootstrap/js/bootstrap.min.js"></script>
            </head>
        ';
    }
    
    //index.php
    function saludo($name){
        echo'
            <div class="container" align="center">
                <h2>Willkommen '.$name.'!</h2>
            </div>
        ';
    }
    
    //navbar = 1 (logged), navbar = 0 (not logged)
    function navbar($opc = 1){
        
        echo '
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php"><img src="graphics/logo.png"/></a>
                    </div>
              
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            ';
        
        if($opc == 1){
            echo '
                        <ul class="nav navbar-nav">
                          <li><a href="contenido.php">Contenidos</a></li>
                          <li><a href="practica.php">Practicar</a></li>
                          <li><a href="quiz.php">Quiz</a></li>
                        </ul>
            
                        <ul class="nav navbar-nav navbar-right">
                    
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'.$_SESSION['user'].'<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="avance.php">Ver avances</a></li>
                                    <li class="divider"></li>
                                    <li><a href="index.php?out=1">Salir</a></li>
                                </ul>
                            </li>
            ';
            
        }else{
           
            echo '
                        <ul class="nav navbar-nav navbar-right">
            
                            <li><a data-toggle="modal" data-target="#login">Ingresar</a></li>
                            <li><a data-toggle="modal" data-target="#reg">Registrarse</a></li>
            ';
              
        }
        
        echo '
                        </ul>
                    </div>
                </div>
            </nav>
        ';
        
    }
    
    //index.php para ingresar o registrarse
    function modal(){
        
        //login    
        echo '
            <div id="login" class="modal fade" role="dialog">
                <div class="modal-dialog">
              
                    <div class="modal-content">
                    
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="text-align:center">Ingresar</h4>
                        </div>
                        
                        <div class="modal-body">
                            
                            <div class="container">
                                <div class="col-md-6">
                                    <form class="form-horizontal" action="login.php" method="post" style="text-align:center" >
                                        <fieldset>
                                          <div class="form-group">
                                            <label for="inputEmail" class="col-lg-3 control-label">Usuario</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="inputEmail" placeholder="escribe tu usuario" name="user" required>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="inputPassword" class="col-lg-3 control-label">Contraseña</label>
                                            <div class="col-lg-6">
                                              <input type="password" class="form-control" id="inputPassword" placeholder="escribe tu contraseña" name="pass" required>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <div>
                                                <button type="submit" class="btn btn-primary">Entrar</button>
                                            </div>
                                          </div>
                                        </fieldset>
                                      </form>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
              
                </div>
            </div>
        ';
        
        //practica
        /*echo '
            <div id="practica" class="modal fade" role="dialog">
                <div class="modal-dialog">
              
                    <div class="modal-content">
                    
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="text-align:center">¿Qué desea hacer?</h4>
                        </div>
                        
                        <div class="modal-body">
                            
                            <div class="container">
                                <div class="col-md-offset-1 col-md-4">
                                    <a href="practicar.php" class="btn btn-primary">Practicar lección</a>
                                    <a href="quiz.php" class="btn btn-success">Quiz de la lección</a>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
              
                </div>
            </div>
        ';*/
        
        //registro
        echo '
            <div id="reg" class="modal fade" role="dialog">
                <div class="modal-dialog">
              
                    <div class="modal-content">
                    
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="text-align:center">Registrarse</h4>
                        </div>
                        
                        <div class="modal-body">
                            
                            <div class="container">
                                <div class="col-md-6">
                                    <form class="form-horizontal" action="registrar.php" method="post" style="text-align:center" >
                                        <fieldset>
                                          <div class="form-group">
                                            <label for="inputEmail" class="col-lg-3 control-label">Usuario</label>
                                            <div class="col-lg-6">
                                              <input type="text" class="form-control" id="inputEmail" placeholder="escribe tu usuario" name="ruser" required>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="inputPassword" class="col-lg-3 control-label">Contraseña</label>
                                            <div class="col-lg-6">
                                              <input type="password" class="form-control" id="inputPassword" placeholder="escribe tu contraseña" name="rpass" required>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="inputPassword" class="col-lg-3 control-label">Comprobación</label>
                                            <div class="col-lg-6">
                                              <input type="password" class="form-control" id="inputPassword" placeholder="vuelve a escribir tu contraseña" name="cpass" required>
                                            </div>
                                          </div>
                                          
                                          <div class="form-group">
                                            <div>
                                                <button type="submit" class="btn btn-primary">Registrarme</button>
                                            </div>
                                          </div>
                                        </fieldset>
                                      </form>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
              
                </div>
            </div>
        ';
    }
    
    //mensajes de errores
    $error1 =
    '<div class="col-md-offset-3 col-md-6">
        <div class="alert alert-dismissible alert-warning">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Usuario o contraseña incorrecta</strong>
        </div>
    </div>';
    $error2 =
    '<div class="col-md-offset-3 col-md-6">
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>No se pudo registrar, contraseña  y comprobación son distintas</strong>
        </div>
    </div>';
    $error3 =
    '<div class="col-md-offset-3 col-md-6">
        <div class="alert alert-dismissible alert-info">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Ingrese o regístrese</strong>
        </div>
    </div>';
    $error4 =
    '<div class="col-md-offset-3 col-md-6">
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>No se pudo registrar, nombre de usuario no disponible</strong>
        </div>
    </div>';
    $errorInsertar =
    '<div class="col-md-offset-3 col-md-6">
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>No se pudo registrar tu calificación</strong>
        </div>
    </div>';
    $success1 =
    '<div class="col-md-offset-2 col-md-8">
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Registrado correctamente, ahora solo ingresa con tu nombre de usuario y contraseña</strong>
        </div>
    </div>
    ';

?>