<?php
// app/views/members/success.php
$base = rtrim(BASE_URL, '/');
?>
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card card-soft p-5 text-center">
      <i class="bi bi-emoji-smile display-4 text-success mb-3"></i>
      <h3 class="fw-bold">¡Registro guardado!</h3>
      <p class="text-muted">Gracias por completar tu información.</p>
      <a class="btn btn-outline-primary" href="<?= $base ?>/index.php?controller=members&action=create">
        Registrar otro miembro
      </a>
    </div>
  </div>
</div>
