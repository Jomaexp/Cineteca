<?php

    /**
     * Esta clase va a gestionar los usuarios de nuestra BD.
     * Podrá crear un usuario nuevo.
     * Podrá verificar si un usuario ya existe.
     * Podrá consultar los datos de un usuario.
     * Podrá validar los datos de un usuario en la BBDD.
     */
    class Usuario{
    
        /**
         * Esta función va a comprobar si ya existe un usuario con el
         * mismo nombre que el que le pasamos por argumento.
         * @param object $pdo es un objeto con la conexión a la BBDD.
         * @param string $nombre es el nombre del usuario a comprobar.
         * @return boolean Si se ha encontrado un usuario con ese nombre devuelve true.
         */
        public function existeUsuario($pdo, $nombre){
            try{
                $sql = "SELECT * FROM usuario WHERE nombre='$nombre'";
                $consulta = $pdo->query($sql);
                if($consulta->rowCount()>0){
                    return true;
                }else return false;
            }catch (PDOException $e) {
                echo "Excepcion encontrada: ", $e->getMessage(), "\n";
                return null;
            }
        }

        /**
         * Esta función va a consultar los datos completos de un usuario.
         * @param object $pdo es un objeto con la conexión a la BBDD.
         * @param string $nombre es el nombre del usuario a comprobar.
         * @return object $resultado es un objeto con todos los datos del usuario.
         */
        public function consultaDatosUsuario($pdo, $nombre){
            try{
                $sql = "SELECT * FROM usuario WHERE nombre='$nombre'";
                $consulta = $pdo->query($sql);
                // Si la consulta tiene más de 0 filas.
                if($consulta->rowCount()>0){
                    $resultado = $consulta->fetchObject();
                    return $resultado;
                }else return null;
            }catch (PDOException $e) {
                echo "Excepcion encontrada: ", $e->getMessage(), "\n";
                return null;
            }
        }

        /**
         * Esta función va a comprobar que existe un usuario con un nombre y contraseña
         * concretos en la BBDD.
         * @param object $pdo es un objeto con la conexión a la BBDD.
         * @param string $nombre es el nombre del usuario a comprobar.
         * @param string $password es la contraseña a comprobar.
         * @return boolean Si existe un usuario con esas credenciales devuelve true.
         */
        public function validarDatosUsuario($pdo, $nombre, $password){
            try{
                $sql = "SELECT * FROM usuario WHERE nombre='$nombre' AND password='$password'";
                $consulta = $pdo->query($sql);
                // Si la consulta tiene más de 0 filas.
                if($consulta->rowCount()>0){
                    return true;
                }else return false;
            }catch (PDOException $e) {
                echo "Excepcion encontrada: ", $e->getMessage(), "\n";
                return null;
            }
        }

        /**
         * Esta función va a crear un nuevo usuario en la BBDD.
         * @param object $pdo es un objeto con la conexión a la BBDD.
         * @param string $nombre es el nombre del usuario a insertar.
         * @param string $password es la contraseña a insertar.
         * @return boolean Si se ha podido crear el usuario devuelve True.
         */
        public function insertaUsuario($pdo, $nombre, $password){
            try{
                $sql = "INSERT INTO usuario (nombre, password,id_rol)
                VALUES ('$nombre', '$password', 2)";
        
                if ($pdo->query($sql)) {
                    return true;
                }else{
                    return false;
                }
            }catch (PDOException $e) {
                echo "Excepcion encontrada: ", $e->getMessage(), "\n";
                return null;
            }
        }
    }
?>