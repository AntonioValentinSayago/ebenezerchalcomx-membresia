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
              <span class="text-danger text-bold">* Campos obligatorios</span> <br />
              <div class="row g-3" style="font-weight: bold;">
                <div class="col-md-6">
                  <label class="form-label form-section-title">Nombre(s) <span
                      class="text-danger text-bold">*</span></label>
                  <input required name="nombres" type="text" class="form-control form-control-lg"
                    value="<?= $val('nombres') ?>">
                  <div class="invalid-feedback">Requerido.</div>
                </div>
                <div class="col-md-6">
                  <label class="form-label form-section-title">Apellido paterno <span
                      class="text-danger text-bold">*</span></label>
                  <input required name="apellido_paterno" type="text" class="form-control form-control-lg"
                    value="<?= $val('apellido_paterno') ?>">
                  <div class="invalid-feedback">Requerido.</div>
                </div>
                <div class="col-md-6">
                  <label class="form-label form-section-title">Apellido materno <span
                      class="text-danger text-bold">*</span></label>
                  <input required name="apellido_materno" type="text" class="form-control form-control-lg"
                    value="<?= $val('apellido_materno') ?>">
                  <div class="invalid-feedback">Requerido.</div>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Fecha de Nacimiento <span class="text-danger text-bold">*</span></label>
                  <input required name="fecha_nacimiento" type="date" class="form-control" value="">
                  <div class="invalid-feedback">Requerido.</div>
                </div>

                <div class="col-md-3">
                  <label class="form-label">Edad <span class="text-danger text-bold">*</span></label>
                  <input required name="edad" type="number" min="0" max="120" class="form-control"
                    value="<?= $val('edad') ?>">
                  <div class="invalid-feedback">Edad inválida.</div>
                </div>

                <div class="col-md-3">
                  <label class="form-label">Bautizado <span class="text-danger text-bold">*</span></label>
                  <div class="form-check form-switch mt-1">
                    <input required name="bautizado" class="form-check-input" type="checkbox" <?= ($member->bautizado ?? 0) ? 'checked' : '' ?>>
                    <label class="form-check-label">Sí</label>
                  </div>
                </div>

                <div class="col-md-3">
                  <label class="form-label">Cobertura<span class="text-danger text-bold">*</span></label>
                  <div class="form-check form-switch mt-1">
                    <input required name="cobertura" class="form-check-input" type="checkbox" <?= ($member->cobertura ?? 0) ? 'checked' : '' ?>>
                    <label class="form-check-label">Sí</label>
                  </div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Nivel académico <span class="text-danger text-bold">*</span></label>
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
                  <label class="form-label">Ocupación <span class="text-danger text-bold">*</span></label>
                  <input required list="ocupaciones" name="ocupacion" class="form-control"
                    value="<?= $val('ocupacion') ?>" placeholder="Escribe o selecciona...">
                  <datalist id="ocupaciones">
                    <?php foreach ($ocupaciones as $op): ?>
                      <option value="<?= htmlspecialchars($op, ENT_QUOTES, 'UTF-8') ?>"></option>
                    <?php endforeach; ?>
                  </datalist>
                  <div class="form-hint text-muted" style="font-size: 10px;">Puedes escribir la tuya si no aparece.
                  </div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Fecha de conversión</label>
                  <input name="fecha_conversion" type="date" class="form-control"
                    value="<?= $val('fecha_conversion') ?>">
                  <div class="invalid-feedback">Requerido.</div>
                </div>


                <div class="col-md-12">
                  <label class="form-label" style="font-size: 14px;">Cursos teológicos y/o discipulados</label>
                  <input name="cursos" type="text" class="form-control" value="<?= $val('cursos') ?>"
                    placeholder="Ej.: Teología 1, Discipulado básico">
                  <div class="invalid-feedback">Requerido.</div>
                </div>

                <div class="col-12">
                  <label class="form-label">Talentos y virtudes (separa con comas) <span
                      class="text-danger text-bold">*</span></label>
                  <input required id="talentos" name="talentos" type="text" class="form-control"
                    value="<?= $val('talentos') ?>" placeholder="Ej.: canto, liderazgo, servicio, enseñanza">
                  <div id="talentosPreview" class="mt-2"></div>
                  <div class="invalid-feedback">Requerido.</div>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Departamentos</label>
                  <select name="ministerios[]" class="form-select" multiple>
                    <option value="Servidores">Servidores</option>
                    <option value="Adulam">Adulam</option>
                    <option value="Multimedia">Multimedia</option>
                    <option value="Bernabé">Bernabé</option>
                    <option value="Intercesión">Intercesión</option>
                    <option value="Cafetería">Cafetería</option>
                    <option value="Ebenekids">Ebenekids</option>
                    <option value="Clinica-Lucas">Clinica Lucas</option>
                    <option value="Audio">Audio</option>
                    <option value="Ujieres">Talento</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                  <input required name="correo" id="correo" type="email" class="form-control">
                  <div id="correo-feedback" class="invalid-feedback">Requerido.</div>
                </div>


                <div class="col-md-6">
                  <label class="form-label">Número telefónico <span class="text-danger text-bold">*</span></label>
                  <input required name="telefono" type="tel" class="form-control" value="<?= $val('telefono') ?>">
                  <div class="invalid-feedback">Requerido.</div>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Estado civil <span class="text-danger text-bold">*</span></label>
                  <select required name="estado_civil" class="form-select">
                    <?php foreach ($estadosCiviles as $op): ?>
                      <option value="<?= $op ?>" <?= (($member->estado_civil ?? '') === $op) ? 'selected' : '' ?>><?= $op ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                  <div class="invalid-feedback">Requerido.</div>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Género <span class="text-danger text-bold">*</span></label>
                  <select required name="genero" class="form-select">
                    <?php foreach ($generos as $op): ?>
                      <option value="<?= $op ?>" <?= (($member->genero ?? '') === $op) ? 'selected' : '' ?>><?= $op ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                  <div class="invalid-feedback">Requerido.</div>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Iglesia anterior</label>
                  <input name="iglesia_anterior" type="text" class="form-control"
                    value="<?= $val('iglesia_anterior') ?>">
                  <div class="invalid-feedback">Requerido.</div>
                </div>

                <div class="col-md-12">
                  <label class="form-label">Razón de salida</label>
                  <input name="razon_salida" type="text" class="form-control" value="<?= $val('razon_salida') ?>">
                </div>

                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck" style="font-weight: 100">
                      Al registrarte, aceptas nuestra Política de Privacidad, que describe cómo recopilamos, usamos y
                      protegemos tus datos.
                    </label>
                    <div class="invalid-feedback">
                      Para continuar, acepta que estas de acuerdo.
                    </div>
                  </div>
                </div>
              </div>

              <div class="d-flex align-items-center mt-4">
                <button class="btn btn-lg btn-success me-2" style="border-radius: 16px; width: 100%;">
                  <i class="bi bi-save me-1"></i> Guardar registro
                </button>
              </div>
            </form>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
                const correoInput = document.querySelector("input[name='correo']");
                const form = document.querySelector("form");

                const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                // --- Validación al enviar formulario ---
                if (form) {
                  form.addEventListener("submit", (e) => {
                    let valido = true;

                    if (correoInput && !correoRegex.test(correoInput.value)) {
                      correoInput.classList.add("is-invalid");
                      valido = false;
                    }

                    if (!valido) e.preventDefault();
                  });
                }

                // --- Validación CORREO ---
                if (correoInput) {
                  correoInput.addEventListener("input", () => {
                    if (correoRegex.test(correoInput.value)) {
                      correoInput.classList.remove("is-invalid");
                      correoInput.classList.add("is-valid");
                    } else {
                      correoInput.classList.remove("is-valid");
                      correoInput.classList.add("is-invalid");
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