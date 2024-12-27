<?php
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
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar si el usuario ya existe
    $checkQuery = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "<p class='error'>El nombre de usuario o correo electrónico ya está registrado.</p>";
    } else {
        // Registrar nuevo usuario
        $insertQuery = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        
        if ($conn->query($insertQuery) === TRUE) {
            echo'<script type="text/javascript">
             alert("Registro creado exitosamente");
             window.location.href="login.html";
            </script>';
            //header('Location: '. index.html);
            //echo "<p class='message'>Registro exitoso. Puedes iniciar sesión ahora.</p>";

        } else {
            echo'<script type="text/javascript">
            alert("Error al registrar el usuario");
            window.location.href="index.html";
           </script>';
            
        }
    }
}

$conn->close();
?>
