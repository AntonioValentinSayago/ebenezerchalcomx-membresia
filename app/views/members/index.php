<div class="container py-4">
    <h2 class="mb-4 text-center">Hermanos Registrados</h2>

    <!-- Buscador en vivo -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Buscar hermano...">
    </div>

    <!-- Tabla responsiva -->
    <div class="table-responsive shadow rounded">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Edad</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Ocupación</th>
                    <th>Estado Civil</th>
                </tr>
            </thead>
            <tbody id="membersTable">
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
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">No hay registros disponibles</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // --- Buscador en vivo ---
    document.getElementById("searchInput").addEventListener("keyup", function () {
        const value = this.value.toLowerCase();
        const rows = document.querySelectorAll("#membersTable tr");
        rows.forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
        });
    });
</script>