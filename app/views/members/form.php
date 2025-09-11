<?php
// Detectar si es edición o creación
$isEdit = isset($member) && !empty($member->id);
$action = $isEdit
    ? "index.php?controller=members&action=update"
    : "index.php?controller=members&action=store";
$title = $isEdit ? "Editar Miembro" : "Registrar Nuevo Miembro";
$buttonText = $isEdit ? "Actualizar" : "Guardar";
?>

<div class="container mt-4">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white fw-bold">
      <?= $title ?>
    </div>
    <div class="card-body">
      <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
          <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
              <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <form method="POST" action="<?= $action ?>">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
        <?php if ($isEdit): ?>
          <input type="hidden" name="id" value="<?= htmlspecialchars($member->id) ?>">
        <?php endif; ?>

        <div class="row">
          <!-- Nombres -->
          <div class="col-md-4 mb-3">
            <label class="form-label">Nombres</label>
            <input type="text" name="nombres" class="form-control"
                   value="<?= htmlspecialchars($member->nombres ?? '') ?>" required>
          </div>

          <!-- Apellido Paterno -->
          <div class="col-md-4 mb-3">
            <label class="form-label">Apellido Paterno</label>
            <input type="text" name="apellido_paterno" class="form-control"
                   value="<?= htmlspecialchars($member->apellido_paterno ?? '') ?>" required>
          </div>

          <!-- Apellido Materno -->
          <div class="col-md-4 mb-3">
            <label class="form-label">Apellido Materno</label>
            <input type="text" name="apellido_materno" class="form-control"
                   value="<?= htmlspecialchars($member->apellido_materno ?? '') ?>">
          </div>
        </div>

        <div class="row">
          <!-- Edad -->
          <div class="col-md-2 mb-3">
            <label class="form-label">Edad</label>
            <input type="number" name="edad" class="form-control"
                   value="<?= htmlspecialchars($member->edad ?? '') ?>">
          </div>

          <!-- Fecha de Nacimiento -->
          <div class="col-md-4 mb-3">
            <label class="form-label">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form-control"
                   value="<?= htmlspecialchars($member->fecha_nacimiento ?? '') ?>">
          </div>

          <!-- CURP -->
          <div class="col-md-6 mb-3">
            <label class="form-label">CURP</label>
            <input type="text" name="curp" maxlength="18" class="form-control"
                   value="<?= htmlspecialchars($member->curp ?? '') ?>">
          </div>
        </div>

        <div class="row">
          <!-- Correo -->
          <div class="col-md-6 mb-3">
            <label class="form-label">Correo</label>
            <input type="email" name="correo" class="form-control"
                   value="<?= htmlspecialchars($member->correo ?? '') ?>">
          </div>

          <!-- Teléfono -->
          <div class="col-md-6 mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control"
                   value="<?= htmlspecialchars($member->telefono ?? '') ?>">
          </div>
        </div>

        <div class="row">
          <!-- Bautizado -->
          <div class="col-md-2 mb-3">
            <div class="form-check mt-4">
              <input type="checkbox" name="bautizado" class="form-check-input"
                     <?= !empty($member->bautizado) ? 'checked' : '' ?>>
              <label class="form-check-label">Bautizado</label>
            </div>
          </div>

          <!-- Cobertura -->
          <div class="col-md-2 mb-3">
            <div class="form-check mt-4">
              <input type="checkbox" name="cobertura" class="form-check-input"
                     <?= !empty($member->cobertura) ? 'checked' : '' ?>>
              <label class="form-check-label">Cobertura</label>
            </div>
          </div>

          <!-- Fecha de Conversión -->
          <div class="col-md-4 mb-3">
            <label class="form-label">Fecha de Conversión</label>
            <input type="date" name="fecha_conversion" class="form-control"
                   value="<?= htmlspecialchars($member->fecha_conversion ?? '') ?>">
          </div>
        </div>

        <div class="row">
          <!-- Nivel académico -->
          <div class="col-md-4 mb-3">
            <label class="form-label">Nivel Académico</label>
            <select name="nivel_academico" class="form-select">
              <?php foreach ($niveles as $nivel): ?>
                <option value="<?= htmlspecialchars($nivel) ?>"
                  <?= (isset($member->nivel_academico) && $member->nivel_academico === $nivel) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($nivel) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Ocupación -->
          <div class="col-md-4 mb-3">
            <label class="form-label">Ocupación</label>
            <select name="ocupacion" class="form-select">
              <?php foreach ($ocupaciones as $ocupacion): ?>
                <option value="<?= htmlspecialchars($ocupacion) ?>"
                  <?= (isset($member->ocupacion) && $member->ocupacion === $ocupacion) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($ocupacion) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Tipo de Sangre -->
          <div class="col-md-4 mb-3">
            <label class="form-label">Tipo de Sangre</label>
            <select name="tipo_sangre" class="form-select">
              <?php foreach ($tiposSangre as $tipo): ?>
                <option value="<?= htmlspecialchars($tipo) ?>"
                  <?= (isset($member->tipo_sangre) && $member->tipo_sangre === $tipo) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($tipo) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="row">
          <!-- Estado Civil -->
          <div class="col-md-4 mb-3">
            <label class="form-label">Estado Civil</label>
            <select name="estado_civil" class="form-select">
              <?php foreach ($estadosCiviles as $estado): ?>
                <option value="<?= htmlspecialchars($estado) ?>"
                  <?= (isset($member->estado_civil) && $member->estado_civil === $estado) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($estado) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Género -->
          <div class="col-md-4 mb-3">
            <label class="form-label">Género</label>
            <select name="genero" class="form-select">
              <?php foreach ($generos as $gen): ?>
                <option value="<?= htmlspecialchars($gen) ?>"
                  <?= (isset($member->genero) && $member->genero === $gen) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($gen) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="row">
          <!-- Iglesia Anterior -->
          <div class="col-md-6 mb-3">
            <label class="form-label">Iglesia Anterior</label>
            <input type="text" name="iglesia_anterior" class="form-control"
                   value="<?= htmlspecialchars($member->iglesia_anterior ?? '') ?>">
          </div>

          <!-- Razón de Salida -->
          <div class="col-md-6 mb-3">
            <label class="form-label">Razón de Salida</label>
            <input type="text" name="razon_salida" class="form-control"
                   value="<?= htmlspecialchars($member->razon_salida ?? '') ?>">
          </div>
        </div>

        <div class="row">
          <!-- Cursos -->
          <div class="col-md-6 mb-3">
            <label class="form-label">Cursos</label>
            <input type="text" name="cursos" class="form-control"
                   value="<?= htmlspecialchars($member->cursos ?? '') ?>">
          </div>

          <!-- Talentos -->
          <div class="col-md-6 mb-3">
            <label class="form-label">Talentos (separados por coma)</label>
            <input type="text" name="talentos" class="form-control"
                   value="<?= htmlspecialchars($member->talentos ?? '') ?>">
          </div>
        </div>

        <div class="row">
          <!-- Ministerios -->
          <div class="col-md-12 mb-3">
            <label class="form-label">Ministerios (separados por coma)</label>
            <input type="text" name="ministerios[]" class="form-control"
                   value="<?= isset($member->ministerios) ? implode(',', json_decode($member->ministerios, true)) : '' ?>">
          </div>
        </div>

        <div class="text-end">
          <a href="index.php?controller=members&action=index" class="btn btn-secondary">Cancelar</a>
          <button type="submit" class="btn btn-success"><?= $buttonText ?></button>
        </div>
      </form>
    </div>
  </div>
</div>
