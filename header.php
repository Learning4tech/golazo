<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golazo SL Dashboard</title>
	
	<!-- DataTables CSS -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

	<!-- jQuery (Requerido por DataTables y Bootstrap si usas componentes basados en jQuery) -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!-- DataTables JS -->
	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

	<!-- Popper.js (si no lo tienes cargado ya) -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>

	<!-- Bootstrap JS Bootstrap Bundle (incluye Popper.js y Bootstrap JS) -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Cargar Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al CSS personalizado-->
	
</head>
<body>
    <!-- Header Section -->
    <header class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <img src="logo.png" alt="Golazo Logo" class="navbar-brand" width="100">
            <a class="navbar-brand" href="#">Golazo SL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" href="operaciones.php">Panel de Control</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="plantas.php">Plantas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="procesos.php">Procesos</a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" href="maquinas.php">Máquinas</a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" href="tecnicos.php">Técnicos</a>
                    </li>
                    <!-- Add more links as needed -->
                </ul>
            </div>
        </div>
    </header>
