<?php
    /**
    * Esta clase va a gestionar las peliculas de nuestra BD.
    * Podrá listar todas las películas.
    * Podrá buscar películas según unos parámetros insertados.
    * Podrá Mostrar los detalles de una película concreta.
    * Podrá buscar la película con mayor nota de la BBDD.
    * Podrá devolver todos los géneros de la tabla de géneros.
    * Podra devolver todas las plataformas de la tabla plataformas.
    * Podrá devolver todas las productoras de la tabla productoras.
    * Podrá actualizar la nota de una película.
    * Podrá comprobar si una película ya existe en la BBDD. 
    * Podrá insertar una película nueva en la BBDD.
    * Podrá actualizar los datos de una película de la BBDD.
    * Podrá borrar una película de la BBDD.
    */
    class Pelicula{
        /**
        * Esta función va a devolver el listado completo de películas de la BBDD
        * ordenada por título.
        * @param object $pdo es un objeto que contiene una conexión a la BBDD.
        * @return array $peliculas es un array de objetos del tipo película.
        */
        public function listadoPeliculas($pdo){
            try{
                $sql = "SELECT p.id, p.titulo, p.poster, g.nombre as genero, p.anio, p.nota FROM pelicula p JOIN generos g 
                WHERE g.id=p.id_genero ORDER BY titulo";
                $consulta = $pdo->query($sql);
                // se comprueba que la consulta contiene más de 0 filas.
                if($consulta->rowCount()>0){
                    /* Mientras haya filas en la consulta vamos insertando
                    objetos en cada fila de un array */
                    while($fila = $consulta->fetchObject()){
                        $peliculas[] = $fila;
                    }
                    return $peliculas;
                }else return null;

            }catch (PDOException $e) {
                echo "Excepcion encontrada: ", $e->getMessage(), "\n";
                return null;
            }
        }

        /**
         * Esta función realiza la búsqueda de películas en la base de datos según los parámetros
         * que se le entreguen sobre su título, género, plataforma, criterio de orden y si ese orden es 
         * de mayor a menor o de menor a mayor (si es de título será alfabético).
         * @param object $pdo es un objeto que contiene una conexión a la BBDD.
         * @param string $titulo es el título de la película a buscar.
         * @param string $genero es el género a buscar.
         * @param string $plataforma es la plataforma digital a buscar.
         * @param string $orden es el criterio de orden por el que se ordenará (titulo, año, nota)
         * @param string $ordenapor nos dice si el orden del criterio es ascendente o descendente.
         * @return array $peliculas es un array de objetos del tipo película.
         */
        public function busquedaPeliculas($pdo, $titulo, $genero, $plataforma, $orden, $ordenapor){
            try{
                if($genero=="Todos"){
                    if($plataforma=="Todas"){
                        $sql = "SELECT p.id, p.poster, p.titulo, p.anio,  g.nombre as genero, nota FROM pelicula p 
                        JOIN generos g WHERE g.id=p.id_genero AND p.titulo LIKE '$titulo%' ORDER BY $orden $ordenapor";                        
                    }else{
                        $sql = "SELECT  p.id,p.poster, p.titulo, p.anio,  g.nombre as genero, nota FROM pelicula p 
                        JOIN generos g WHERE g.id=p.id_genero AND p.$plataforma=1 AND p.titulo LIKE '$titulo%' ORDER BY $orden $ordenapor";      
                    }
                }else{
                    if($plataforma=="Todas"){
                        $sql = "SELECT p.id,p.poster, p.titulo, p.anio, p.id_genero, g.nombre as genero, nota FROM pelicula p 
                        JOIN generos g WHERE g.id=p.id_genero AND g.id=$genero AND p.titulo LIKE '$titulo%' ORDER BY $orden $ordenapor";  
                    }else{
                        $sql = "SELECT p.id,p.poster, p.titulo, p.anio, p.id_genero, g.nombre as genero, nota FROM pelicula p 
                        JOIN generos g WHERE g.id=p.id_genero AND g.id=$genero AND p.$plataforma=1 
                        AND p.titulo LIKE '$titulo%' ORDER BY $orden $ordenapor";
                    } 
                }
                $consulta = $pdo->query($sql);
                // se comprueba que la consulta contiene más de 0 filas.
                if($consulta->rowCount()>0){
                    /* Mientras haya filas en la consulta vamos insertando
                    objetos en cada fila de un array */
                    while($fila = $consulta->fetchObject()){
                        $peliculas[] = $fila;
                    }
                    return $peliculas;
                }else {
                    $peliculas = null;
                    return $peliculas;
                }
            }catch (PDOException $e) {
            echo "Excepcion encontrada: ", $e->getMessage(), "\n";
            return null;
            }
        }
       
        /**
         * Esta función va a devolver todos los detalles de una película de la BBDD.
         * @param object $pdo es un objeto que contiene una conexión a la BBDD.
         * @param int $id es el identificador de la película a buscar en la BBDD.
         * @return object $pelicula contiene todos los datos de la película.
         */
        public function detallesPelicula($pdo, $id){
            try{
                $sql = "SELECT p.id, p.titulo, p.anio, g.nombre as genero, p.nota,
                p.director, 
                p.guion, p.bandasonora, p.poster, pr.nombre as productora, p.sinopsis, p.duracion,
                p.disneyplus, p.netflix, p.amazonprime, p.appletv, p.hbomax, p.id_productora, p.id_genero,
                p.skyshowtime, p.googleplay, p.trailer FROM pelicula p
                JOIN generos g JOIN productoras pr WHERE g.id=p.id_genero 
                AND pr.id=p.id_productora AND p.id='$id'";
                $consulta = $pdo->query($sql);
                // se comprueba que la consulta contiene más de 0 filas.
                if($consulta->rowCount()>0){
                    // Guardamos en el objeto pelicula el objeto consulta 
                    $pelicula = $consulta->fetchObject();
                    return $pelicula;
                    }else return null;
            }catch (PDOException $e) {
                echo "Excepcion encontrada: ", $e->getMessage(), "\n";
                return null;
            }
        }

        /**
         * Esta función va a buscar la película con mayor nota de la BBDD.
         * @param object $pdo es un objeto que contiene una conexión a la BBDD.
         * @return object $pelicula contiene el id de la pelicula.
         */
        public function BuscaPeliculaMasNota($pdo){
            try{
                $sql = "SELECT id FROM pelicula WHERE nota = (SELECT MAX(nota) FROM pelicula)";
                $consulta = $pdo->query($sql);
                // se comprueba que la consulta contiene más de 0 filas.
                // si no hay películas en la base de datos esto no devuelve nada.
                if($consulta->rowCount()>0){
                    // Guardamos en el objeto pelicula el objeto consulta 
                    $id = $consulta->fetchObject();
                    return $id;
                    }else return null;
            }catch (PDOException $e) {
                echo "Excepcion encontrada: ", $e->getMessage(), "\n";
                return null;
            }
        }

        /**
         * Esta función nos devuelve la lista de géneros de
         * la tabla generos de la BBDD con su nombre e id.
         * @param object $pdo es un objeto que contiene una conexión a la BBDD.
         * @return array $generos contiene todos los géneros de la tabla géneros.
         */
        public function listadoGeneros($pdo){
            try{
                $sql = "SELECT id, nombre FROM generos ORDER BY nombre";
                $consulta = $pdo->query($sql);
                // se comprueba que la consulta contiene más de 0 filas.
                if($consulta->rowCount()>0){
                    /* Mientras haya filas en la consulta vamos insertando
                    objetos en cada fila de un array */
                    while($fila = $consulta->fetchObject()){
                        $generos[] = $fila;
                    }
                    return $generos;
                }else return null;
            }catch (PDOException $e) {
                echo "Excepcion encontrada: ", $e->getMessage(), "\n";
                return null;
            }
        }
        
        /**
         * Esta función nos devuelve la lista de plataformas de
         * la tabla plataformas de la BBDD con su nombre e id.
         * @param object $pdo es un objeto que contiene una conexión a la BBDD.
         * @return array $plataformas contiene todas las plataformas de la tabla plataformas.
         */
        public function listadoPlataformas($pdo){
            try{
                $sql = "SELECT id, nombre FROM plataformas ORDER BY nombre";
                $consulta = $pdo->query($sql);
                // se comprueba que la consulta contiene más de 0 filas.
                if($consulta->rowCount()>0){
                    /* Mientras haya filas en la consulta vamos insertando
                    objetos en cada fila de un array */
                    while($fila = $consulta->fetchObject()){
                        $plataformas[] = $fila;
                    }
                    return $plataformas;
                }else return null;
            }catch (PDOException $e) {
                echo "Excepcion encontrada: ", $e->getMessage(), "\n";
                return null;
            }   
        }

         /**
         * Esta función nos devuelve la lista de productoras de
         * la tabla productoras de la BBDD con su nombre e id.
         * @param object $pdo es un objeto que contiene una conexión a la BBDD.
         * @return array $productoras contiene todas las productoras de la tabla productoras.
         */
        public function listadoProductoras($pdo){
            try{
                $sql = "SELECT id, nombre FROM productoras ORDER BY nombre";
                $consulta = $pdo->query($sql);
                // se comprueba que la consulta contiene más de 0 filas.
                if($consulta->rowCount()>0){
                    /* Mientras haya filas en la consulta vamos insertando
                    objetos en cada fila de un array */
                    while($fila = $consulta->fetchObject()){
                        $productoras[] = $fila;
                    }
                    return $productoras;
                }else return null;
            }catch (PDOException $e) {
                echo "Excepcion encontrada: ", $e->getMessage(), "\n";
                return null;
            } 
        }
        
        /**
         * Esta funcíon actualiza la nota de una película.
         * @param object $pdo es un objeto que contiene una conexión a la BBDD.
         * @param float $nota es la nota que se va poner a la película
         * @param int $id_pelicula es el identificador único de la película en la BBDD.
         * @return boolean Si se ha actualizado con éxito devuelve true.
         */
        public function actualizaNotaPelicula($pdo, $nota, $id_pelicula){
            try{
                $sql = "UPDATE pelicula SET nota ='$nota' WHERE id='$id_pelicula'";
                $consulta = $pdo->query($sql);
                // se comprueba que la consulta contiene más de 0 filas.
                if($consulta->rowCount()>0){
                    return true;
                }else return null;
            }catch (PDOException $e) {
                echo "Excepcion encontrada: ", $e->getMessage(), "\n";
                return null;
            }
        }
        
        /**
         * Esta función va a comprobar si una película ya existe en la BBDD.
         * @param object $pdo es un objeto que contiene una conexión a la BBDD.
         * @param string $titulo es el título de la película.
         * @param int $anio es el año de estreno de la película.
         * @param string $director es el nombre del director de la película.
         * @return boolean Si la película ya existe en la BBDD devuelve true.
         */
        public function compruebaPelicula($pdo, $titulo, $anio, $director){
            try{
                $sql = "SELECT * FROM pelicula WHERE titulo='$titulo' 
                AND anio=$anio AND director='$director'";
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
         * Esta función va a guardar una película nueva en la BBDD.
         * @param object $pdo es un objeto que contiene una conexión a la BBDD.
         * @param string $titulo es el título de la película.
         * @param int $anio es el año de estreno de la película.
         * @param int $duracion es la duración en minutos de la película.
         * @param string $director es el nombre del director de la película.
         * @param string $guion es el nombre del guionista de la película.
         * @param string $bandasonora es el nombre del compositor de la banda sonora.
         * @param int $idgenero es el identificador del género de la película.
         * @param int $idproductora es el identificador de la productora de la película.
         * @param string $sinopsis es una breve sinopsis de la película.
         * @param float $nota es la nota que se le inserta a la película.
         * @param int $netflix si es 1 es que está en esa plataforma, si es 0 no.
         * @param int $amazonprime si es 1 es que está en esa plataforma, si es 0 no.
         * @param int $appletv si es 1 es que está en esa plataforma, si es 0 no.
         * @param int $googleplay si es 1 es que está en esa plataforma, si es 0 no.
         * @param int $disneyplus si es 1 es que está en esa plataforma, si es 0 no.
         * @param int $hbomax si es 1 es que está en esa plataforma, si es 0 no.
         * @param int $skyshowtime si es 1 es que está en esa plataforma, si es 0 no.
         * @param object $poster contiene los datos de la imagen del poster.
         * @param string $trailer contiene el código del trailer en youtube
         * @return boolean Si se ha insertado con éxito devuelve true.
         */
        public function insertaPelicula($pdo, $titulo, $anio,
        $duracion, $director, $guion, $bandasonora, $idgenero, $idproductora,
        $sinopsis, $netflix, $amazonprime, $appletv, $googleplay,
        $disneyplus, $hbomax, $skyshowtime, $poster, $trailer){
            try{
                // Se crea la consulta para insertar los datos
                $pdo->beginTransaction();

                $sql = "INSERT INTO pelicula (titulo, anio, duracion, director,
                guion, bandasonora, id_genero, id_productora, sinopsis,nota,  netflix,
                amazonprime, appletv, googleplay, disneyplus, hbomax, skyshowtime, poster, trailer) 
                VALUES ('$titulo',$anio,$duracion,'$director','$guion',
                '$bandasonora','$idgenero','$idproductora', 
                '$sinopsis',-1, $netflix, $amazonprime, $appletv, $googleplay,
                $disneyplus, $hbomax, $skyshowtime, 
                '$poster', 'https://www.youtube-nocookie.com/embed/$trailer')";

                $consulta = $pdo->prepare($sql);
                if($consulta->execute()){
                    $pdo->commit();
                    return true;
                }else{
                    $pdo->rollback();
                    return false;
                }
            }catch (PDOException $e) {
                echo "Excepcion encontrada: ", $e->getMessage(), "\n";
                return null;
            }
        }
        
        /**
         * Esta función va a actualizar una pelicula en la BBDD.
         * @param object $pdo es un objeto que contiene una conexión a la BBDD.
         * @param string $titulo es el título de la película.
         * @param int $anio es el año de estreno de la película.
         * @param int $duracion es la duración en minutos de la película.
         * @param string $director es el nombre del director de la película.
         * @param string $guion es el nombre del guionista de la película.
         * @param string $bandasonora es el nombre del compositor de la banda sonora.
         * @param int $idgenero es el identificador del género de la película.
         * @param int $idproductora es el identificador de la productora de la película.
         * @param string $sinopsis es una breve sinopsis de la película.
         * @param float $nota es la nota que se le inserta a la película.
         * @param int $netflix si es 1 es que está en esa plataforma, si es 0 no.
         * @param int $amazonprime si es 1 es que está en esa plataforma, si es 0 no.
         * @param int $appletv si es 1 es que está en esa plataforma, si es 0 no.
         * @param int $googleplay si es 1 es que está en esa plataforma, si es 0 no.
         * @param int $disneyplus si es 1 es que está en esa plataforma, si es 0 no.
         * @param int $hbomax si es 1 es que está en esa plataforma, si es 0 no.
         * @param int $skyshowtime si es 1 es que está en esa plataforma, si es 0 no.
         * @param object $poster contiene los datos de la imagen del poster.
         * @param string $trailer contiene el código del trailer en youtube
         * @param int $id es el id de la película.
         * @return boolean Si se ha insertado con éxito devuelve true.
         */
        public function actualizaPelicula($pdo, $titulo, $anio,
        $duracion, $director, $guion, $bandasonora, $idgenero, $idproductora,
        $sinopsis, $netflix, $amazonprime, $appletv, $googleplay,
        $disneyplus, $hbomax, $skyshowtime, $poster, $trailer, $id){
            try{
                $pdo->beginTransaction();
                /* Dependiendo de si hemos insertado poster o no se hace un update u otro. Puede que no queramos 
                cambiar el poster y así no obligamos al administrador a insertarlo cada vez.*/
                if($poster==null){
                    $sql = "UPDATE pelicula SET titulo='$titulo', anio=$anio, duracion=$duracion, director='$director',
                    guion='$guion', bandasonora='$bandasonora', id_genero=$idgenero, id_productora=$idproductora,
                    sinopsis='$sinopsis', netflix=$netflix, amazonprime=$amazonprime, appletv=$appletv,
                    googleplay=$googleplay, disneyplus=$disneyplus, hbomax=$hbomax, skyshowtime=$skyshowtime,
                    trailer='https://www.youtube-nocookie.com/embed/$trailer' WHERE id='$id'";
                }else{
                    $sql = "UPDATE pelicula SET titulo='$titulo', anio=$anio, duracion=$duracion, director='$director',
                    guion='$guion', bandasonora='$bandasonora', id_genero=$idgenero, id_productora=$idproductora,
                    sinopsis='$sinopsis', netflix=$netflix, amazonprime=$amazonprime, appletv=$appletv,
                    googleplay=$googleplay, disneyplus=$disneyplus, hbomax=$hbomax, skyshowtime=$skyshowtime,
                    poster='$poster', trailer='https://www.youtube-nocookie.com/embed/$trailer' WHERE id='$id'";
                }
                $consulta = $pdo->prepare($sql);
                if($consulta->execute()){
                    $pdo->commit();
                    return true;
                }else{
                    $pdo->rollback();
                    return false;
                }
            }catch (PDOException $e) {
                echo "Excepcion encontrada: ", $e->getMessage(), "\n";
                return null;
            }
        }

        /**
         * Esta función va a borrar una película de la BBDD.
         * @param object $pdo es un objeto que contiene una conexión a la BBDD.
         * @param int $id es el id de la película en la BBDD.
         * @return boolean Si se ha borrado con éxito devuelve true.
         */
        public function BorraPelicula($pdo, $id){
            try{
                $pdo->beginTransaction();
                $sql = "DELETE FROM pelicula WHERE id='$id'";
                $consulta = $pdo->prepare($sql);
                if($consulta->execute()){
                    $pdo->commit();
                    return true;
                }else{
                    $pdo->rollback();
                    return false;
                }
            }catch (PDOException $e) {
                echo "Excepcion encontrada: ", $e->getMessage(), "\n";
                return null;
            }
        }
}
?>