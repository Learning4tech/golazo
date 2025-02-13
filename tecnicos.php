<?php
// Send UTF-8 header before any output (make sure no echo/HTML is outputted before this)
header('Content-Type: text/html; charset=utf-8');
require 'database.php';  // Include database connection
include 'header.php';  // Declare el header

// Fetch tecnicos
$query = "SELECT * FROM tecnicos";
$result = $conn->query($query);

// Begin HTML output
echo '<div class="container my-4">';
echo '<h2 class="text-center">Técnicos</h2>';
echo '<table class="table table-bordered">';
echo '<thead><tr><th>DNI</th><th>Nombre</th><th>Apellido</th><th>Fecha Nacimiento</th></tr></thead><tbody>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['dni']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['apellido']}</td>
                <td>{$row['fecha_nacimiento']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4' class='text-center'>No results found.</td></tr>";
}

echo '</tbody></table>';
echo '</div>';

$conn->close();  // Close the database connection
include 'footer.php';  // Declare the footer
?>
