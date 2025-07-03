<?php
    /**
     * Esta función va a controlar el inicio de sesión de los usuarios 
     * en la base de datos. Avisando de los errores que cometa el usuario 
     * en caso de que no introduzca credenciales con formato correcto o
     * el caso en que introduzca credenciales no existentes en la BBDD.
     * Finalmente, si el usuario introduce las credenciales correctas,
     * iniciará sesión como tal.
     * Finalmente se mostrarán los resultados con la vista "vista_login"
     */
    function cont_login(){

    // Requerimos los modelos usuario y conexión para usar sus funciones.
    require_once "modelo/modelo_usuario.php";
    require_once "modelo/modelo_conexion.php";

    // Se crea un objeto de la clase conexión
    $objetoConexion = new Conexion();
    // Se crea la conexión a la base de datos.
    $conexion_bd = $objetoConexion->conexion();
    if($conexion_bd==null){
        echo("Conexión fallida con la base de datos");
    }
    // Se crea un objeto de clase usuario.
    $objetoUsuario = new Usuario();

    /* Se crea una variable global mensaje y MensajeUser para avisar al usuario
    si hay algún problema con las credenciales*/
    $mensaje = "";
    $mensajeUser = "";
    // Comprobamos si se ha enviado el formulario
    if (isset($_POST['usuario']) && isset($_POST['password'])&& isset($_POST['open'])){
        // Si usuario y password no están vacíos se introducen cada uno en una variable
        if(!empty($_POST['usuario']) && !empty($_POST['password'])){            
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
            }else{
                /* Si las dos variables cumplen con el formato correcto
                entonces se encripta la contraseña para añadir seguridad.*/
                $pass = crypt($_POST['password'], 'cineteca1984');
                // si se valida que el usuario existe con esas credenciales
                if($objetoUsuario->validarDatosUsuario($conexion_bd, $user, $pass)==true){
                    /* se introducen los datos del usuario necesarios en 
                     variables de sesión para ser utilizados durante la misma. */
                    $datosUsuario = $objetoUsuario->consultaDatosUsuario($conexion_bd, $user);
                    //echo $datosUsuario->id_rol; comprobante de rol de usuario
                    $_SESSION['rol'] = $datosUsuario->id_rol;
                    $_SESSION['usuario']=$user;
                    $_SESSION['idusuario']=$datosUsuario->id;
                    $mensaje= "Sesión iniciada. Pulse en una opción cualquiera del menú.";
                    ?>
                    <script>
                        Swal.fire({
                        icon: 'success',
                        title: 'Usuario <?php echo $_SESSION['usuario']; ?> conectado!',
                        text: 'Pulsa en OK',
                        }).then(() => {
                            location.replace('../index.php/inicio');
                        });</script>
                   <?php
                    
                // Si los datos de usuario no se valida en la BBDD se avisa con mensaje.
            }else{
                $mensaje = "Credenciales incorrectas.";
                ?> <script> 
                Swal.fire({
                  icon: 'error',
                  title: 'Advertencia',
                  text: 'Credenciales Incorrectas!',
                  footer: '<a class="enlace_alerta" href="../index.php/registro">Si no estás registrado pulse aquí</a>',
                }).then(() => {
                    location.replace('../index.php/login');
                });
                </script>
                <?php
            }
            }
        // Si no se ha rellenado alguno de los dos campos se avisa con un mensaje.
        }else $mensaje = "Debe completar todos los campos"; 
    }
    // una vez tenemos los datos para la página desconectamos de la base de datos.
    $objetoConexion=null;
    $conexion_bd=null;
    // Finalmente requerimos la vista_login para mostrar todo lo que se ha procesado. 
    require_once "vistas/vista_login.php";
}?>