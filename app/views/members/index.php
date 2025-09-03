<!-- app/views/index.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Hermanos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">

    <div class="container">
        <h2 class="mb-4">Hermanos Registrados</h2>

        <!-- Barra de búsqueda -->
        <input id="searchInput" type="text" class="form-control mb-3"
            placeholder="Buscar por nombre, correo, teléfono o CURP...">

        <!-- Tabla -->
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>CURP</th>
                </tr>
            </thead>
            <tbody id="membersTable">
                <?php foreach ($members as $m): ?>
                    <tr>
                        <td><?= htmlspecialchars($m['nombres'] . ' ' . $m['apellido_paterno'] . ' ' . $m['apellido_materno']) ?>
                        </td>
                        <td><?= htmlspecialchars($m['correo']) ?></td>
                        <td><?= htmlspecialchars($m['telefono']) ?></td>
                        <td><?= htmlspecialchars($m['curp']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        // --- Búsqueda en vivo ---
        document.addEventListener("DOMContentLoaded", () => {
            const searchInput = document.getElementById("searchInput");
            const rows = document.querySelectorAll("#membersTable tr");

            searchInput.addEventListener("keyup", () => {
                const query = searchInput.value.toLowerCase();
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(query) ? "" : "none";
                });
            });
        });
    </script>
</body>

</html>