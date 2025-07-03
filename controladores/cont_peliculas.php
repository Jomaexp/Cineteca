<?php
    /**
     * Esta función va a mostrar el listado de películas en pantalla 
     * permitiendo, mediante un formulario, buscar  al mismo tiempo 
     * todas las películas de la base de datos que coincidan con los criterios
     * que incluyamos en el formulario de búsqueda.
     * Finalmente mostrará los datos resultantes en la vista "vista_peliculas"
     *  */
    function lista_peliculas(){

    // Requerimos los modelos película y conexión que serán necesarios.
    require_once "modelo/modelo_pelicula.php";
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

    /* Creamos las variables que se inicializan a cadena vacía.
     Estas van a contener los datos del formulario más adelante */
    $titulo="";
    $gener="";
    $plataform="";
    $ordena="";
    $ordenapor="";

    /* Controlamos si se había enviado datos por POST para guardarlos
    en variables para usar los datos cómodamente. */
    if(isset ($_GET['titulo'])){
        $titulo = $_GET['titulo'];
    }
    if(isset ($_GET['plataforma'])){
        $plataform = $_GET['plataforma'];
    }
    if(isset ($_GET['genero'])){
        $gener = $_GET['genero'];
    }
    if(isset ($_GET['ordena'])){
        $ordena = $_GET['ordena'];
    }
    if(isset ($_GET['ordenapor'])){
        $ordenapor = $_GET['ordenapor'];
    }
 
    /* Si se ha pulsado el botón del formulario con name "enviado" y se han seteado
    todos los campos, ya sean vacíos o por defecto. */
    if (isset($_GET['enviado']) && isset($_GET['plataforma']) && isset($_GET['genero'])
        && isset($_GET['titulo']) && isset($_GET['ordena'])&& isset($_GET['ordenapor']) ){

        /* Se guarda en el objeto $peliculas el resultado de la búsqueda con los datos
        que habíamos enviado por el formulario. */
        $peliculas = $objetoPelicula->busquedaPeliculas($conexion_bd, $_GET['titulo'], 
        $_GET['genero'], $_GET['plataforma'],$_GET['ordena'],$_GET['ordenapor']);
    
    /* Si no se ha pulsado el botón del formulario con name "enviado" se mostrará
    por defecto el listado completo de películas.*/
    }else{
        $peliculas = $objetoPelicula->listadoPeliculas($conexion_bd);
        
    }
    /* Para rellenar los select "generos" y "plataformas" usaremos variables
    que contengan la devolución de las funciones que los buscan en la BBDD en sus
    pertinentes tablas. */
    $generos = $objetoPelicula->listadoGeneros($conexion_bd);
    $plataformas = $objetoPelicula->listadoPlataformas($conexion_bd);

    // una vez tenemos los datos para la página desconectamos de la base de datos.
    $objetoConexion=null;
    $conexion_bd=null;
    // Finalmente requerimos la vista_peliculas para que todo se muestre según la misma.
    require_once "vistas/vista_peliculas.php";
}

    /**
     * Esta función va a mostrar los detalles de una película concreta y, 
     * también va a permitir guardar una nueva crítica si el usuario ha iniciado sesión
     * y no la ha criticado previamente, aparte de que haya rellenado el campo crítica y
     * el de nota correctamente.
     * Cada vez que opere mostrará los datos llamando a la vista "vista_pelicula"
     */
    function detalles_Pelicula($id){

        // Requerimos los modelos película, crítica y conexión que serán necesarios.
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

        /* Guradamos en las variables usuario y id_usuario sus datos
         para poder usarlos en las críticas */
        if(isset ($_SESSION['usuario'])){
            $usuario = $_SESSION['usuario'];
        }
        if(isset ($_SESSION['idusuario'])){
            $id_usuario = $_SESSION['idusuario'];
        }

        // Se crea un objeto de clase pelicula.
        $objetoPelicula = new Pelicula();
        
        //Guardamos en $peliculaDatos que contiene los detalles de la película.
        // para ser manipulados y, tras todo el proceso, recoger de nuevo
        // los datos ya actualizados en otra variable.
        $peliculaDatos = $objetoPelicula->detallesPelicula($conexion_bd, $id);

        // Declaramos variables globales que se van a usar para contener datos
        $critica="";
        $nota="";
        $mensajeCritica = "";
        // aquí guardamos el id de la película actual en una variable para poder usarlo
        $id_pelicula = $peliculaDatos->id;
        
        /* Controlamos si se había enviado datos por POST y se guardan
        en las variables correspondientes. */
        if(isset ($_POST['critica']) && isset ($_POST['nota'])){
            $critica = $_POST['critica'];
            $nota = $_POST['nota'];
        }
            
        // Se crea un objeto de clase critica.
        $objetoCritica = new Critica();
             
        /* Comprobamos si se habían recibido críticas y se actualiza la nota media
        de la película justo al cargar la página para mostrar los datos actuales. */
        $tiene_criticas = $objetoCritica->compruebaExisteCritica($conexion_bd, $id_pelicula); 
        if($tiene_criticas!=false){
            $notaMedia = $objetoCritica->recogeNotaMedia($conexion_bd, $id_pelicula);
            $objetoPelicula->actualizaNotaPelicula($conexion_bd, $notaMedia, $id_pelicula);
        }
        
        /* Si se ha enviado la crítica se va a ir comprobando 
        Si se han rellenado los dos campos
        Si la variable de sesión 'usuario' está seteada
        Si el usuario de la base de datos ya había criticado o no esa película.
        Dependiendo del caso se guardará en la variable $mensajeCritica un mensaje y,
        de ser necesario, se insertará la crítica en la base de datos y se actualizará
        su nota media. */
        if(isset($_POST['criticaenviada'])){
            /* insertamos en una variable la longitud del string $critica
            Esto se hace con mb_strlen porque captura correctamente acentos y el caracter "ñ". 
            La función strlen daba problemas con esos caracteres porque los cuenta dobles.*/
            $critica_caracteres = mb_strlen($critica);
            /* si la crítica no está vacía y es inferior o igual a 800 caracteres y la nota no está vacía
            y está entre 0 y 10 entonces ya se comprueba si el usuario ha criticado o no la película.
            Si lo ha hecho se da un mensaje anunciando esto. Si no lo ha hecho se insertará su crítica.*/
            if($critica!="" && $nota!="" && $critica_caracteres<=800 && $nota>=0 && $nota<=10){
                if(isset($_SESSION['usuario'])){
                    if($objetoCritica->compruebaCritica($conexion_bd, $id_usuario, $id_pelicula)){
                        $mensajeCritica = "El usuario ya ha criticado la película";
                        ?> 
                        <script> 
                            Swal.fire({
                            icon: 'error',
                            title: 'Lo sentimos',
                            text: 'Usted ya ha criticado la película',
                            }).then(() => {
                                    location.replace('../index.php/pelicula?id=<?php echo$id_pelicula?>');
                                });</script>
                        </script>
                <?php   
                    }else{
                    $mensajeCritica = $objetoCritica->insertarCritica($conexion_bd, $critica, $nota, $id_usuario, $id_pelicula); 
                    // ahora se comprueba la nueva nota media y se actualiza la nota de pelicula.
                    $tiene_criticas = $objetoCritica->compruebaExisteCritica($conexion_bd, $id_pelicula); 
                    if($tiene_criticas!=false){
                        $notaMedia = $objetoCritica->recogeNotaMedia($conexion_bd, $id_pelicula);
                        $objetoPelicula->actualizaNotaPelicula($conexion_bd, $notaMedia, $id_pelicula);
                        ?>
                            <script>
                                Swal.fire({
                                icon: 'success',
                                title: 'Su crítica ha sido almacenada!',
                                text: 'Pulse en OK para continuar',
                                }).then(() => {
                                    location.replace('../index.php/pelicula?id=<?php echo$id_pelicula?>');
                                });</script>
                        <?php
                    }
                    } 
                }else {
                    $mensajeCritica = "Ha de iniciar sesión para comentar.";
                    ?> 
                        <script> 
                            Swal.fire({
                            icon: 'error',
                            title: 'Lo sentimos',
                            text: 'Ha de iniciar sesión para poder criticar películas',
                            footer: '<a class="enlace_alerta" href="../index.php/registro">Si quiere registrarse pulse aquí</a>',
                            }).then(() => {
                                location.replace('../index.php/pelicula?id=<?php echo$id_pelicula?>');
                            });
                        </script>
                <?php   
                }
            }else{
                $mensajeCritica = "Por favor rellene todos los campos. La crítica no puede tener más de 800 caracteres y la nota debe estar entre 0 y 10 con un decimal si lo desea.";
            } 
        }                  

        // Guardamos en $criticas el listado de criticas de esa película.
        // Esto se hace para que al recargar ya se vea la crítica del usuario.
        $criticas = $objetoCritica->listadoCriticas($conexion_bd, $id);
            
        /* Ahora se devuelven en la variable $pelicula los datos de la película ya actualizados.
        Esto es importante porque se va a ver reflejado el cambio de nota media al momento de 
        que el usuario puntúe la película. */
        $pelicula = $objetoPelicula->detallesPelicula($conexion_bd, $id);

        // una vez tenemos los datos para la página desconectamos de la base de datos.
        $objetoConexion=null;
        $conexion_bd=null;
        // Finalmente requerimos la vista_pelicula para mostrar todo lo que se ha procesado.    
        require_once "vistas/vista_pelicula.php";
    }
?>