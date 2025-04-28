<?php if (isset($_GET) && $_GET['ok']==1): ?>
    <article id="ok1" class="ok">
        <span class="material-symbols-outlined">check</span>
        <p>Sesión cerrada correctamente</p>
    </article>
<?php elseif (isset($_GET) && $_GET['ok']==2): ?>
    <article id="ok2" class="ok">
        <span class="material-symbols-outlined">check</span>
        <p>Cuenta creada con éxito</p>
    </article>
<?php elseif (isset($_GET) && $_GET['error']==1): ?>
    <article id="error1" class="error">
        <span class="material-symbols-outlined">block</span>
        <p>Correo o contraseña incorrectos</p>
    </article>
<?php elseif (isset($_GET) && $_GET['error']==2): ?>
    <article id="error2" class="error">
        <span class="material-symbols-outlined">block</span>
        <p>Faltan campos requeridos</p>
    </article>
    <?php elseif (isset($_GET['usado']) && $_GET['usado'] == 3): ?>
    <article id="usado" class="error">
        <span class="material-symbols-outlined">block</span>
        <p>Intente Denuevo</p>
    </article>
<?php elseif (isset($_GET) && $_GET['info']==1): ?>
    <article id="info1" class="info">
        <span class="material-symbols-outlined">info</span>
        <p>No has iniciado sesión</p>
    </article>
<?php elseif (isset($_GET) && $_GET['warning']==1): ?>
    <article id="warning1" class="warning">
        <span class="material-symbols-outlined">warning</span>
        <p>No tienes permiso para acceder a ese contenido</p>
    </article>
    <?php elseif (isset($_GET) && $_GET['ok']==3): ?>
    <article id="ok3" class="ok">
        <span class="material-symbols-outlined">check</span>
        <p>Planta Agregada con éxito</p>
    </article>
    <?php elseif (isset($_GET) && $_GET['invalido']==1): ?>
    <article id="invalido" class="error">
        <span class="material-symbols-outlined">block</span>
        <p>Correo o telefono incorrectos</p>
    </article>

<?php endif; ?>