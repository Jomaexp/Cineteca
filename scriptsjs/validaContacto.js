/* Esta función va a comparar los valores tomados de los campos de un
    formulario de contacto con nombre, email asunto y cuerpo con expresiones
    regulares para validar que tienen un formato correcto. Si algun campo no tiene 
    el formato mostrará en el html un mensaje y devolverá "false". Si todos los 
    campos tienen el formato correcto no se mostrará ningún mensaje y se devolverá "true".
*/
function validar() {
    var okNombre = validarNombre();
    var okMail = validarEmail();
    var okAsunto = validarAsunto();
    var okCuerpo = validarCuerpo();
    if (okNombre && okMail && okAsunto && okCuerpo) {
        return true;
    } else return false;
}
/* Esta función va a validar el nombre siguiendo un patrón concreto 
contenido en una expresión regular */

function validarNombre() {
    var ok;  // variable para controlar si el campo nombre cumple con su formato
    var msgError; // variable para contener el mensaje de error pertinente de ser necesario
    var nombre = document.getElementById("nombre").value;

    /* La siguiente expresión regular indica que ha de ser una una cadena de entre 3 y 20
    caracteres y sólo pueden ser letras y espacios.*/
    var v_nombre = new RegExp('^[ a-zñáéíóúA-ZÑÁÉÍÓÚ]{3,20}$');  // Expresión regular de nombre.

    // Inicializo el mensaje de error para que no aparezca sin antes cumplir condiciones para ello
    document.getElementById("nonombre").innerHTML = "";

    /* Si el el campo de nombre está vacío se asignará a msgError el mensaje
    pertinente y se asignará false a la variable ok */
    if (nombre.length == 0) {
        ok = false;
        msgError = "Rellene el campo nombre";
        /* Si la comparación de la expresión regular "v_nombre" con la variable 
        nombre devuelve false, entonces se asignará a msgError el mensaje
        pertinente y se asignará false a la variable ok */
    } else if (v_nombre.test(nombre)) {
        ok = true;
    } else {
        ok = false;
        msgError = "El campo nombre sólo adminte letras y espacios, de 3 a 20 caracteres. ";
    }
    /* Ahora se observa si la variable ok es false, de serlo se muestra el mensaje de error
    que contenga la variable msgError. Si la variable ok es true se devuelve true.*/
    if (!ok) {
        document.getElementById("nonombre").innerHTML = msgError;
        return false;
    } else return true;
}

/* Esta función va a validar el email siguiendo un patrón concreto 
contenido en una expresión regular */
function validarEmail() {
    var ok;  // variable para controlar si el campo mail cumple con su formato
    var msgError; // variable para contener el mensaje de error pertinente de ser necesario
    var email = document.getElementById("email").value;
    /* la siguiente expresión regular sólo permite formatos email, un texto seguido de @
    con un texto seguido de un punto . y otro texto. ejemplo: pepe@pepe.com */
    var v_email = new RegExp('[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}');

    // Inicializo el mensaje de error para que no aparezca sin antes cumplir condiciones para ello
    document.getElementById("noemail").innerHTML = "";

    /* Si la variable email está vacía se asignará a msgError el mensaje
    pertinente y se asignará false a la variable ok */
    if (email.length == 0) {
        ok = false;
        msgError = "Rellene el campo email";
        /* Si la comparación de la expresión regular "v_email" con la variable 
        email devuelve true, entonces se asignará a la variable ok true */
    } else if (v_email.test(email)) {
        ok = true;
    } else {
        /*Si no cumple el patrón se asigna a msgError el mensaje
        pertinente y se asignará false a la variable ok */
        ok = false;
        msgError = "Inserte un correo electrónico válido";
    }
    /* Ahora se observa si la variable ok es false, de serlo se muestra el mensaje de error
    que contenga la variable msgError. Si la variable ok es true se devuelve true.*/
    if (!ok) {
        document.getElementById("noemail").innerHTML = msgError;
        return false;
    } else return true;
}

/* Esta función va a validar el asunto siguiendo un patrón concreto 
contenido en una expresión regular */

function validarAsunto() {
    var ok;  // variable para controlar si el campo asunto cumple con su formato
    var msgError; // variable para contener el mensaje de error pertinente de ser necesario
    var asunto = document.getElementById("asunto").value;
    /* La siguiente expresión regular indica que ha de ser una una cadena de entre 4 y 30
    caracteres y sólo pueden ser letras y espacios.*/
    var v_asunto = new RegExp('^[ a-zA-ZñÑáéíóúÁÉÍÓÚ]{4,30}$');  // Expresión regular de asunto.

    // Inicializo el mensaje de error para que no aparezca sin antes cumplir condiciones para ello
    document.getElementById("noasunto").innerHTML = "";

    /* Si el el campo de asunto está vacío se asignará a msgError el mensaje
    pertinente y se asignará false a la variable ok */
    if (asunto.length < 4) {
        ok = false;
        msgError = "El texto del asunto ha de contener al menos 4 caracteres.";
        /* Si la comparación de la expresión regular "v_asunto" con la variable 
        asunto devuelve false, entonces se asignará a msgError el mensaje
        pertinente y se asignará false a la variable ok */
    } else if (v_asunto.test(asunto)) {
        ok = true;
    } else {
        ok = false;
        msgError = "El asunto sólo puede contener de 4 a 30 caracteres y sólo admite letras y espacios.";
    }
    /* Ahora se observa si la variable ok es false, de serlo se muestra el mensaje de error
    que contenga la variable msgError. Si la variable ok es true se devuelve true.*/
    if (!ok) {
        document.getElementById("noasunto").innerHTML = msgError;
        return false;
    } else return true;
}

/* Esta función va a validar el cuerpo del contacto siguiendo un patrón concreto 
contenido en una expresión regular */

function validarCuerpo() {
    var ok;  // variable para controlar si el campo cuerpocontacto cumple con su formato
    var msgError; // variable para contener el mensaje de error pertinente de ser necesario
    var cuerpocontacto = document.getElementById("cuerpocontacto").value;

    /* La siguiente expresión regular indica que ha de ser una una cadena de entre 4 y 800
    caracteres y sólo pueden ser letras, números y espacios.*/
    var v_cuerpocontacto = new RegExp('^[ a-zA-ZñÑáéíóúÁÉÍÓÚ0-9\s.,()"?¿@!¡]{4,800}$');  // Expresión regular de asunto.

    // Inicializo el mensaje de error para que no aparezca sin antes cumplir condiciones para ello
    document.getElementById("nocuerpocontacto").innerHTML = "";

    /* Si el el campo de cuerpocontacto está vacío se asignará a msgError el mensaje
    pertinente y se asignará false a la variable ok */
    if (cuerpocontacto.length < 4) {
        ok = false;
        msgError = "El texto de su mensaje ha de contener al menos 4 caracteres.";
        /* Si la comparación de la expresión regular "v_cuerpocontacto" con la variable 
        cuerpocontacto devuelve false, entonces se asignará a msgError el mensaje
        pertinente y se asignará false a la variable ok */
    } else if (v_cuerpocontacto.test(cuerpocontacto)) {
        ok = true;
    } else {
        ok = false;
        msgError = "El cuerpo sólo puede contener de 4 a 800 caracteres y sólo admite letras, números, espacios y los caracteres \" ? ¿ y . , ( ) ! ¡ ";
    }
    /* Ahora se observa si la variable ok es false, de serlo se muestra el mensaje de error
    que contenga la variable msgError. Si la variable ok es true se devuelve true.*/
    if (!ok) {
        document.getElementById("nocuerpocontacto").innerHTML = msgError;
        return false;
    } else return true;
}