<?php
// 1. Incluir nuestro archivo de funciones de la nueva carpeta
include 'includes/utils.php';

// 2. Obtener los datos del formulario de signin.php
$nombre = $_POST['inputNombre'];
$correo = $_POST['inputCorreo'];
$contrasena = $_POST['inputContraseña'];
$rut = $_POST['inputRut'];

// 3. ¡Validar el RUT!
if (!validarRut($rut)) {
    // El RUT es inválido.
    // Devolvemos al usuario al formulario de registro con un mensaje de error.
    header('Location: signin.php?error=rut_invalido');
    exit();
}

// 4. (Lógica de Base de Datos - SIMULADA)
// Aquí deberías:
// a) Verificar si el $correo o el $rut YA EXISTEN en tu base de datos.
//    Si existen -> header('Location: signin.php?error=usuario_existe'); exit();
//
// b) Hashear la contraseña (¡MUY IMPORTANTE!)
//    $hash = password_hash($contrasena, PASSWORD_DEFAULT);
//
// c) Guardar el nuevo usuario en la base de datos
//    INSERT INTO usuarios (nombre, correo, rut, contrasena_hash, rol) 
//    VALUES (?, ?, ?, ?, 'client');

// --- SIMULACIÓN DE ÉXITO ---
// Asumimos que la creación fue exitosa.

// 5. Redirigir al login con mensaje de éxito
// El usuario ahora puede iniciar sesión con su nueva cuenta.
header('Location: login.php?registro=exitoso');
exit();

?>