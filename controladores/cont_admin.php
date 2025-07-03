<?php
    /**
     * Esta funcion va a controlar la sección de administrador.
     * Va a evitar que se pueda acceder a la sección mientras
     * que el usuario conectado no tegan rol 1 (administrador).
     * Va a permitir insertar una nueva película en la BBDD
     * siempre que esta no exista ya en la misma.
     * Va a permitir seleccionar una película de la BBDD.
     * Va a permitir actualizar los datos de la película seleccionada de la BBDD.
     * Va a permitir borrar la película seleccionada de la BBDD.
     * Finalmente llamará a la vista "vista_admin" para mostrar los datos.
     */
    function cont_admin(){
        /* Se controla que no acceda a la sección administrador nadie
         que no sea rol 1 (administrador). Si se intenta entrar por url 
         se le redirige por no tener permiso */
         if(!isset($_SESSION['usuario']) || (isset($_SESSION['rol']) && $_SESSION['rol']!=1)){
            header('location: /CINETECA/index.php/inicio');
        }
        /* Requerimos los modelos pelicula, critica y  conexión para 
        usar sus funciones. */
        require_once "modelo/modelo_pelicula.php";
        require_once "modelo/modelo_critica.php";
        require_once "modelo/modelo_conexion.php";
        //Se crea un objeto de clase conexión para conectar con la BBDD
        $objetoConexion = new Conexion();
        // Se crea la conexión a la base de datos.
        $conexion_bd = $objetoConexion->conexion();
        if($conexion_bd==null){
            echo("Conexión fallida con la base de datos");
        }   
        // Se crea un objeto de clase pelicula.
        $objetoPelicula = new Pelicula();
        /* Se crea una variable global mensaje para avisar al administrador
        del resultado del intento de insertar una nueva película. */
        $mensaje = "";
        
        /* inicializamos las variables necesarias para guardar
        los datos de la película */
        $titulo="";
        $anio="";
        $duracion="";
        $director="";
        $guion="";
        $bandasonora="";
        $genero="";
        $productora="";
        $sinopsis="";
        $netflix=0;
        $amazonprime=0;
        $appletv=0;
        $googleplay=0;
        $disneyplus=0;
        $hbomax=0;
        $skyshowtime=0;
        $poster="";
        $trailer="";
        $idpeli="";

        /* Se guardan en las variables generos y productoras el listado
        de las mismas para poder mostrarlo luego en un select. */
        $generos = $objetoPelicula->listadoGeneros($conexion_bd);
        $productoras = $objetoPelicula->listadoProductoras($conexion_bd);
        // Se llama al listado completo de películas para el select con el desplegable para editar y borrar
        $peliculas = $objetoPelicula->listadoPeliculas($conexion_bd);
        /* Se inicializan las variables que vamos a usar para almacenar los datos de una película que se
        seleccione de la lista desplegable. */
        $titulopeli = "";
        $aniopeli = "";
        $duracionpeli = "";
        $directorpeli = "";
        $guionpeli = "";
        $bandasonorapeli = "";
        $generopeli = "";
        $productorapeli = "";
        $sinopsispeli = "";
        $netflixpeli = "";
        $amazonprimepeli = "";
        $appletvpeli = "";
        $googleplaypeli = "";
        $disneypluspeli = "";
        $hbomaxpeli = "";
        $skyshowtimepeli = "";
        $posterpeli = "";
        $trailerpeli = "";   
        /* Si se pulsa en seleccionarpelicula se recogen los datos de esa película y se insertan en 
        las variables para tal uso, que son las que hemos inicializado justo antes. */ 
        if (isset($_POST['seleccionarpelicula'])) {
            $peliculaDatos = $objetoPelicula->detallesPelicula($conexion_bd, $_POST['listapelicula']);
            $titulopeli = $peliculaDatos->titulo;
            $aniopeli = $peliculaDatos->anio;
            $duracionpeli =$peliculaDatos->duracion;
            $directorpeli =$peliculaDatos->director;
            $guionpeli =$peliculaDatos->guion;
            $bandasonorapeli =$peliculaDatos->bandasonora;
            $generopeli =$peliculaDatos->id_genero;
            $productorapeli =$peliculaDatos->id_productora;
            $sinopsispeli = $peliculaDatos->sinopsis;
            $netflixpeli = $peliculaDatos->netflix;
            $amazonprimepeli = $peliculaDatos->amazonprime;
            $appletvpeli = $peliculaDatos->appletv;
            $googleplaypeli = $peliculaDatos->googleplay;
            $disneypluspeli = $peliculaDatos->disneyplus;
            $hbomaxpeli = $peliculaDatos->hbomax;
            $skyshowtimepeli = $peliculaDatos->skyshowtime;
            $posterpeli = $peliculaDatos->poster;
            $trailerpeli = substr($peliculaDatos->trailer, -11, 11);
            $idpeli = $peliculaDatos->id;
            $posterpeli = $peliculaDatos->poster;
        }

        // Se pregunta si se ha pulsado el botón de actualizar pelicula.
        if(isset($_POST['actualizarpelicula'])){
            /* se pregunta si ningún campo está vacío y si hemos pulsado al menos un checkbox de plataforma.
            Aquí el campo poster no se tiene en cuenta porque al ser un file, si se tiene en cuenta,
            el usuario tiene que insertarlo de nuevo aunque esté actualizando y eso no tiene sentido. */ 
            if (!empty($_POST['titulo']) && !empty($_POST['anio'])  && !empty($_POST['duracion'])
            && !empty($_POST['director']) && !empty($_POST['guion']) && !empty($_POST['bandasonora'])
            && !empty($_POST['genero']) && !empty($_POST['productora']) && !empty($_POST['sinopsis'])
            && !empty($_POST['trailer']) && !empty($_POST['id'])
            &&( 
            isset($_POST['netflix']) || isset($_POST['amazonprime']) || isset($_POST['appletv'])
            || isset($_POST['appletv']) || isset($_POST['googleplay']) || isset($_POST['disneyplus'])
            || isset($_POST['hbomax']) || isset($_POST['skyshowtime']))){
                /* Se comprueba el checkbox de cada plataforma
                y, si se ha marcado, se guarda en una variable
                el valor 1.*/
                if(isset($_POST['netflix'])){
                    $netflix=1;
                }
                if(isset($_POST['amazonprime'])){
                    $amazonprime=1;
                }
                if(isset($_POST['appletv'])){
                    $appletv=1;
                }           
                if(isset($_POST['googleplay'])){
                    $googleplay=1;
                }  
                if(isset($_POST['disneyplus'])){
                    $disneyplus=1;
                }  
                if(isset($_POST['hbomax'])){
                    $hbomax=1;
                }  
                if(isset($_POST['skyshowtime'])){
                    $skyshowtime=1;
                }

                $titulo= $_POST['titulo'];
                $anio= $_POST['anio'];
                $duracion= $_POST['duracion'];
                $director= $_POST['director'];
                $guion= $_POST['guion'];
                $bandasonora= $_POST['bandasonora'];
                $genero= $_POST['genero'];
                $productora= $_POST['productora'];
                $sinopsis= $_POST['sinopsis'];
                $trailer= $_POST['trailer'];
                if(empty($_FILES['poster']['name'])){
                    $poster = null;
                } else {
                    $poster= $_FILES['poster'];
                    $poster=addslashes(file_get_contents($poster['tmp_name']));  
                }
                $id = $_POST['id'];
            

                /* Si la película se actualiza se informa
                tanto si se ha realizado con éxito como si ha habido algún error. */
                if($objetoPelicula->actualizaPelicula($conexion_bd, $titulo, $anio,
                $duracion, $director, $guion, $bandasonora, $genero, $productora,
                $sinopsis, $netflix, $amazonprime, $appletv, $googleplay,
                $disneyplus, $hbomax, $skyshowtime,$poster, $trailer, $id )==true){

                $mensaje = "La película se ha actualizado correctamente en la base de datos.";
                ?>
                <script>
                    Swal.fire({
                    icon: 'success',
                    title: 'Película actualizada con éxito!',
                    text: 'Pulsa en OK',
                    }).then(() => {
                        location.replace('../index.php/admin');
                    });</script>
                    <?php
                    }else  $mensaje =  "Ha habido algún error";
                
            }else  $mensaje =  "Debe rellenar todos los campos y añadir al menos una plataforma.";  
        }

        // Se pregunta si se ha pulsado el botón de borrar pelicula.
        if(isset($_POST['borrarpelicula'])){
            // se pregunta si la variable POST id no está vacía
            if (!empty($_POST['id'])){
 
                $id = $_POST['id'];

                /* Si la película se borra de la base de datos se notifica sobre ello.*/
                if($objetoPelicula->BorraPelicula($conexion_bd, $id)==true){

                $mensaje = "La película se ha borrado de la base de datos.";
                ?>
                <script>
                    Swal.fire({
                    icon: 'success',
                    title: 'Película borrada de la base de datos!',
                    text: 'Pulsa en OK',
                    }).then(() => {
                        location.replace('../index.php/admin');
                    });</script>
                    <?php
                    }else  $mensaje =  "Ha habido algún error";
                
            }else  $mensaje =  "El id de película no puede estar vacío.";  
        }
        
        // Se pregunta si se ha pulsado el botón de añadir película.
        if(isset($_POST['aniadirpelicula'])){
            // se pregunta si ningún campo está vacío y si hemos pulsado al menos un checkbox de plataforma
            if (!empty($_POST['titulo']) && !empty($_POST['anio'])  && !empty($_POST['duracion'])
            && !empty($_POST['director']) && !empty($_POST['guion']) && !empty($_POST['bandasonora'])
            && !empty($_POST['genero']) && !empty($_POST['productora']) && !empty($_POST['sinopsis'])
            && !empty($_POST['trailer'])
            &&( 
            isset($_POST['netflix']) || isset($_POST['amazonprime']) || isset($_POST['appletv'])
            || isset($_POST['appletv']) || isset($_POST['googleplay']) || isset($_POST['disneyplus'])
            || isset($_POST['hbomax']) || isset($_POST['skyshowtime']))){
                /* Se comprueba el checkbox de cada plataforma
                y, si se ha marcado, se guarda en una variable
                el valor 1.*/
                if(isset($_POST['netflix'])){
                    $netflix=1;
                }
                if(isset($_POST['amazonprime'])){
                    $amazonprime=1;
                }
                if(isset($_POST['appletv'])){
                    $appletv=1;
                }           
                if(isset($_POST['googleplay'])){
                    $googleplay=1;
                }  
                if(isset($_POST['disneyplus'])){
                    $disneyplus=1;
                }  
                if(isset($_POST['hbomax'])){
                    $hbomax=1;
                }  
                if(isset($_POST['skyshowtime'])){
                    $skyshowtime=1;
                }

                $titulo= $_POST['titulo'];
                $anio= $_POST['anio'];
                $duracion= $_POST['duracion'];
                $director= $_POST['director'];
                $guion= $_POST['guion'];
                $bandasonora= $_POST['bandasonora'];
                $genero= $_POST['genero'];
                $productora= $_POST['productora'];
                $sinopsis= $_POST['sinopsis'];
                $trailer= $_POST['trailer'];
                /* con esta condicion evitamos que, si no metemos imagen, nos salte error php
                 sobre "path no puede ser empty". 
                 De hecho va a permitir insertar una película sin poster, pero como podemos actualizarla,
                 si eso pasa solo falta seleccionarla y ponérselo. */
                if(empty($_FILES['poster']['name'])){
                    $poster = null;
                } else {
                    $poster= $_FILES['poster'];
                    /* Ahora guardamos en la variable $poster el resultado de
                    realizar el conjunto de el directorio y nombre temporal
                    del fichero que se guardó al hacer $_FILES. */ 
                    $poster=addslashes(file_get_contents($poster['tmp_name']));  
                }

                // Ahora se comprueba si la película ya existe en la base de datos y se informa.
                if($objetoPelicula->compruebaPelicula($conexion_bd, $titulo, $anio, $director)==true){
                    $mensaje = "La película ya existe en la base de datos"; 
                    ?>                           
                    <script> 
                        Swal.fire({
                        icon: 'error',
                        title: 'Advertencia',
                        background:  '#004000',
                        text: 'La película que intentas añadir ya existe en la base de datos.',
                        }).then(() => {
                            location.replace('../index.php/admin');
                        });
                    </script>
                    <?php
                }else{
                    /* Si la película no existe en la base de datos se inserta y se informa
                    tanto si se ha realizado con éxito como si ha habido algún error. */
                    if($objetoPelicula->insertaPelicula($conexion_bd, $titulo, $anio,
                    $duracion, $director, $guion, $bandasonora, $genero, $productora,
                    $sinopsis, $netflix, $amazonprime, $appletv, $googleplay,
                    $disneyplus, $hbomax, $skyshowtime,$poster, $trailer)==true){

                        $mensaje = "La película se ha añadido correctamente a la base de datos.";
                        ?>
                        <script>
                            Swal.fire({
                            icon: 'success',
                            title: 'Película añadida con éxito!',
                            text: 'Pulsa en OK',
                            }).then(() => {
                                location.replace('../index.php/admin');
                            });</script>
                    <?php
                    }else  $mensaje =  "Ha habido algún error";
                } 
            }else  $mensaje =  "Debe rellenar todos los campos y añadir al menos una plataforma.";  
        }   
        // una vez tenemos los datos para la página desconectamos de la base de datos.
        $objetoConexion=null;
        $conexion_bd=null;
        // Finalmente requerimos la vista_admin para mostrar todo lo que se ha procesado. 
        require_once "vistas/vista_admin.php";
    }
?>