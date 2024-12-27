<?php
session_start(); // Iniciar sesión

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar si las credenciales son correctas
    $checkQuery = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($checkQuery);
    //include 'welcome.html';

    if ($result->num_rows > 0) {
        // Si las credenciales son correctas, guardar la sesión y redirigir al welcome.html
        $_SESSION['username'] = $username; // Guardar el nombre de usuario en la sesión
       
        header("Location: Juego/welcome2.html"); // Redirigir a welcome.html dentro de la carpeta Juego
        exit(); // Detener la ejecución del script después de la redirección
    } else {
        
        echo "<script>alert('Usuario o contraseña incorrectos.');</script>";
    }
}

$conn->close();
?>
