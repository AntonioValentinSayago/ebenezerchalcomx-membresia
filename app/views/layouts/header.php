<?php
// app/views/layouts/header.php
$base = rtrim(BASE_URL, '/');
?>
<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ebenezer Chalco MX</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $base ?>/assets/css/custom.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="icon" sizes="64x64" href="assets/img/sin_background.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="./assets/img/sin_background.png">
  <meta name="description" content="Ministerios Ebenezer Chalco MX - Registro de Memebresias.">
</head>

<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-gradient shadow-sm" style="background: #2c5d70;">
    <div class="container">
      <!-- Logo y link al formulario -->
      <a class="navbar-brand fw-bold" href="<?= $base ?>/index.php?controller=members&action=create">
        <img src="./assets/img/sin_background.png" width="60px" height="60px" /> Ebenezer Chalco MX
      </a>

      <!-- Botón responsive -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <!-- Link al formulario -->
          <li class="nav-item">
            <a class="nav-link <?= ($_GET['action'] ?? '') === 'create' ? 'active fw-bold' : '' ?>"
              href="<?= $base ?>/index.php?controller=members&action=create">
              Registrar Hermano
            </a>
          </li>
          <!-- Link a la tabla de miembros -->
          <li class="nav-item">
            <a class="nav-link <?= ($_GET['action'] ?? '') === 'index' ? 'active fw-bold' : '' ?>"
              href="<?= $base ?>/index.php?controller=members&action=index">
              Ver Miembros
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="py-4">
    <div class="container">