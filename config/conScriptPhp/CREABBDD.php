<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea BD</title>
</head>
<body>
    <?php
    try {
        /* Hago la conexión PDO con el usuario root 
        que tiene todos los privilegios. */
        $cadenaConexion = "mysql:host=localhost";
        $usuario = "root";
        $clave = "";
        $bd = new PDO($cadenaConexion, $usuario, $clave,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") 
        );

        echo "Conexión establecida en localhost.<br><br>";

        $sql="CREATE USER 'josemaria'@'localhost' IDENTIFIED BY 'Pepe@Reyes2023';";

        if($bd->query($sql)){
            echo "Usuario josemaria de la bbddd creado con éxito.<br><br>";
            $sql="GRANT SELECT, INSERT, UPDATE, DELETE ON *.* TO 'josemaria'@'localhost';";
            if($bd->query($sql)){
                echo "Privilegios de select, insert, update y delete otorgados al usuario josemaria.<br><br>";
            }
        }
        /*Creo la base de datos cineclub con el set de caracteres
        utf8 spanish para poder usar español sin problemas.*/
        $sql = "CREATE DATABASE IF NOT EXISTS cineteca
            DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;";
        
        if ($bd->query($sql))
        {
            echo "Base de Datos cineteca creada con éxito.<br><br>";

            //Selecciono la base de datos cineclub para operar en ella.
		    $bd->query("use cineteca");

            /*Creamos la tabla "Rol" si esta no existe previamente.
              Si se crea correctamente o no se notifica por pantalla.*/
              $sql="CREATE TABLE IF NOT EXISTS rol (
                  id INTEGER NOT NULL AUTO_INCREMENT,
                  tipo VARCHAR(50) NOT NULL,
                  privilegios VARCHAR(300) NOT NULL,
                  PRIMARY KEY (id)
                  )";    

              if ($bd->query($sql))
              {
                  echo "Tabla Rol creada.<br><br>";
                  
                  /*Insertamos los datos iniciales de nuestra tabla "Rol".
                    Si todo va bien se notificará, si hay algún error también.*/
                  $sql1 = "INSERT INTO rol (tipo, privilegios) 
                  VALUES ('Administrador','Tiene todos los privilegios en la 
                  base de datos.')";
                  $sql2 = "INSERT INTO rol (tipo, privilegios) 
                  VALUES ('Usuario','Solo puede hacer criticas de peliculas
                  y buscar en la base de datos.')";                  
  
                  if ($bd->query($sql1) && $bd->query($sql2))
                      {
                          echo "Inserción realizada con éxito en tabla rol.<br><br>";
                      }
                      else echo "Error insertando datos en tabla rol.<br><br>";                 
              }
              else echo "Error creando tabla rol.<br><br>";

              /*Creamos la tabla "Generos" si esta no existe previamente.
              Si se crea correctamente o no se notifica por pantalla.*/
              $sql="CREATE TABLE IF NOT EXISTS generos (
                id INTEGER NOT NULL AUTO_INCREMENT,
                nombre VARCHAR(50) NOT NULL,
                PRIMARY KEY (id)
                )";    

            if ($bd->query($sql))
            {
                echo "Tabla generos creada.<br><br>";
                
                /*Insertamos los datos iniciales de nuestra tabla "Generos".
                  Si todo va bien se notificará, si hay algún error también.*/
                $sql1 = "INSERT INTO generos (nombre) 
                VALUES ('Ciencia-Ficcion')";
                $sql2 = "INSERT INTO generos (nombre) 
                VALUES ('Accion')";
                $sql3 = "INSERT INTO generos (nombre) 
                VALUES ('Drama')";
                $sql4 = "INSERT INTO generos (nombre) 
                VALUES ('Aventuras')";
                $sql5 = "INSERT INTO generos (nombre) 
                VALUES ('Superheroes')";
                $sql6 = "INSERT INTO generos (nombre) 
                VALUES ('Thriller')";
                $sql7 = "INSERT INTO generos (nombre) 
                VALUES ('Terror')";
                $sql8 = "INSERT INTO generos (nombre) 
                VALUES ('Musical')";
                $sql9 = "INSERT INTO generos (nombre) 
                VALUES ('Animacion')";  
                $sql10 = "INSERT INTO generos (nombre) 
                VALUES ('Comedia')";                                              

                if ($bd->query($sql1) && $bd->query($sql2) && $bd->query($sql3)
                && $bd->query($sql4)
                && $bd->query($sql5)
                && $bd->query($sql6)
                && $bd->query($sql7)
                && $bd->query($sql8)
                && $bd->query($sql9)
                && $bd->query($sql10))
                    {
                        echo "Inserción realizada con éxito en tabla generos.<br><br>";
                    }
                    else echo "Error insertando datos en tabla generos.<br><br>";                 
            }
            else echo "Error creando tabla generos.<br><br>";

              /*Creamos la tabla "Productoras" si esta no existe previamente.
              Si se crea correctamente o no se notifica por pantalla.*/
              $sql="CREATE TABLE IF NOT EXISTS productoras (
                id INTEGER NOT NULL AUTO_INCREMENT,
                nombre VARCHAR(50) NOT NULL,
                PRIMARY KEY (id)
                )";    

            if ($bd->query($sql))
            {
                echo "Tabla productora creada.<br><br>";
                
                /*Insertamos los datos iniciales de nuestra tabla "Productoras".
                  Si todo va bien se notificará, si hay algún error también.*/
                $sql1 = "INSERT INTO productoras (nombre) 
                VALUES ('Columbia')";
                $sql2 = "INSERT INTO productoras (nombre) 
                VALUES ('Orion')";
                $sql3 = "INSERT INTO productoras (nombre) 
                VALUES ('Fox')";
                $sql4 = "INSERT INTO productoras (nombre) 
                VALUES ('Disney')";
                $sql5 = "INSERT INTO productoras (nombre) 
                VALUES ('Tristar')";
                $sql6 = "INSERT INTO productoras (nombre) 
                VALUES ('Universal')";
                $sql7 = "INSERT INTO productoras (nombre) 
                VALUES ('Dreamworks')";
                $sql8 = "INSERT INTO productoras (nombre) 
                VALUES ('WarnerBros')";
                $sql9 = "INSERT INTO productoras (nombre) 
                VALUES ('Miramax')";
                $sql10 = "INSERT INTO productoras (nombre) 
                VALUES ('Sony')";
                $sql11 = "INSERT INTO productoras (nombre) 
                VALUES ('Metro')";
                $sql12 = "INSERT INTO productoras (nombre) 
                VALUES ('Netflix')";
                $sql13 = "INSERT INTO productoras (nombre) 
                VALUES ('Amazon')";
                $sql14 = "INSERT INTO productoras (nombre) 
                VALUES ('Touchstone')";
                $sql15 = "INSERT INTO productoras (nombre) 
                VALUES ('Paramount')";
                $sql16 = "INSERT INTO productoras (nombre) 
                VALUES ('NewLine')";
                $sql17 = "INSERT INTO productoras (nombre) 
                VALUES ('LionsGate')";                                          

                if ($bd->query($sql1) && $bd->query($sql2) && $bd->query($sql3)
                && $bd->query($sql4)
                && $bd->query($sql5)
                && $bd->query($sql6)
                && $bd->query($sql7)
                && $bd->query($sql8)
                && $bd->query($sql9)
                && $bd->query($sql10)
                && $bd->query($sql11)
                && $bd->query($sql12)
                && $bd->query($sql13)
                && $bd->query($sql14)
                && $bd->query($sql15)
                && $bd->query($sql16)
                && $bd->query($sql17))
                    {
                        echo "Inserción realizada con éxito en tabla productoras.<br><br>";
                    }
                    else echo "Error insertando datos en tabla productoras.<br><br>";                 
            }
            else echo "Error creando tabla productoras.<br><br>";


            /*Creamos la tabla "Plataformas" si esta no existe previamente.
              Si se crea correctamente o no se notifica por pantalla.*/
              $sql="CREATE TABLE IF NOT EXISTS plataformas (
                id INTEGER NOT NULL AUTO_INCREMENT,
                nombre VARCHAR(50) NOT NULL,
                PRIMARY KEY (id)
                )";    

            if ($bd->query($sql))
            {
                echo "Tabla plataformas creada.<br><br>";
                
                /*Insertamos los datos iniciales de nuestra tabla "Plataformas".
                  Si todo va bien se notificará, si hay algún error también.*/
                $sql1 = "INSERT INTO plataformas (nombre) 
                VALUES ('netflix')";
                $sql2 = "INSERT INTO plataformas (nombre) 
                VALUES ('amazonprime')";
                $sql3 = "INSERT INTO plataformas (nombre) 
                VALUES ('appletv')";
                $sql4 = "INSERT INTO plataformas (nombre) 
                VALUES ('googleplay')";
                $sql5 = "INSERT INTO plataformas (nombre) 
                VALUES ('disneyplus')";
                $sql6 = "INSERT INTO plataformas (nombre) 
                VALUES ('hbomax')";
                $sql7 = "INSERT INTO plataformas (nombre) 
                VALUES ('skyshowtime')";                            

                if ($bd->query($sql1) && $bd->query($sql2) && $bd->query($sql3)
                && $bd->query($sql4)
                && $bd->query($sql5)
                && $bd->query($sql6)
                && $bd->query($sql7))
                    {
                        echo "Inserción realizada con éxito en tabla Plataformas.<br><br>";
                    }
                    else echo "Error insertando datos en tabla Plataformas.<br><br>";                 
            }
            else echo "Error creando tabla Plataformas.<br><br>";
            //ESTO ES NUEVO
             /*Creamos la tabla "Usuario" si esta no existe previamente.
              Si se crea correctamente o no se notifica por pantalla.*/
              $sql="SET FOREIGN_KEY_CHECKS=0;
              CREATE TABLE IF NOT EXISTS usuario (
                  id INTEGER NOT NULL AUTO_INCREMENT,
                  nombre VARCHAR(50) NOT NULL,
                  password VARCHAR(255) NOT NULL,
                  id_rol INTEGER NOT NULL,
                  PRIMARY KEY (id),
                  FOREIGN KEY (id_rol) REFERENCES rol (id)
                  ON DELETE CASCADE
                  )";    

              if ($bd->query($sql))
              {
                  echo "Tabla usuario creada.<br><br>";
                  
                  /*Insertamos los datos iniciales de nuestra tabla "Usuario".
                    Si todo va bien se notificará, si hay algún error también.*/
                  $sql1 = "INSERT INTO usuario (nombre, password, id_rol) 
                  VALUES ('JMER1984','ciPRtU3xAgUTE',1)";
  
                  if ($bd->query($sql1))
                      {
                          echo "Inserción realizada con éxito en tabla usuario.<br><br>";
                      }
                      else echo "Error insertando datos en tabla usuario.<br><br>";                 
              }
              else echo "Error creando tabla Usuario.<br><br>";  
              
            /*Creamos la tabla "Pelicula" si esta no existe previamente.
              Si se crea correctamente o no se notifica por pantalla.*/
              $sql="CREATE TABLE IF NOT EXISTS pelicula (
				id INTEGER NOT NULL AUTO_INCREMENT,
				titulo VARCHAR(100) NOT NULL,
				anio INT(4) NOT NULL,
				duracion INT(3) NOT NULL,
                director VARCHAR(100) NOT NULL,
                guion VARCHAR(100) NOT NULL,
                bandasonora VARCHAR(100) NOT NULL,
                id_genero INTEGER NOT NULL,
                poster LONGBLOB,
                id_productora INTEGER NOT NULL,
                sinopsis VARCHAR(700) NOT NULL,
                nota FLOAT(3,1) NOT NULL,
                netflix BIT NOT NULL,
                amazonprime BIT NOT NULL,
                appletv BIT NOT NULL,
                googleplay BIT NOT NULL,
                disneyplus BIT NOT NULL,
                hbomax BIT NOT NULL,
                skyshowtime BIT NOT NULL,
                trailer VARCHAR(500) NOT NULL,
				PRIMARY KEY (id),
                FOREIGN KEY (id_genero) REFERENCES generos (id),
                FOREIGN KEY (id_productora) REFERENCES productoras (id)
				)";    
                
            if ($bd->query($sql))
            {
                echo "Tabla pelicula creada<br><br>";
                
                
            }else echo "Error creando tabla pelicula.<br><br>";

              /*Creamos la tabla "Critica" si esta no existe previamente.
              Si se crea correctamente o no se notifica por pantalla.*/
              $sql="SET FOREIGN_KEY_CHECKS=0;
              CREATE TABLE IF NOT EXISTS critica (
                  id INTEGER NOT NULL AUTO_INCREMENT,
                  texto VARCHAR(800) NOT NULL,
                  nota FLOAT(3,1) NOT NULL,
                  id_pelicula INTEGER NOT NULL,
                  id_usuario INTEGER NOT NULL,
                  PRIMARY KEY (id),
                  FOREIGN KEY (id_pelicula) REFERENCES pelicula (id)
                  ON DELETE CASCADE,
                  FOREIGN KEY (id_usuario) REFERENCES usuario (id)
                  ON DELETE CASCADE
                  )";    

              if ($bd->query($sql))
              {
                echo "Tabla critica creada.<br><br>";   
              }
              else echo "Error creando tabla critica.<br><br>";  
        }
        else echo "Error creando base de datos cineteca.<br><br>";
    }
    // Si hay alguna excepción en el try se capturará y se informará por pantalla.
	catch (PDOException $e) {
		echo 'Excepción capturada: ',  $e->getMessage();
	}
    ?>
    <br>
    <footer><h3>Creación de base de datos por José María Expósito Reyes 75160119Y</h3></footer>
</body>
</html>