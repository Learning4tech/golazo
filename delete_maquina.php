<?php
// Incluir la conexión a la base de datos
require 'database.php'; 
include 'header.php';  // Incluir la cabecera (header)

// Verificar si se ha proporcionado el ID de la máquina para eliminar
if (isset($_GET['id'])) {
    $no = $_GET['id'];

    // Eliminar la máquina de la base de datos
    $query = "DELETE FROM maquinas WHERE no='$no'";
    if ($conn->query($query) === TRUE) {
        echo "<p>¡Máquina eliminada correctamente!</p>";  // Mensaje de éxito
    } else {
        echo "<p>Error: " . $conn->error . "</p>";  // Mensaje de error
    }
}

// Redirigir de vuelta a la página principal de máquinas
echo "<p><a href='index.php' class='btn btn-success'>Volver a la lista de máquinas</a></p>";

// Cerrar conexión con la base de datos
$conn->close(); 
include 'footer.php';  // Incluir el pie de página (footer)
?>
