
-- Base de datos: life_gym (PostgreSQL)
-- --------------------------------------------------------

-- Tabla: roles
DROP TABLE IF EXISTS roles CASCADE;
CREATE TABLE roles (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);
INSERT INTO roles (id, nombre) VALUES
(1, 'usuario'),
(2, 'administrador');

-- Tabla: usuarios
DROP TABLE IF EXISTS usuarios CASCADE;
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    fechaNacimiento DATE DEFAULT NULL,
    identificacion BIGINT NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    rol_id INT REFERENCES roles(id)
);
INSERT INTO usuarios VALUES
(43, 'andres', 'estrada', '32145678921', '2002-07-20', 1236548789, 'andres@gmail.com', '$2y$10$/UYCCzNSrVLQ1GX1XsryF.6.s3052359KToedTZssfQ1JkbzinumG', '2025-06-26 21:38:29', 2),
(44, 'Nicolas', 'Jimenez', '3168771073', '2002-07-20', 1193228149, 'nicolasjimenezguzman1@gmail.com', '$2y$10$wVZ6gK7wFzPUJ9aH1C2UvuZUdcgJ3BCWfciO.kT.wH1KU5bwAQMnS', '2025-06-26 21:57:30', 2),
(45, 'carlota', 'jimenez', '325645987', '2002-07-20', 1236547889, 'carlota@gmail.com', '$2y$10$P80lm2MOvvT0FbBTSqGdAO/8Z0VZDMltdt0WS7gOo.4Wl/9AGlrcu', '2025-07-08 18:40:20', 1),
(46, 'sandra Elizabeth', 'Guzman ', '3174910020', '1977-02-20', 36753350, 'sandraguzman@gmail.com', '$2y$10$Ms5FjdHxU2MBtJnP4/OCremFgYCh/vXTBoXbDpYJAuJ/X.V9D3VN2', '2025-07-16 22:17:16', 1),
(47, 'angela yovanna', 'jimenez guzman ', '3225840242', '2000-11-10', 1004214601, 'angela@gmail.com', '$2y$10$9bKKUN9a5KFFTMcDnkdo2uBF6b9GDZZqrJ.Wv.bVL7tGeEAvRFpHu', '2025-07-22 19:21:42', 1);

-- Tabla: clases
DROP TABLE IF EXISTS clases CASCADE;
CREATE TABLE clases (
    id SERIAL PRIMARY KEY,
    cliente VARCHAR(100) NOT NULL,
    grupo VARCHAR(100) NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    tiempo_descanso VARCHAR(50) NOT NULL,
    video TEXT,
    imagen1 VARCHAR(255),
    imagen2 VARCHAR(255),
    imagen3 VARCHAR(255),
    fecha_creacion DATE NOT NULL
);
INSERT INTO clases VALUES
(1,'Nicolas','Torso','pecho completo','ssssssss','3 minutos','https://www.youtube.com/watch?v=91MpFsZI9VA&list=RD91MpFsZI9VA&start_radio=1','Captura de pantalla 2024-03-22 151951.png','','','2025-07-17'),
(2,'carlos','Torso','pecho completo','ddddddd','3 minutos','https://www.youtube.com/watch?v=91MpFsZI9VA&list=RD91MpFsZI9VA&start_radio=1','Captura de pantalla 2024-03-22 151951.png','','','2025-07-17'),
(3,'Nicolas','Torso','pecho completo','jpkj´jkój','3 minutos','https://www.youtube.com/watch?v=91MpFsZI9VA&list=RD91MpFsZI9VA&start_radio=1','111.png','','','2025-07-17'),
(4,'sandra','Inferior','Pierna Completa','sentadilla 3x10rnhacka 4x15rnextenciones 3x10','3 minutos','https://www.youtube.com/watch?v=91MpFsZI9VA&list=RD91MpFsZI9VA&start_radio=1','','','','2025-07-17'),
(5,'angela','Torso','Pierna Completa','sentadillarnhackrnextenciones','3 minutos','https://www.youtube.com/watch?v=91MpFsZI9VA&list=RD91MpFsZI9VA&start_radio=1','','','','2025-07-22');

-- Tabla: contactos
DROP TABLE IF EXISTS contactos CASCADE;
CREATE TABLE contactos (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    mensaje TEXT NOT NULL,
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO contactos VALUES
(1,'Nicolas','nicolasjimenezguzman1@gmail.com','holaa','2025-05-03 20:08:14'),
(2,'jesus','jesus@email.com','hola','2025-05-03 21:39:07'),
(3,'estebans','esteban@gmail.com','hola','2025-05-03 21:40:00'),
(4,'daniela','daniela@gmail.com','hola','2025-05-03 21:41:50'),
(5,'silvia','silvia@gmail.com','hola','2025-05-03 21:43:03'),
(6,'andrea','andrrea@gmail.com','hola','2025-05-03 21:45:01'),
(7,'jessica','jessica@gmail.com','hmjnxfnfs','2025-05-03 21:46:55'),
(8,'luisa','luisa@gmail.com','hoila','2025-05-03 21:48:16'),
(9,'luis','luis@gmail.com','hmjnxfnfs','2025-05-03 21:51:42'),
(10,'daniielita','danni@gmail.com','hgolaa','2025-05-03 21:54:16'),
(11,'jesus','esteban@gmail.com','hmjnxfnfs','2025-05-03 21:56:27'),
(12,'Nicolas','nicolasjimenezguzman1@gmail.com','hmjnxfnfs','2025-05-03 22:01:40'),
(13,'jose','jose@gmail.com','tytu','2025-05-04 00:12:24'),
(14,'luis','luis@gmail.com','frfr','2025-05-06 16:07:07'),
(15,'jesus','esteban@gmail.com','hola','2025-05-10 00:12:13'),
(16,'jesus','esteban@gmail.com','tytu','2025-05-10 01:07:19'),
(17,'Carlos Alberto','carlosestrada@gmail.com','hola me podrias regalar informacion sobre ubicacion y demas planes o personalizados','2025-05-12 15:52:39'),
(18,'pepito andres','pepitoandres@gmail.com','Hola quiero mas informacion sobre planes y perzonalisados','2025-05-12 17:26:01'),
(19,'pepito andres','pepitoandres@gmail.com','hola','2025-06-26 19:39:11'),
(20,'pepito andres','pepitoandres@gmail.com','hola','2025-06-26 19:39:37'),
(21,'Nicolas','nicolasjimenezguzman1@gmail.com','Hola buenas tarde quiero mas informacion sobre los planes','2025-06-26 21:53:56'),
(22,'Nicolas','nicolasjimenezguzman1@gmail.com','hola quiero mas info','2025-07-17 01:05:23');

-- Tabla: planes
DROP TABLE IF EXISTS planes CASCADE;
CREATE TABLE planes (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion TEXT NOT NULL,
    precio DECIMAL(10,0) NOT NULL DEFAULT 70000,
    duracion INT NOT NULL DEFAULT 30,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO planes VALUES
(1,'Plan Básico','Acceso a todos los servicios básicos del gimnasio. Incluye asesoramiento básico con instructores.',50000,30,'2025-05-09 23:11:14'),
(2,'Plan Avanzado','Acceso a todos los servicios, asesoramiento con instructores y entrenamientos personalizados.',80000,45,'2025-05-09 23:11:14'),
(3,'Plan Premium','Acceso completo a todos los servicios del gimnasio, asesoramiento, entrenamientos personalizados y acceso ilimitado a clases grupales.',120000,60,'2025-05-09 23:11:14');

-- Tabla: pagos
DROP TABLE IF EXISTS pagos CASCADE;
CREATE TABLE pagos (
    id SERIAL PRIMARY KEY,
    cliente_id INT NOT NULL,
    monto DECIMAL(10,2) NOT NULL,
    metodo_pago VARCHAR(50) NOT NULL,
    fecha_pago TIMESTAMP NOT NULL,
    estado_pago VARCHAR(20) DEFAULT 'Pendiente',
    plan_id INT
);
INSERT INTO pagos VALUES
(1,1193228149,50000.00,'Pendiente','2025-05-10 01:48:34','En proceso',NULL),
(2,1193228149,50000.00,'Pendiente','2025-05-10 03:06:55','En proceso',NULL),
(3,1,50000.00,'Pendiente','2025-05-12 18:05:16','En proceso',NULL);

-- Tabla: reportes
DROP TABLE IF EXISTS reportes CASCADE;
CREATE TABLE reportes (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100),
    peso DECIMAL(5,2),
    estatura DECIMAL(4,2),
    edad INT,
    carga_pecho INT,
    carga_sentadilla INT,
    carga_biceps INT,
    carga_triceps INT,
    carga_hombro INT,
    fecha_reporte TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO reportes VALUES
(8,'carlos',80.00,1.69,45,45,20,10,10,20,'2025-07-16 20:05:42'),
(9,'carlos',80.00,1.69,45,45,20,10,10,20,'2025-07-16 20:08:07'),
(10,'carlos',80.00,1.69,45,45,20,10,10,20,'2025-07-16 20:10:27'),
(11,'carlos',85.00,1.69,45,50,90,20,50,30,'2025-07-16 20:16:07'),
(12,'carlos',85.00,1.69,45,50,90,20,50,30,'2025-07-16 20:20:39'),
(13,'daniel',90.00,1.90,20,50,10,10,50,90,'2025-07-16 20:27:03'),
(14,'daniel',80.00,1.90,20,60,20,20,100,90,'2025-07-16 20:27:38'),
(15,'Sandra',70.00,1.68,48,10,10,10,10,10,'2025-07-17 01:03:50'),
(16,'Sandra',60.00,1.68,48,20,20,20,20,20,'2025-07-17 01:04:37'),
(17,'angela',60.00,1.67,25,20,20,20,20,20,'2025-07-22 19:24:39'),
(18,'angela',50.00,1.67,25,25,25,25,25,20,'2025-07-22 19:24:57');
