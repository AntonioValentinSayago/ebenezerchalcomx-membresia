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
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-gradient shadow-sm" style="background: #2c5d70;">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= $base ?>/index.php?controller=members&action=create">
      <img src="./assets/img/sin_background.png" width="60px" height="60px"/> Ebenezer Chalco MX
    </a>
  </div>
</nav>
<main class="py-4">
  <div class="container">
