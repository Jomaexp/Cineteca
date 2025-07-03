<div id="contenedor_inicio">
    <h2 class="banner_cabeza">Película más valorada</h2>
    <div class='banner'>                   
        <img   src="data:image/jpg;base64,<?= base64_encode($peliculaBanner->poster) ?>"/>
        <div class="banner_cuerpo">          
            <div class="banner_datos">
                <p class="banner_titulo"> <?php echo $peliculaBanner->titulo ?></p> 
                <p class="banner_anio">Año: <?php echo $peliculaBanner->anio?></p>
                <p class="banner_genero">Género: <?php echo $peliculaBanner->genero?></p>
                <?php
                    if($peliculaBanner->nota==-1){
                        echo  "<p class='banner_nota'>Nota: N/P</p>" ;
                    }else echo "<p class='banner_nota'>Nota: " . $peliculaBanner->nota . "</p>";?>
            </div>
            <div class="banner_sinopsis">
                <p ><?php echo $peliculaBanner->sinopsis?></p>
            </div>
            <div class="banner_enlace">
                <a href='http://localhost/CINETECA/index.php/pelicula?id=<?php echo $peliculaBanner->id?>'>Ver ficha</a>
            </div>
        </div>
    </div>
    <div class="inicio_tarjetas">
        <div class="inicio_tarjeta">
            <img src="../assets/tarjetasinicio/coleccion.jpg" ></img>
            <div class="inicio_tarjeta_cuerpo">
                <a href="http://localhost/CINETECA/index.php/peliculas"><p>Visita nuestra fantástica colección de películas y descubre dónde verlas!</p></a>
                </p>
            </div>
        </div>
        <div class="inicio_tarjeta">
            <img src="../assets/tarjetasinicio/critica.png" ></img>
            <div class="inicio_tarjeta_cuerpo">
            <a href="http://localhost/CINETECA/index.php/sobrenosotros"><p>Quieres conocer los inicios de Cineteca? Entra y conócenos un poco.</p></a>
            </div>
        </div>
        <div class="inicio_tarjeta">
            <img src="../assets/tarjetasinicio/usuario.png" ></img>
            <div class="inicio_tarjeta_cuerpo">
                <a href="http://localhost/CINETECA/index.php/registro"><p>Aún no estás registrado? Es gratis y te permite criticar y puntuar las películas!</p></a>
            </div>
        </div>
    </div>
</div>
