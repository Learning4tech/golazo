<?php
// Incluir la conexión a la base de datos
require 'database.php'; 
include 'header.php';  // Incluir la cabecera (header)
?>

<div class="container my-4">
    <!-- Descripción del Proyecto -->
    <div class="jumbotron text-center">
        <h1>Bienvenido al Proyecto Golazo SL</h1>
        <p>Golazo SL es una tarea de la clase de informática de JOSEP FRANCESC SILVA GALIANA de la UNED.</p>
        <p>Los archivos se pueden descargar en <a href="https://github.com/Learning4tech/golazo" target="_blank">GitHub</a>.</p>
    </div>

    <!-- Descripción de la Tarea -->
    <div class="mb-4">
        <h3>Descripción de la Tarea</h3>
        <p>La tarea literalmente es: Diseñar la base de datos Fábrica de Pelotas “Golazo”.</p>
        <p>Solicitan nuestros servicios para resolver el almacenamiento de datos de un sistema de gestión de la producción de una fábrica de pelotas. La fábrica se compone de una serie de plantas, cada una identificada por un color. De las plantas conocemos la superficie en metros cuadrados y la lista de procesos que se llevan a cabo dentro de ellas; de estos procesos sólo conocemos su nombre y un grado de complejidad asociado. Dentro de cada planta se encuentran las máquinas. Cada máquina es de una marca y un modelo, y se identifica por un número; este número es único a lo largo de todas las plantas. Cada máquina es operada por técnicos, debemos conocer en qué rango de fechas los técnicos estuvieron asignados a esa máquina, y además en qué turno (mañana, tarde o noche). De los técnicos conocemos su DNI, nombre, apellido y fecha de nacimiento, aparte de una serie de números telefónicos de contacto. Existen situaciones normales en las que una máquina sale de servicio y debe ser reparada, lo único que nos interesa conocer aquí es cuál otra máquina está asignada para tomar el trabajo que ella no puede realizar.</p>
    </div>

    <!-- Rastro de Navegación -->
    <div class="row mb-4">
        <!-- Página de Operaciones -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Operaciones</h5>
                    <p class="card-text">Gestiona y visualiza las operaciones realizadas por las máquinas, incluyendo el filtro por planta, fecha y turno.</p>
                    <a href="operaciones.php" class="btn btn-primary">Ir a Operaciones</a>
                </div>
            </div>
        </div>

        <!-- Página de Máquinas -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Máquinas</h5>
                    <p class="card-text">Gestiona las máquinas asignadas a cada planta, y puedes añadir, editar o eliminar máquinas.</p>
                    <a href="maquinas.php" class="btn btn-primary">Ir a Máquinas</a>
                </div>
            </div>
        </div>

        <!-- Página de Técnicos -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Técnicos</h5>
                    <p class="card-text">Gestiona los técnicos, sus datos personales, asignación de máquinas y turnos de trabajo.</p>
                    <a href="tecnicos.php" class="btn btn-primary">Ir a Técnicos</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Página de Base de Datos -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Base de Datos</h5>
                    <p class="card-text">Descarga la base de datos de todas las plantas, máquinas, operaciones y técnicos gestionados en el sistema.</p>
                    <a href="golazo3.sql" class="btn btn-primary">Ir a Base de Datos</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';  // Incluir el pie de página (footer)
?>
