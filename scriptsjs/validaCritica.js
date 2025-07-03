/* Esta función va a comprobar que el usuario ha introducido 
los valores correctos en la crítica de la película.
*/
function validar() {
    var okUCritica = validarCritica();
    var okNota = validarNota();
    if (okUCritica && okNota) {
        return true;
    } else if (!okUCritica && !okNota && (document.getElementById("msgcritica").value == "Rellene la crítica.")) {
        var msgError = "Rellene los dos campos por favor.";
        document.getElementById("msgcritica").innerHTML = msgError;
        document.getElementById("msgnota").innerHTML = "";
        return false;
    } else return false;
}
/* Esta función va a validar la crítica para que esta sea válida únicamente
cuando no esté vacía y contenga como máximo 800 caracteres. */

function validarCritica() {
    var ok;  // variable para controlar si el campo critica cumple con su formato
    var msgError; // variable para contener el mensaje de error pertinente de ser necesario
    var critica = document.getElementById("critica").value;

    // Inicializo el mensaje de error para que no aparezca sin antes cumplir condiciones para ello
    document.getElementById("msgcritica").innerHTML = "";

    /* Si lavariable crítica está vacía se asignará a msgError el mensaje
    pertinente y se asignará false a la variable ok */
    if (critica.length == 0) {
        ok = false;
        msgError = "Rellene la crítica.";
        // si no, se observará que la crítica no mida más de 800 caracteres porque daría error en la BBDD.            
    } else {
        if (critica.length > 800) {
            ok = false;
            msgError = "La crítica no puede tener más de 800 caracteres.";
        } else {
            ok = true;
        }
    }

    /* Ahora se observa si la variable ok es false, de serlo se muestra el mensaje de error
    que contenga la variable msgError. Si la variable ok es true se devuelve true.*/
    if (!ok) {
        document.getElementById("msgcritica").innerHTML = msgError;
        return false;
    } else return true;
}

/* Esta función va a validar que hemos rellenado el campo de nota y que cumple
siendo un número entre 0 y 10,*/
function validarNota() {
    var ok;  // variable para controlar si el campo nota cumple con su formato
    var msgError; // variable para contener el mensaje de error pertinente de ser necesario
    var nota = document.getElementById("nota").value;

    // Inicializo el mensaje de error para que no aparezca sin antes cumplir condiciones para ello
    document.getElementById("msgnota").innerHTML = "";
    /* Si la variable nota está vacía se asignará a msgError el mensaje
    pertinente y se asignará false a la variable ok */
    if (nota.length == 0) {
        ok = false;
        msgError = "Ponga nota a la película.";
        /* Si no, se comprueba si nota es un número entre 0 y 10. Si lo es se devuelve true.
        Si no lo es se guardará en msgError el mensaje pertinente.*/
    } else {
        if (!isNaN(nota) && (nota >= 0 && nota <= 10)) {
            ok = true;
        } else msgError = "Solo puede introducir números del 0 al 10 con un decimal en la nota."
    }
    /* Ahora se observa si la variable ok es false, de serlo se muestra el mensaje de error
    que contenga la variable msgError. Si la variable ok es true se devuelve true.*/
    if (!ok) {
        document.getElementById("msgnota").innerHTML = msgError;
        return false;
    } else return true;
}