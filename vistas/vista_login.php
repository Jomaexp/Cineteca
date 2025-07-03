<div id="login">
    <form id="formu-login" action="login" method="post" onsubmit="return validar();">
        <legend id="cabezalogin">Ingresa tus datos</legend>
            <div id="login-campos">
                <input class="entrada" type="text" name="usuario" id="usuario" placeholder="inserte nombre de usuario"/>
                <div class="avisologin" id="nouser"><?php if($mensajeUser!="")echo $mensajeUser;?></div>
                <input class="entrada" type="password" name="password" id="password" placeholder="inserte su contraseña"/>
                <div class="avisologin" id="nopass"><?php if($mensaje!="")echo $mensaje;?></div>
            </div>
            <br><a href="http://localhost/CINETECA/index.php/registro"><p>No eres usuario? Regístrate aquí!</p></a>
            <input type="submit" class ="boton" name='open' value="Iniciar Sesión"/>
    </form>
</div>
<script src="../scriptsjs/validalogin.js"></script>