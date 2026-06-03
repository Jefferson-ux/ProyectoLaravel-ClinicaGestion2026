USE bd_clinica;

-- Limpieza total previa
SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE pagos;

TRUNCATE TABLE recetas;

TRUNCATE TABLE citas;

TRUNCATE TABLE pacientes;

TRUNCATE TABLE doctores;

TRUNCATE TABLE especialidades;

SET FOREIGN_KEY_CHECKS = 1;

-- ==========================================
-- 1. ESPECIALIDADES (6 registros)
-- ==========================================
INSERT INTO
    especialidades (
        id,
        nombre,
        descripcion,
        estado,
        created_at,
        updated_at
    )
VALUES (
        1,
        'Medicina General',
        'Atención médica primaria y preventiva',
        1,
        NOW(),
        NOW()
    ),
    (
        2,
        'Pediatría',
        'Cuidado médico especializado para niños',
        1,
        NOW(),
        NOW()
    ),
    (
        3,
        'Ginecología',
        'Salud del sistema reproductor femenino',
        1,
        NOW(),
        NOW()
    ),
    (
        4,
        'Dermatología',
        'Enfermedades de la piel, cabello y uñas',
        1,
        NOW(),
        NOW()
    ),
    (
        5,
        'Oftalmología',
        'Cuidado de la visión y medida de la vista',
        1,
        NOW(),
        NOW()
    ),
    (
        6,
        'Cardiología',
        'Enfermedades del corazón y sistema circulatorio',
        1,
        NOW(),
        NOW()
    );

-- ==========================================
-- 2. DOCTORES (24 registros - 4 por especialidad)
-- ==========================================
INSERT INTO
    doctores (
        id,
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
VALUES
    -- Medicina General (id_especialidad: 1)
    (
        1,
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
        2,
        '12345678',
        'Andrés',
        'Soto Palacios',
        '943111222',
        'andres.soto@medacare.com',
        1,
        1,
        NOW(),
        NOW()
    ),
    (
        3,
        '87654321',
        'Marina',
        'Vega Delgado',
        '943333444',
        'marina.vega@medacare.com',
        1,
        1,
        NOW(),
        NOW()
    ),
    (
        4,
        '23456789',
        'Jorge',
        'Campos Leyva',
        '943555666',
        'jorge.campos@medacare.com',
        1,
        1,
        NOW(),
        NOW()
    ),
    -- Pediatría (id_especialidad: 2)
    (
        5,
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
        6,
        '34567890',
        'Enrique',
        'Paredes Tello',
        '943222333',
        'enrique.paredes@medacare.com',
        2,
        1,
        NOW(),
        NOW()
    ),
    (
        7,
        '45678901',
        'Lucía',
        'Fernández Ríos',
        '943444555',
        'lucia.fernandez@medacare.com',
        2,
        1,
        NOW(),
        NOW()
    ),
    (
        8,
        '56789012',
        'Alberto',
        'Quispe Marín',
        '943666777',
        'alberto.quispe@medacare.com',
        2,
        1,
        NOW(),
        NOW()
    ),
    -- Ginecología (id_especialidad: 3)
    (
        9,
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
        10,
        '67890123',
        'Ricardo',
        'Vargas Luna',
        '943888999',
        'ricardo.vargas@medacare.com',
        3,
        1,
        NOW(),
        NOW()
    ),
    (
        11,
        '78901234',
        'Elena',
        'Cáceda Cruz',
        '943999000',
        'elena.caceda@medacare.com',
        3,
        1,
        NOW(),
        NOW()
    ),
    (
        12,
        '89012345',
        'Hugo',
        'Morales Bazán',
        '943111333',
        'hugo.morales@medacare.com',
        3,
        1,
        NOW(),
        NOW()
    ),
    -- Dermatología (id_especialidad: 4)
    (
        13,
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
        14,
        '90123456',
        'Clara',
        'Zavaleta Ortiz',
        '943444666',
        'clara.zavaleta@medacare.com',
        4,
        1,
        NOW(),
        NOW()
    ),
    (
        15,
        '01234567',
        'Oscar',
        'Miranda Vigo',
        '943777888',
        'oscar.miranda@medacare.com',
        4,
        1,
        NOW(),
        NOW()
    ),
    (
        16,
        '11223344',
        'Patricia',
        'Ganoza Reyna',
        '943222555',
        'patricia.ganoza@medacare.com',
        4,
        1,
        NOW(),
        NOW()
    ),
    -- Oftalmología (id_especialidad: 5)
    (
        17,
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
        18,
        '22334455',
        'Rosa',
        'Fuentes Solís',
        '943888111',
        'rosa.fuentes@medacare.com',
        5,
        1,
        NOW(),
        NOW()
    ),
    (
        19,
        '33445566',
        'Fernando',
        'Tirado Saavedra',
        '943999222',
        'fernando.tirado@medacare.com',
        5,
        1,
        NOW(),
        NOW()
    ),
    (
        20,
        '44556677',
        'Gabriela',
        'Guerra Peña',
        '943777333',
        'gabriela.guerra@medacare.com',
        5,
        1,
        NOW(),
        NOW()
    ),
    -- Cardiología (id_especialidad: 6)
    (
        21,
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
        22,
        '55667788',
        'Silvia',
        'Mesta Novoa',
        '943555111',
        'silvia.mesta@medacare.com',
        6,
        1,
        NOW(),
        NOW()
    ),
    (
        23,
        '66778899',
        'Javier',
        'Blas Agurto',
        '943444222',
        'javier.blas@medacare.com',
        6,
        1,
        NOW(),
        NOW()
    ),
    (
        24,
        '77889900',
        'Beatriz',
        'Lázaro Vila',
        '943333111',
        'beatriz.lazaro@medacare.com',
        6,
        1,
        NOW(),
        NOW()
    );

-- ==========================================
-- 3. PACIENTES (35 registros)
-- ==========================================
INSERT INTO
    pacientes (
        id,
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
        1,
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
        2,
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
        3,
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
        4,
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
        5,
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
        6,
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
        7,
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
        8,
        '44112233',
        'Raúl',
        'Zavaleta Cueva',
        '1988-07-19',
        '956111001',
        'Urb. La Caleta Mz A Lote 2',
        'raul.zav@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        9,
        '44223344',
        'Julia',
        'Sifuentes Paredes',
        '1995-12-02',
        '956222002',
        'P.J. El Progreso Jr. Ica 120',
        'julia.sif@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        10,
        '44334455',
        'Tomás',
        'Arias Gonzales',
        '2015-05-14',
        '956333003',
        'Urb. Garatea Mz E Lote 40, Nuevo Chimbote',
        'tomas.arias@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        11,
        '44445566',
        'Rosa',
        'Flores Malca',
        '1967-09-21',
        '956444004',
        'Av. Pacifico 740, Nuevo Chimbote',
        'rosa.flores@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        12,
        '44556677',
        'César',
        'Huamán Jara',
        '1979-03-11',
        '956555005',
        'Jr. Tumbes 315, Chimbote',
        'cesar.huaman@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        13,
        '44667788',
        'Alicia',
        'Montero Ríos',
        '1993-11-08',
        '956666006',
        'Urb. Banchero Rossi Mz C Lote 12',
        'alicia.montero@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        14,
        '44778899',
        'Félix',
        'Guerrero Neira',
        '1955-01-24',
        '956777007',
        'P.J. Tres de Octubre Mz H Lote 5',
        'felix.guerrero@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        15,
        '44889900',
        'Isabel',
        'Benites Soto',
        '2002-06-30',
        '956888008',
        'Urb. Las Gardenias Calle Los Lirios 140',
        'isabel.benites@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        16,
        '55112233',
        'Víctor',
        'Sáenz Torres',
        '1984-02-17',
        '956999009',
        'Av. Meiggs 1050, Chimbote',
        'victor.saenz@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        17,
        '55223344',
        'Diana',
        'Campos Ruiz',
        '1991-10-05',
        '956111222',
        'Urb. San Rafael Mz O Lote 18',
        'diana.campos@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        18,
        '55334455',
        'Gabriel',
        'Vigo Alva',
        '2019-04-12',
        '956222333',
        'Jr. Leoncio Prado 620, Chimbote',
        'gabriel.vigo@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        19,
        '55445566',
        'Sara',
        'Mendoza Falcon',
        '1972-08-29',
        '956333444',
        'Urb. Los Heroes Mz A Lote 7',
        'sara.mendoza@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        20,
        '55556677',
        'Daniel',
        'Cabrera Luna',
        '1963-12-14',
        '956444555',
        'Av. Country 280, Nuevo Chimbote',
        'daniel.cabrera@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        21,
        '55667788',
        'Olga',
        'Ramos Castillo',
        '1998-05-22',
        '956555666',
        'Urb. Bella Mar Mz F Lote 22',
        'olga.ramos@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        22,
        '55778899',
        'Manuel',
        'Villar Real',
        '1990-03-09',
        '956666777',
        'Jr. Palacios 145, Chimbote',
        'manuel.villar@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        23,
        '55889900',
        'Clara',
        'Chunga Palacios',
        '2012-07-01',
        '956777888',
        'P.J. San Juan Mz I Lote 3',
        'clara.chunga@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        24,
        '66112233',
        'Humberto',
        'Pérez Ruiz',
        '1976-11-19',
        '956888999',
        'Urb. Los Pinos Mz B Lote 11',
        'humberto.perez@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        25,
        '66223344',
        'Natalia',
        'Gutiérrez Alva',
        '1996-01-15',
        '956999111',
        'Av. Anchoveta 410, Nuevo Chimbote',
        'natalia.gut@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        26,
        '66334455',
        'Mateo',
        'Torres Vega',
        '2021-09-05',
        '956111333',
        'Jr. Manuel Ruiz 320, Chimbote',
        'mateo.torres@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        27,
        '66445566',
        'Eva',
        'Benites Falcon',
        '1969-06-26',
        '956222444',
        'Urb. Las Brisas Mz K Lote 9',
        'eva.benites@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        28,
        '66556677',
        'Arturo',
        'Ramos Luna',
        '1959-10-10',
        '956333555',
        'Av. Brasil 125, Nuevo Chimbote',
        'arturo.ramos@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        29,
        '66667788',
        'Beatriz',
        'Castillo Real',
        '1994-04-03',
        '956444666',
        'Jr. Balta 712, Chimbote',
        'beatriz.castillo@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        30,
        '66778899',
        'Samuel',
        'Palacios Vega',
        '1987-02-28',
        '956555777',
        'Urb. El Bosque Mz D Lote 14',
        'samuel.palacios@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        31,
        '77112233',
        'Irene',
        'Mendoza Alva',
        '2001-12-12',
        '956666888',
        'Jr. Caraz 240, Chimbote',
        'irene.mendoza@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        32,
        '77223344',
        'Marcos',
        'Gómez Falcon',
        '1982-08-08',
        '956777999',
        'Urb. Dunas Mz A Lote 3, Nuevo Chimbote',
        'marcos.gomez@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        33,
        '77334455',
        'Sofía',
        'Silva Merino',
        '2017-03-23',
        '956888111',
        'Jr. Moore 415, Chimbote',
        'sofia.silva@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        34,
        '77445566',
        'Ricardo',
        'Castro Díaz',
        '1971-05-17',
        '956999222',
        'Urb. Nicolas Garatea Mz W Lt 15',
        'ricardo.castro@gmail.com',
        1,
        NOW(),
        NOW()
    ),
    (
        35,
        '77556677',
        'Teresa',
        'Vega Olivos',
        '1965-01-01',
        '956111444',
        'Av. Aviación 920, Chimbote',
        'teresa.vega@gmail.com',
        1,
        NOW(),
        NOW()
    );

-- ==========================================
-- 4. CITAS (45 registros exactos)
-- ==========================================
INSERT INTO
    citas (
        id,
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
    -- ATENDIDOS (Generan receta y pago normal)
    (
        1,
        1,
        1,
        '2026-05-25',
        '08:00:00',
        'Control de presion arterial y fatiga cronica',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        2,
        3,
        5,
        '2026-05-25',
        '09:30:00',
        'Fiebre persistente y tos seca en el infante',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        3,
        2,
        9,
        '2026-05-26',
        '10:00:00',
        'Control prenatal de rutina ecografica',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        4,
        4,
        13,
        '2026-05-26',
        '15:30:00',
        'Alergia cutanea severa en los brazos y torso',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        5,
        5,
        17,
        '2026-05-27',
        '11:00:00',
        'Disminucion de agudeza visual ojo izquierdo',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        6,
        6,
        21,
        '2026-05-27',
        '16:00:00',
        'Dolor agudo de pecho y taquicardia leve',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        7,
        8,
        2,
        '2026-05-25',
        '08:45:00',
        'Chequeo general post-operación',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        8,
        10,
        6,
        '2026-05-25',
        '10:15:00',
        'Control de crecimiento y desarrollo del niño',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        9,
        9,
        10,
        '2026-05-26',
        '11:30:00',
        'Evaluación de quiste ovárico por ecografía',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        10,
        11,
        14,
        '2026-05-26',
        '16:45:00',
        'Revisión de quemadura de segundo grado',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        11,
        12,
        18,
        '2026-05-27',
        '12:00:00',
        'Medida de vista y descarte de glaucoma',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        12,
        13,
        22,
        '2026-05-27',
        '17:15:00',
        'Control de hipertensión emotiva crónica',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        13,
        15,
        3,
        '2026-05-28',
        '09:00:00',
        'Migrañas agudas matutinas recurrentes',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        14,
        18,
        7,
        '2026-05-28',
        '10:30:00',
        'Asma bronquial estacional severa',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        15,
        17,
        11,
        '2026-05-28',
        '14:00:00',
        'Hemorragia uterina disfuncional leve',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        16,
        19,
        15,
        '2026-05-29',
        '15:00:00',
        'Dermatitis seborreica en cuero cabelludo',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        17,
        20,
        19,
        '2026-05-29',
        '16:15:00',
        'Irritación ocular severa por soldadura',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        18,
        21,
        23,
        '2026-05-29',
        '17:30:00',
        'Evaluación pre-quirúrgica cardiovascular',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        19,
        23,
        4,
        '2026-05-30',
        '09:30:00',
        'Dolor abdominal agudo en fosa iliaca',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        20,
        26,
        8,
        '2026-05-30',
        '11:00:00',
        'Fiebre eruptiva sospecha de varicela',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        21,
        25,
        12,
        '2026-05-30',
        '12:15:00',
        'Monitoreo de latidos fetales semana 32',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        22,
        27,
        16,
        '2026-06-01',
        '08:15:00',
        'Infección micótica en uñas de los pies',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        23,
        28,
        20,
        '2026-06-01',
        '09:45:00',
        'Cataratas maduras ojo derecho',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        24,
        29,
        24,
        '2026-06-01',
        '11:15:00',
        'Arritmia esporádica post esfuerzo físico',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        25,
        31,
        1,
        '2026-06-01',
        '14:00:00',
        'Resfriado común con congestión severa',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        26,
        33,
        5,
        '2026-06-01',
        '15:15:00',
        'Infección estomacal y deshidratación',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        27,
        32,
        9,
        '2026-06-02',
        '08:30:00',
        'Control ginecológico anual Papanicolaou',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        28,
        34,
        13,
        '2026-06-02',
        '09:45:00',
        'Acné quístico severo con inflamación',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        29,
        35,
        17,
        '2026-06-02',
        '11:00:00',
        'Fatiga ocular por teletrabajo prolongado',
        'ATENDIDO',
        NOW(),
        NOW()
    ),
    (
        30,
        14,
        21,
        '2026-06-02',
        '12:15:00',
        'Dolor precordial intermitente en reposo',
        'ATENDIDO',
        NOW(),
        NOW()
    ),

-- CANCELADOS (Citas canceladas y pagos en estado ANULADO para tu lógica de caja)
(
    31,
    7,
    24,
    '2026-05-28',
    '09:00:00',
    'Evaluación de marcapasos',
    'CANCELADO',
    NOW(),
    NOW()
),
(
    32,
    2,
    1,
    '2026-05-28',
    '14:30:00',
    'Revisión de análisis de sangre',
    'CANCELADO',
    NOW(),
    NOW()
),
(
    33,
    12,
    10,
    '2026-05-29',
    '10:00:00',
    'Consulta ginecológica express',
    'CANCELADO',
    NOW(),
    NOW()
),
(
    34,
    16,
    14,
    '2026-05-29',
    '11:30:00',
    'Tratamiento de verruga plantar',
    'CANCELADO',
    NOW(),
    NOW()
),
(
    35,
    22,
    18,
    '2026-05-30',
    '15:00:00',
    'Limpieza de conducto lagrimal',
    'CANCELADO',
    NOW(),
    NOW()
),
(
    36,
    24,
    22,
    '2026-05-30',
    '16:30:00',
    'Electrocardiograma de esfuerzo',
    'CANCELADO',
    NOW(),
    NOW()
),
(
    37,
    30,
    2,
    '2026-06-01',
    '10:00:00',
    'Dolor lumbar crónico recurrente',
    'CANCELADO',
    NOW(),
    NOW()
),

-- PENDIENTES (Simulan la agenda futura, no tienen pagos ni recetas creadas todavía)
(
    38,
    1,
    13,
    '2026-06-05',
    '08:30:00',
    'Revisión de lunares sospechosos en la espalda',
    'PENDIENTE',
    NOW(),
    NOW()
),
(
    39,
    4,
    17,
    '2026-06-05',
    '10:30:00',
    'Control post-operatorio de miopía',
    'PENDIENTE',
    NOW(),
    NOW()
),
(
    40,
    5,
    21,
    '2026-06-06',
    '16:30:00',
    'Evaluación por sopló cardíaco detectado',
    'PENDIENTE',
    NOW(),
    NOW()
),
(
    41,
    9,
    3,
    '2026-06-06',
    '09:00:00',
    'Control trimestral de gestación',
    'PENDIENTE',
    NOW(),
    NOW()
),
(
    42,
    11,
    7,
    '2026-06-08',
    '11:15:00',
    'Control de alergia respiratoria infantil',
    'PENDIENTE',
    NOW(),
    NOW()
),
(
    43,
    17,
    11,
    '2026-06-08',
    '14:30:00',
    'Resultados de biopsia de cuello uterino',
    'PENDIENTE',
    NOW(),
    NOW()
),
(
    44,
    20,
    15,
    '2026-06-09',
    '08:00:00',
    'Tratamiento láser para manchas solares',
    'PENDIENTE',
    NOW(),
    NOW()
),
(
    45,
    24,
    19,
    '2026-06-09',
    '10:00:00',
    'Evaluación de fondo de ojo diabético',
    'PENDIENTE',
    NOW(),
    NOW()
);

-- ==========================================
-- 5. RECETAS (Solo asociadas a citas ATENDIDO IDs: 1 al 30)
-- ==========================================
INSERT INTO
    recetas (
        id_cita,
        descripcion,
        medicamentos,
        recomendaciones,
        created_at,
        updated_at
    )
SELECT
    c.id AS id_cita,
    CONCAT(
        'Diagnóstico clínico para la especialidad médica vinculada al doctor #',
        c.id_doctor
    ) AS descripcion,
    'Medicamento Principal 500mg - 1 tableta cada 8 horas por 5 días.\nProtector Gástrico 20mg en ayunas por las mañanas.' AS medicamentos,
    'Evitar esfuerzos físicos pesados, mantener reposo relativo por 24 horas y aumentar la ingesta de líquidos.' AS recomendaciones,
    NOW(),
    NOW()
FROM citas c
WHERE
    c.estado = 'ATENDIDO';

-- ==========================================
-- 6. PAGOS (Asociados a citas ATENDIDO y CANCELADO IDs: 1 al 37)
-- ==========================================
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
SELECT
    c.id AS id_cita,
    CASE (c.id % 3)
        WHEN 0 THEN 60.00
        WHEN 1 THEN 80.00
        ELSE 100.00
    END AS monto,
    c.fecha AS fecha_pago,
    CASE (c.id % 4)
        WHEN 0 THEN 'EFECTIVO'
        WHEN 1 THEN 'YAPE'
        WHEN 2 THEN 'TARJETA'
        ELSE 'PLIN'
    END AS metodo_pago,
    CASE c.estado
        WHEN 'CANCELADO' THEN 'ANULADO'
        ELSE 'PAGADO'
    END AS estado,
    NOW(),
    NOW()
FROM citas c
WHERE
    c.estado IN ('ATENDIDO', 'CANCELADO');