<?php
    /**
     * Esta clase va a gestionar la conexión a la base de datos.
     * Podrá conectar con la BBDD.
     */
    class Conexion{
        /**
         * Esta función crea la conexión con la base de datos cineteca.
         * @return object $pdo es el objeto que contiene la conexión a la BBDD. */        
        public function conexion()
        {
            $servidor = "localhost";
            $usuario = "josemaria";
            $clave = "Pepe@Reyes2023";
            $bd = "cineteca";
            try{
                /* Creamos la conexión PDO con el usuario josemaria
                en la base de datos cineteca, atendiendo a que todo se 
                procese con utf8 para evitar errores al escribir caracteres
                del castellano como la ñ.*/
                $cadenaConexion = "mysql:dbname=$bd;host=$servidor";
                $pdo = new PDO($cadenaConexion, $usuario, $clave,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                return $pdo;
            }catch (PDOException $e){
                return null;
            }
        }
    }
?>