<?php
    /**
     * Esta clase va a gestionar las críticas de las películas de nuestra BD.
     * Podrá listar todas las críticas.
     * Podrá verificar si un usuario ya ha criticado una película.
     * Recoger la media de las notas que recibe una misma película en sus criticas.
     * Podrá insertar una nueva crítica (al hacer esto tendremos que actualizar
     * la nota media de una película con su correspondiente función).
     * Podrá comprobar si una película concreta tiene críticas o no en la BBDD.
     */
    class Critica{         
        /**
         * Esta función recoge todas las críticas de una película según su id.
         * @param object $pdo es un objeto con conexión a BBDD con PDO.
         * @param int $id_pelicula es el identificador de la película en la BBDD.
         * @return array $criticas es un array de objetos con las críticas de la película.
         */
        public function listadoCriticas($pdo, $id_pelicula){
            try{
                $sql = "SELECT c.texto, c.nota , c.id_pelicula, u.nombre FROM critica c
                JOIN usuario u WHERE u.id=c.id_usuario AND id_pelicula='$id_pelicula' ORDER BY c.nota DESC";
                $consulta = $pdo->query($sql);
                // se comprueba que la consulta contiene más de 0 filas.
                if($consulta->rowCount()>0){
                    /* Mientras haya filas en la consulta vamos insertando
                    objetos en cada fila de un array */
                    while($fila = $consulta->fetchObject()){
                        $criticas[] = $fila;
                    }
                    return $criticas;
                }else return null;
            }catch (PDOException $e) {
                echo "Excepcion encontrada: ", $e->getMessage(), "\n";
                return null;
            }
        }

        /**
         * Esta función recoge los datos de una crítica para guardarlos en la BBDD.
         * @param object $pdo es un objeto con conexión a BBDD con PDO.
         * @param int $id_pelicula es el identificador de la película en la BBDD.
         * @param string $texto es el texto de la crítica del usuario.
         * @param float $nota es la nota que otorga el usuario.
         * @param int $id_usuario es el identificador del usuario que escribe la crítica.
         * @return string $mensajeCritica nos indica si se ha insterado la crítica correctamente.
         */
        public function insertarCritica($pdo, $texto, $nota, $id_usuario, $id_pelicula){
            try{
                    $sql =  "INSERT INTO critica (texto, nota, id_usuario, id_pelicula) 
                    VALUES ('$texto',$nota,$id_usuario,$id_pelicula)";
                    if($pdo->query($sql)){
                        /* Si se ha podido criticar se guarda el mensaje */
                        $mensajeCritica = "Gracias por aportar!";
                        return $mensajeCritica;
                        }
            }catch (PDOException $e) {
                echo "Excepcion encontrada: ", $e->getMessage(), "\n";
                return null;
            }
        }

        /**
         * Esta función va a comprobar si existe en la BBDD una crítica con un id_usuario
         * y un id_pelicula concretos. Evitará que el mismo usuario critique dos veces la película.
         * @param object $pdo es un objeto con conexión a BBDD con PDO.
         * @param int $id_usuario es el identificador del usuario que escribe la crítica.
         * @param int $id_pelicula es el identificador de la película en la BBDD.
         * @return boolean Si es true la crítica ya existe.
         */
        public function compruebaCritica($pdo, $id_usuario, $id_pelicula){
            try{
                $sql = "SELECT * FROM critica WHERE id_pelicula='$id_pelicula' AND id_usuario='$id_usuario'";
                $consulta = $pdo->query($sql);
                // se comprueba que la consulta contiene más de 0 filas.
                if($consulta->rowCount()>0){
                    return true;
                    }else return false;
            }catch (PDOException $e) {
                echo "Excepcion encontrada: ", $e->getMessage(), "\n";
                return null;
            }
        }

        /**
         * Esta función va a realizar la nota media de una película.
         * @param object $pdo es un objeto con conexión a BBDD con PDO.
         * @param int $id_pelicula es el identificador de la película en la BBDD.
         * @return float $notaMedia es la nota media actual de la película en la BBDD.
         */
        public function recogeNotaMedia($pdo, $id_pelicula){
            try{
                // PRIMERO HACE LA MEDIA DE LAS NOTAS DE LAS CRITICAS DE ESA PELI.
                $sql1 = "SELECT AVG(nota) AS media FROM critica WHERE id_pelicula='$id_pelicula'";
                $consulta = $pdo->query($sql1);
                // se comprueba que la consulta contiene más de 0 filas.
                if($consulta->rowCount()>0){
                    // Guardamos en el objeto notaMedia el objeto consulta 
                    $notaMedia = $consulta->fetchObject();
                    $notaMedia = $notaMedia->media;
                    $notaMedia = (float)($notaMedia);
                    return $notaMedia;
                    }else return null;
            }catch (PDOException $e) {
                echo "Excepcion encontrada: ", $e->getMessage(), "\n";
                return null;
            }
        } 

        /**
         * Esta función va a comprobar si existe en la BBDD críticas con un id_película
         * @param object $pdo es un objeto con conexión a BBDD con PDO.
         * @param int $id_pelicula es el identificador de la película en la BBDD.
         * @return boolean Si es true la crítica ya existe.
         */
        public function compruebaExisteCritica($pdo, $id_pelicula){
            try{
                $sql = "SELECT * FROM critica WHERE id_pelicula='$id_pelicula'";
                $consulta = $pdo->query($sql);
                // se comprueba que la consulta contiene más de 0 filas.
                if($consulta->rowCount()>0){
                    return true;
                    }else return false;
            }catch (PDOException $e) {
                echo "Excepcion encontrada: ", $e->getMessage(), "\n";
                return null;
            }
        }
}   