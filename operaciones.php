<?php
// Incluir la conexión a la base de datos
require 'database.php'; 
include 'header.php';  // Incluir la cabecera (header)

// Variables para el filtro (por defecto no se filtra nada)
$planta_filter = '';
$fecha_filter = '';
$turno_filter = [];

// Verificar si se ha enviado el formulario de filtros
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['planta'])) {
        $planta_filter = $_GET['planta'];
    }
    if (isset($_GET['fecha'])) {
        $fecha_filter = $_GET['fecha'];
    }
    if (isset($_GET['turno'])) {
        $turno_filter = $_GET['turno'];
    }
}

// Consultar las plantas para el dropdown
$planta_query = "SELECT DISTINCT planta FROM operaciones";
$planta_result = $conn->query($planta_query);

if ($planta_result === false) {
    // Si la consulta falla, mostrar un mensaje de error
    die("Error en la consulta de plantas: " . $conn->error);
}

// Construir la consulta con los filtros seleccionados
$query = "SELECT o.*, t.nombre, t.apellido 
          FROM operaciones o
          JOIN tecnicos t ON o.tecnico = t.dni 
          WHERE 1=1";

// Filtro por planta
if ($planta_filter) {
    $query .= " AND o.planta = '$planta_filter'";
}

// Filtro por fecha (solo día)
if ($fecha_filter) {
    $query .= " AND DATE(o.inicio) = '$fecha_filter'";
}

// Filtro por turno
if (count($turno_filter) > 0) {
    $query .= " AND (";
    $turno_conditions = [];
    
    if (in_array('Mañana', $turno_filter)) {
        $turno_conditions[] = "HOUR(o.inicio) >= 6 AND HOUR(o.inicio) < 14";
    }
    if (in_array('Tarde', $turno_filter)) {
        $turno_conditions[] = "HOUR(o.inicio) >= 14 AND HOUR(o.inicio) < 22";
    }
    if (in_array('Noche', $turno_filter)) {
        $turno_conditions[] = "HOUR(o.inicio) >= 22 OR HOUR(o.inicio) < 6";
    }

    $query .= implode(" OR ", $turno_conditions);
    $query .= ")";
}

// Ejecutar la consulta y verificar si tiene resultados
$result = $conn->query($query);

if ($result === false) {
    // Si la consulta falla, mostrar un mensaje de error
    die("Error en la consulta: " . $conn->error);
}

// Inicio de salida HTML
echo '<div class="container my-4">';
echo '<h2 class="text-center">Operaciones</h2>';

// Formulario para aplicar filtros
echo '<form method="GET" class="form-inline mb-3">';
echo '<div class="row">';
echo '<div class="col-md-3 form-group">';
echo '<label for="planta" class="sr-only">Planta:</label>';
echo '<select name="planta" id="planta" class="form-control">';
echo '<option value="">Selecciona Planta</option>';

// Llenar las opciones de planta dinámicamente
if ($planta_result->num_rows > 0) {
    while ($row = $planta_result->fetch_assoc()) {
        echo '<option value="' . $row['planta'] . '" ' . ($planta_filter == $row['planta'] ? 'selected' : '') . '>' . $row['planta'] . '</option>';
    }
}

echo '</select>';
echo '</div>';

echo '<div class="col-md-3 form-group">';
echo '<label for="fecha" class="sr-only">Fecha:</label>';
echo '<input type="date" name="fecha" id="fecha" class="form-control" value="' . $fecha_filter . '">';
echo '</div>';

echo '<div class="col-md-3 form-group">';
echo '<label for="turno" class="sr-only">Turno:</label>';
echo '<div class="form-check">';
echo '<input type="checkbox" name="turno[]" value="Mañana" class="form-check-input" ' . (in_array('Mañana', $turno_filter) ? 'checked' : '') . '>';
echo '<label class="form-check-label">Mañana</label>';
echo '</div>';
echo '<div class="form-check">';
echo '<input type="checkbox" name="turno[]" value="Tarde" class="form-check-input" ' . (in_array('Tarde', $turno_filter) ? 'checked' : '') . '>';
echo '<label class="form-check-label">Tarde</label>';
echo '</div>';
echo '<div class="form-check">';
echo '<input type="checkbox" name="turno[]" value="Noche" class="form-check-input" ' . (in_array('Noche', $turno_filter) ? 'checked' : '') . '>';
echo '<label class="form-check-label">Noche</label>';
echo '</div>';
echo '</div>';

echo '<div class="col-md-3 form-group text-center">';
echo '<button type="submit" class="btn btn-primary">Aplicar Filtros</button>';
echo '</div>';
echo '</div>';
echo '</form>';

// Botón para limpiar los filtros
echo '<form method="GET" class="form-inline mb-3">';
echo '<button type="submit" class="btn btn-secondary">Limpiar Filtros</button>';
echo '</form>';

// Tabla para mostrar las operaciones
echo '<table class="table table-bordered mt-3" id="operacionesTable">';
echo '<thead><tr><th>Fecha</th><th>Turno</th><th>Planta</th><th>Proceso</th><th>Máquina</th><th>Técnico</th></tr></thead><tbody>';

// Verificar si hay resultados y mostrarlos
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Obtener la hora de inicio para determinar el turno
        $hora_inicio = date('H', strtotime($row['inicio']));

        // Determinar el turno según la hora
        if ($hora_inicio >= 6 && $hora_inicio < 14) {
            $turno = 'Mañana';
        } elseif ($hora_inicio >= 14 && $hora_inicio < 22) {
            $turno = 'Tarde';
        } else {
            $turno = 'Noche';
        }

        echo "<tr>
                <td>" . date('Y-m-d', strtotime($row['inicio'])) . "</td>
                <td>{$turno}</td>
                <td>{$row['planta']}</td>
                <td>{$row['proceso']}</td>
                <td>{$row['maquina_modelo']}</td>
                <td>{$row['nombre']} {$row['apellido']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>No se encontraron resultados.</td></tr>";
}

echo '</tbody></table>';
echo '</div>';

// Cerrar conexión con la base de datos
$conn->close(); 
include 'footer.php';  // Incluir el pie de página (footer)
?>

<script>
  // Funcionalidad para ordenar columnas
  $(document).ready(function() {
    $('#operacionesTable').DataTable({
      "ordering": true  // Habilitar la ordenación de columnas
    });
  });
</script>
