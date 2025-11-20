<?php
// 1. INICIAR LA SESIÓN
// session_start() debe ser lo primero en CUALQUIER archivo que use sesiones.
// Lo ponemos aquí, y como todos los demás archivos incluyen el header, 
// la sesión estará disponible en todas partes.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// --- 2. LÓGICA DE ROL REAL ---
// Ya no usamos un placeholder. Leemos la sesión.
// Si el usuario no está logueado, lo definimos como 'false' (cliente por defecto o invitado).
$is_admin = (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin');

// Si no está logueado (sesión no seteada), lo redirigimos al login.
// Descomenta esto cuando tu login funcione.
/*
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?error=no_sesion');
    exit();
}
*/


// Define a variable for the current page title
if (!isset($page_title)) {
    $page_title = "Agenda";
}
// Define a variable for the active link in the sidebar
if (!isset($active_link)) {
    $active_link = 'agenda';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?> - Taller integrador</title>

    <!-- Load Custom CSS (from main.scss compilation) -->
    <link rel="stylesheet" href="/src/main.css">
    <!-- Load Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Load Bootstrap JS Bundle (Installed via NPM) -->
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Tus estilos de colores (rosado) van aquí... */
        :root {
            --sidebar-color: rgba(255, 219, 229);
            --active-link-color: rgb(245, 114, 151);
            --primary-bg-light: rgba(255, 219, 229);
            --text-color-dark: #333;
        }
        
        .sidebar {
            width: 280px;
            min-width: 280px;
            background-color: var(--sidebar-color);
            transition: transform 0.3s ease-in-out;
        }

        .main-content-area {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            max-height: 100vh;
        }
        
        .nav-link.active-custom {
            color: var(--active-link-color) !important;
            font-weight: 600;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 0.5rem;
        }

        /* Estilos del Calendario... */
        .month-nav-tabs .nav-link {
            border: 2px solid transparent;
            color: var(--bs-gray-600);
            font-weight: 600;
            font-size: 1.25rem;
            padding: 0.75rem 1.5rem;
        }
        .month-nav-tabs .nav-link.active {
            color: var(--active-link-color);
            border-bottom-color: var(--active-link-color);
            background-color: transparent;
        }
        .week-selector .btn { font-weight: 600; }
        .week-selector .btn.active {
            background-color: var(--active-link-color);
            border-color: var(--active-link-color);
            color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .admin-nav-control .form-select {
            border-color: var(--active-link-color);
            color: var(--active-link-color);
            font-weight: 600;
            max-width: 150px;
        }

        /* Estilos de la Grilla (Hourly Grid) ... */
        .hourly-grid-container { border: 1px solid var(--bs-gray-300); border-radius: 0.5rem; overflow: hidden; }
        .day-column-header { padding: 0.75rem 0.5rem; text-align: center; font-weight: bold; background-color: var(--bs-gray-100); border-bottom: 1px solid var(--bs-gray-300); }
        .day-column-header.disabled { color: var(--bs-gray-500); }
        .time-slot-label { display: flex; align-items: center; justify-content: center; padding: 0.5rem; font-size: 0.9rem; font-weight: 600; color: var(--bs-gray-700); background-color: var(--bs-gray-100); border-top: 1px solid var(--bs-gray-200); }
        .hourly-cell { min-height: 90px; border-left: 1px solid var(--bs-gray-200); border-top: 1px solid var(--bs-gray-200); transition: background-color 0.2s; cursor: pointer; }
        .hourly-cell:hover:not(.disabled) { background-color: var(--primary-bg-light); }
        .hourly-cell.disabled { background-color: var(--bs-gray-100); cursor: not-allowed; opacity: 0.7; }
        .hourly-grid-body .row:first-child .time-slot-label, .hourly-grid-body .row:first-child .hourly-cell { border-top: none; }
        .hourly-cell:last-child { border-right: 1px solid var(--bs-gray-200); }

    </style>
    
</head>
<body class="d-flex vh-100 bg-light" data-is-admin="<?php echo $is_admin ? 'true' : 'false'; ?>">

    <!-- 1. Sidebar for Navigation -->
    <nav class="sidebar d-flex flex-column p-3 h-100 shadow-lg d-none d-md-block">
        <!-- ... (Resto del sidebar sin cambios) ... -->
        <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
            <i class="bi bi-calendar3 fs-2 me-2"></i>
            <span class="fs-4 fw-bold">Mi Agenda</span>
        </div>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="agenda.php" class="nav-link text-dark <?php echo $active_link === 'agenda' ? 'active-custom' : ''; ?>" aria-current="page">
                    <i class="bi bi-calendar-event me-2"></i>
                    Agenda
                </a>
            </li>
            <li>
                <a href="clients.php" class="nav-link text-dark <?php echo $active_link === 'clients' ? 'active-custom' : ''; ?>">
                    <i class="bi bi-people me-2"></i>
                    Clientes
                </a>
            </li>
            <li>
                <a href="history.php" class="nav-link text-dark <?php echo $active_link === 'history' ? 'active-custom' : ''; ?>">
                    <i class="bi bi-clock-history me-2"></i>
                    Historial
                </a>
            </li>
            <li>
                <a href="settings.php" class="nav-link text-dark <?php echo $active_link === 'settings' ? 'active-custom' : ''; ?>">
                    <i class="bi bi-gear me-2"></i>
                    Ajustes
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://placehold.co/32x32/343a40/ffffff?text=U" alt="user avatar" width="32" height="32" class="rounded-circle me-2">
                <!-- Mostramos el nombre de usuario de la sesión si existe -->
                <strong class="d-none d-sm-inline"><?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Usuario'; ?></strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="#">Nuevo evento...</a></li>
                <li><a class="dropdown-item" href="profile.php">Perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </div>
    </nav>
    
    <!-- ... (Resto del Offcanvas Menu sin cambios) ... -->
    <div class="offcanvas offcanvas-start bg-light" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="mobileSidebarLabel">Mi Agenda</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item"><a href="agenda.php" class="nav-link text-dark <?php echo $active_link === 'agenda' ? 'active-custom' : ''; ?>"><i class="bi bi-calendar-event me-2"></i>Agenda</a></li>
            <li><a href="clients.php" class="nav-link text-dark <?php echo $active_link === 'clients' ? 'active-custom' : ''; ?>"><i class="bi bi-people me-2"></i>Clientes</a></li>
            <li><a href="history.php" class="nav-link text-dark <?php echo $active_link === 'history' ? 'active-custom' : ''; ?>"><i class="bi bi-clock-history me-2"></i>Historial</a></li>
            <li><a href="settings.php" class="nav-link text-dark <?php echo $active_link === 'settings' ? 'active-custom' : ''; ?>"><i class="bi bi-gear me-2"></i>Ajustes</a></li>
        </ul>
        <hr>
        <a href="logout.php" class="btn btn-danger w-100"><i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión</a>
      </div>
    </div>

    <!-- 2. Main Content Area (Start) -->
    <div class="main-content-area d-flex flex-column">

        <!-- Header/Top Bar (Always visible) -->
        <header class="d-flex justify-content-between align-items-center mb-4 p-3 bg-white shadow-sm rounded-lg">
            
            <!-- ... (Resto del header sin cambios) ... -->
            <button class="btn btn-light d-md-none me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
                <i class="bi bi-list fs-4"></i>
            </button>
            
            <h1 class="fs-3 fw-bolder text-black mb-0"><?php echo htmlspecialchars($page_title); ?></h1>

            <div class="d-flex align-items-center">
                <div class="input-group me-3 d-none d-sm-flex">
                    <input type="text" class="form-control" placeholder="Buscar..." aria-label="Buscar" aria-describedby="search-icon">
                    <span class="input-group-text bg-white" id="search-icon"><i class="bi bi-search"></i></span>
                </div>
                <div class="dropdown d-md-none">
                    <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://placehold.co/32x32/343a40/ffffff?text=U" alt="user avatar" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser2">
                        <li><a class="dropdown-item" href="profile.php">Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Dynamic Content Area Starts Here -->
        <main class="flex-grow-1">