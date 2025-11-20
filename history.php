<?php
// 1. Set the page context variables
// We must set $active_link BEFORE including the header.
$active_link = 'history';

// 2. We need to set the $page_title *before* the header.
// To do this, we must know the role. We'll peek at the debug switch
// logic from the header. This is a safe way to set the title.
// NOTE: This assumes the 'layout/header.php' file is in the 'layout' folder.

$is_admin_check = false; // Default to client
if (file_exists('layout/header.php')) {
    $header_content = file_get_contents('layout/header.php');
    
    // Check if $DEBUG_MODE = true
    if (strpos($header_content, '$DEBUG_MODE = true;') !== false && strpos($header_content, '// $DEBUG_MODE = true;') === false) {
        // If debug is on, check which role is forced
        if (strpos($header_content, '$DEBUG_FORCE_ROLE = \'admin\';') !== false && strpos($header_content, '// $DEBUG_FORCE_ROLE = \'admin\';') === false) {
            $is_admin_check = true;
        }
    } else {
        // Debug mode is off, check the real session (if it exists)
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $is_admin_check = (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin');
    }
}

if ($is_admin_check) {
    $page_title = "Historial de Citas";
} else {
    $page_title = "Mi Historial";
}


// 3. Include the header
// The header will read $page_title, $active_link, and define the REAL $is_admin
include 'layout/header.php';
?>

<!-- 4. Page Content -->
<div class="container-fluid">

    <?php if ($is_admin): ?>
    <!-- =================================================================== -->
    <!-- =================== ADMINISTRATOR VIEW ============================ -->
    <!-- =================================================================== -->
    
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h2 class="h5 mb-0 fw-bold">Filtrar Historial</h2>
            <!-- Admin Filters -->
            <div class="row g-3 align-items-center mt-2">
                <div class="col-md-5">
                    <input type="text" class="form-control" placeholder="Buscar por cliente, mascota o RUT...">
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" id="dateFrom">
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" id="dateTo">
                </div>
                <div class="col-md-1 d-grid">
                    <button class="btn" type="button" style="background-color: var(--active-link-color); color: white;">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Cliente</th>
                            <th scope="col">Mascota</th>
                            <th scope="col">Servicio</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Costo</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Mock Data Row 1 -->
                        <tr>
                            <td class="fw-bold">Juan Pérez</td>
                            <td>Fido</td>
                            <td>Baño y Corte</td>
                            <td>10/11/2025</td>
                            <td>10:00 - 12:00</td>
                            <td>$25.000</td>
                            <td><span class="badge bg-success">Completado</span></td>
                        </tr>
                        <!-- Mock Data Row 2 -->
                        <tr>
                            <td class="fw-bold">María González</td>
                            <td>Milo</td>
                            <td>Baño y Corte</td>
                            <td>10/11/2025</td>
                            <td>08:00 - 10:00</td>
                            <td>$25.000</td>
                            <td><span class="badge bg-success">Completado</span></td>
                        </tr>
                        <!-- Mock Data Row 3 -->
                        <tr>
                            <td class="fw-bold">Juan Pérez</td>
                            <td>Fido</td>
                            <td>Baño y Corte</td>
                            <td>01/10/2025</td>
                            <td>14:00 - 16:00</td>
                            <td>$10.000</td>
                            <td><span class="badge bg-secondary">Cancelado</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php else: ?>
    <!-- =================================================================== -->
    <!-- ======================= CLIENT VIEW =============================== -->
    <!-- =================================================================== -->
    
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0 fw-bold">Mi Historial de Citas</h2>
        <!-- Optional: A download button -->
        <button class="btn btn-outline-danger">
            <i class="bi bi-download me-2"></i>
            Descargar Historial
        </button>
    </div>

    <!-- Client History Table -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Mascota</th>
                            <th scope="col">Servicio</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Costo</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Mock Data Row 1 (Client's Pet) -->
                        <tr>
                            <td class="fw-bold">Mi Mascota 1</td>
                            <td>Baño y Corte</td>
                            <td>05/11/2025</td>
                            <td>10:00 - 12:00</td>
                            <td>$25.000</td>
                            <td><span class="badge bg-success">Completado</span></td>
                        </tr>
                        <!-- Mock Data Row 2 (Client's Pet) -->
                        <tr>
                            <td class="fw-bold">Mi Mascota 2</td>
                            <td>Baño y Corte</td>
                            <td>15/10/2025</td>
                            <td>08:00 - 10:00</td>
                            <td>$25.000</td>
                            <td><span class="badge bg-success">Completado</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php endif; ?>

</div>
<!-- === END PAGE CONTENT === -->


<!-- 5. Page-Specific JavaScript (if any) -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // We can add filtering logic here later
        const isAdmin = document.body.dataset.isAdmin === 'true';

        if (isAdmin) {
            console.log("Modo Administrador de Historial activo.");
        } else {
            console.log("Modo Cliente de Historial activo.");
        }
    });
</script>


<?php
// 6. Include the standard footer
include 'layout/footer.php';
?>