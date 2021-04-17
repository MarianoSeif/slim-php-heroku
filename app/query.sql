--Ejercicios Clase 5 SQL
--Mariano Seif - 3º D


--Creación base de datos
CREATE DATABASE `prog3`;

--Creación de tablas
CREATE TABLE `prog3`.`usuarios` ( `id` INT NOT NULL AUTO_INCREMENT , `nombre` VARCHAR(50) NOT NULL , `apellido` VARCHAR(50) NOT NULL , `mail` VARCHAR(50) NOT NULL , `fecha` DATE NOT NULL , `localidad` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `prog3`.`productos` ( `id` INT NOT NULL AUTO_INCREMENT , `codigo_de_barra` INT NOT NULL , `nombre` VARCHAR(50) NOT NULL , `tipo` VARCHAR(50) NOT NULL , `stock` INT NOT NULL , `precio` DECIMAL(10,2) NOT NULL , `fecha_de_creacion` DATE NOT NULL , `fecha_de_modificacion` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `prog3`.`ventas` ( `id` INT NOT NULL AUTO_INCREMENT , `id_producto` INT NOT NULL , `id_usuario` INT NOT NULL , `cantidad` INT NOT NULL , `fecha_de_venta` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

--Inserción de datos en tablas
INSERT INTO `prog3`.`productos`() VALUES (1001, 77900361, "Westmacott", "liquido", 33, 15.87, "2021-2-9", "2020-9-26"),
(1002, 77900362, "Spirit", "solido", 45, 69.74, "2020-9-18", "2020-4-14"),
(1003, 77900363, "Newgrosh", "polvo", 14, 68.19, "2020-11-29", "2021-2-11"),
(1004, 77900364, "McNickle", "polvo", 19, 53.51, "2020-11-28", "2020-4-17"),
(1005, 77900365, "Hudd", "solido", 68, 26.56, "2020-12-19", "2020-6-19"),
(1006, 77900366, "Schrader", "polvo", 17, 96.54, "2020-8-2", "2020-4-18"),
(1007, 77900367, "Bachellier", "solido", 59, 69.17, "2021-1-30", "2020-6-7"),
(1008, 77900368, "Fleming", "solido", 38, 66.77, "2020-10-26", "202-10-3"),
(1009,77900369,"Hurry", "solido",44,43.01,"2020-7-4","2020-5-30"),
(1010,77900310,"Krauss","polvo",73,35.73,"2021-3-3","2020-8-30");

INSERT INTO `prog3`.`usuarios`() VALUES (101,"Mariano","Kautor","dkantor0@example.com","2021-1-7","Quilmes"),
(102,"German","Gerram","ggerram1@hud.gov","2020-5-8","Berazategui"),
(103,"Deloris","Fosis","bsharpe2@wisc.edu","2020-11-28","Avellaneda"),
(104,"Brok","Neiner","bblazic3@desdev.cn","2020-12-8","Quilmes"),
(105,"Garrick","Brent","gbrent4@theguardian.com","2020-12-17","Moron"),
(106,"Bili","Baus","bhoff5@addthis.com","2020-11-27","Moreno");

INSERT INTO `prog3`.`ventas`() VALUES
(1,1001,101,2,"2020-7-19"),
(2,1008,102,3,"2020-8-16"),
(3,1007,102,4,"2021-1-24"),
(4,1006,103,5,"2021-1-14"),
(5,1003,104,6,"2021-3-20"),
(6,1005,105,7,"2021-2-22"),
(7,1003,104,6,"2020-12-2"),
(8,1003,106,6,"2020-6-10"),
(9,1002,106,6,"2021-2-4"),
(10,1001,106,1,"2020-5-17");

--Ej 1 Obtener los detalles completos de todos los usuarios, ordenados alfabéticamente.
SELECT * FROM usuarios ORDER BY apellido;
--Ej 2 Obtener los detalles completos de todos los productos líquidos.
SELECT * FROM productos WHERE tipo='liquido';
--Ej 3 Obtener todas las compras en los cuales la cantidad esté entre 6 y 10 inclusive.
SELECT * FROM ventas WHERE cantidad BETWEEN 6 AND 10;
--Ej 4 Obtener la cantidad total de todos los productos vendidos.
SELECT SUM(cantidad) FROM ventas;
--Ej 5 Mostrar los primeros 3 números de productos que se han enviado.
SELECT codigo_de_barra FROM productos ORDER BY fecha_de_creacion ASC LIMIT 3;
--Ej 6 Mostrar los nombres del usuario y los nombres de los productos de cada venta.
SELECT u.nombre, u.apellido, p.nombre FROM ventas JOIN usuarios u ON id_usuario=u.id JOIN productos p ON id_producto=p.id;
--Ej 7 Indicar el monto (cantidad * precio) por cada una de las ventas.
SELECT (v.cantidad * p.precio) AS Monto FROM ventas v JOIN productos p ON v.id_producto=p.id;
--Ej 8 Obtener la cantidad total del producto 1003 vendido por el usuario 104.
SELECT SUM(cantidad) AS Total FROM ventas WHERE id_usuario=104 AND id_producto=1003;
--Ej 9 Obtener todos los números de los productos vendidos por algún usuario de Avellaneda
SELECT DISTINCT p.codigo_de_barra FROM ventas v JOIN productos p ON v.id_producto=p.id JOIN usuarios u ON v.id_usuario=u.id WHERE u.localidad='Avellaneda';
--Ej 10 Obtener los datos completos de los usuarios cuyos nombres contengan la letra ‘u’. (Busca en la columna nombre)
SELECT * FROM usuarios WHERE nombre LIKE '%u%';
--Ej 10 Obtener los datos completos de los usuarios cuyos nombres contengan la letra ‘u’. (Busca en la columna nombre y apellido)
SELECT * FROM usuarios WHERE nombre OR apellido LIKE '%u%';
--Ej 11 Traer las ventas entre junio del 2020 y febrero 2021.
SELECT * FROM ventas WHERE fecha_de_venta BETWEEN '2020-06-01' AND '2021-02-28';
--Ej 12 Obtener los usuarios registrados antes del 2021.
SELECT * FROM usuarios WHERE fecha < '2021';
--Ej 13 13.Agregar el producto llamado ‘Chocolate’, de tipo Sólido y con un precio de 25,35. (Columnas NOT NULL sin DEFAULT VALUE)
INSERT INTO productos(codigo_de_barra,nombre,tipo,stock,precio,fecha_de_creacion,fecha_de_modificacion) VALUES (77900311,'Chocolate','Sólido',0,25.35, CURRENT_DATE , CURRENT_DATE);
--Ej 14 Insertar un nuevo usuario
INSERT INTO usuarios(nombre,apellido,mail,fecha,localidad) VALUES ('Mariano','Seif','19mfs81@gmail.com',CURRENT_DATE,'Avellaneda');
--Ej 15 Cambiar los precios de los productos de tipo sólido a 66,60.
UPDATE productos SET precio=66.60 WHERE tipo='solido';
--Ej 16 Cambiar el stock a 0 de todos los productos cuyas cantidades de stock sean menores a 20 inclusive.
UPDATE productos SET stock=0 WHERE stock<=20;
--Ej 17 Eliminar el producto número 1010.
DELETE FROM productos WHERE id=1010;
--Ej 18 Eliminar a todos los usuarios que no han vendido productos.
DELETE FROM usuarios WHERE id NOT IN (SELECT DISTINCT id_usuario FROM ventas);


-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-04-2021 a las 20:17:34
-- Versión del servidor: 5.7.33-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.34-18+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prog3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo_de_barra` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha_de_creacion` date NOT NULL,
  `fecha_de_modificacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo_de_barra`, `nombre`, `tipo`, `stock`, `precio`, `fecha_de_creacion`, `fecha_de_modificacion`) VALUES
(1001, 77900361, 'Westmacott', 'liquido', 33, '15.87', '2021-02-09', '2020-09-26'),
(1002, 77900362, 'Spirit', 'solido', 45, '66.60', '2020-09-18', '2020-04-14'),
(1003, 77900363, 'Newgrosh', 'polvo', 0, '68.19', '2020-11-29', '2021-02-11'),
(1004, 77900364, 'McNickle', 'polvo', 0, '53.51', '2020-11-28', '2020-04-17'),
(1005, 77900365, 'Hudd', 'solido', 68, '66.60', '2020-12-19', '2020-06-19'),
(1006, 77900366, 'Schrader', 'polvo', 0, '96.54', '2020-08-02', '2020-04-18'),
(1007, 77900367, 'Bachellier', 'solido', 59, '66.60', '2021-01-30', '2020-06-07'),
(1008, 77900368, 'Fleming', 'solido', 38, '66.60', '2020-10-26', '0202-10-03'),
(1009, 77900369, 'Hurry', 'solido', 44, '66.60', '2020-07-04', '2020-05-30'),
(1011, 77900311, 'Chocolate', 'Sólido', 0, '66.60', '2021-04-17', '2021-04-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `localidad` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `mail`, `fecha`, `localidad`) VALUES
(101, 'Mariano', 'Kautor', 'dkantor0@example.com', '2021-01-07', 'Quilmes'),
(102, 'German', 'Gerram', 'ggerram1@hud.gov', '2020-05-08', 'Berazategui'),
(103, 'Deloris', 'Fosis', 'bsharpe2@wisc.edu', '2020-11-28', 'Avellaneda'),
(104, 'Brok', 'Neiner', 'bblazic3@desdev.cn', '2020-12-08', 'Quilmes'),
(105, 'Garrick', 'Brent', 'gbrent4@theguardian.com', '2020-12-17', 'Moron'),
(106, 'Bili', 'Baus', 'bhoff5@addthis.com', '2020-11-27', 'Moreno'),
(108, 'Mariano', 'Seif', '19mfs81@gmail.com', '2021-04-17', 'Avellaneda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_de_venta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `id_producto`, `id_usuario`, `cantidad`, `fecha_de_venta`) VALUES
(1, 1001, 101, 2, '2020-07-19'),
(2, 1008, 102, 3, '2020-08-16'),
(3, 1007, 102, 4, '2021-01-24'),
(4, 1006, 103, 5, '2021-01-14'),
(5, 1003, 104, 6, '2021-03-20'),
(6, 1005, 105, 7, '2021-02-22'),
(7, 1003, 104, 6, '2020-12-02'),
(8, 1003, 106, 6, '2020-06-10'),
(9, 1002, 106, 6, '2021-02-04'),
(10, 1001, 106, 1, '2020-05-17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1012;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;