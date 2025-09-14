<?php
$base = rtrim(BASE_URL, '/');
$val = fn($k, $d = '') => htmlspecialchars($member->$k ?? $d, ENT_QUOTES, 'UTF-8');
$isEdit = isset($member->id) && $member->id !== null;
$action = $action ?? "$base/index.php?controller=members&action=store";
?>

<div class="row justify-content-center">
  <div class="col-xl-10 col-12">
    <div class="card card-soft">
      <div class="row g-0">
        <!-- Panel izquierdo -->
        <div class="col-lg-5 d-none d-lg-block" style="
          background: radial-gradient(circle,rgba(44, 93, 112, 1) 0%, rgba(148, 202, 233, 1) 100%);
          color: #fff;">
          <div class="p-4 p-lg-5">
            <span class="badge badge-soft mb-2"><i class="bi bi-stars me-1"></i> Bienvenido</span>
            <h2 class="fw-bold"><?= $isEdit ? 'Editar Hermano' : 'Solicitud de Membresía' ?></h2>
            <p class="opacity-75">Completa la información para <?= $isEdit ? 'editar el' : 'registrar un' ?> miembro.
            </p>
            <ul class="list-unstyled small opacity-75">
              <li class="mb-1"><i class="bi bi-check-circle me-2"></i> Datos protegidos</li>
              <li class="mb-1"><i class="bi bi-check-circle me-2"></i> Diseño agradable</li>
              <li class="mb-1"><i class="bi bi-check-circle me-2"></i> Compatible móviles</li>
            </ul>
          </div>
        </div>

        <!-- Formulario derecho -->
        <div class="col-lg-7">
          <div class="p-4 p-lg-5">
            <?php if (!empty($errors)): ?>
              <div class="alert alert-danger">
                <ul class="mb-0">
                  <?php foreach ($errors as $e): ?>
                    <li><?= htmlspecialchars($e, ENT_QUOTES, 'UTF-8') ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>

            <form method="post" action="<?= $action ?>" class="needs-validation" novalidate>
              <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
              <?php if ($isEdit): ?>
                <input type="hidden" name="id" value="<?= $member->id ?>">
              <?php endif; ?>

              <span class="text-danger text-bold">* Campos obligatorios</span> <br />
              <div class="row g-3" style="font-weight: bold;">
                <div class="col-md-6">
                  <label class="form-label">Nombre(s) *</label>
                  <input required name="nombres" type="text" class="form-control form-control-lg"
                    value="<?= $val('nombres') ?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Apellido paterno *</label>
                  <input required name="apellido_paterno" type="text" class="form-control form-control-lg"
                    value="<?= $val('apellido_paterno') ?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Apellido materno *</label>
                  <input required name="apellido_materno" type="text" class="form-control form-control-lg"
                    value="<?= $val('apellido_materno') ?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Fecha de nacimiento *</label>
                  <input required name="fecha_nacimiento" type="date" class="form-control"
                      value="<?= $val('fecha_nacimiento') ?>"
                      max="<?= date('Y-m-d') ?>">
                </div>
                <div class="col-md-3">
                  <label class="form-label">Edad *</label>
                  <input required name="edad" type="number" min="0" max="120" class="form-control"
                    value="<?= $val('edad') ?>">
                </div>
                <div class="col-md-3">
                  <label class="form-label">Bautizado *</label>
                  <div class="form-check form-switch mt-1">
                    <input name="bautizado" class="form-check-input" type="checkbox" <?= ($member->bautizado ?? 0) ? 'checked' : '' ?>>
                  </div>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Cobertura *</label>
                  <div class="form-check form-switch mt-1">
                    <input name="cobertura" class="form-check-input" type="checkbox" <?= ($member->cobertura ?? 0) ? 'checked' : '' ?>>
                  </div>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Nivel académico *</label>
                  <select name="nivel_academico" class="form-select" required>
                    <?php foreach ($niveles as $op): ?>
                      <option value="<?= $op ?>" <?= ($member->nivel_academico ?? '') === $op ? 'selected' : '' ?>><?= $op ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Ocupación *</label>
                  <input required list="ocupaciones" name="ocupacion" class="form-control"
                    value="<?= $val('ocupacion') ?>" placeholder="Escribe o selecciona...">
                  <datalist id="ocupaciones">
                    <?php foreach ($ocupaciones as $op): ?>
                      <option value="<?= htmlspecialchars($op, ENT_QUOTES, 'UTF-8') ?>"></option>
                    <?php endforeach; ?>
                  </datalist>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Fecha de conversión</label>
                  <input name="fecha_conversion" type="date" class="form-control"
                    value="<?= $val('fecha_conversion') ?>"
                    max="<?= date('Y-m-d') ?>">
                </div>
                <div class="col-md-12">
                  <label class="form-label">Cursos teológicos y/o discipulados</label>
                  <?php
                  $opcionesCursos = ['Todos', 'Basica 1', 'Basica 2', 'Mayordomia', 'Servicio'];
                  $seleccionados = json_decode($member->cursos ?? '[]', true) ?: [];
                  ?>
                  <select name="cursos[]" class="form-select" id="cursosSelect" multiple>
                    <?php foreach ($opcionesCursos as $curso): ?>
                      <option value="<?= htmlspecialchars($curso) ?>" <?= in_array($curso, $seleccionados) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($curso) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>



                <div class="col-md-12">
                  <label class="form-label">Talentos (separa por comas) *</label>
                  <input required name="talentos" type="text" class="form-control" value="<?= $val('talentos') ?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Departamentos</label>
                  <?php $seleccionados = json_decode($member->ministerios ?? '[]', true); ?>
                  <select name="ministerios[]" class="form-select" multiple>
                    <?php
                    $options = ["Servidores", "Adulam", "Multimedia", "Bernabé", "Intercesión", "Cafetería", "Ebenekids", "Clinica-Lucas", "Audio", "Ujieres"];
                    foreach ($options as $op): ?>
                      <option value="<?= $op ?>" <?= in_array($op, $seleccionados) ? 'selected' : '' ?>><?= $op ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Correo electrónico</label>
                  <input name="correo" type="email" class="form-control" value="<?= $val('correo') ?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Teléfono *</label>
                  <input required name="telefono" type="tel" class="form-control" value="<?= $val('telefono') ?>">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Estado civil *</label>
                  <select required name="estado_civil" class="form-select">
                    <?php foreach ($estadosCiviles as $op): ?>
                      <option value="<?= $op ?>" <?= ($member->estado_civil ?? '') === $op ? 'selected' : '' ?>><?= $op ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Género *</label>
                  <select required name="genero" class="form-select">
                    <?php foreach ($generos as $op): ?>
                      <option value="<?= $op ?>" <?= ($member->genero ?? '') === $op ? 'selected' : '' ?>><?= $op ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Iglesia anterior</label>
                  <input name="iglesia_anterior" type="text" class="form-control"
                    value="<?= $val('iglesia_anterior') ?>">
                </div>
                <div class="col-md-12">
                  <label class="form-label">Razón de salida</label>
                  <input name="razon_salida" type="text" class="form-control" value="<?= $val('razon_salida') ?>">
                </div>
              </div>

              <div class="d-flex align-items-center mt-4">
                <button class="btn btn-lg btn-success me-2 w-100">
                  <i class="bi bi-save me-1"></i> <?= $isEdit ? 'Actualizar' : 'Guardar registro' ?>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const select = document.getElementById("cursosSelect");

    select.addEventListener("change", function () {
      const values = Array.from(select.selectedOptions).map(opt => opt.value);

      // Si se selecciona "Todos", marcar todo
      if (values.includes("Todos")) {
        for (let option of select.options) {
          option.selected = true;
        }
      }

      // Si se deselecciona "Todos", desmarcar solo "Todos"
      else if (!values.includes("Todos") && select.querySelector('option[value="Todos"]').selected) {
        select.querySelector('option[value="Todos"]').selected = false;
      }
    });
  });
</script>