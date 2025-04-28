<?php include '../layouts/default/head.php'; ?>
    <title>VerdeFast - Panel de Control</title>
    <link rel="stylesheet" href="/assets/css/extra/configuracion.css">
</head>
<body>
<?php include '../../controller/modules/alertas.php'; ?>
    <header class="header">
        <div class="logo">
            <span class="verde">Verde</span><span class="fast">Fast</span>
        </div>
        <nav class="nav">
            <ul>
                <li>
                    <a href="#" class="a nav-item">
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
                    <a href="#" class="a nav-item">
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
                    <input type="checkbox" id="riego" name="riego" class="toggle-switch-input">
                    <span class="slider"></span>
                </label>
            </div>
            
            <div class="control-panel">
                <h2 class="panel-title">Sistema de pulsos mioeléctricos</h2>
                <label class="switch">
                    <input type="checkbox" id="mioel" name="mioel" class="toggle-switch-input">
                    <span class="slider"></span>
                </label>
            </div>
        </div>
    </main>
</body>
</html>