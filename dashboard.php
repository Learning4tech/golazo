<?php
// Incluir la conexión a la base de datos
require 'database.php'; 
include 'header.php';  // Incluir la cabecera (header)

// Consultar técnicos y máquinas para los filtros
$query_tecnicos = "SELECT DISTINCT tecnico FROM operaciones";
$result_tecnicos = $conn->query($query_tecnicos);

$query_maquinas = "SELECT DISTINCT maquina_no FROM operaciones";
$result_maquinas = $conn->query($query_maquinas);

// Procesar filtros
$filter_tecnico = isset($_POST['tecnico']) ? $_POST['tecnico'] : '';
$filter_maquina = isset($_POST['maquina']) ? $_POST['maquina'] : '';
$filter_date = isset($_POST['date']) ? $_POST['date'] : '';

// Consultar operaciones filtradas
$query = "SELECT * FROM operaciones WHERE 1";

if ($filter_tecnico) {
    $query .= " AND tecnico = '$filter_tecnico'";
}

if ($filter_maquina) {
    $query .= " AND maquina_no = '$filter_maquina'";
}

if ($filter_date) {
    $query .= " AND DATE(inicio) = '$filter_date'";
}

$result = $conn->query($query);

// Inicio de salida HTML
echo '<div class="container my-4">';
echo '<h2 class="text-center">Dashboard de Operaciones</h2>';

// Filtros
echo '<form method="POST" class="mb-3">';
echo '<div class="row">';
echo '<div class="col-md-3 form-group">';
echo '<label for="tecnico">Técnico:</label>';
echo '<select name="tecnico" id="tecnico" class="form-control">';
echo '<option value="">Todos</option>';
while ($row_tecnico = $result_tecnicos->fetch_assoc()) {
    echo '<option value="' . $row_tecnico['tecnico'] . '" ' . ($row_tecnico['tecnico'] == $filter_tecnico ? 'selected' : '') . '>' . $row_tecnico['tecnico'] . '</option>';
}
echo '</select>';
echo '</div>';

echo '<div class="col-md-3 form-group">';
echo '<label for="maquina">Máquina:</label>';
echo '<select name="maquina" id="maquina" class="form-control">';
echo '<option value="">Todas</option>';
while ($row_maquina = $result_maquinas->fetch_assoc()) {
    echo '<option value="' . $row_maquina['maquina_no'] . '" ' . ($row_maquina['maquina_no'] == $filter_maquina ? 'selected' : '') . '>Máquina ' . $row_maquina['maquina_no'] . '</option>';
}
echo '</select>';
echo '</div>';

echo '<div class="col-md-3 form-group">';
echo '<label for="date">Fecha:</label>';
echo '<input type="date" name="date" id="date" class="form-control" value="' . $filter_date . '">';
echo '</div>';

echo '<div class="col-md-3 form-group">';
echo '<button type="submit" class="btn btn-primary mt-4">Filtrar</button>';
echo '</div>';
echo '</div>';
echo '</form>';

// Tabla de operaciones
echo '<table class="table table-bordered mt-3">';
echo '<thead><tr><th>Fecha</th><th>Técnico</th><th>Máquina</th><th>Turno</th><th>Acciones</th></tr></thead><tbody>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Determinar el turno (mañana, tarde, noche)
        $hora = date('H', strtotime($row['inicio']));
        $turno = '';
        if ($hora >= 6 && $hora < 14) {
            $turno = 'Mañana';
        } elseif ($hora >= 14 && $hora < 22) {
            $turno = 'Tarde';
        } else {
            $turno = 'Noche';
        }

        // Mostrar cada operación en una fila de la tabla
        echo "<tr>
                <td>{$row['inicio']}</td>
                <td>{$row['tecnico']}</td>
                <td>{$row['maquina_no']}</td>
                <td>{$turno}</td>
                <td>
                    <!-- Botón de editar -->
                    <a href='update_operacion.php?id={$row['id']}' class='btn btn-warning btn-sm'>Editar</a>
                    <!-- Botón de eliminar -->
                    <a href='delete_operacion.php?id={$row['id']}' class='btn btn-danger btn-sm'>Eliminar</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5' class='text-center'>No se encontraron resultados.</td></tr>";
}

echo '</tbody></table>';
echo '</div>';

$conn->close();
include 'footer.php';  // Incluir el pie de página (footer)
?>

<!-- Aquí agregar el código para la gráfica de barras -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Crear el gráfico de barras para mostrar las operaciones por turno
  const ctx = document.getElementById('turnoChart').getContext('2d');
  const turnoChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Mañana', 'Tarde', 'Noche'],
      datasets: [{
        label: 'Operaciones por Turno',
        data: [10, 15, 5], // Aquí debes calcular los valores según los datos que tengas
        backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
        borderColor: ['#28a745', '#ffc107', '#dc3545'],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

<!-- Graficar según los datos (esto es solo un ejemplo, debes ajustar el código para que los datos de la tabla se muestren correctamente) -->

<canvas id="turnoChart" width="400" height="200"></canvas>

