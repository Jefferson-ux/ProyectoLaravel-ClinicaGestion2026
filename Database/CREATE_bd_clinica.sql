CREATE DATABASE bd_clinica;

USE bd_clinica;

CREATE TABLE especialidades (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    descripcion VARCHAR(255),
    estado TINYINT DEFAULT 1
);

CREATE TABLE doctores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    dni CHAR(8) NOT NULL UNIQUE,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    telefono VARCHAR(15),
    correo VARCHAR(100) UNIQUE,
    id_especialidad INT,
    estado TINYINT DEFAULT 1,
    CONSTRAINT fk_doctor_especialidad FOREIGN KEY (id_especialidad) REFERENCES especialidades (id)
);

CREATE TABLE pacientes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    dni CHAR(8) NOT NULL UNIQUE,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE,
    telefono VARCHAR(15),
    direccion VARCHAR(255),
    correo VARCHAR(100),
    estado TINYINT DEFAULT 1
);

CREATE TABLE citas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_paciente INT NOT NULL,
    id_doctor INT NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    motivo VARCHAR(255),
    estado VARCHAR(20) DEFAULT 'PENDIENTE',
    CONSTRAINT fk_cita_paciente FOREIGN KEY (id_paciente) REFERENCES pacientes (id),
    CONSTRAINT fk_cita_doctor FOREIGN KEY (id_doctor) REFERENCES doctores (id)
);

CREATE TABLE recetas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_cita INT NOT NULL,
    descripcion TEXT,
    medicamentos TEXT,
    recomendaciones TEXT,
    CONSTRAINT fk_receta_cita FOREIGN KEY (id_cita) REFERENCES citas (id)
);

CREATE TABLE pagos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_cita INT NOT NULL,
    monto DECIMAL(10, 2),
    fecha_pago DATE,
    metodo_pago VARCHAR(50),
    estado VARCHAR(20) DEFAULT 'PAGADO',
    CONSTRAINT fk_pago_cita FOREIGN KEY (id_cita) REFERENCES citas (id)
);