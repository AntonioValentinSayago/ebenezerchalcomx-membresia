<div class="container mt-5">
    <h2 class="mb-4">
        <?= empty($member->id) ? 'Registrar nuevo miembro' : 'Editar miembro' ?>
    </h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= $action ?>" class="needs-validation" novalidate>
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
        <?php if (!empty($member->id)): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($member->id) ?>">
        <?php endif; ?>

        <!-- Nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                value="<?= htmlspecialchars($member->nombre ?? '') ?>" required>
        </div>

        <!-- Apellido -->
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido"
                value="<?= htmlspecialchars($member->apellido ?? '') ?>" required>
        </div>

        <!-- Correo -->
        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo"
                value="<?= htmlspecialchars($member->correo ?? '') ?>" required>
        </div>

        <!-- CURP -->
        <div class="mb-3">
            <label for="curp" class="form-label">CURP</label>
            <input type="text" class="form-control" id="curp" name="curp"
                value="<?= htmlspecialchars($member->curp ?? '') ?>">
        </div>

        <!-- Ocupación -->
        <div class="mb-3">
            <label for="ocupacion" class="form-label">Ocupación</label>
            <select class="form-select" id="ocupacion" name="ocupacion" required>
                <option value="">Seleccione...</option>
                <?php foreach ($ocupaciones as $op): ?>
                    <option value="<?= htmlspecialchars($op) ?>" <?= ($member->ocupacion ?? '') === $op ? 'selected' : '' ?>>
                        <?= htmlspecialchars($op) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Nivel educativo -->
        <div class="mb-3">
            <label for="nivel_educativo" class="form-label">Nivel educativo</label>
            <select class="form-select" id="nivel_educativo" name="nivel_educativo" required>
                <option value="">Seleccione...</option>
                <?php foreach ($niveles as $op): ?>
                    <option value="<?= htmlspecialchars($op) ?>" <?= ($member->nivel_educativo ?? '') === $op ? 'selected' : '' ?>>
                        <?= htmlspecialchars($op) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Estado civil -->
        <div class="mb-3">
            <label for="estado_civil" class="form-label">Estado civil</label>
            <select class="form-select" id="estado_civil" name="estado_civil" required>
                <option value="">Seleccione...</option>
                <?php foreach ($estadosCiviles as $op): ?>
                    <option value="<?= htmlspecialchars($op) ?>" <?= ($member->estado_civil ?? '') === $op ? 'selected' : '' ?>>
                        <?= htmlspecialchars($op) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Sangre -->
        <div class="mb-3">
            <label for="tipo_sangre" class="form-label">Tipo de sangre</label>
            <select class="form-select" id="tipo_sangre" name="tipo_sangre">
                <option value="">Seleccione...</option>
                <?php foreach ($tiposSangre as $op): ?>
                    <option value="<?= htmlspecialchars($op) ?>" <?= ($member->tipo_sangre ?? '') === $op ? 'selected' : '' ?>>
                        <?= htmlspecialchars($op) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Género -->
        <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <select class="form-select" id="genero" name="genero" required>
                <option value="">Seleccione...</option>
                <?php foreach ($generos as $op): ?>
                    <option value="<?= htmlspecialchars($op) ?>" <?= ($member->genero ?? '') === $op ? 'selected' : '' ?>>
                        <?= htmlspecialchars($op) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Botón -->
        <button type="submit" class="btn btn-lg btn-success">
            <i class="bi bi-save"></i>
            <?= empty($member->id) ? 'Guardar registro' : 'Actualizar registro' ?>
        </button>

        <!-- Link de regreso -->
        <a href="<?= $base ?>/index.php?controller=members&action=index" class="btn btn-secondary btn-lg">
            <i class="bi bi-arrow-left"></i> Regresar a la lista
        </a>
    </form>
</div>