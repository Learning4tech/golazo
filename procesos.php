<?php
// Send UTF-8 header before any output (make sure no echo/HTML is outputted before this)
header('Content-Type: text/html; charset=utf-8');
require 'database.php';  // Include database connection
include 'header.php';  // Declare the header

// Fetch procesos
$query = "SELECT * FROM procesos";
$result = $conn->query($query);

// Begin HTML output
echo '<div class="container my-4">';
echo '<h2 class="text-center">Procesos</h2>';
echo '<table class="table table-bordered">';
echo '<thead><tr><th>Nombre</th><th>Complejidad</th><th>Planta Color</th></tr></thead><tbody>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['nombre']}</td>
                <td>{$row['complejidad']}</td>
                <td>{$row['planta_color']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3' class='text-center'>No results found.</td></tr>";
}

echo '</tbody></table>';
echo '</div>';

$conn->close();  // Close the database connection
include 'footer.php';  // Declare the footer
?>
