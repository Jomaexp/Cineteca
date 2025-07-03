<div id="contenido_admin">   
    <div id="nuevapelicula"> 
        <form class="formu" action="admin" method="post" enctype="multipart/form-data">
            <legend id="cabezaadmin">Datos de la película</legend>
                <div id="izqpeliadmin">        
                    <input title="Título de la película"  class="entrada" type="text" name="titulo" placeholder="Titulo de la película" 
                        id="titulo" <?php if($titulopeli!="") echo "value='$titulopeli'";?> />                                                                                                              
                    <input title="Año de estreno de la película"  class="entrada" type="number" name="anio" placeholder="Año" 
                        id="anio"<?php if($aniopeli!="") echo "value='$aniopeli'" ?>/>
                    <input title="Duración en minutos de la película"  class="entrada" type="number" name="duracion" placeholder="Duración" 
                        id="duracion"<?php if($duracionpeli!="") echo "value='$duracionpeli'" ?>/>
                    <input title="Director de la película" class="entrada" type="text" name="director" placeholder="Director" 
                        id="director"<?php if($directorpeli!="") echo "value='$directorpeli'" ?>/>
                    <input title="Guionista de la película" class="entrada" type="text" name="guion" placeholder="Guionista" 
                        id="guion"<?php if($guionpeli!="") echo "value='$guionpeli'" ?>/>
                    <input title="Banda sonora de la película"  class="entrada" type="text" name="bandasonora" placeholder="Banda Sonora" 
                        id="bandasonora"<?php if($bandasonorapeli!="") echo "value='$bandasonorapeli'" ?>/>
                    <select title="genero de la película" class="entrada" name="genero" id="genero">
                        <option value="">Género</option>
                        <?php foreach($generos as $genero){
                        if($generopeli!=""){
                            if ($genero->id == $generopeli){
                                echo "<option selected value=". $genero->id.">".$genero->nombre."</option>";
                            }else  echo "<option value=". $genero->id.">".$genero->nombre."</option>"; 
                        } else echo "<option value=". $genero->id.">".$genero->nombre."</option>";                                                                                                             
                        }?>
                    </select>
                    <input title="Pon el código que aparece en la url del vídeo de youtube tras el símbolo =" 
                    class="entrada" type="text" name="trailer" placeholder="Código trailer youtube" id="trailer"
                    <?php if($trailerpeli!="") echo "value='$trailerpeli'" ?>/>  
                        <select title="productora de la película" class="entrada" name="productora" id="productora">
                        <option value="">Productora</option>
                        <?php foreach($productoras as $productora){   
                            if($productorapeli!=""){
                                if ($productora->id == $productorapeli){
                                    echo "<option selected value=". $productora->id.">".$productora->nombre."</option>";
                                }else  echo "<option value=". $productora->id.">".$productora->nombre."</option>"; 
                            }else echo "<option value=". $productora->id.">".$productora->nombre."</option>";                                                 
                        }?>
                    </select>
                </div>
            <div id="dchapeliadmin">
            <!-- El siguiente input está oculto, es el campo id y se usará únicamente para poder recogerlo para el borrado -->
            <input class="entrada"  type="hidden" name="id" placeholder="Id de la película" 
                id="id" <?php if($idpeli!="") echo "value='$idpeli'" ?>/>
                    <!-- si este textarea lo parto en dos líneas no funciona bien -->
                    <textarea title="Sinopsis de la película" class="entrada" rows="6" name="sinopsis" placeholder="Sinopsis" id="sinopsisadmin"><?php if($sinopsispeli!="") echo $sinopsispeli;?></textarea>
                    <p class="entrada">Poster en formato jpg</p>
                        <input title="Inserta el poster en formato jpg" accept="image/jpeg" class="entrada" type="file" name="poster" id="poster"/>
                    <?php 
                if($posterpeli!=""){?>
                    <div id='posterdivadmin'>
                        <img alt="poster de la película" height= "165" src="data:image/jpg;base64,<?= base64_encode($posterpeli) ?>"/>
                    </div>
                <?php }else{?>
                    <div id='posterdivadmin'>
                        <img alt="no hay poster disponible" height= "165" src="../assets/imagenadmin/noposter.jpg"/>
                    </div>
                <?php } ?>
            </div>
            <div class="plataformastitul">
                <h3>Plataformas en emisión</h3>
            </div>         
            <div id="plataformasadmin">               
                <label for="netflix">Netflix:</label>
                <input class="entradacheck" type="checkbox" name="netflix" id="netflix"
                <?php if($netflixpeli==1)echo "checked"?>/>
                <label for="amazonprime">AmazonPrime:</label>
                <input class="entradacheck" type="checkbox" name="amazonprime" id="amazonprime"
                <?php if($amazonprimepeli==1)echo "checked"?>/>
                <label for="appletv">appletv:</label>
                <input class="entradacheck" type="checkbox" name="appletv" id="appletv"
                <?php if($appletvpeli==1)echo "checked"?>/>
                <label for="googleplay">googleplay:</label>
                <input class="entradacheck" type="checkbox" name="googleplay" id="googleplay"
                <?php if($googleplaypeli==1)echo "checked"?>/>
                <label for="disneyplus">disneyplus:</label>
                <input class="entradacheck" type="checkbox" name="disneyplus" id="disneyplus"
                <?php if($disneypluspeli==1)echo "checked"?>/>
                <label for="hbomax">hbomax:</label>
                <input class="entradacheck" type="checkbox" name="hbomax" id="hbomax"
                <?php if($hbomaxpeli==1)echo "checked"?>/>
                <label for="skyshowtime">skyshowtime:</label>
                <input class="entradacheck" type="checkbox" name="skyshowtime" id="skyshowtime"
                <?php if($skyshowtimepeli==1)echo "checked"?>/>
            </div>
            <input class="boton" type="submit" name="aniadirpelicula" value="Añadir película" />
            <div id="msg"><?php if($mensaje!="")echo $mensaje;?></div>    
            <strong>Listado de películas en la base de datos</strong> 
            <select  class="selectorpeli" name="listapelicula" id="listapelicula">
                <?php foreach($peliculas as $pelicula){   
                    echo "<option value=". $pelicula->id.">".$pelicula->titulo."</option>";                                                       
                }?>
            </select>
            <input class="boton2" type="submit" name="seleccionarpelicula" value="Seleccionar película"></input>
            <input class="boton2" type="submit" name="actualizarpelicula" value="Actualizar película"></input>   
            <input class="boton2" type="submit" name="borrarpelicula" value="Borrar película"></input>      
        </form>
    </div>
</div>