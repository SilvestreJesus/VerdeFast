<?php
include '../layouts/default/head.php';
require_once __DIR__ . '/../../model/planta.php'; 

$planta = new ModeloPlanta(); // Instancia la clase ModeloPlanta
$tiposFamilias = $planta->obtenerTiposFamilias(); // Llama al método que devuelve tipos y familias

?>
<link rel="stylesheet" href="/assets/css/tecnico/registro_planta.css">
<link rel="icon" type="image/x-icon" href="/assets/img/icono-verdefast.png" />
<title>VerdeFast - Registro Planta</title>
</head>
<body>
<header class="header">
    <div class="logo">
        <span class="verde">Verde</span><span class="fast">Fast</span>
    </div>
    <nav class="nav">
        <ul>
            <li>
                <a href="#" class="a nav-item">
                    <span class="material-symbols-outlined">news</span>
                    Registro Planta
                </a>
            </li>
            <li>
                <a href="/view/tecnico/soporte.php" class="a nav-item">
                    <span class="material-symbols-outlined">news</span>
                    Soporte
                </a>
            </li>
            <li>
                <a href="/view/tecnico/perfil.php" class="a nav-item">
                    <span class="material-symbols-outlined">person</span>
                    Perfil
                </a>
            </li>
        </ul>
    </nav>
</header>

<?php include '../../controller/modules/alertas.php'; ?>
    <div class="registro-container">
        
        <h1 class="titulo">Registrar Planta</h1>

        <form class="formulario" action="/controller/crud/registrar_planta.php" method="POST">
            <div class="campo">
                <label for="correo" class="etiqueta">Correo del Cliente</label>
                <input type="email" id="correo" name="correo" class="input" required>
            </div>
            <div class="campo">
                <label for="telefono" class="etiqueta">Telefono del Cliente</label>
                <input type="tel" id="telefono" name="telefono" class="input" required>
            </div>
            <div class="campo">
                <label for="nombre_planta" class="etiqueta">Nombre de la Planta</label>
                <input type="text" id="nombre_planta" name="nombre_planta" class="input" required>
            </div>


            <div class="campo">
                
                <label for="tipo" class="etiqueta">Tipo</label>
                <select id="tipo" name="tipo" class="input" required>
                    <option value="" disabled selected>Seleccione</option>
                    <?php foreach ($tiposFamilias['tipo'] as $tipo): ?>
                        <option value="<?php echo $tipo; ?>"><?php echo $tipo; ?></option>
                    <?php endforeach; ?>
                </select>   
            </div>

            <div class="campo">
                <label for="familia" class="etiqueta">Familia</label>
                <select id="familia" name="familia" class="input" required>
                    <option value="" disabled selected>Seleccione</option>
                    <?php foreach ($tiposFamilias['familia'] as $familia): ?>
                        <option value="<?php echo $familia; ?>"><?php echo $familia; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="campo">
                <label for="cantidad" class="etiqueta">Cantidad Cultivo</label>
                <input type="number" id="cantidad" name="cantidad" class="input" required>
            </div>

            <div class="campo">
                <label for="tamaño_largo" class="etiqueta">Tamaño de la densidad de largo</label>
                <input type="number" id="tamaño_largo" name="tamaño_largo" class="input" required>
            </div>
            <div class="campo">
                <label for="tamaño_ancho" class="etiqueta">Tamaño de la densidad de ancho</label>
                <input type="number" id="tamaño_ancho" name="tamaño_ancho" class="input" required>
            </div>

            <button type="submit" class="añadir boton">Añadir</button>
        </form>
    </div>

<?php include '../layouts/default/footer.php'; ?>
