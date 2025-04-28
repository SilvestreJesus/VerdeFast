<?php include '../layouts/default/head.php'; ?>
    <link rel="stylesheet" href="/assets/css/form/registrar_usuario.css">
    <link rel="icon" type="image/x-icon" href="/assets/img/icono-verdefast.png" />
    <title>VerdeFast - Registrate</title>
</head>
<body>
<?php include '../../controller/modules/alertas.php'; ?>
    <div class="registro-container">
        <h1 class="titulo">Crea tu cuenta</h1>
        
        <form class="formulario" action="/controller/crud/registrar_usuario.php" method="POST">
            <div class="campo">
                <label for="nombres" class="etiqueta">Nombre(s)</label>
                <input type="text" id="nombre" name="nombre" class="input" required>
            </div>

            <div class="campo">
                <label for="apellidos" class="etiqueta">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" class="input" required>
            </div>
            
            <div class="campo">
                <label for="fecha-nac" class="etiqueta">Fecha de Nacimiento</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="input" required>
            </div>
            
            <div class="campo">
                <label for="genero" class="etiqueta">Genero</label>
                <select id="genero" name="genero" class="input" required>
                    <option value="" disabled selected>Seleccione</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                    <option value="otro">Otro</option>
                    <option value="no-especificar">Prefiero no especificar</option>
                </select>
            </div>
            
            <div class="campo">
                <label for="telefono" class="etiqueta">Telefono</label>
                <input type="tel" id="telefono" name="telefono" class="input" required>
            </div>
            
            <div class="campo campo-completo">
                <label for="domicilio" class="etiqueta">Domicilio</label>
                <input type="text" id="domicilio" name="domicilio" class="input" required>
            </div>
            
            <div class="campo">
                <label for="correo" class="etiqueta">Correo</label>
                <input type="email" id="correo" name="correo" class="input" required>
            </div>
            
            <div class="campo">
                <label for="pass" class="etiqueta">Contraseña</label>
                <input type="password" id="pass" name="pass" class="input" required>
            </div>
            
            <button type="submit" class="registrarse boton">Regístrate</button>
        </form>
    </div>
<?php include '../layouts/default/footer.php'; ?>