<?php /* NOTA IMPORTANTE: Esta linea de codigo debe de ir en todas las paginas
       * que esten ligadas al registro del formulario
       */ 
require_once $_SERVER["DOCUMENT_ROOT"].'/06-formRegister/config.ini.php';
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Proyecto de formulario de registro para web's</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <!-- html5 boilerplate Archivos -->
        <link rel="stylesheet" href="<?php echo BASEURL;?>public/css/normalize.css">
        <link rel="stylesheet" href="<?php echo BASEURL;?>public/css/main.css">        
        <script type="text/javascript" src="<?php echo BASEURL;?>public/js/modernizr.js"></script> 
        <!-- Style de las paginas : Aqui tu css style que quieras ponerle a la pagina -->        
        <link rel="stylesheet" type="text/css" href="<?php echo BASEURL;?>public/css/style.css">  
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div id="conten-all">
            <header>
                <h1>FormProyect by:<img src="<?php echo BASEURL;?>public/images/logo7.png" alt="Logo de desarrolladoresweb" title="Form Proyect by: DW"></h1>
            </header>
            <nav class="menu">
                <ul>
                    <li><a href="<?php echo BASEURL;?>">Home</a></li>
                    <li><a href="<?php echo BASEURL;?>application/views/register.php">Live Demo</a></li>
                    <li><a href="<?php echo BASEURL;?>application/views/login.php">Login</a></li>
                    <li><a href="#">Download</a></li>
                </ul>
            </nav>
        </div>    