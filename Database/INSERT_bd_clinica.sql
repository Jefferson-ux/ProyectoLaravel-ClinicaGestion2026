USE bd_clinica;

-- Desactivamos restricciones temporalmente para un vaciado limpio si es necesario
SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE pagos;

TRUNCATE TABLE recetas;

TRUNCATE TABLE citas;

TRUNCATE TABLE pacientes;

TRUNCATE TABLE doctores;

TRUNCATE TABLE especialidades;

SET FOREIGN_KEY_CHECKS = 1;

-- ==========================================
-- 1. INSERTS PARA LA TABLA: especialidades
-- ==========================================
INSERT INTO
    especialidades (
        nombre,
        descripcion,
        estado,
        created_at,
        updated_at
    )
VALUES (
        'Medicina General',
        'Atención médica primaria y preventiva para toda la familia',
        1,
        NOW(),
        NOW()
    ),
    (
        'Pediatría',
        'Cuidado médico especializado para bebés, niños y adolescentes',
        1,
        NOW(),
        NOW()
    ),
    (
        'Ginecología y Obstetricia',
        'Salud del sistema reproductor femenino y control del embarazo',
        1,
        NOW(),
        NOW()
    ),
    (
        'Dermatología',
        'Diagnóstico y tratamiento de enfermedades de la piel, cabello y uñas',
        1,
        NOW(),
        NOW()
    ),
    (
        'Oftalmología',
        'Cuidado de la visión, medida de la vista y cirugías oculares',
        1,
        NOW(),
        NOW()
    ),
    (
        'Traumatología',
        'Lesiones del aparato locomotor, huesos, articulaciones y músculos',
        1,
        NOW(),
        NOW()
    ),
    (
        'Cardiología',
        'Prevención, diagnóstico y tratamiento de enfermedades del corazón',
        1,
        NOW(),
        NOW()
    ),
    (
        'Especialidad Antigua',
        'Esta especialidad ya no se ofrece en la clínica',
        0,
        NOW(),
        NOW()
    );
-- Registro Inactivo para pruebas

-- ==========================================
-- 2. INSERTS PARA LA TABLA: doctores
-- ==========================================
INSERT INTO
    doctores (
        dni,
        nombres,
        apellidos,
        telefono,
        correo,
        id_especialidad,
        estado,
        created_at,
        updated_at
    )
VALUES (
        '45781234',
        'Carlos',
        'Mendoza Ruiz',
        '943123456',
        'carlos.mendoza@medacare.com',
        1,
        1,
        NOW(),
        NOW()
    ),
    (
        '10234567',
        'Ana',
        'Gutiérrez Falcon',
        '943789012',
        'ana.gutierrez@medacare.com',
        2,
        1,
        NOW(),
        NOW()
    ),
    (
        '32984512',
        'Sofía',
        'Benites Alva',
        '943456789',
        'sofia.benites@medacare.com',
        3,
        1,
        NOW(),
        NOW()
    ),
    (
        '70124598',
        'Diego',
        'Torres Luna',
        '943234567',
        'diego.torres@medacare.com',
        4,
        1,
        NOW(),
        NOW()
    ),
    (
        '41152637',
        'Manuel',
        'Ramos Castillo',
        '943345678',
        'manuel.ramos@medacare.com',
        5,
        1,
        NOW(),
        NOW()
    ),
    (
        '09871234',
        'Héctor',
        'Chunga Palacios',
        '943901234',
        'hector.chunga@medacare.com',
        6,
        1,
        NOW(),
        NOW()
    ),
    (
        '25634719',
        'Laura',
        'Villar Real',
        '943567890',
        'laura.villar@medacare.com',
        7,
        1,
        NOW(),
        NOW()
    ),
    (
        '44332211',
        'Juan',
        'Pérez Exmédico',
        '943000111',
        'juan.perez@medacare.com',
        1,
        0,
        NOW(),
        NOW()
    );
-- Registro Inactivo para pruebas

-- ==========================================
-- 3. INSERTS PARA LA TABLA: pacientes
-- ==========================================
INSERT INTO
    pacientes (
        dni,
        nombres,
        apellidos,
        fecha_nacimiento,
        telefono,
        direccion,
        correo,
        estado,
        created_at,
        updated_at
    )
VALUES (
        '32975142',
        'Luis',
        'Sánchez Flores',
        '1985-04-12',
        '956123456',
        'Av. Pardo 1420, Chimbote',
        'luis.sanchez@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        '45789632',
        'María',
        'Córdova Vega',
        '1992-08-25',
        '956789012',
        'Urb. Casuarinas Mz B Lote 5, Nuevo Chimbote',
        'maria.cordova@hotmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        '70256314',
        'Kevin',
        'Villanueva Baca',
        '2018-11-03',
        '956456789',
        'Jr. Elías Aguirre 540, Chimbote',
        'padre.kevin@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        '10254879',
        'Elena',
        'Pazos Merino',
        '1974-01-30',
        '956234567',
        'P.J. San Pedro Mz F Lote 12, Chimbote',
        'elena.pazos@outlook.com',
        1,
        NOW(),
        NOW()
    ),
    (
        '48596321',
        'Jorge',
        'Espinoza Díaz',
        '1960-06-15',
        '956345678',
        'Av. Argentina 455, Nuevo Chimbote',
        'jorge.espinoza@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        '32841596',
        'Carmen',
        'Rosales Olivos',
        '2000-10-22',
        '956901234',
        'Urb. Buenos Aires Calle 3, Nuevo Chimbote',
        'carmen.rosales@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        '75142639',
        'Pedro',
        'Bailón Castro',
        '1995-03-05',
        '956567890',
        'Jr. Ladislao Espinar 210, Chimbote',
        'pedro.bailon@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        '00112233',
        'Paciente',
        'De Baja Prueba',
        '1990-01-01',
        '956000111',
        'Dirección Antigua',
        'prueba@gmail.com',
        0,
        NOW(),
        NOW()
    );
-- Registro Inactivo para pruebas

-- ==========================================
-- 4. INSERTS PARA LA TABLA: citas
-- ==========================================
INSERT INTO
    citas (
        id_paciente,
        id_doctor,
        fecha,
        hora,
        motivo,
        estado,
        created_at,
        updated_at
    )
VALUES
    -- Citas Atendidas (Generarán Recetas y Pagos de inmediato)
    (
        1,
        1,
        '2026-05-25',
        '08:00:00',
        'Control anual de presión arterial y fatiga',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        3,
        2,
        '2026-05-25',
        '09:30:00',
        'Fiebre persistente y tos seca en el menor',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        2,
        3,
        '2026-05-26',
        '10:00:00',
        'Control prenatal de rutina ecográfica',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        4,
        4,
        '2026-05-26',
        '15:30:00',
        'Alergia cutánea severa en los brazos',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        5,
        5,
        '2026-05-27',
        '11:00:00',
        'Disminución de agudeza visual ojo izquierdo',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        6,
        6,
        '2026-05-27',
        '16:00:00',
        'Dolor agudo en la rodilla post-caída casual',
        'ATENDIDO',
        NOW(),
        NOW()
    ),

-- Citas Canceladas (Generarán Pagos en estado ANULADO para auditoría de caja)
(
    7,
    7,
    '2026-05-28',
    '09:00:00',
    'Arritmias cardiacas esporádicas nocturnas',
    'CANCELADO',
    NOW(),
    NOW()
),
(
    2,
    1,
    '2026-05-28',
    '14:30:00',
    'Revisión de resultados de laboratorio de sangre',
    'CANCELADO',
    NOW(),
    NOW()
),

-- Citas Pendientes (No tienen Receta ni Pago, simulan la agenda futura de la clínica)
(
    1,
    4,
    '2026-06-01',
    '08:30:00',
    'Revisión de lunares sospechosos en la espalda',
    'PENDIENTE',
    NOW(),
    NOW()
),
(
    4,
    6,
    '2026-06-01',
    '10:30:00',
    'Control post-esguince de tobillo leve',
    'PENDIENTE',
    NOW(),
    NOW()
),
(
    5,
    7,
    '2026-06-02',
    '16:30:00',
    'Evaluación neurológica por hormigueo recurrente',
    'PENDIENTE',
    NOW(),
    NOW()
);

-- ==========================================
-- 5. INSERTS PARA LA TABLA: recetas
-- ==========================================
-- Solo vinculadas a las Citas Atendidas (IDs: 1, 2, 3, 4, 5, 6)
-- Las recetas se pueden editar según las reglas, pero nunca eliminar.
INSERT INTO
    recetas (
        id_cita,
        descripcion,
        medicamentos,
        recomendaciones,
        created_at,
        updated_at
    )
VALUES (
        1,
        'Paciente con hipertensión arterial estadio 1 controlada.',
        'Losartán 50mg - 1 tableta cada 24 horas por 30 días.\nHidroclorotiazida 12.5mg - 1 tableta por la mañana por 15 días.',
        'Reducir el consumo de sodio, realizar caminatas de 30 minutos diarias y agendar control en un mes.',
        NOW(),
        NOW()
    ),
    (
        2,
        'Faringitis aguda de origen bacteriano.',
        'Amoxicilina + Ácido Clavulánico 400mg susp. - 5ml cada 12 horas por 7 días.\nParacetamol 120mg/5ml - 6ml cada 6 horas si presenta fiebre mayor a 38°C.',
        'Abundante hidratación, guardar reposo escolar por 3 días y evitar bebidas heladas.',
        NOW(),
        NOW()
    ),
    (
        3,
        'Gestante de 24 semanas con evolución fetal normoevolutiva.',
        'Sulfato Ferroso 300mg - 1 tableta diaria en ayunas.\nÁcido Fólico 5mg - 1 tableta diaria.',
        'Continuar con dieta balanceada rica en hierro, acudir a su ecografía morfológica la próxima semana.',
        NOW(),
        NOW()
    ),
    (
        4,
        'Dermatitis por contacto de origen alérgico (posible jabón industrial).',
        'Cetirizina 10mg - 1 tableta por las noches por 10 días.\nCremicort (Hidrocortisona al 1%) - Aplicar capa delgada cada 12 horas por 5 días.',
        'Suspender uso de jabones con fragancia, usar ropa de algodón suelta y no rascar las lesiones.',
        NOW(),
        NOW()
    ),
    (
        5,
        'Astigmatismo miópico y presbicia en incremento.',
        'No aplica medicamentos farmacológicos corporales.\nGotas lubricantes oftálmicas (Lágrimas artificiales) - 1 gota cada 6 horas en ambos ojos.',
        'Uso permanente de lentes correctores con filtro azul para pantallas, descanso visual cada 50 minutos.',
        NOW(),
        NOW()
    ),
    (
        6,
        'Traumatismo leve de rodilla derecha sin evidencia de fractura ósea.',
        'Ibuprofeno 400mg - 1 tableta cada 8 horas después de los alimentos por 5 días.\nGastropromex (Omeprazol 20mg) - 1 cápsula en ayunas por 5 días.',
        'Aplicar compresas frías por 15 minutos tres veces al día, mantener la pierna elevada y reposo relativo.',
        NOW(),
        NOW()
    );

-- ==========================================
-- 6. INSERTS PARA LA TABLA: pagos
-- ==========================================
-- Incluye transacciones para Citas Atendidas (PAGADO) y Citas Canceladas (ANULADO)
-- Los pagos no se editan ni se eliminan, mantienen la correlatividad estricta de caja.
INSERT INTO
    pagos (
        id_cita,
        monto,
        fecha_pago,
        metodo_pago,
        estado,
        created_at,
        updated_at
    )
VALUES
    -- Pagos Válidos ingresados a Caja
    (
        1,
        50.00,
        '2026-05-25',
        'EFECTIVO',
        'PAGADO',
        NOW(),
        NOW()
    ),
    (
        2,
        70.00,
        '2026-05-25',
        'YAPE',
        'PAGADO',
        NOW(),
        NOW()
    ),
    (
        3,
        100.00,
        '2026-05-26',
        'TARJETA',
        'PAGADO',
        NOW(),
        NOW()
    ),
    (
        4,
        80.00,
        '2026-05-26',
        'PLIN',
        'PAGADO',
        NOW(),
        NOW()
    ),
    (
        5,
        60.00,
        '2026-05-27',
        'TRANSFERENCIA',
        'PAGADO',
        NOW(),
        NOW()
    ),
    (
        6,
        90.00,
        '2026-05-27',
        'EFECTIVO',
        'PAGADO',
        NOW(),
        NOW()
    ),

-- Pagos de Citas Canceladas (Quedan grabados como ANULADOS por el Administrador para evitar fraudes)
(
    7,
    120.00,
    '2026-05-28',
    'TARJETA',
    'ANULADO',
    NOW(),
    NOW()
), -- Cita cancelada, dinero devuelto / transacción reversada
(
    8,
    50.00,
    '2026-05-28',
    'EFECTIVO',
    'ANULADO',
    NOW(),
    NOW()
);
-- Cita cancelada antes de ingresar a consulta