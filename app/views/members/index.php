<!-- app/views/members/index.php -->
<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="container py-4">
    <h2 class="mb-4 text-center">Hermanos Registrados</h2>

    <!-- Tabla con DataTables -->
    <div class="table-responsive shadow rounded">
        <table id="membersTable" class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Edad</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Ocupación</th>
                    <th>Estado Civil</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($members)): ?>
                    <?php foreach ($members as $m): ?>
                        <tr>
                            <td><?= htmlspecialchars($m['nombres']) ?></td>
                            <td><?= htmlspecialchars($m['apellido_paterno'] . ' ' . $m['apellido_materno']) ?></td>
                            <td><?= htmlspecialchars($m['edad']) ?></td>
                            <td><?= htmlspecialchars($m['correo']) ?></td>
                            <td><?= htmlspecialchars($m['telefono']) ?></td>
                            <td><?= htmlspecialchars($m['ocupacion']) ?></td>
                            <td><?= htmlspecialchars($m['estado_civil']) ?></td>
                            <td>
                                <a href="<?= $base ?>/index.php?controller=members&action=edit&id=<?= $m['id'] ?>"
                                    class="btn btn-sm btn-primary">Editar</a>
                                <a href="<?= $base ?>/index.php?controller=members&action=delete&id=<?= $m['id'] ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Seguro que deseas eliminar este registro?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted">No hay registros disponibles</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Scripts de DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        $("#membersTable").DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
            },
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            columnDefs: [
                { orderable: false, targets: -1 } // Acciones no ordenables
            ]
        });
    });
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>