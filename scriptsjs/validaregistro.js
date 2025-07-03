/* Esta función va a comparar los valores tomados de los campos de un
    formulario "usuario" "password1" y "pasword2" con expresiones regulares para validar que 
    tienen un formato correcto. Si algun campo no tiene el formato mostrará
    en el html el mensaje o mensajes pertinentes y devolverá "false". Si todos los campos tienen
    el formato correcto no se mostrará ningún mensaje y se devolverá "true".
*/
function validar() {
    var okUsuario = validarUsuario();
    var okPass = validarPassword();
    if (okUsuario && okPass) {
        return true;
    }
    return false;
}
/* Esta función va a validar el usuario siguiendo un patrón concreto 
contenido en una expresión regular */

function validarUsuario() {
    var ok;  // variable para controlar si el campo usuario cumple con su formato
    var msgError; // variable para contener el mensaje de error pertinente de ser necesario
    var usuario = document.getElementById("usuario").value;

    /* La siguiente expresión regular indica que ha de ser una cadena de 3 a 8 letras  y/o dígitos.
    Sin poder incluir nada más en esta. */
    var v_usuario = new RegExp('^[a-zñA-ZÑ0-9]{3,8}$');  // Expresión regular de usuario.

    // Inicializo el mensaje de error para que no aparezca sin antes cumplir condiciones para ello
    document.getElementById("nouser").innerHTML = "";

    /* Si el el campo de usuario está vacío se asignará a msgError el mensaje
    pertinente y se asignará false a la variable ok */
    if (usuario.length == 0) {
        ok = false;
        msgError = "Rellene el campo de usuario";
        /* Si no, si la comparación de la expresión regular "v_usuario" con la variable 
        usuario devuelve true, entonces se asignará a la variable ok el valor true.*/
    } else if (v_usuario.test(usuario)) {
        ok = true;
        /*Si no, se asignará a msgError el mensaje
        pertinente y se asignará false a la variable ok. */
    } else {
        ok = false;
        msgError = "El usuario solo admite texto compuesto exclusivamente" +
            " por letras y/o números con una longitud de entre 3 y 8 caracteres." +
            " Ejemplo: Pepe4568";
    }

    /* Ahora se observa si la variable ok es false, de serlo se muestra el mensaje de error
    que contenga la variable msgError. Si la variable ok es true se devuelve true.*/
    if (!ok) {
        document.getElementById("nouser").innerHTML = msgError;
        return false;
    } else return true;
}

/* Esta función va a validar la contraseña siguiendo un patrón concreto 
contenido en una expresión regular */
function validarPassword() {
    var ok;  // variable para controlar si el campo contraseña cumple con su formato
    var msgError; // variable para contener el mensaje de error pertinente de ser necesario
    var password = document.getElementById("password").value;
    var password2 = document.getElementById("password2").value;
    /* La siguiente expresión regular indica que ha de ser una cadena de 4 a 9 letras y/o dígitos.
    Sin poder incluir nada más en esta. */
    var v_password = new RegExp('^[A-ZÑa-zñ0-9]{4,9}$');

    // Inicializo el mensaje de error para que no aparezca sin antes cumplir condiciones para ello
    document.getElementById("nopass").innerHTML = "";

    /* Si password1 o password2 está vacío se asignará a msgError el mensaje
    pertinente y se asignará false a la variable ok */
    if (password.length == 0 || password2.length == 0) {
        ok = false;
        msgError = "Rellene los dos campos de contraseña";
    } else if (password == password2) {
        /* si la comparación de la expresión regular "v_password" con la variable 
        password devuelve true, entonces se asignará a la variable ok true */
        if (v_password.test(password)) {
            ok = true;
        } else {
            /*Si no cumple el patrón se asigna a msgError el mensaje
            pertinente y se asignará false a la variable ok */
            ok = false;
            msgError = "La contraseña debe contener de 4 a 9 caracteres." +
                " Compuesta por letras y/o números." +
                " Ejemplo: P1P2";
        }
    } else {
        ok = false;
        msgError = "Las contraseñas no coinciden"
    }
    /* Ahora se observa si la variable ok es false, de serlo se muestra el mensaje de error
    que contenga la variable msgError. Si la variable ok es true se devuelve true.*/
    if (!ok) {
        document.getElementById("nopass").innerHTML = msgError;
        return false;
    } else return true;
}