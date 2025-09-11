<!-- app/views/members/index.php -->
<?php $base = rtrim(BASE_URL, '/'); ?>

<div class="container py-4">
    <h2 class="mb-4 text-center">Hermanos Registrados</h2>

    <div class="d-flex justify-content-end mb-3">
        <a href="<?= $base ?>/index.php?controller=members&action=create" class="btn btn-success">
            <i class="bi bi-person-plus-fill me-1"></i> Agregar nuevo miembro
        </a>
    </div>

    <div class="table-responsive shadow rounded">
        <table id="membersTable" class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($members)): ?>
                    <?php foreach ($members as $m): ?>
                        <tr>
                            <td><?= htmlspecialchars($m['nombres']) ?></td>
                            <td><?= htmlspecialchars($m['apellido_paterno'] . ' ' . $m['apellido_materno']) ?></td>
                            <td><?= htmlspecialchars($m['correo']) ?></td>
                            <td>
                                <a href="<?= $base ?>/index.php?controller=members&action=edit&id=<?= $m['id'] ?>"
                                    class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="<?= $base ?>/index.php?controller=members&action=delete&id=<?= $m['id'] ?>"
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('¿Seguro que deseas eliminar este registro?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">No hay registros disponibles</td>
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