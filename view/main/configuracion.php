<?php include '../layouts/default/head.php'; ?>
    <title>VerdeFast - Panel de Control</title>
    <link rel="stylesheet" href="/assets/css/main/configuracion.css">
    <link rel="icon" type="image/x-icon" href="/assets/img/icono-verdefast.png" />
</head>
<body>
<?php include '../../controller/modules/alertas.php'; ?>
<?php
if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
    $esp32 = "http://192.168.0.17";

    if ($accion == "activar_riego") {
        file_get_contents("$esp32/activar_riego");
        echo "✅ Riego activado";
    }
    elseif ($accion == "desactivar_riego") {
        file_get_contents("$esp32/desactivar_riego");
        echo "✅ Riego desactivado";
    }
    elseif ($accion == "activar_pulsos") {
        file_get_contents("$esp32/activar_pulsos");
        echo "✅ Pulsos activados";
    }
    elseif ($accion == "desactivar_pulsos") {
        file_get_contents("$esp32/desactivar_pulsos");
        echo "✅ Pulsos desactivados";
    }
    else {
        echo "❌ Acción inválida";
    }
} 
?>

    <header class="header">
        <div class="logo">
            <span class="verde">Verde</span><span class="fast">Fast</span>
        </div>
        <nav class="nav">
            <ul>
                <li>
                    <a href="/view/form/selec_planta.php" class="a nav-item">
                        <span class="material-symbols-outlined">home</span>
                        Panel
                    </a>
                </li>
                <li>
                    <a href="#" class="a nav-item">
                        <span class="material-symbols-outlined">news</span>
                        Bitácoras
                    </a>
                </li>
                <li>
                    <a href="#" class="a nav-item">
                        <span class="material-symbols-outlined">settings</span>
                        Configuración
                    </a>
                </li>
                <li>
                    <a href="/view/main/perfil.php" class="a nav-item">
                        <span class="material-symbols-outlined">person</span>
                        Perfil
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <div class="notification-bar">
            <div class="growth-alert">
                Sembradio de papas creció un 5%
            </div>
            <div class="notification-icon">
                <p style="font-size: 30px;">🔔</p>
                <div class="notification-count">8</div>
            </div>
        </div>
        
        <div class="control-grid">
            <div class="control-panel">
                <h2 class="panel-title">Sistema de riego</h2>
                <label class="switch">
                <input type="checkbox" id="riego" name="riego" class="toggle-switch-input" <?php echo $riegoEstado; ?>>
                    <span class="slider"></span>
                </label>
            </div>
            
            <div class="control-panel">
                <h2 class="panel-title">Sistema de pulsos bioeléctricos</h2>
                <label class="switch">
                <input type="checkbox" id="bioel" name="bioel" class="toggle-switch-input" <?php echo $bioelEstado; ?>>

                    <span class="slider"></span>
                </label>
            </div>
        </div>

        <div class="control-grid">
            <div class="control-panel">
                <h2 class="panel-title">Sistema automatizado de riego</h2>
                <label class="switch">
                <input type="checkbox" id="riegoauto" name="riegoauto" class="toggle-switch-input" <?php echo $riegoAutoEstado; ?>>
                    <span class="slider"></span>
                </label>
            </div>
            
            <div class="control-panel">
                <h2 class="panel-title">Sistema automatizado de pulsos </h2>
                <label class="switch">
                <input type="checkbox" id="bioelauto" name="bioelauto" class="toggle-switch-input" <?php echo $bioelAutoEstado; ?>>

                    <span class="slider"></span>
                </label>
            </div>
        </div>  
    </main>
    <script>
    const url = '/view/main/configuracion.php?accion=';

    document.getElementById('riego').addEventListener('change', function() {
        const accion = this.checked ? "activar_riego" : "desactivar_riego";
        
        fetch('https://889a-189-215-150-134.ngrok-free.app' + url + accion)
        .then(response => response.text())
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));

        fetch('http://localhost:9100' + url + accion)
        .then(response => response.text())
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));
    });

    document.getElementById('bioel').addEventListener('change', function() {
        const accion = this.checked ? "activar_pulsos" : "desactivar_pulsos";
        
        fetch('https://889a-189-215-150-134.ngrok-free.app' + url + accion)
        .then(response => response.text())
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));

        fetch('http://localhost:9100' + url + accion)
        .then(response => response.text())
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));
    });
    </script>


</body>
</html>