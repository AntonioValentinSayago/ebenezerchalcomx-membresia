<?php
// app/views/members/create.php
$base = rtrim(BASE_URL, '/');
$member = $member ?? null;
$val = fn($k, $d = '') => htmlspecialchars($member->$k ?? $d, ENT_QUOTES, 'UTF-8');
?>
<div class="row justify-content-center">
  <div class="col-xl-10 col-12">
    <div class="card card-soft">
      <div class="row g-0">
        <div class="col-lg-5 d-none d-lg-block" style="
          background: radial-gradient(circle,rgba(44, 93, 112, 1) 0%, rgba(148, 202, 233, 1) 100%);;
          color: #fff;">
          <div class="p-4 p-lg-5">
            <span class="badge badge-soft mb-2"><i class="bi bi-stars me-1"></i> Bienvenido</span>
            <h2 class="fw-bold">Solucitud de Membresia</h2>
            <p class="opacity-75">Completa la información para el registro de nuestra iglesia.</p>
            <ul class="list-unstyled small opacity-75">
              <li class="mb-1"><i class="bi bi-check-circle me-2"></i> Datos protegidos</li>
              <li class="mb-1"><i class="bi bi-check-circle me-2"></i> Diseño agradable</li>
              <li class="mb-1"><i class="bi bi-check-circle me-2"></i> Compatible móviles</li>
            </ul>
          </div>
        </div>
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

            <form method="post" action="<?= $base ?>/index.php?controller=members&action=store" class="needs-validation"
              novalidate>
              <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

              <div class="row g-3" style="font-weight: bold;">
                <div class="col-md-5">
                  <label class="form-label form-section-title">Nombre(s)</label>
                  <input required name="nombres" type="text" class="form-control form-control-lg"
                    value="<?= $val('nombres') ?>">
                  <div class="invalid-feedback">Requerido.</div>
                </div>
                <div class="col-md-3">
                  <label class="form-label form-section-title">Apellido paterno</label>
                  <input required name="apellido_paterno" type="text" class="form-control form-control-lg"
                    value="<?= $val('apellido_paterno') ?>">
                  <div class="invalid-feedback">Requerido.</div>
                </div>
                <div class="col-md-4">
                  <label class="form-label form-section-title">Apellido materno</label>
                  <input required name="apellido_materno" type="text" class="form-control form-control-lg"
                    value="<?= $val('apellido_materno') ?>">
                  <div class="invalid-feedback">Requerido.</div>
                </div>

                <div class="col-md-2">
                  <label class="form-label">Edad</label>
                  <input required name="edad" type="number" min="0" max="120" class="form-control"
                    value="<?= $val('edad') ?>">
                  <div class="invalid-feedback">Edad inválida.</div>
                </div>
                <div class="col-md-5">
                  <label class="form-label">Fecha de Nacimiento</label>
                  <input required name="fecha_nacimiento" type="date" min="0" max="120" class="form-control" value="">
                  <div class="invalid-feedback">Requerido.</div>
                </div>
                <div class="col-md-4">
                  <label class="form-label">CURP</label>
                  <input required name="curp" type="text" min="0" class="form-control" value="" maxlength="18"
                    style="text-transform: uppercase;">
                  <div class="invalid-feedback">CURP Invalido.</div>
                </div>


                <div class="col-md-3">
                  <label class="form-label">Bautizado</label>
                  <div class="form-check form-switch mt-1">
                    <input required name="bautizado" class="form-check-input" type="checkbox" <?= ($member->bautizado ?? 0) ? 'checked' : '' ?>>
                    <label class="form-check-label">Sí</label>
                  </div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Nivel académico</label>
                  <select name="nivel_academico" class="form-select" required>
                    <?php foreach ($niveles as $op): ?>
                      <option value="<?= $op ?>" <?= (($member->nivel_academico ?? '') === $op) ? 'selected' : '' ?>>
                        <?= $op ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                  <div class="invalid-feedback">Requerido.</div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Fecha de conversión</label>
                  <input required name="fecha_conversion" type="date" class="form-control"
                    value="<?= $val('fecha_conversion') ?>">
                  <div class="invalid-feedback">Requerido.</div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Ocupación</label>
                  <input required list="ocupaciones" name="ocupacion" class="form-control"
                    value="<?= $val('ocupacion') ?>" placeholder="Escribe o selecciona...">
                  <datalist id="ocupaciones">
                    <?php foreach ($ocupaciones as $op): ?>
                      <option value="<?= htmlspecialchars($op, ENT_QUOTES, 'UTF-8') ?>"></option>
                    <?php endforeach; ?>
                  </datalist>
                  <div class="form-hint text-muted">Puedes escribir la tuya si no aparece.</div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Cursos teológicos y/o discipulados</label>
                  <input required name="cursos" type="text" class="form-control" value="<?= $val('cursos') ?>"
                    placeholder="Ej.: Teología 1, Discipulado básico">
                  <div class="invalid-feedback">Requerido.</div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Nombre de iglesia anterior</label>
                  <input name="iglesia_anterior" type="text" class="form-control"
                    value="<?= $val('iglesia_anterior') ?>">
                  <div class="invalid-feedback">Requerido.</div>
                </div>

                <div class="col-md-12">
                  <label class="form-label">Razón de salida</label>
                  <input name="razon_salida" type="text" class="form-control" value="<?= $val('razon_salida') ?>">
                </div>

                <div class="col-12">
                  <label class="form-label">Talentos y virtudes (separa con comas)</label>
                  <input required id="talentos" name="talentos" type="text" class="form-control"
                    value="<?= $val('talentos') ?>" placeholder="Ej.: canto, liderazgo, servicio, enseñanza">
                  <div id="talentosPreview" class="mt-2"></div>
                  <div class="invalid-feedback">Requerido.</div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Correo electrónico</label>
                  <input required name="correo" type="email" class="form-control" value="<?= $val('correo') ?>">
                  <div class="invalid-feedback">Correo inválido.</div>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Número telefónico</label>
                  <input required name="telefono" type="tel" class="form-control" value="<?= $val('telefono') ?>">
                  <div class="invalid-feedback">Requerido.</div>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Tipo de sangre</label>
                  <select required name="tipo_sangre" class="form-select">
                    <?php foreach ($tiposSangre as $op): ?>
                      <option value="<?= $op ?>" <?= (($member->tipo_sangre ?? '') === $op) ? 'selected' : '' ?>><?= $op ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                  <div class="invalid-feedback">Requerido.</div>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Estado civil</label>
                  <select required name="estado_civil" class="form-select">
                    <?php foreach ($estadosCiviles as $op): ?>
                      <option value="<?= $op ?>" <?= (($member->estado_civil ?? '') === $op) ? 'selected' : '' ?>><?= $op ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                  <div class="invalid-feedback">Requerido.</div>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Género</label>
                  <select required name="genero" class="form-select">
                    <?php foreach ($generos as $op): ?>
                      <option value="<?= $op ?>" <?= (($member->genero ?? '') === $op) ? 'selected' : '' ?>><?= $op ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                  <div class="invalid-feedback">Requerido.</div>
                </div>
              </div>

              <div class="d-flex align-items-center mt-4">
                <button class="btn btn-lg btn-success me-2" style="border-radius: 16px; width: 100%;">
                  <i class="bi bi-save me-1"></i> Guardar registro
                </button>
              </div>
            </form>

            <script>
              // Bootstrap client-side validation
              (function () {
                'use strict'
                const forms = document.querySelectorAll('.needs-validation')
                Array.from(forms).forEach(function (form) {
                  form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                      event.preventDefault()
                      event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                  }, false)
                })
              })();

              document.addEventListener("DOMContentLoaded", () => {
                const curpInput = document.querySelector("input[name='curp']");
                const form = document.querySelector("form");

                const curpRegex = /^[A-Z]{4}\d{6}[HM]{1}[A-Z]{5}[0-9A-Z]{2}$/;

                if (curpInput) {
                  // Forzar mayúsculas
                  curpInput.addEventListener("input", () => {
                    curpInput.value = curpInput.value.toUpperCase();

                    if (curpRegex.test(curpInput.value)) {
                      curpInput.classList.remove("is-invalid");
                      curpInput.classList.add("is-valid");
                    } else {
                      curpInput.classList.remove("is-valid");
                      curpInput.classList.add("is-invalid");
                    }
                  });
                }

                if (form) {
                  form.addEventListener("submit", (e) => {
                    if (!curpRegex.test(curpInput.value)) {
                      e.preventDefault(); // No envía si no es válido
                      curpInput.classList.add("is-invalid");
                    }
                  });
                }
              });
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>