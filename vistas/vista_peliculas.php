<div id="contenedor_peliculas">
    <div id="cabezapeliculas">
        <h2>Buscador de películas</h2>
    </div>
    <div id="formupeliculas">
        <form id="formulario" action="peliculas" method="get">
        <fieldset>
            <input class="entrada" type="text" name="titulo" id="titulo" placeholder="Título" value="<?php echo $titulo;?>"/>
            <select class="entrada" name="genero" id="genero">
                <option value="Todos">Generos</option>
                <?php foreach($generos as $gen){   
                    // Se pregunta si el género ya estaba pasado por get y se deja seleccionado
                    if($gener!="" && $gen->id==$gener){
                        echo "<option value=". $gen->id." selected>".$gen->nombre."</option>";                                
                    }else echo "<option value=". $gen->id.">".$gen->nombre."</option>";      
                }?>
            </select>
            <select class="entrada" name="plataforma" id="plataforma">
                <option value="Todas">Plataformas</option>
                <?php foreach($plataformas as $plataforma){  
                    // Se pregunta si la plataforma ya estaba pasada por get y se deja seleccionada                   
                    if($plataform!="" && $plataforma->nombre==$plataform){
                        echo "<option value=". $plataforma->nombre." selected>".$plataforma->nombre."</option>";                                   
                    }else echo "<option value=". $plataforma->nombre.">".$plataforma->nombre."</option>";                                   
                }?>
            </select>
      
            <label for="ordena">Ordenar por:</label>
            <select class="entrada" name="ordena" id="ordena">
                <option value="titulo"<?php if($ordena=="titulo")echo "selected";?>>Titulo</option>
                <option value="anio"<?php if($ordena=="anio")echo "selected";?>>Año</option>
                <option value="nota"<?php if($ordena=="nota")echo "selected";?>>Nota</option>
            </select>
            <select  class="entrada" name="ordenapor" id="ordenapor">
                <option value="ASC"<?php if($ordenapor=="ASC")echo "selected";?>>Ascendente</option>
                <option value="DESC"<?php if($ordenapor=="DESC")echo "selected";?>>Descendente</option> 
            </select>
            <input type="submit" class ="boton" name="enviado" value="Buscar"/>
        </form>
        </fieldset>
    </div>   
    <div class="infopelicula">
        <?php if($peliculas!=null){
                foreach ($peliculas as $pelicula){
                    ?>
                    <div class='tarjeta'>
                        <img  height= "242" src="data:image/jpg;base64,<?= base64_encode($pelicula->poster) ?>"/>
                        <div class="tarjeta_cuerpo">
                            <p class="tarjeta_titulo"> <?php echo $pelicula->titulo ?></p> 
                            <p class="tarjeta_anio">Año: <?php echo $pelicula->anio?></p>
                            <p class="tarjeta_genero">Género: <?php echo $pelicula->genero?></p>
                            <?php
                            if($pelicula->nota==-1){
                                echo  "<p class='tarjeta_nota'>Nota: N/P</p>" ;
                            }else echo "<p class='tarjeta_nota'>Nota: " . $pelicula->nota . "</p>";?>
                            <?php echo "<a href='http://localhost/CINETECA/index.php/pelicula?id=$pelicula->id'>Ver ficha</a>"?> 
                        </div>
                    </div>
                <?php        
                }
            } else echo "No hay películas que coincidan con la búsqueda.";
            ?>           
    </div>        
</div>