<?php
// app/views/layouts/header.php
$base = rtrim(BASE_URL, '/');
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro de Miembros - Iglesia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $base ?>/assets/css/custom.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-gradient shadow-sm" style="background: linear-gradient(135deg,#0ea5e9,#6366f1);">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= $base ?>/index.php?controller=members&action=create">
      <i class="bi bi-crosshair"></i> Iglesia Vida Nueva
    </a>
  </div>
</nav>
<main class="py-4">
  <div class="container">
