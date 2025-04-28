<?php include '../layouts/default/head.php'; ?>
    <link rel="stylesheet" href="/assets/css/form/login.css">
    <title>VerdeFast - Inicia sesión o regístrate</title>
</head>
<body>
<?php include '../../controller/modules/alertas.php'; ?>
    <div class="verdefast">
        <span class="verde">Verde</span><span class="fast">Fast</span>
    </div>
    <main>
        <div class="titulo-inputs">
            <h1>Iniciar sesión</h1>
            <div class="inputs">
                <form action="/controller/iniciar_sesion.php" method="POST">
                    <article>
                        <input type="text" name="correo" placeholder="Correo electrónico" required>
                        <span class="material-symbols-outlined">person</span>
                    </article>
                    <article>
                        <input type="password" name="pass" placeholder="Contraseña" required>
                        <span class="material-symbols-outlined">lock</span>
                    </article>
                    <div class="botones">
                        <button type="submit" class="iniciar-sesion boton">Iniciar sesión</button>
                        <a href="/view/form/registrar_usuario.php" id="rg" class="reg-usuario boton-secundario">Regístrate</a>
                        
                    </div>
                </form>
            <a href="/view/form/login.php?warning=1" class="a reg-clave">¿Has olvidado tu contraseña?</a>
    </main>
    <a href="/view/form/registrar_usuario.php" class="reg-usuario boton-secundario">Regístrate</a>
    <div class="bg"></div>
    <div class="login-bg"></div>
<?php include '../layouts/default/footer.php'; ?>