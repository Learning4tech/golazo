<?php
// Incluir la conexión a la base de datos
require 'database.php'; 
include 'header.php';  // Incluir la cabecera (header)

// Consultar las máquinas en la base de datos
$query = "SELECT * FROM maquinas";
$result = $conn->query($query);

// Verificar si se ha enviado el formulario de agregar nueva máquina
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_maquina'])) {
    // Recoger los datos del formulario
    $no = $_POST['no'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];

    // Insertar los datos en la base de datos
    $query = "INSERT INTO maquinas (no, marca, modelo) VALUES ('$no', '$marca', '$modelo')";
    if ($conn->query($query) === TRUE) {
        echo "<p>¡Nueva máquina agregada correctamente!</p>";  // Mensaje de éxito
    } else {
        echo "<p>Error: " . $conn->error . "</p>";  // Mensaje de error
    }
}

// Inicio de salida HTML
echo '<div class="container my-4">';
echo '<h2 class="text-center">Máquinas</h2>';

// Formulario para agregar una nueva máquina
// Inicio formulario de entrada (en una línea)
echo '<form method="POST" class="mb-3">
    <div class="row">
        <div class="col-md-3 form-group">
            <label for="no" class="sr-only">No:</label>
            <input type="number" name="no" id="no" class="form-control" placeholder="No" required>
        </div>
        <div class="col-md-3 form-group">
            <label for="marca" class="sr-only">Marca:</label>
            <input type="text" name="marca" id="marca" class="form-control" placeholder="Marca" required>
        </div>
        <div class="col-md-3 form-group">
            <label for="modelo" class="sr-only">Modelo:</label>
            <input type="text" name="modelo" id="modelo" class="form-control" placeholder="Modelo" required>
        </div>
        
        <div class="col-md-12 form-group text-center mt-2">
            <button type="submit" name="add_maquina" class="btn btn-primary">Agregar Máquina</button>
        </div>
    </div>
</form>'; // Fin formulario de entrada

// Tabla para mostrar las máquinas
echo '<table class="table table-bordered">';
echo '<thead><tr><th>No</th><th>Marca</th><th>Modelo</th><th>Proceso</th><th>Acciones</th></tr></thead><tbody>';

// Verificar si hay resultados y mostrarlos
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Mostrar cada máquina en una fila de la tabla
        echo "<tr>
                <td>{$row['no']}</td>
                <td>{$row['marca']}</td>
                <td>{$row['modelo']}</td>
              <td>
                    <!-- Botón de editar -->
                    <a href='update_maquina.php?id={$row['no']}' class='btn btn-warning btn-sm'>Editar</a>
                    <!-- Botón de eliminar -->
                    <a href='delete_maquina.php?id={$row['no']}' class='btn btn-danger btn-sm'>Eliminar</a>
                </td>
              </tr>";
    }
} else {
    // Mensaje cuando no hay resultados
    echo "<tr><td colspan='5' class='text-center'>No se encontraron resultados.</td></tr>";
}

echo '</tbody></table>';
echo '</div>';

// Cerrar conexión con la base de datos
$conn->close(); 
include 'footer.php';  // Incluir el pie de página (footer)
?>
