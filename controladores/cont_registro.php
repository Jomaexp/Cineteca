<?php
    /**
     * Esta función va a controlar el registro de usuarios.
     * Va a contemplar que los datos que se introduzcan se ajusten
     * a unos patrones concretos y que los dos campos de contraseña
     * del formulario coinciden.
     * Si hay algún error o fallo en el patrón por parte del usuario
     * el sistema informará con un mensaje.
     * Finalmente se mostrarán los resultados en la vista "vista_registro"
     */
    function cont_registro(){

    // Requerimos una vez el modelo usuario para usar sus funciones.
    require_once "modelo/modelo_usuario.php";
    require_once "modelo/modelo_conexion.php";

    // Se crea un objeto de la clase conexión
    $objetoConexion = new Conexion();
    // Se crea la conexión a la base de datos.
    $conexion_bd = $objetoConexion->conexion();
    if($conexion_bd==null){
        echo("Conexión fallida con la base de datos");
    }
    // Se crea un objeto de la clase Usuario
    $objetoUsuario = new Usuario();
  
    /* Se crea variables globales para avisar sobre usuario o contraseña con
     formato incorrecto. */
    $mensaje = "";
    $mensajeUser = "";
    // Comprobamos si se ha enviado el formulario
    if (isset($_POST['usuario']) && isset($_POST['password'])&& isset($_POST['password2'])){
        /* Si usuario y los dos campos de password no están vacíos se introducen 
        cada uno en una variable */
        if(!empty($_POST['usuario']) && !empty($_POST['password']) && !empty($_POST['password2'])){            
            $pass = $_POST['password'];
            $user = $_POST['usuario'];
            // Comprobamos si la variable user o la variable pass no atienden al formato requerido
            if(!(preg_match('/^[a-zñA-ZÑ0-9]{3,8}$/', $user)) || !(preg_match('/^[a-zñA-ZÑ0-9]{4,9}$/', $pass))){
                /* Comprobamos si la variable usuario atiende al formato correcto.
                Si esto no es así se guarda en una variable el mensaje de advertencia.*/
                if(!(preg_match('/^[a-zñA-ZÑ0-9]{3,8}$/', $user))){
                    $mensajeUser = "El usuario solo admite texto compuesto exclusivamente".
                    " por letras y/o números con una longitud de entre 3 y 8 caracteres.".
                    " Ejemplo: Pepe4568";
                }
                /* Comprobamos si la variable contraseña atiende al formato correcto.
                Si esto no es así se guarda en una variable el mensaje de advertencia.*/
                if(!(preg_match('/^[a-zñA-ZÑ0-9]{4,9}$/', $pass))){
                    $mensaje = "La contraseña debe contener de 4 a 9 caracteres." .
                    " Compuesta por letras y/o números." .
                    " Ejemplo: P1P2";
                }
            }else {
                /* Si las dos variables cumplen con el formato correcto
                    entonces se comprueba si las dos contraseñas coinciden.*/
                if($_POST['password']==$_POST['password2']){
                    /* Si eso ocurre entonces se encripta la contraseña para 
                    añadir seguridad usando crypt y la clave "cineteca1984".*/
                    $pass = crypt($_POST['password'], 'cineteca1984');
                    // Se comprueba si existe un usuario con ese nombre en la base de datos
                    if($objetoUsuario->existeUsuario($conexion_bd, $user)==true){
                        $mensaje = "Ese usuario ya existe";
                        /* justo tras el mensaje llamamos con javascript a sweetalert para que oculte el
                        mensaje de php y, cuando pulsemos aceptar, nos recargue la página sin ningún mensaje de error.*/
                        ?> <script> 
                            Swal.fire({
                            icon: 'error',
                            title: 'Lo sentimos',
                            background:  '#004000',
                            text: 'Ya existe un usuario con ese nombre. Escoge otro por favor.',
                        }).then(() => {
                                    location.replace('../index.php/registro');
                                });
                        </script>
                    <?php
                    }else{ 
                        /* Si el nombre de usuario no existe en la base de datos
                        al ejecutar el insert en la BBDD se guarda un mensaje u otro
                        según se haya podido hacer con éxito o no.*/
                        if ($objetoUsuario->insertaUsuario($conexion_bd, $user, $pass)==true) {
                            $mensaje = "Usuario creado con éxito. Diríjase a la página de login para iniciar sesión";
                            /* justo tras el mensaje llamamos con javascript a sweetalert para que oculte el
                            mensaje de php y, cuando pulsemos aceptar, nos redirija a la página de login (inicio de sesión).*/
                            ?>
                            <script>
                                Swal.fire({
                                icon: 'success',
                                title: 'Usuario creado con éxito!',
                                text: 'Pulsa en Aceptar para ir a la ventana de inicio de sesión',
                                }).then(() => {
                                    location.replace('../index.php/login');
                                });</script>
                           <?php
                        }else{
                            $mensaje = "No se ha podido crear el usuario";
                        }
                    }
                // Si las contraseñas introducidas no coinciden se avisa al usuario.
                }else  $mensaje = "Las contraseñas no coinciden.";
            }
        // Si algún campo no se ha rellenado se avisa al usuario.
        }else $mensaje = "Debe completar todos los campos";
    }   
    // una vez tenemos los datos para la página desconectamos de la base de datos.
    $objetoConexion=null;
    $conexion_bd=null;
    require_once "vistas/vista_registro.php";

}?>