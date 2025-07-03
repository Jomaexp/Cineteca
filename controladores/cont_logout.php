<?php
/**
 * Esta función va a cerrar la sesión, borrando los
 * datos contenidos en el array de sesión y eliminando también
 * cookies si existiera alguna.
 * Finalmente redirigirá a la página de inicio.
 */
function cont_logout(){
        // Se asocia al array de sesión un array vacío.
        $_SESSION=array();
        // Si la sesión usa cookies las elimina.
        if(ini_get("session.use_cookies")){
            $params = session_get_cookie_params();
            setcookie(session_name(),'',time()-4200,
                $params["path"],$params["domain"],
                $params["secure"],$params["httponly"]);
        }
        // Se destruye la sesión actual.
        session_destroy();
        // Se redirige al usuario a la página de inicio.
        /* header header('location: index.php'); 
        si dejamos este no se marca el estilo que nos 
        indica que estamos en inicio al salir de sesión.
        Comprobado que hay que hacerlo con la dirección completa tras el host.*/
        header('location: /CINETECA/index.php/inicio');
}
?>