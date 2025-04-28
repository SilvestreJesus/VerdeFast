

<?php include '../layouts/default/head.php'; ?>
    <link rel="stylesheet" href="/assets/css/form/selec_planta.css">
    <title>VerdeFast - Seleccione Sembradío</title>
    <link rel="icon" type="image/x-icon" href="/assets/img/icono-verdefast.png" />
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
                    <a href="/view/main/configuracion.php" class="a nav-item">
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
        <h1 class="title">Selecciona el sembradío que necesites</h1>
        
        <div class="sembradio-list">
            <div class="sembradio-item">
                <div class="sembradio-icon">
                    🥔
                </div>
                <div class="sembradio-info">
                    <h2 class="sembradio-name">Sembradio Papa</h2>
                    <p class="sembradio-density">Densidad: 100m*20m</p>
                </div>
            </div>
            
            <div class="sembradio-item">
                <div class="sembradio-icon">
                    🍅
                </div>
                <div class="sembradio-info">
                    <h2 class="sembradio-name">Sembradio Tomate</h2>
                    <p class="sembradio-density">Densidad: 10m*10m</p>
                </div>
            </div>
            
            <div class="sembradio-item">
                <div class="sembradio-icon">
                    🌽
                </div>
                <div class="sembradio-info">
                    <h2 class="sembradio-name">Sembradio Maiz</h2>
                    <p class="sembradio-density">Densidad: 200m*100m</p>
                </div>
            </div>
        </div>
    </main>

    
</body>
</html>