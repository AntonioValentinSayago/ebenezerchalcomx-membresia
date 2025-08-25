
Proyecto: Registro de Miembros (PHP MVC + MySQL + Bootstrap 5)
Fecha: 2025-08-22

1) Crear base de datos:
   - Importa el archivo database.sql en tu MySQL.

2) Configurar conexión:
   - Edita app/config/config.php (DB_HOST, DB_NAME, DB_USER, DB_PASS, BASE_URL).

3) Servidor web:
   - Configura tu servidor para que 'public/' sea el DocumentRoot o visita /public/index.php.
   - Enrutamiento por query string: ?controller=members&action=create

4) Campos guardados:
   - 'talentos' se guarda como JSON en la columna talentos_json (separa con comas).

5) Seguridad:
   - Incluye protección CSRF y validaciones básicas.
   - Para producción considera sanitizar más entradas, usar HTTPS, y añadir autenticación.

6) Estilos:
   - Bootstrap 5 + estilos suaves (assets/css/custom.css).

¡Listo!
