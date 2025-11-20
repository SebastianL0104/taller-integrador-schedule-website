<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taller integrador - Registro</title>

    <link rel="stylesheet" href="/src/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  </head>
<body>
  <div class="container-fluid vh-100">
    <div class="row h-100 justify-content-center">
      <div class="p-5 bg-primary my-5">

        <div class="text-center mb-5 mt-3">
          <h1 class="bg-light fw-bold py-3 px-5 d-inline-block shadow">¡Bienvenido!</h1>
        </div>

        <div class="row align-items-center">

          <div class="col-md-6 text-center">

            <!-- 
                ACTUALIZADO: El 'action' ahora apunta a 'procesar_registro.php'.
                Y los inputs tienen el atributo 'name' para que PHP pueda recibirlos.
            -->
            <form action="procesar_registro.php" method="POST" class="registro-form">

              <h2 class="mb-5 fs-1 fw-bold">Registrarse</h2>

              <!-- Mensajes de Error -->
              <?php if (isset($_GET['error'])): ?>
                <?php if ($_GET['error'] === 'rut_invalido'): ?>
                    <div class="alert alert-danger">Error: El RUT ingresado no es válido.</div>
                <?php elseif ($_GET['error'] === 'usuario_existe'): ?>
                    <div class="alert alert-danger">Error: El correo o RUT ya está registrado.</div>
                <?php else: ?>
                    <div class="alert alert-danger">Error en el registro.</div>
                <?php endif; ?>
              <?php endif; ?>

              <div class="group mb-5">
                <input required="" type="text" class="input" id="inputNombre" name="inputNombre" maxlength=50>
                <i class="bi bi-person custom-icono"></i>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label for="inputNombre">Nombre completo</label>
              </div>

              <div class="group mb-5">
                <input required="" type="text" class="input" id="inputCorreo" name="inputCorreo" maxlength="50">
                <i class="bi bi-envelope custom-icono"></i>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label for="inputCorreo">Correo electrónico</label>
              </div>

              <div class="group mb-5">
                <!-- Cambiado a type="password" por seguridad -->
                <input required="" type="password" class="input" id="inputContraseña" name="inputContraseña" maxlength="50">
                <i class="bi bi-eye custom-icono"></i>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label for="inputContraseña">Contraseña</label>
              </div>

              <div class="group mb-5">
                <input required="" type="text" class="input" id="inputRut" name="inputRut" maxlength="12">
                <i class="bi bi-person-vcard custom-icono"></i>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label for="inputRut">Rut (ej: 12345678-9)</label>
              </div>


              <button type="submit" class="custom-button mb-3">
                Registrarse
                <div class="arrow-wrapper">
                  <div class="arrow"></div>
                </div>
              </button>

              <a href="login.php" class="py-3 fs-4 bg-transparent text-dark fw-bold ">¡Ya tienes una cuenta? Iniciar Sesión</a>

            </form>
          </div>
            <div class="col-md-6 text-center ">
              <img src="images/dogcutespa.png" class="img-fluid rounded shadow mt-5" alt="logo" style="max-height: 400px; width: auto;"> 
            </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>