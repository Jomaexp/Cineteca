<div id="login">
    <form id="formucont" action="contacto" method="post" onsubmit="return validar();">
        <legend id="cabezalogin">Contacte con nosotros</legend>
            <div id="login-campos">
                <input class="entrada" type="text" name="nombre" id="nombre" placeholder="inserte su nombre"/>
                <div class="avisologin" id="nonombre"><?php if($mensajeNombre!="")echo $mensajeNombre;?></div>
                <input class="entrada" type="mail" name="email" id="email" placeholder="inserte su email"/>
                <div class="avisologin" id="noemail"><?php if($mensajeMail!="")echo $mensajeMail;?></div>
                <input class="entrada" type="text" name="asunto" id="asunto" placeholder="inserte el asunto"/>
                <div class="avisologin" id="noasunto"><?php if($mensajeAsunto!="")echo $mensajeAsunto;?></div>
                <textarea class="entrada" rows="6" name="cuerpocontacto" 
                placeholder="Escriba aquí cualquier consulta o sugerencia que tenga. Le contestaremos lo más rápido posible."
                id="cuerpocontacto" ></textarea>
                <div class="avisologin" id="nocuerpocontacto"><?php if($mensajeCuerpo!="")echo $mensajeCuerpo;?></div>
            </div>
        <input type="submit" class ="boton" name='enviaContacto' value="Enviar"/>
    </form>
</div>
<script src="../scriptsjs/validaContacto.js"></script>