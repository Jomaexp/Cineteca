<?php
/* Este es el controlador principal. El que va a controlar como actúa
la web según la uri a la que se dirige el usuario. */

// Si no está seteado el usuario de sesión se inicia sesión y flujo.
if(!isset($_SESSION['usuario'])){
    ob_start();
    session_start();
}

// Requerimos todos los controladores necesarios.
require_once "modelo/modelo_usuario.php";
require_once "modelo/modelo_pelicula.php";
require_once "modelo/modelo_critica.php";
require_once "controladores/cont_inicio.php";
require_once "controladores/cont_registro.php";
require_once "controladores/cont_peliculas.php";
require_once "controladores/cont_login.php";
require_once "controladores/cont_admin.php";
require_once "controladores/cont_logout.php";
require_once "controladores/cont_contacto.php";
require_once "controladores/cont_sobrenosotros.php";

/* Recogemos la uri insertada para compararla con los nombres de las direcciones
que tienen las páginas del sitio web. */

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = explode('/', $path);
$URI = $segments[count($segments)-1];

// Descomentar la siguiente línea para comprobar en que URI estamos
// echo ">>>$URI<br>";

/* Se requiere una vez la cabecera, la cual va a ser la plantilla que va a iniciar
todas las páginas. Es la que contiene el header con el menú de navegación. */
require_once "plantillas/cabecera.php";

/* Ahora se empieza a preguntar la uri en la que nos encontramos para ejecutar
el controlador pertinente a esta. */

if ($URI == 'index.php' || $URI == 'inicio') 
{
    // Se ejecuta el controlador específico que muestra el inicio.
	cont_inicio();
}
 elseif ($URI == 'peliculas') 
{
    /* Se ejecuta el controlador específico que muestra 
    el listado de peliculas. */
    lista_peliculas(); 
}

elseif ($URI == 'pelicula' && isset($_GET['id'])) 
{
    /* Se ejecuta el controlador específico que muestra
    los detalles de una película concreta. Es lo que llamamos en 
    nuestro sitio "ficha" de la película. */
    detalles_Pelicula($_GET['id']); 
}

elseif ($URI == 'login') 
{
    // Se ejecuta el controlador específico de inicio de sesión
    cont_login(); 
}
elseif ($URI == 'logout') 
{
    // Se ejecuta el controlador específico que cierra sesión
    cont_logout(); 
}
elseif ($URI == 'registro') 
{
    // Se ejecuta el controlador específico de registro
    cont_registro(); 
}
elseif ($URI == 'admin') 
{
    // Se ejecuta el controlador específico de administrador
    cont_admin(); 
}
elseif ($URI == 'contacto') 
{
    // Se ejecuta el controlador específico de contacto
    cont_contacto(); 
}
elseif ($URI == 'sobrenosotros') 
{
    // Se ejecuta el controlador específico de la página sobrenosotros
    cont_sobrenosotros(); 
}
else 
{ 
    /* Si el usuario intenta a acceder a una página que no existe
    se le mostrará el siguiente mensaje.*/
    header('Status: 404 Not Found');
    echo '<html><body><h1>La página a la que intenta acceder no       
          existe</h1></body></html>';
}
// Requerimos la plantilla de pie de página
require_once "plantillas/pie.php";

// Se limpia el flujo para evitar el mensaje "headers already sent".
ob_end_flush();
?>