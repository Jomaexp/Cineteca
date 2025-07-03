<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CINE-TECA</title>
    <?php
    /* almacenamos el navegador del usuario para buscar cadenas dentro de este y así
    diferenciar posteriormente si estamos usando uno u otro. Los estilos cambian en admin */
    $navegador_usuario = $_SERVER['HTTP_USER_AGENT'];
    $navega_chrome = strrpos($navegador_usuario, 'Chrome');
    $navega_edge = strrpos($navegador_usuario, 'Edg');
    $navega_firefox = strrpos($navegador_usuario, 'Firefox');
    $tipo_devuelto_chrome = gettype($navega_chrome);
 
    /* Vamos a comprobar el navegador desde el que estamos para que el menú admin no se rompa 
    Sabemos que se rompe en Edge y en Firefox (en opera va bien).
    Según si estamos en chrome o en otro navegador se usará el style o el style2. */
    if ($tipo_devuelto_chrome==='integer' && $navega_edge===false) {
        $navegador = 'Chrome';
        ?>
        <style>
            @import url("../estilos/style.css");
        </style>
        <?php 
    }else {
        $navegador= 'Firefox o Edge';
    ?>
        <style>
            @import url("../estilos/style2.css");
        </style>
    <?php
    } 
    ?>
    <!-- Se añade el script de sweetalert desde aquí porque se usa en varias páginas. -->
    <script src="../scriptsjs/sweetalert2.all.min.js"></script>
</head>
<body>
<?php // variable url para facilitar la escritura de las direcciones del menu
$url = "http://localhost/CINETECA/index.php";
?>
    <nav class="nav">
        <nav class="nav_contenedor">
            <a href="<?= $url .'/inicio'?>" class="logo_nombre">
                <img width="40" heigth="40" src="../assets/iconos/logo.svg" 
                    alt="logo cineteca" class="nav_img"></img>
                <h1 class="nav_logo">CineTeca</h1>
            </a>
            <label for="menu_check" class="nav_label">
                <img width="40" heigth="40" src="../assets/iconos/barrasnav.svg" 
                alt="menu icono" class="nav_img"></img>
            </label>
            <input type="checkbox" id="menu_check" class="nav_input">

            <div class="nav_menu">
                <div class="nav_enlaces">
                    <a <?php if($_SERVER['REQUEST_URI']=="/CINETECA/index.php/inicio") echo "id='nav_enlace_activo'";?>
                    class="nav_enlace" href="<?= $url .'/inicio'?>">Inicio</a>
                    <a <?php if($_SERVER['REQUEST_URI']=="/CINETECA/index.php/peliculas") echo "id='nav_enlace_activo'";?>
                    class="nav_enlace" href="<?= $url .'/peliculas'?>">Peliculas</a>
                    <?php 
                        /* Si está seteada la variable de sesión 'rol' y
                        esta tiene el valor 1, se muestra la opción Administrador en el menú de navegación. */
                        if(isset($_SESSION['rol']) && $_SESSION['rol']==1){
                            ?>
                            <a <?php if($_SERVER['REQUEST_URI']=="/CINETECA/index.php/admin") echo "id='nav_enlace_activo'";?>
                            class="nav_enlace" href="<?= $url .'/admin'?>">Admin</a>
                            <?php
                        }
                    ?>
                </div>
                <div class="nav_usuario">
                    <?php
                        /* Si no está seteada la variable de sesión usuario se muestra la opción "iniciar sesión"
                        en el menú de navegación. */
                        if(!isset($_SESSION['usuario'])){
                            ?>
                            <a <?php if($_SERVER['REQUEST_URI']=="/CINETECA/index.php/login") echo "id='nav_enlace_activo'";?>
                            class="nav_enlace" href="<?= $url .'/login'?>">iniciar sesion</a>
                            <?php
                        /* Si está seteada la variable de sesión usuario se muestra la opción "Cerrar sesión"
                        en el menú de navegación. */
                        }else if(isset($_SESSION['usuario'])){
                            ?>
                            <span><?php echo $_SESSION['usuario'];?> </span>
                            <a class="nav_enlace" href="<?= $url .'/logout'?>">Cerrar sesion</a>
                            <?php
                        }
                    ?>  
                </div>     
            </div>
        </nav>
    </nav> 