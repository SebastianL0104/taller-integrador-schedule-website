<?php
// 1. Set the page context variables
// We get the $is_admin variable from the header, so we check it *after* including it.
// We must, however, set the $page_title and $active_link *before* including the header.

$active_link = 'clients'; // This is for the sidebar highlight

// We need to set the $page_title *before* including the header.
// To do this, we must duplicate the placeholder check for $is_admin
// This is temporary until you have real session logic.
if (file_exists('layout/header.php')) {
    // This is a placeholder to read the variable from header.php for this logic
    // In a real app, this check would be against the $_SESSION
    $header_content = file_get_contents('layout/header.php');
    if (strpos($header_content, '$is_admin = true;') !== false && strpos($header_content, '// $is_admin = true;') === false) {
        $is_admin_check = true;
    } else {
        $is_admin_check = false;
    }
} else {
    // Fallback in case header not found
    $is_admin_check = false;
}


if ($is_admin_check) {
    $page_title = "Administrar Clientes";
} else {
    $page_title = "Mis Mascotas";
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
            <div class="row align-items-center">
                <div class="col-md-6">
                    <!-- UPDATED: Header changed as requested -->
                    <h2 class="h5 mb-0 fw-bold">Clientes y mascotas</h2>
                </div>
                <div class="col-md-6">
                    <!-- Admin Search Bar (Kept as requested) -->
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar por nombre, RUT o correo...">
                        <button class="btn" type="button" style="background-color: var(--active-link-color); color: white;">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">RUT</th>
                            <th scope="col">Correo Electrónico</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Mascotas</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Mock Data Row 1 -->
                        <tr>
                            <td class="fw-bold">Juan Pérez</td>
                            <td>12.345.678-9</td>
                            <td>juan.perez@example.com</td>
                            <td>+56 9 1234 5678</td>
                            <td><span class="badge bg-danger">2</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye-fill"></i> Ver</button>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                            </td>
                        </tr>
                        <!-- Mock Data Row 2 -->
                        <tr>
                            <td class="fw-bold">María González</td>
                            <td>9.876.543-2</td>
                            <td>maria.gonzalez@example.com</td>
                            <td>+56 9 9876 5432</td>
                            <td><span class="badge bg-danger">1</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye-fill"></i> Ver</button>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                            </td>
                        </tr>
                        <!-- Mock Data Row 3 -->
                        <tr>
                            <td class="fw-bold">Carlos Soto</td>
                            <td>20.123.456-K</td>
                            <td>carlos.soto@example.com</td>
                            <td>+56 9 1122 3344</td>
                            <td><span class="badge bg-danger">3</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye-fill"></i> Ver</button>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                            </td>
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
        <!-- UPDATED: Header changed as requested -->
        <h2 class="h4 mb-0 fw-bold">Cliente y mascota</h2>
        
        <!-- Button is kept at the top as it matches the card layout -->
        <button class="btn" style="background-color: var(--active-link-color); color: white;" data-bs-toggle="modal" data-bs-target="#registerPetModal">
            <i class="bi bi-plus-circle-fill me-2"></i>
            Registrar Nueva Mascota
        </button>
    </div>

    <!-- Pet List (as Cards) -->
    <div class="row g-3">
        <!--TODO:los mock pet card originalmente eran especie-raza, se cambiarón por avances de frontend-->
        <!-- Mock Pet Card 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title h4 fw-bold">Fido</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Bichón Frisé - 5kg</h6>
                    <p class="card-text">
                        <ul class="list-unstyled mb-0">
                            <li><strong>Nacimiento:</strong> 15/03/2021</li>
                            <li><strong>Notas:</strong> Amigable, pero alérgico al pollo.</li>
                        </ul>
                    </p>
                    <div class="mt-auto pt-3">
                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil-fill"></i> Editar</button>
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i> Eliminar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mock Pet Card 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title h4 fw-bold">Milo</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Chihuahua - 2kg</h6>
                    <p class="card-text">
                        <ul class="list-unstyled mb-0">
                            <li><strong>Nacimiento:</strong> 01/11/2023</li>
                            <li><strong>Notas:</strong> Un poco tímido con extraños.</li>
                        </ul>
                    </p>
                    <div class="mt-auto pt-3">
                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil-fill"></i> Editar</button>
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i> Eliminar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Placeholder for no pets -->
        <!-- 
        <div class="col-12">
            <div class="alert alert-info" role="alert">
                Aún no has registrado ninguna mascota. ¡Haz clic en "Registrar Nueva Mascota" para empezar!
            </div>
        </div>
        -->

    </div>

    <?php endif; ?>

</div>
<!-- === END PAGE CONTENT === -->


<!-- =================================================================== -->
<!-- =================== MODAL (CLIENT VIEW ONLY) ====================== -->
<!-- =================================================================== -->
<?php if (!$is_admin): ?>
<div class="modal fade" id="registerPetModal" tabindex="-1" aria-labelledby="registerPetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="registerPetModalLabel">Registrar Nueva Mascota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="register-pet-form" action="procesar_mascota.php" method="POST">
                    <!-- Pet Name -->
                    <div class="mb-3">
                        <label for="petName" class="form-label">Nombre de la Mascota <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="petName" name="petName" required>
                    </div>
                    
                    <div class="row">
                        <!-- Species -->
                        <div class="col-md-6 mb-3">
                            <label for="petSpecies" class="form-label">Especie <span class="text-danger">*</span></label>
                            <select class="form-select" id="petSpecies" name="petSpecies" required>
                                <option value="" selected disabled>Seleccionar...</option>
                                <option value="Perro">Perro</option>
                                <option value="Gato">Gato</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <!-- Breed -->
                        <div class="col-md-6 mb-3">
                            <label for="petBreed" class="form-label">Raza</label>
                            <input type="text" class="form-control" id="petBreed" name="petBreed">
                        </div>
                    </div>

                    <!-- Birth Date -->
                    <div class="mb-3">
                        <label for="petBirthdate" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="petBirthdate" name="petBirthdate">
                    </div>

                    <!-- Additional Notes -->
                    <div class="mb-3">
                        <label for="petNotes" class="form-label">Notas Adicionales</label>
                        <textarea class="form-control" id="petNotes" name="petNotes" rows="3" placeholder="Alergias, comportamiento, etc."></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="register-pet-form" class="btn" style="background-color: var(--active-link-color); color: white;">Guardar Mascota</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<!-- 5. Page-Specific JavaScript (if any) -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // We can add form validation or fetch logic here later
        const isAdmin = document.body.dataset.isAdmin === 'true';

        if (!isAdmin) {
            // Client-side logic
            const petForm = document.getElementById('register-pet-form');
            if(petForm) {
                petForm.addEventListener('submit', (e) => {
                    e.preventDefault(); // Prevent actual submission for now
                    // Here you would typically send the data with fetch() or let the form submit
                    console.log('Formulario enviado (simulación)');
                    
                    // Close the modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('registerPetModal'));
                    modal.hide();
                    
                    // Reset the form (optional)
                    petForm.reset();
                    
                    // Here you would also refresh the list of pets
                });
            }
        } else {
            // Admin-side logic
            console.log("Modo Administrador de Clientes activo.");
        }
    });
</script>


<?php
// 6. Include the standard footer
include 'layout/footer.php';
?>