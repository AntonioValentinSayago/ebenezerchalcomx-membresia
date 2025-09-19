<?php $base = rtrim(BASE_URL, '/'); ?>


<div class="alert alert-warning" role="alert">
  Hermano, registrado correctamente
</div>

<hr />

<div class="container py-4">
    <div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Advertencia</h4>
  <p> Información de los hermanos no disponible por motivos de Seguridas.</p>
  <hr>
  <p class="mb-0">Disponible más tarde.</p>
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
