-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2025 at 03:54 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emilio`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `ct_nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `ct_descripcion` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime(5) NOT NULL,
  `activacion` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `ct_nombre`, `ct_descripcion`, `fecha`, `activacion`) VALUES
(0, 'Kyrios Burg', 'Kyrios', '2024-07-01 11:51:46.00000', 1),
(2, 'Cryspi Frie', 'Cryspi', '2024-07-24 12:52:30.00000', 1),
(3, 'Lomito Ryan', 'Ryan', '2024-07-26 12:53:08.00000', 1),
(4, 'Godzilla Burguer', 'Godzilla', '0000-00-00 00:00:00.00000', 0),
(6, 'Spicy Cryspi Chiken', 'Spicy', '0000-00-00 00:00:00.00000', 0),
(7, 'Che  sscakes', ' sscakes', '0000-00-00 00:00:00.00000', 0),
(8, 'Muñecos Coleccionabl', 'Muñecos', '0000-00-00 00:00:00.00000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `consultas`
--

CREATE TABLE `consultas` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Ciudad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Pais` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Comentario` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contactos`
--

CREATE TABLE `contactos` (
  `id_contactos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crude`
--

CREATE TABLE `crude` (
  `id_crude` int(11) NOT NULL,
  `nombre_prod` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `precio` float(10,2) NOT NULL,
  `precio_vta` float(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_min` int(11) NOT NULL,
  `eliminado` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perfil`
--

CREATE TABLE `perfil` (
  `id_Perfil` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `perfil`
--

INSERT INTO `perfil` (`id_Perfil`, `descripcion`) VALUES
(1, 'admin'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `ID_Pro` int(50) NOT NULL,
  `Precio` float NOT NULL,
  `Precio_final` float NOT NULL,
  `Nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Stock` int(10) NOT NULL,
  `Stock_min` int(11) NOT NULL,
  `img` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `active` bit(1) DEFAULT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`ID_Pro`, `Precio`, `Precio_final`, `Nombre`, `Stock`, `Stock_min`, `img`, `active`, `categoria_id`) VALUES
(2, 500, 500, 'Kyrios Burgers', 40, 5, '1719926494_0e5ded1a718a94a35b5d.jpg', NULL, 0),
(3, 800, 800, 'Cryspi Fries', 50, 5, '1719926427_bb524bdebc7d15baf696.jpg', NULL, 0),
(4, 1200, 1200, 'Lomito Ryan', 50, 5, '1719926445_6d11cb43edef204b5f93.jpg', NULL, 0),
(5, 1800, 1800, 'Godzilla Burguer', 50, 5, '1719926474_7a0f707e27f902714ed1.jpg', NULL, 0),
(6, 2500, 2500, 'Spicy Cryspi Chiken', 40, 5, '1719926374_3c03ea59bb32e793ea16.webp', NULL, 0),
(8, 500, 500, 'Che  sscakes', 100, 10, '1719926354_930a3ec2dbd8b9bed400.jpg', NULL, 0),
(9, 900, 900, 'Muñecos Coleccionables', 50, 5, '????\0JFIF\0\0H\0H\0\0??\0;CREATOR: gd-jpeg v1.0 (using IJG JPEG v62), quality = 95\n??\0C\0\n\n\n\n\r\r#%$\"\"!&+7/&)4)!\"0A149;>>>%.DIC<H7=>;', NULL, 0),
(12, 1500, 1650, 'Sandwich Pollo', 50, 5, '1719926247_460cb8f305bdb7ec7d13.jpg', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `perfil_id` int(11) NOT NULL,
  `baja` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `Nombre`, `Apellido`, `Usuario`, `Email`, `pass`, `perfil_id`, `baja`) VALUES
(1, 'Emilio', 'Durand', 'Emilio_durando', 'Emiliodurand91@gmail.com', 'Emi123456789', 1, 'NO'),
(2, 'Carolina', 'Maldonado', 'Caro_mal@hotmail.com', 'tuturrita@gmail.com', 'alguien4321', 2, 'NO'),
(3, 'Emilio', 'Perez', 'Juanchi', 'Juanperez1234@gmail.com', '$2y$10$NhvVfYLz6d.JRQNMsNTfq.utDq6Q/ZI0jD.xImTCX5CCTa1SiY4o2', 2, 'NO'),
(4, 'Emilio', 'Durand', 'pp234', 'el_emi147@hotmail.com', '$2y$10$YD7t3P.04WVlxeRYvO9Dwumqp8zavgSCXqGML1Bf.0a./focbRqdS', 1, 'NO'),
(5, 'Emilio', 'Durand', 'Emiliodu', 'lkajsduib@gmail.com', '$2y$10$5PJYZZvBVbsFcI0th6jaAubt9pu4v1E8XKu3Xl5ocygjXnhNoJ/8e', 1, 'NO'),
(6, 'juan', 'Alberto', 'Juanchi', 'el_emi@hotmail.com', '$2y$10$Cu9ZqoL9.1BC.M87VB5l4.DaRuLd2lKare0mCuo86/qNd3YyJA5UC', 1, 'NO'),
(7, 'maria', 'garay', 'maria', 'mariajoselo@gmail.com', '$2y$10$jFU.Hr7Mqnb1wc2HDaVoxez9r/gcCk.XFWq3Nz.o97A0M2fstslUG', 2, 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `venta_cabecera`
--

CREATE TABLE `venta_cabecera` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `total_venta` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `venta_detalle`
--

CREATE TABLE `venta_detalle` (
  `id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `Precio` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id_contactos`);

--
-- Indexes for table `crude`
--
ALTER TABLE `crude`
  ADD PRIMARY KEY (`id_crude`);

--
-- Indexes for table `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_Perfil`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID_Pro`),
  ADD KEY `FK_Prod_Categoria` (`categoria_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `perfil_id` (`perfil_id`);

--
-- Indexes for table `venta_cabecera`
--
ALTER TABLE `venta_cabecera`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venta_id` (`venta_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id_contactos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crude`
--
ALTER TABLE `crude`
  MODIFY `id_crude` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_Perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `ID_Pro` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `venta_cabecera`
--
ALTER TABLE `venta_cabecera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `venta_detalle`
--
ALTER TABLE `venta_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`id_Perfil`) REFERENCES `usuarios` (`id_usuario`);

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_Prod_Categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id_categoria`);

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id_Perfil`);

--
-- Constraints for table `venta_cabecera`
--
ALTER TABLE `venta_cabecera`
  ADD CONSTRAINT `venta_cabecera_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`);

--
-- Constraints for table `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD CONSTRAINT `venta_detalle_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `venta_cabecera` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
