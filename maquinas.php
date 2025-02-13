<?php
// Incluir la conexión a la base de datos
require 'database.php'; 
include 'header.php';  // Incluir la cabecera (header)

// Consultar las máquinas en la base de datos
$query = "SELECT * FROM maquinas";
$result = $conn->query($query);

// Inicio de salida HTML
echo '<div class="container my-4">';
echo '<h2 class="text-center">Máquinas</h2>';

// Formulario para agregar una nueva máquina - Modal
echo '<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMaquinaModal">Agregar Nueva Máquina</button>';

// Tabla para mostrar las máquinas
echo '<table class="table table-bordered mt-3">';
echo '<thead><tr><th>No</th><th>Marca</th><th>Modelo</th><th>Acciones</th></tr></thead><tbody>';

// Verificar si hay resultados y mostrarlos
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['no']}</td>
                <td>{$row['marca']}</td>
                <td>{$row['modelo']}</td>
                <td>
                    <!-- Botón de editar -->
                    <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#updateMaquinaModal' data-id='{$row['no']}' data-marca='{$row['marca']}' data-modelo='{$row['modelo']}'>Editar</button>
                    <!-- Botón de eliminar -->
                    <button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteMaquinaModal' data-id='{$row['no']}'>Eliminar</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4' class='text-center'>No se encontraron resultados.</td></tr>";
}

echo '</tbody></table>';
echo '</div>';

$conn->close();
include 'footer.php';  // Incluir el pie de página (footer)
?>

<!-- Modal para agregar una nueva máquina -->
<div class="modal fade" id="addMaquinaModal" tabindex="-1" aria-labelledby="addMaquinaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addMaquinaModalLabel">Agregar Nueva Máquina</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="addMaquinaForm">
          <div class="form-group">
            <label for="no">No:</label>
            <input type="number" name="no" id="no" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="marca">Marca:</label>
            <input type="text" name="marca" id="marca" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="modelo">Modelo:</label>
            <input type="text" name="modelo" id="modelo" class="form-control" required>
          </div>
          <button type="submit" name="add_maquina" class="btn btn-primary">Agregar Máquina</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para editar una máquina -->
<div class="modal fade" id="updateMaquinaModal" tabindex="-1" aria-labelledby="updateMaquinaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateMaquinaModalLabel">Editar Máquina</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="updateMaquinaForm">
          <div class="form-group">
            <label for="no">No:</label>
            <input type="number" name="no" id="update_no" class="form-control" readonly required>
          </div>
          <div class="form-group">
            <label for="marca">Marca:</label>
            <input type="text" name="marca" id="update_marca" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="modelo">Modelo:</label>
            <input type="text" name="modelo" id="update_modelo" class="form-control" required>
          </div>
          <button type="submit" name="update_maquina" class="btn btn-primary">Actualizar Máquina</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para eliminar una máquina -->
<div class="modal fade" id="deleteMaquinaModal" tabindex="-1" aria-labelledby="deleteMaquinaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteMaquinaModalLabel">Eliminar Máquina</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Está seguro de que desea eliminar esta máquina?</p>
        <form method="POST" id="deleteMaquinaForm">
          <input type="hidden" name="maquina_no" id="delete_maquina_no">
          <button type="submit" name="delete_maquina" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // Llenar el formulario de actualización con los valores de la máquina
  $('#updateMaquinaModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);  // Botón que abrió el modal
    var maquina_no = button.data('id');  // Extraer el ID
    var marca = button.data('marca');  // Extraer la marca
    var modelo = button.data('modelo');  // Extraer el modelo

    var modal = $(this);
    modal.find('#update_no').val(maquina_no);  // Asignar valor al campo No
    modal.find('#update_marca').val(marca);  // Asignar valor al campo Marca
    modal.find('#update_modelo').val(modelo);  // Asignar valor al campo Modelo
  });

  // Llenar el formulario de eliminación con el ID de la máquina
  $('#deleteMaquinaModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);  // Botón que abrió el modal
    var maquina_no = button.data('id');  // Extraer el ID

    var modal = $(this);
    modal.find('#delete_maquina_no').val(maquina_no);  // Asignar el ID de la máquina para eliminar
  });
</script>
