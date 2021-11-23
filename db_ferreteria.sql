/*
 Navicat Premium Data Transfer

 Source Server         : mañana
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : db_ferreteria

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 02/11/2021 16:15:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cargo
-- ----------------------------
DROP TABLE IF EXISTS `cargo`;
CREATE TABLE `cargo`  (
  `idcargo` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idcargo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cargo
-- ----------------------------
INSERT INTO `cargo` VALUES (1, 'Jefe');
INSERT INTO `cargo` VALUES (5, 'Vendedor');

-- ----------------------------
-- Table structure for categoria
-- ----------------------------
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria`  (
  `idcategoria` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idcategoria`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categoria
-- ----------------------------
INSERT INTO `categoria` VALUES (5, 'Vivienda');

-- ----------------------------
-- Table structure for cliente
-- ----------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente`  (
  `idcliente` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellido` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dui` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `telefono` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idcliente`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cliente
-- ----------------------------
INSERT INTO `cliente` VALUES (5, 'Maria Carmen', 'Auxiliadora del Carmen', '01667222-3', 1, '7772-7777');

-- ----------------------------
-- Table structure for compra
-- ----------------------------
DROP TABLE IF EXISTS `compra`;
CREATE TABLE `compra`  (
  `idcompra` bigint(20) NOT NULL AUTO_INCREMENT,
  `dia` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `credito` double NULL DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  `monto` double NOT NULL,
  `idproveedor` bigint(20) NOT NULL,
  `idusuario` bigint(20) NOT NULL,
  `fecha_credito` date NULL DEFAULT NULL,
  PRIMARY KEY (`idcompra`) USING BTREE,
  INDEX `fk_compraprov`(`idproveedor`) USING BTREE,
  INDEX `fk_usucompra`(`idusuario`) USING BTREE,
  CONSTRAINT `fk_compraprov` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idproveedor`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_usucompra` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of compra
-- ----------------------------
INSERT INTO `compra` VALUES (7, 2, 11, 2021, 0, 0, 111.2, 4, 1, '0000-00-00');
INSERT INTO `compra` VALUES (8, 2, 11, 2021, 0, 0, 2.18, 4, 1, '0000-00-00');
INSERT INTO `compra` VALUES (9, 2, 11, 2021, 0, 0, 19.5, 4, 1, '0000-00-00');

-- ----------------------------
-- Table structure for detallecompra
-- ----------------------------
DROP TABLE IF EXISTS `detallecompra`;
CREATE TABLE `detallecompra`  (
  `iddetalle` bigint(20) NOT NULL AUTO_INCREMENT,
  `idcompra` bigint(20) NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `preciocompra` double NOT NULL,
  `precioventa` double NOT NULL,
  PRIMARY KEY (`iddetalle`) USING BTREE,
  INDEX `fk_compra`(`idcompra`) USING BTREE,
  INDEX `fk_productocompra`(`idproducto`) USING BTREE,
  CONSTRAINT `fk_compra` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_compraprod` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detallecompra
-- ----------------------------
INSERT INTO `detallecompra` VALUES (8, 7, 5, 20, 5.56, 6.116);
INSERT INTO `detallecompra` VALUES (9, 8, 5, 2, 1.09, 1.199);
INSERT INTO `detallecompra` VALUES (10, 9, 6, 15, 1.3, 1.43);

-- ----------------------------
-- Table structure for detalleventa
-- ----------------------------
DROP TABLE IF EXISTS `detalleventa`;
CREATE TABLE `detalleventa`  (
  `iddetalle` bigint(20) NOT NULL AUTO_INCREMENT,
  `idventa` bigint(20) NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`iddetalle`) USING BTREE,
  INDEX `fk_productoventa`(`idventa`) USING BTREE,
  INDEX `fk_ventaprod`(`idproducto`) USING BTREE,
  CONSTRAINT `fk_venta` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ventaprod` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for empleado
-- ----------------------------
DROP TABLE IF EXISTS `empleado`;
CREATE TABLE `empleado`  (
  `idempleado` bigint(20) NOT NULL AUTO_INCREMENT,
  `dui` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nit` varchar(19) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `direccion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dia` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `idcargo` bigint(20) NOT NULL,
  PRIMARY KEY (`idempleado`) USING BTREE,
  INDEX `fk_cargo`(`idcargo`) USING BTREE,
  CONSTRAINT `fk_cargo` FOREIGN KEY (`idcargo`) REFERENCES `cargo` (`idcargo`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of empleado
-- ----------------------------
INSERT INTO `empleado` VALUES (1, '01667277-6', 'Super Admin', 'Ferreteria', '0000-010103-100-1', 'Calle El matadragon', '2333-3333', 10, 12, 2003, 1, 1);
INSERT INTO `empleado` VALUES (19, '01777373-7', 'William Antonio', 'Del Cid Mejia', '0001-012781-300-2', 'Reparto Los Naranjos, #167 Calle El Naranjo', '2273-8330', 17, 12, 2003, 2, 5);
INSERT INTO `empleado` VALUES (20, '01777374-7', 'William Antonio', 'Del Cid Mejia', '0001-012781-300-3', 'Reparto Las Naranjas', '2333-3223', 17, 12, 2003, 1, 5);

-- ----------------------------
-- Table structure for imagen
-- ----------------------------
DROP TABLE IF EXISTS `imagen`;
CREATE TABLE `imagen`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `productoid` bigint(20) NOT NULL,
  `img` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_imagenprod`(`productoid`) USING BTREE,
  CONSTRAINT `fk_imagenprod` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of imagen
-- ----------------------------
INSERT INTO `imagen` VALUES (11, 5, 'pro_d6c8f21ede12c5e32b674724b9b842d2.jpg');
INSERT INTO `imagen` VALUES (12, 6, 'pro_3ebd4fa666ce1ebe8ea366a523fb6ea8.jpg');

-- ----------------------------
-- Table structure for marca
-- ----------------------------
DROP TABLE IF EXISTS `marca`;
CREATE TABLE `marca`  (
  `idmarca` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`idmarca`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of marca
-- ----------------------------
INSERT INTO `marca` VALUES (7, 'HERMEX', 1);

-- ----------------------------
-- Table structure for modulo
-- ----------------------------
DROP TABLE IF EXISTS `modulo`;
CREATE TABLE `modulo`  (
  `idmodulo` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idmodulo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of modulo
-- ----------------------------
INSERT INTO `modulo` VALUES (1, 'Inicio', 'Pantalla Principal', 1);
INSERT INTO `modulo` VALUES (2, 'Usuarios', 'Usuarios del sistema', 1);
INSERT INTO `modulo` VALUES (3, 'Roles de Usuario', 'Roles de Usuario del Sistema', 1);
INSERT INTO `modulo` VALUES (4, 'Empleados', 'Registrar, Editar y/o Eliminar empleados', 1);
INSERT INTO `modulo` VALUES (5, 'Compras', 'Compras', 1);
INSERT INTO `modulo` VALUES (6, 'Inventario', 'Inventario', 1);
INSERT INTO `modulo` VALUES (7, 'Ventas', 'Ventas', 1);
INSERT INTO `modulo` VALUES (8, 'Clientes', 'Clientes', 1);
INSERT INTO `modulo` VALUES (9, 'Productos', 'Productos', 1);
INSERT INTO `modulo` VALUES (10, 'Proveedores', 'Proveedores', 1);
INSERT INTO `modulo` VALUES (11, 'Marca', 'Marca de los productos', 1);
INSERT INTO `modulo` VALUES (12, 'Unidad de Medida', 'Unidad de Medida', 1);
INSERT INTO `modulo` VALUES (13, 'Categoria', 'Cateoria', 1);
INSERT INTO `modulo` VALUES (14, 'Cargos', 'Cargos', 1);

-- ----------------------------
-- Table structure for permisos
-- ----------------------------
DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos`  (
  `idpermiso` bigint(20) NOT NULL AUTO_INCREMENT,
  `rolid` bigint(20) NOT NULL,
  `moduloid` bigint(20) NOT NULL,
  `leer` int(11) NOT NULL DEFAULT 0,
  `escribir` int(11) NOT NULL DEFAULT 0,
  `actualizar` int(11) NOT NULL DEFAULT 0,
  `eliminar` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idpermiso`) USING BTREE,
  INDEX `rolid`(`rolid`) USING BTREE,
  INDEX `moduloid`(`moduloid`) USING BTREE,
  CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`moduloid`) REFERENCES `modulo` (`idmodulo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 307 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permisos
-- ----------------------------
INSERT INTO `permisos` VALUES (181, 1, 1, 1, 1, 1, 1);
INSERT INTO `permisos` VALUES (182, 1, 2, 1, 1, 1, 1);
INSERT INTO `permisos` VALUES (183, 1, 3, 1, 1, 1, 1);
INSERT INTO `permisos` VALUES (184, 1, 4, 1, 1, 1, 1);
INSERT INTO `permisos` VALUES (185, 1, 5, 1, 1, 1, 1);
INSERT INTO `permisos` VALUES (186, 1, 6, 1, 1, 1, 1);
INSERT INTO `permisos` VALUES (187, 1, 7, 1, 1, 1, 1);
INSERT INTO `permisos` VALUES (188, 1, 8, 1, 1, 1, 1);
INSERT INTO `permisos` VALUES (189, 1, 9, 1, 1, 1, 1);
INSERT INTO `permisos` VALUES (190, 1, 10, 1, 1, 1, 1);
INSERT INTO `permisos` VALUES (191, 1, 11, 1, 1, 1, 1);
INSERT INTO `permisos` VALUES (192, 1, 12, 1, 1, 1, 1);
INSERT INTO `permisos` VALUES (193, 1, 13, 1, 1, 1, 1);
INSERT INTO `permisos` VALUES (194, 1, 14, 1, 1, 1, 1);
INSERT INTO `permisos` VALUES (293, 14, 1, 1, 0, 0, 0);
INSERT INTO `permisos` VALUES (294, 14, 2, 0, 0, 0, 0);
INSERT INTO `permisos` VALUES (295, 14, 3, 0, 0, 0, 0);
INSERT INTO `permisos` VALUES (296, 14, 4, 1, 0, 0, 0);
INSERT INTO `permisos` VALUES (297, 14, 5, 1, 0, 0, 0);
INSERT INTO `permisos` VALUES (298, 14, 6, 0, 0, 0, 0);
INSERT INTO `permisos` VALUES (299, 14, 7, 0, 0, 0, 0);
INSERT INTO `permisos` VALUES (300, 14, 8, 1, 0, 0, 0);
INSERT INTO `permisos` VALUES (301, 14, 9, 1, 0, 0, 0);
INSERT INTO `permisos` VALUES (302, 14, 10, 1, 0, 0, 0);
INSERT INTO `permisos` VALUES (303, 14, 11, 1, 0, 0, 0);
INSERT INTO `permisos` VALUES (304, 14, 12, 1, 0, 0, 0);
INSERT INTO `permisos` VALUES (305, 14, 13, 1, 0, 0, 0);
INSERT INTO `permisos` VALUES (306, 14, 14, 1, 0, 0, 0);

-- ----------------------------
-- Table structure for producto
-- ----------------------------
DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto`  (
  `idproducto` bigint(20) NOT NULL AUTO_INCREMENT,
  `codigobarra` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idmarca` bigint(20) NOT NULL,
  `idcategoria` bigint(20) NOT NULL,
  `idunidadmedida` bigint(20) NOT NULL,
  PRIMARY KEY (`idproducto`) USING BTREE,
  INDEX `fk_marcaprod`(`idmarca`) USING BTREE,
  INDEX `fk_unidadmprod`(`idunidadmedida`) USING BTREE,
  INDEX `fk_categoria`(`idcategoria`) USING BTREE,
  CONSTRAINT `fk_categoria` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_marcaprod` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idmarca`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_unidadmprod` FOREIGN KEY (`idunidadmedida`) REFERENCES `unidadmedida` (`idunidad`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of producto
-- ----------------------------
INSERT INTO `producto` VALUES (5, '00001', 'GOLPEADOR PARA PUERTA T/LEON', 1, 24, '', 7, 5, 4);
INSERT INTO `producto` VALUES (6, '00002', 'JALADERA PARA MUEBLE', 1, 15, '', 7, 5, 4);

-- ----------------------------
-- Table structure for proveedor
-- ----------------------------
DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE `proveedor`  (
  `idproveedor` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `direccion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `telefono` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contacto_vendedor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idproveedor`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of proveedor
-- ----------------------------
INSERT INTO `proveedor` VALUES (4, 'ACACESPROMAC, DE R.L.', 'SAN SALVADOR, SAN SALVADOR', 1, '2521-0000', 'Alexander Fleming');

-- ----------------------------
-- Table structure for rol
-- ----------------------------
DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol`  (
  `idrol` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombrerol` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idrol`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rol
-- ----------------------------
INSERT INTO `rol` VALUES (1, 'Administrador', 'Administrador', 1);
INSERT INTO `rol` VALUES (14, 'Vendedor', 'Este Rol sera para los vendedores de la Ferreteria Granadeño', 1);

-- ----------------------------
-- Table structure for unidadmedida
-- ----------------------------
DROP TABLE IF EXISTS `unidadmedida`;
CREATE TABLE `unidadmedida`  (
  `idunidad` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idunidad`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of unidadmedida
-- ----------------------------
INSERT INTO `unidadmedida` VALUES (4, 'UNIDAD');

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `idusuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `email_usuario` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `contrasena` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `idempleado` bigint(20) NULL DEFAULT NULL,
  `token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `datecreated` datetime(0) NOT NULL DEFAULT current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idusuario`) USING BTREE,
  INDEX `rolid`(`rolid`) USING BTREE,
  INDEX `fk_empleado`(`idempleado`) USING BTREE,
  CONSTRAINT `fk_empleado` FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 'ferreteriagradanenio12@gmail.com', '75b3897ea5239a738b3ba1061e19e052c6181043d248d0f099d5b09a8dee8ba7', 1, '', 1, '2021-08-11 16:22:35', 1);
INSERT INTO `usuario` VALUES (17, 'dm18019@ues.edu.sv', '75b3897ea5239a738b3ba1061e19e052c6181043d248d0f099d5b09a8dee8ba7', 20, '', 14, '2021-11-02 15:42:21', 1);

-- ----------------------------
-- Table structure for venta
-- ----------------------------
DROP TABLE IF EXISTS `venta`;
CREATE TABLE `venta`  (
  `idventa` bigint(20) NOT NULL AUTO_INCREMENT,
  `dia` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `monto` double NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `idcliente` bigint(20) NOT NULL,
  `idusuario` bigint(20) NOT NULL,
  PRIMARY KEY (`idventa`) USING BTREE,
  INDEX `fk_clienteventa`(`idcliente`) USING BTREE,
  INDEX `fk_usuventa`(`idusuario`) USING BTREE,
  CONSTRAINT `fk_clienteventa` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_usuventa` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
