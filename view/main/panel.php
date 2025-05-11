<?php include '../layouts/default/head.php'; ?>
    <link rel="stylesheet" href="/assets/css/main/panel.css">
    <link rel="stylesheet" href="/assets/css/modules/modal_panel.css">
    <script src="/assets/js/modal_panel.js" defer></script>
    <title>VerdeFast - Panel de Control</title>
</head>
<body>
<?php include '../../controller/modules/alertas.php'; ?>
    <?php include '../layouts/modules/header.php'; ?>
    <?php include '../layouts/modules/modal_panel.php'; ?>
    <main class="main-content">
        <div class="dashboard-grid">
            <div class="metrics-container">
                <pre class="date-time">00:00 am        01/01/2025</pre>
                <div class="metrics-grid">
                    <div class="metric-card">
                        <div class="metric-icon">
                            <p style="font-size: 30px;">🌱</p>
                        </div>
                        <div class="metric-value">7.0</div>
                        <div class="metric-label">pH</div>
                        <div class="metric-change change-positive">+30% que ayer</div>
                    </div>       
                    <div class="metric-card">
                        <div class="metric-icon">
                            <p style="font-size: 30px;">🌡️</p>
                        </div>
                        <div class="metric-value">30 °C</div>
                        <div class="metric-label">Temperatura</div>
                        <div class="metric-change change-negative">-5% que ayer</div>
                    </div>          
                    <div class="metric-card">
                        <div class="metric-icon">
                            <p style="font-size: 30px;">💦</p>
                        </div>
                        <div class="metric-value">10%</div>
                        <div class="metric-label">Humedad</div>
                        <div class="metric-change change-negative">-2% que ayer</div>
                    </div>
                </div>
            </div>       
            <div class="sembradio-card">
                <div class="sembradio-header">
                    <div class="sembradio-title">Sembradio Papa <span class="dropdown-icon"></span></div>
                </div>
                <div class="sembradio-density">Densidad: 100m*20m</div>
                <div class="papa-icon-container">
                    <p style="font-size: 100px;">🥔</p>
                </div>
            </div>
            <div class="fenologia-card">
                <h2 class="fenologia-title">Fenología del cultivo</h2>
                <!-- Contenido vacío para la fenología -->
            </div>
        </div>      
        <div class="bottom-grid">
            <div class="pronostico-card">
                <h2 class="pronostico-title">Pronóstico de producción</h2>
                <p class="pronostico-subtitle">80 Piezas en la siembra</p>
                <div class="gauge-container">
                    <div class="gauge-background"></div>
                    <div class="gauge-percentage">80%</div>
                </div>
            </div>
            <div class="tamano-card">
                <h2 class="tamano-title">Tamaño de la planta</h2>
                <!-- Contenido vacío para el tamaño de la planta -->
            </div>
        </div>
        <button id="open-selec-planta">Seleccionar sembradío</button>
    </main>
<?php include '../layouts/default/footer.php'; ?>