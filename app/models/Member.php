<?php
// app/models/Member.php

class Member
{
    public $id; // ← Agrega esta línea ✅
    public $nombres;
    public $apellido_paterno;
    public $apellido_materno;
    public $edad;
    public $fecha_nacimiento;
    public $curp;
    public $bautizado;
    public $cobertura;
    public $nivel_academico;
    public $fecha_conversion;
    public $ocupacion;
    public $cursos;
    public $iglesia_anterior;
    public $razon_salida;
    public $talentos; // cadena separada por comas
    public $ministerios;

    public $correo;
    public $telefono;
    public $tipo_sangre;
    public $estado_civil;
    public $genero;

    public function __construct($data = [])
    {
        $this->nombres = trim($data['nombres'] ?? '');
        $this->apellido_paterno = trim($data['apellido_paterno'] ?? '');
        $this->apellido_materno = trim($data['apellido_materno'] ?? '');
        $this->edad = isset($data['edad']) ? (int) $data['edad'] : null;
        $this->fecha_nacimiento = $data['fecha_nacimiento'] ?? null;
        $this->curp = isset($data['curp']) ? strtoupper(trim($data['curp'])) : '';
        $this->bautizado = isset($data['bautizado']) ? 1 : 0;
        $this->cobertura = isset($data['cobertura']) ? 1 : 0;
        $this->nivel_academico = trim($data['nivel_academico'] ?? '');
        $this->fecha_conversion = $data['fecha_conversion'] ?? null;
        $this->ocupacion = trim($data['ocupacion'] ?? '');
        $this->cursos = trim($data['cursos'] ?? '');
        $this->iglesia_anterior = trim($data['iglesia_anterior'] ?? '');
        $this->razon_salida = trim($data['razon_salida'] ?? '');
        $this->talentos = trim($data['talentos'] ?? '');
        $this->ministerios = isset($data['ministerios']) ? json_encode($data['ministerios'], JSON_UNESCAPED_UNICODE) : json_encode([]);
        $this->correo = trim($data['correo'] ?? '');
        $this->telefono = trim($data['telefono'] ?? '');
        $this->tipo_sangre = trim($data['tipo_sangre'] ?? '');
        $this->estado_civil = trim($data['estado_civil'] ?? '');
        $this->genero = trim($data['genero'] ?? '');
    }

    public static function occupations()
    {
        return [
            'Administrador/a', 'Abogado/a', 'Actor/Actriz', 'Agente de seguros', 'Agricultor/a',
            'Albañil', 'Almacenista', 'Analista de datos', 'Arquitecto/a', 'Artesano/a',
            'Asistente administrativo', 'Barbero', 'Bibliotecario/a', 'Biólogo/a', 'Bombero',
            'Cajero/a', 'Carpintero/a', 'Chef', 'Chofer', 'Científico/a', 'Comerciante',
            'Comunicólogo/a', 'Contador/a', 'Costurero/a', 'Dentista', 'Desarrollador/a de software',
            'Diseñador/a gráfico', 'Docente/Profesor/a', 'Electricista', 'Enfermero/a',
            'Entrenador/a', 'Estudiante', 'Farmacéutico/a', 'Fotógrafo/a', 'Gerente',
            'Ingeniero/a civil', 'Ingeniero/a industrial', 'Ingeniero/a sistemas', 'Inspector/a',
            'Jardinero/a', 'Jornalero/a', 'Mecánico/a', 'Médico/a', 'Mesero/a', 'Músico/a',
            'Panadero/a', 'Pastor/a', 'Peluquero/a', 'Periodista', 'Pescador/a', 'Plomero',
            'Policía', 'Psicólogo/a', 'Publicista', 'Recepcionista', 'Repartidor/a', 'Soldador/a',
            'Técnico/a', 'Traductor/a', 'Vendedor/a', 'Veterinario/a', 'Ama de casa', 'Otro'
        ];
    }

    public static function educationLevels()
    {
        return ['', 'Sin escolaridad', 'Primaria', 'Secundaria', 'Preparatoria/Bachillerato', 'Técnico', 'Licenciatura', 'Maestría', 'Doctorado', 'Otro'];
    }

    public static function bloodTypes()
    {
        return ['', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'No sabe'];
    }

    public static function maritalStatuses()
    {
        return ['', 'Soltero/a', 'Casado/a', 'Unión libre', 'Divorciado/a', 'Viudo/a', 'Separado/a'];
    }

    public static function genders()
    {
        return ['', 'Femenino', 'Masculino'];
    }

    public function validate()
    {
        $errors = [];
        if ($this->nombres === '') $errors[] = 'El nombre es obligatorio.';
        if ($this->apellido_paterno === '') $errors[] = 'El apellido paterno es obligatorio.';
        if (!empty($this->correo) && !filter_var($this->correo, FILTER_VALIDATE_EMAIL)) $errors[] = 'Correo electrónico inválido.';
        if ($this->edad !== null && ($this->edad < 0 || $this->edad > 120)) $errors[] = 'Edad fuera de rango.';
        if ($this->fecha_conversion && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $this->fecha_conversion)) $errors[] = 'Fecha de conversión inválida.';
        if ($this->fecha_nacimiento && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $this->fecha_nacimiento)) $errors[] = 'Fecha de nacimiento inválida.';
        return $errors;
    }

    public function save()
    {
        $pdo = Database::getInstance()->getConnection();
        $talentosArray = array_values(array_filter(array_map('trim', explode(',', $this->talentos)), fn($v) => $v !== ''));

        $sql = "INSERT INTO members
        (nombres, apellido_paterno, apellido_materno, edad, curp, bautizado, cobertura, nivel_academico, fecha_conversion, fecha_nacimiento, ocupacion,
        cursos, iglesia_anterior, razon_salida, talentos_json, ministerios_json, correo, telefono, tipo_sangre, estado_civil, genero, created_at)
        VALUES
        (:nombres, :apellido_paterno, :apellido_materno, :edad, :curp, :bautizado, :cobertura, :nivel_academico, :fecha_conversion, :fecha_nacimiento, :ocupacion,
        :cursos, :iglesia_anterior, :razon_salida, :talentos_json, :ministerios_json, :correo, :telefono, :tipo_sangre, :estado_civil, :genero, NOW())";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':nombres' => $this->nombres,
            ':apellido_paterno' => $this->apellido_paterno,
            ':apellido_materno' => $this->apellido_materno,
            ':edad' => $this->edad,
            ':curp' => $this->curp,
            ':bautizado' => $this->bautizado,
            ':cobertura' => $this->cobertura,
            ':nivel_academico' => $this->nivel_academico,
            ':fecha_conversion' => $this->fecha_conversion ?: null,
            ':fecha_nacimiento' => $this->fecha_nacimiento ?: null,
            ':ocupacion' => $this->ocupacion,
            ':cursos' => $this->cursos,
            ':iglesia_anterior' => $this->iglesia_anterior,
            ':razon_salida' => $this->razon_salida,
            ':talentos_json' => json_encode($talentosArray, JSON_UNESCAPED_UNICODE),
            ':ministerios_json' => $this->ministerios,
            ':correo' => !empty($this->correo) ? $this->correo : null,
            ':telefono' => $this->telefono,
            ':tipo_sangre' => $this->tipo_sangre,
            ':estado_civil' => $this->estado_civil,
            ':genero' => $this->genero,
        ]);
    }

    public function update($id)
    {
        $pdo = Database::getInstance()->getConnection();
        $talentosArray = array_values(array_filter(array_map('trim', explode(',', $this->talentos)), fn($v) => $v !== ''));

        $sql = "UPDATE members SET
            nombres = :nombres,
            apellido_paterno = :apellido_paterno,
            apellido_materno = :apellido_materno,
            edad = :edad,
            curp = :curp,
            bautizado = :bautizado,
            cobertura = :cobertura,
            nivel_academico = :nivel_academico,
            fecha_conversion = :fecha_conversion,
            fecha_nacimiento = :fecha_nacimiento,
            ocupacion = :ocupacion,
            cursos = :cursos,
            iglesia_anterior = :iglesia_anterior,
            razon_salida = :razon_salida,
            talentos_json = :talentos_json,
            ministerios_json = :ministerios_json,
            correo = :correo,
            telefono = :telefono,
            tipo_sangre = :tipo_sangre,
            estado_civil = :estado_civil,
            genero = :genero
        WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':nombres' => $this->nombres,
            ':apellido_paterno' => $this->apellido_paterno,
            ':apellido_materno' => $this->apellido_materno,
            ':edad' => $this->edad,
            ':curp' => $this->curp,
            ':bautizado' => $this->bautizado,
            ':cobertura' => $this->cobertura,
            ':nivel_academico' => $this->nivel_academico,
            ':fecha_conversion' => $this->fecha_conversion ?: null,
            ':fecha_nacimiento' => $this->fecha_nacimiento ?: null,
            ':ocupacion' => $this->ocupacion,
            ':cursos' => $this->cursos,
            ':iglesia_anterior' => $this->iglesia_anterior,
            ':razon_salida' => $this->razon_salida,
            ':talentos_json' => json_encode($talentosArray, JSON_UNESCAPED_UNICODE),
            ':ministerios_json' => $this->ministerios,
            ':correo' => !empty($this->correo) ? $this->correo : null,
            ':telefono' => $this->telefono,
            ':tipo_sangre' => $this->tipo_sangre,
            ':estado_civil' => $this->estado_civil,
            ':genero' => $this->genero,
            ':id' => $id
        ]);
    }

    public static function delete($id)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("DELETE FROM members WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public static function findById($id)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM members WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new Member($data) : null;
    }

    public function getAll()
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->query("SELECT * FROM members ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
