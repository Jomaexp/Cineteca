<?php
    /**
     * Esta función se va a limitar a llamar a la vista inicio.
     * En esta se mostrará la película con mayor nota recuperando sus datos de la BBDD.
     */
    function cont_inicio(){
        // Requerimos los modelos película, crítica y conexión que serán necesarios.
        require_once "modelo/modelo_pelicula.php";
        require_once "modelo/modelo_conexion.php";

        //Se crea un objeto de clase conexión para conectar con la BBDD
        $objetoConexion = new Conexion();
        // Se crea la conexión a la base de datos.
        $conexion_bd = $objetoConexion->conexion();
        if($conexion_bd==null){
            echo("Conexión fallida con la base de datos");
        }   
        $objetoPelicula = new Pelicula();

        $idMasNota = $objetoPelicula->BuscaPeliculaMasNota($conexion_bd);
        $idMayor = $idMasNota->id;
        $peliculaBanner = $objetoPelicula->detallesPelicula($conexion_bd, $idMayor);

        // una vez tenemos los datos para la página desconectamos de la base de datos.
        $objetoConexion=null;
        $conexion_bd=null;
        // Finalmente requerimos la vista_inicio para mostrar todo lo que se ha procesado. 
        require_once "vistas/vista_inicio.php";
    }
?>