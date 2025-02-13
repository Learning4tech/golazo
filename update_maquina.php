<?php
// Incluir la conexión a la base de datos
require 'database.php'; 
include 'header.php';  // Incluir la cabecera (header)

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_maquina'])) {
    // Recoger los datos del formulario
    $no = $_POST['no'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];

    // Actualizar los datos en la base de datos
    $query = "UPDATE maquinas SET marca='$marca', modelo='$modelo' WHERE no='$no'";
    if ($conn->query($query) === TRUE) {
        echo "<p>¡Máquina actualizada correctamente!</p>";  // Mensaje de éxito
    } else {
        echo "<p>Error: " . $conn->error . "</p>";  // Mensaje de error
    }
} else {
    // Obtener los datos de la máquina a actualizar
    $no = $_GET['id'];
    $query = "SELECT * FROM maquinas WHERE no='$no'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
}

// Inicio de salida HTML
echo '<div class="container my-4">';
echo '<h2 class="text-center">Editar Máquina</h2>';
echo '<form method="POST" class="mb-3">
    <div class="row">
        <div class="col-md-3 form-group">
            <label for="no" class="sr-only">No:</label>
            <input type="number" name="no" id="no" class="form-control" value="' . $row['no'] . '" readonly required>
        </div>
        <div class="col-md-3 form-group">
            <label for="marca" class="sr-only">Marca:</label>
            <input type="text" name="marca" id="marca" class="form-control" value="' . $row['marca'] . '" required>
        </div>
        <div class="col-md-3 form-group">
            <label for="modelo" class="sr-only">Modelo:</label>
            <input type="text" name="modelo" id="modelo" class="form-control" value="' . $row['modelo'] . '" required>
        </div>
        
        <div class="col-md-12 form-group text-center mt-2">
            <button type="submit" name="update_maquina" class="btn btn-primary">Actualizar Máquina</button>
        </div>
    </div>
</form>'; // Fin formulario de actualización

// Cerrar conexión con la base de datos
$conn->close(); 
include 'footer.php';  // Incluir el pie de página (footer)
?>
