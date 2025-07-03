--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `password`, `id_rol`) VALUES
(2, 'Paloma', 'cisheMA0lkKXM', 2),
(3, 'Juanmi', 'cisheMA0lkKXM', 2);

--
-- Volcado de datos para la tabla `critica`
--

INSERT INTO `critica` (`id`, `texto`, `nota`, `id_pelicula`, `id_usuario`) VALUES
(1, 'Una película con mucha acción. Da un poco de miedo pero me gusta que una mujer tenga tanta fuerza. Ripley es mi heroína.', 8.0, 1, 2),
(2, 'Es divertida. Es una película para adolescentes con una banda sonora muy buena.', 7.0, 20, 2),
(3, 'Una película que te deja sin aliento. Denzel está muy bien, como siempre.', 7.5, 10, 2),
(4, 'Una película maravillosa. Elliot es totalmente creíble. Imposible no llorar con ella. Que bonita es.', 9.0, 7, 2),
(5, 'Un musical muy entretenido. Las canciones me gustaron mucho y Jackman está en su salsa en este tipo de películas.', 8.5, 11, 2),
(6, 'Muy divertida. Una comedia bien dirigida. No es la mejor comedia pero cumple su cometido.', 7.0, 12, 2),
(7, 'Una película de acción y aventuras. Si te gusta Arnold y viviste la época te gustará. Si no, probablemente haya tramos que te resulten más pesados.', 6.0, 8, 2),
(8, 'No sabía nada de esta película y me entretuvo bastante. No sabes como va a terminar hasta que lo hace. Giros todo el tiempo.', 7.2, 22, 2),
(9, 'Una película de terror que gustó mucho en mi casa. Da bastante miedo y los actores lo dan todo para que resulte creíble.', 8.8, 13, 2),
(10, 'Una película divertida sin más. Reynolds me parece un poco pesado. A pesar de todo no aburre como otras de este actor.', 6.0, 14, 2),
(11, 'Golpes, tiros, navajazos y poco diálogo. Es una película de acción y punto. Está muy bien si te gusta el género.', 8.4, 17, 2),
(12, 'Un juego para toda la familia. Una aventura que atrapa de principio a fin.', 7.5, 19, 2),
(13, 'La primera y última película de dinosaurios del cine. No se ha vuelto a hacer mejor.', 8.3, 18, 2),
(14, 'Una película con mucha acción y un movimiento de cámara bastante rápido. Me gustó pero no es mi favorita. Prefiero a Bond.', 6.5, 24, 2),
(15, 'Los muñecos son muy graciosos. Tiene algunas bromas muy logradas. La verdad es que entretiene mucho.', 7.3, 5, 2),
(16, 'Aunque es graciosa, la primera parte fue mejor y creo que debió quedarse ahí.', 6.0, 15, 2),
(17, 'Es una película de acción con un guion bastante malillo. Se nota que se basa en un videojuego del que no pudieron sacar gran cosa.', 5.5, 3, 2),
(18, 'No sé cuantas veces la hemos visto en casa. Rocky forma parte de nuestras vidas. La historia de amor y superación de esta película me emociona.', 8.8, 6, 2),
(19, 'Aunque no me gustan las películas de superhéroes esta película es más que eso. Peter Parker es una persona bastante real y su cruzada viviendo una doble vida es interesante.', 6.8, 2, 2),
(20, 'Muchas veces la hemos visto en casa. Los efectos han envejecido pero era la época. Es el mejor superman que ha habido.', 7.5, 16, 2),
(21, 'Tiene canciones que están bien, pero cuando se acerca el tramo final me pareció algo aburrida. Igualmente merece la pena verla.', 6.7, 23, 2),
(22, 'Una historia de amor sobrevalorada en el cine. Bastante pesada. Fue muy premiada pero creo que es una película con mucha parafernalia y poco fondo.', 5.5, 4, 2),
(23, 'Los superhéroes de marvel. Tras tantas películas creo que han conseguido hacer un final digno. Un final muy bien construido.', 7.0, 9, 2),
(24, 'Una película de terror española que compite con las americanas. Con poco presupuesto consigue su cometido. Aunque no es el mejor trabajo de Paco Plaza.', 6.3, 21, 2),
(25, 'Es una aventura brutal. Los personajes son muy carismáticos. No me canso de verla.', 9.2, 1, 3),
(26, 'Una película genial con un trasfondo real. En la adolescencia empezamos a definir quienes vamos a ser. Es un viaje muy divertido.', 7.7, 20, 3),
(27, 'Me mantuvo con los puños apretados hasta el final. Una película con mucho ritmo que va en aumento hasta el final. Muy buen trabajo de montaje.', 8.0, 10, 3),
(28, 'Una de las películas de la infancia para muchos de nosotros. Todos queríamos ser amigos de ET. Creo que la banda sonora le hace un favor enorme para redondearla.', 9.2, 7, 3),
(29, 'Una mezcla de sonido potente y muy definida. Ayuda mucho un montaje que no permite las pausas. Los actores cantan muy bien y las coreografías están muy elaboradas.', 8.9, 11, 3),
(30, 'Película que me recuerda a la típica comedia de los 90. Se trata de reír sin tratar de ser políticamente correcto todo el tiempo. Creo que es la mejor película de Kevin Hart.', 6.5, 12, 3),
(31, 'Guns and Roses, Megadeth y otros en una banda sonora bestial que acompaña a esta aventura que todos hemos soñado con vivir. Una pena que se estrenara a la vez que jurassic park porque casi nadie la vio en su día.', 7.5, 8, 3),
(32, 'Película vertiginosa que empieza con un buen ritmo y ya no para. Quizá no todos los actores están al mismo nivel y eso le hace perder puntos, pero en general me pareció muy buena.', 8.0, 22, 3),
(33, 'El terror ha vuelto de la mano de James Wan. Que falta le hacía al género que alguien lo tomara en serio. Me encanta la saga y esta primera entrega es genial.', 9.3, 13, 3),
(34, 'El sueño de cualquier NPC en un videojuego. Todos los que jugamos GTA hemos pensado alguna vez en esta trama. Muy muy buenos efectos. La acción quizá algo irregular. Reynolds siendo Reynolds.', 6.7, 14, 3),
(35, 'Corre, recarga y dispara. Una montaña rusa repleta de coreografías de acción que quitan el hipo. Keanu siempre lo da todo.', 8.9, 17, 3),
(36, 'Robin Williams nos guía en una aventura que gustará a niños y mayores. Todo el lore de la película me encanta. Este juego donde suenan tambores es de mis favoritos.', 9.0, 19, 3),
(37, 'Steven Spielberg firma una de sus mejores películas. Una adaptación de la novela perfecta para el cine. Los efectos especiales mezclados con los prácticos no han envejecido casi.', 9.2, 18, 3),
(38, 'El hábito hace al hombre. Eso dicen en esta película y desde luego estos kingsman son caballeros de verdad. Acción desenfrenada con buena música y efectos.', 8.5, 24, 3),
(39, 'Todo es fabuloso! No dejé de cantarla durante una semana. Es una de mis películas de animación favoritas. Emmet es un no parar de reír.', 9.0, 5, 3),
(40, 'La lego película se reinventa a sí misma y consigue, gracias en parte a nuevos personajes, sostener bastante el nivel. Baja respecto a la anterior, pero es muy buena.', 7.3, 15, 3),
(41, 'Me gustó que los personajes principales estuvieran bien presentados. La acción entretiene y tiene algunos momentos memorables. La banda sonora sigue siendo espectacular.', 7.0, 3, 3),
(42, 'La ópera prima de Stallone y es un clásico. Todos los personajes aportan algo al guion y no hay nada que sobre. Una película muy redonda. Cine del bueno.', 9.0, 6, 3),
(43, 'La mejor película de superhéroes en solitario de la historia. Sam Raimi lo clavó con esta secuela. Spiderman nunca más está reflejado en la historia y se nota.', 9.5, 2, 3),
(44, 'Me gusta más el tramo de película desde el inicio en Krypton hasta la muerte del padre de Clark. Creo que es más interesante verlo crecer. Aún así la secuencia final es muy buena.', 6.9, 16, 3),
(45, 'Uno de los temas se me ha metido en la cabeza y no puedo dejar de cantarlo. Andrew Garfield lo da todo cantando y bailando. Si te gustan los musicales has de verla.', 8.5, 23, 3),
(46, 'Tenemos muchas cosas buenas en esta película. Los efectos, la banda sonora, la fotografía, etc. La trama no es original pero entretiene. El buque de los sueños tiene aquí su homenaje.', 7.0, 4, 3),
(47, 'El crossover definitivo de marvel. Posiblemente no veamos nada igual en mucho tiempo. Thanos es una amenaza real. Un cierre perfecto para 10 años de películas.', 10.0, 9, 3),
(48, 'La recreación de aquella época y de como era una casa normal española está muy bien. El terror sumado con niños siempre mejora cuando está bien dirigido.', 7.9, 21, 3);