<div id="login">
    <form id="formulog" action="registro" method="post" onsubmit="return validar();">
        <legend id="cabezalogin">Registro de usuario</legend>
        <div id="login-campos">
            <input class="entrada" type="text" name="usuario" id="usuario" placeholder="inserte nombre de usuario" />
            <div class="avisologin" id="nouser"><?php if ($mensajeUser != "") echo $mensajeUser; ?></div>
            <input class="entrada" type="password" name="password" id="password" placeholder="inserte su contraseña" />
            <input class="entrada" type="password" name="password2" id="password2" placeholder="Repita su contraseña" />
            <div class="avisologin" id="nopass"><?php if ($mensaje != "") echo $mensaje; ?></div>
        </div>
        <input type="submit" class="boton" name='open' value="Registrar" />
    </form>
</div>
<script src="../scriptsjs/validaregistro.js"></script>