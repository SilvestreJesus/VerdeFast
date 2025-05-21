<header class="header">
    <div class="logo">
        <span class="verde">Verde</span><span class="fast">Fast</span>
    </div>
    <?php if ($_SESSION['rol'] == "cliente"): ?>
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
    <?php endif; ?>
</header>