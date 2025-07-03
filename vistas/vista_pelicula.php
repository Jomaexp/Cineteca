    <div id="contenedor_pelicula">
        <!-- VAMOS A MAQUETAR CON DIVS PARA HACER DOS COLUMNAS IZQ Y DCHA 
        Llegado a las críticas, vamos a dejar de tener columnas -->
        <div id="fila1">
            <div id="izq">
                <div id='posterdiv'>
                    <img height="242" src="data:image/jpg;base64,<?= base64_encode($pelicula->poster) ?>" />
                </div>
                <div id='titulodiv'>
                    <table id="titul">
                        <tr>
                            <td><?php echo $pelicula->titulo ?></td>
                        </tr>
                        <tr>
                            <?php if ($pelicula->nota == -1) {
                                echo "<td>No puntuada</td>";
                            } else {
                                echo "<td>Nota:  " . $pelicula->nota . "</td>";
                            } ?>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="dcha">
                <div id="detalles">
                    <table>
                        <tr>
                            <th>Año</th>
                            <th>Género</th>
                            <th>Duración</th>
                        </tr>
                        <tr>
                            <td><?php echo $pelicula->anio ?></td>
                            <td><?php echo $pelicula->genero ?></td>
                            <td><?php echo $pelicula->duracion ?> min</td>
                        </tr>
                    </table>
                    <br>
                    <table>
                        <tr>
                            <th>Director</th>
                            <th>Guion</th>
                        </tr>
                        <tr>
                            <td><?php echo $pelicula->director ?></td>
                            <td><?php echo $pelicula->guion ?></td>
                        </tr>
                    </table>
                    <br>
                    <table>
                        <tr>
                            <th>Banda Sonora</th>
                            <th>Productora</th>
                        </tr>
                        <tr>
                            <td><?php echo $pelicula->bandasonora ?></td>
                            <td><?php echo $pelicula->productora ?></td>
                        </tr>
                    </table>
                </div>
            </div> <!--aqui cierra dcha-->
        </div> <!--aqui cierra la fila primera-->
        <div id="sinopsis">
            <table>
                <tr>
                    <th>Sinopsis</th>
                </tr>
                <tr>
                    <td><?php echo $pelicula->sinopsis ?></td>
                </tr>
            </table>
        </div>
        <!--aqui iniciamos fila2-->
        <div id="fila2">
            <div id="izq2">
                <div id="plataformas">Plataformas que la emiten
                    <table>
                        <tr>
                            <?php
                            if ($pelicula->netflix == 1) {
                                echo "<td><a href='https://www.netflix.com/es/' target='_blank'><img width='70' height='70' src='../assets/plataformas/netflix.png'></img></a></td>";
                            }
                            if ($pelicula->disneyplus == 1) {
                                echo "<td><a href='https://www.disneyplus.com/es-es/home' target='_blank'><img width='70' height='70' src='../assets/plataformas/disneyplus.png'></img></a></td>";
                            }
                            if ($pelicula->amazonprime == 1) {
                                echo "<td><a href='https://www.primevideo.com/offers/nonprimehomepage/ref=atv_nb_lcl_es_ES?ie=UTF8' target='_blank'><img width='70' height='70' src='../assets/plataformas/amazonprime.png'></img></a></td>";
                            }
                            if ($pelicula->appletv == 1) {
                                echo "<td><a href='https://www.apple.com/es/apple-tv-plus/' target='_blank'><img width='70' height='70' src='../assets/plataformas/appletv.png'></img></a></td>";
                            }
                            if ($pelicula->googleplay == 1) {
                                echo "<td><a href='https://play.google.com/store/movies?gl=us&pli=1' target='_blank'><img width='70' height='70' src='../assets/plataformas/googleplay.png'></img></a></td>";
                            }
                            if ($pelicula->hbomax == 1) {
                                echo "<td><a href='https://www.hbomax.com/es/es' target='_blank'><img width='70' height='70' src='../assets/plataformas/hbomax.png'></img></a></td>";
                            }
                            if ($pelicula->skyshowtime == 1) {
                                echo "<td><a href='https://www.skyshowtime.com/es' target='_blank'><img width='70' height='70' src='../assets/plataformas/skyshowtime.png'></img></a></td>";
                            } ?>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="dcha2">
                <div id='trailerdiv'>
                    <table id='trailer'>
                        <tr>
                            <th>Trailer</th>
                        </tr>
                        <tr>
                            <td>
                                <iframe width="350" height="195" src="<?php echo $pelicula->trailer; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div><!-- aqui cierra fila2-->
        <?php
        /* Si el controlador devuelve críticas vamos a insertarlas en 
        una tabla para presentarlas en este formato. */
        if ($criticas != null) {
            echo ("<div id='criticas'><table><tr>
                    <th>Critica</th>
                    <th>Nota</th>
                    <th>Usuario</th>
                    </tr>");
            foreach ($criticas as $critica) {
                echo "<tr>";
                echo "<td>" . $critica->texto . "</td>"
                    . "<td>" . $critica->nota . "</td>"
                    . "<td>" . $critica->nombre . "</td>";
                echo "</tr>";
            }
            echo "</table></div>";
        }
        ?>
        <div id="nuevacritica">Critica la película y ponle nota!
            <form id="formulario" action="pelicula?id=<?php echo $pelicula->id ?>" method="post" onsubmit="return validar();">
                <textarea cols="40" rows="5" name="critica" class="entrada" id="critica" placeholder="Inserte aquí su crítica" resizable="no"></textarea>
                <div id="msgcritica"><?php
                    if ($mensajeCritica != "") echo $mensajeCritica; ?></div>
                    <div id="msgnota"></div>
                    <input type="number" class="entrada" min="0" max="10" name="nota" id="nota" step="0.1" placeholder="Nota" />
                    <input type="submit" class="boton" name="criticaenviada" value="Enviar" />
            </form>
        </div>
    </div>
    </div> 
</div>
<script src="../scriptsjs/validaCritica.js"></script>