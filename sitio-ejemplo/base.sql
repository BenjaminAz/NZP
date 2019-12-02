/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : base

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-10-22 20:29:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for comentarios
-- ----------------------------
DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE `comentarios` (
  `id_comentario` int(50) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(50) NOT NULL,
  `id_producto` int(50) NOT NULL,
  `comentario` varchar(200) NOT NULL DEFAULT '',
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id_comentario`),
  UNIQUE KEY `id_comentario` (`id_comentario`),
  KEY `com_usuarios` (`id_usuario`),
  KEY `com_productos` (`id_producto`),
  CONSTRAINT `com_productos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `com_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comentarios
-- ----------------------------
INSERT INTO `comentarios` VALUES ('1', '3', '1', 'Primer comentario', '2019-10-31');
INSERT INTO `comentarios` VALUES ('2', '5', '1', 'Segundo comentario', '2019-11-02');
INSERT INTO `comentarios` VALUES ('3', '2', '1', 'Tercer comentario', '2019-11-09');

-- ----------------------------
-- Table structure for localidades
-- ----------------------------
DROP TABLE IF EXISTS `localidades`;
CREATE TABLE `localidades` (
  `id_localidad` int(50) NOT NULL AUTO_INCREMENT,
  `localidad` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_localidad`),
  UNIQUE KEY `id_localidad` (`id_localidad`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of localidades
-- ----------------------------
INSERT INTO `localidades` VALUES ('1', 'Retiro');
INSERT INTO `localidades` VALUES ('2', 'Chacarita');
INSERT INTO `localidades` VALUES ('3', 'Colegiales');
INSERT INTO `localidades` VALUES ('4', 'Once');
INSERT INTO `localidades` VALUES ('5', 'Palermo');

-- ----------------------------
-- Table structure for marcas
-- ----------------------------
DROP TABLE IF EXISTS `marcas`;
CREATE TABLE `marcas` (
  `id_marca` int(50) NOT NULL AUTO_INCREMENT,
  `marca` varchar(50) NOT NULL,
  PRIMARY KEY (`id_marca`),
  UNIQUE KEY `id_marca` (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of marcas
-- ----------------------------
INSERT INTO `marcas` VALUES ('1', 'Molto');
INSERT INTO `marcas` VALUES ('2', 'La Campagnola');
INSERT INTO `marcas` VALUES ('3', 'Salsati');
INSERT INTO `marcas` VALUES ('4', 'Arcor');
INSERT INTO `marcas` VALUES ('5', 'Krach-Itos');
INSERT INTO `marcas` VALUES ('6', 'Lay´s');
INSERT INTO `marcas` VALUES ('7', 'Pringles');
INSERT INTO `marcas` VALUES ('8', 'Bun');
INSERT INTO `marcas` VALUES ('9', 'Cheetos');
INSERT INTO `marcas` VALUES ('10', 'Pehuamar');

-- ----------------------------
-- Table structure for niveles
-- ----------------------------
DROP TABLE IF EXISTS `niveles`;
CREATE TABLE `niveles` (
  `id_nivel` int(10) NOT NULL AUTO_INCREMENT,
  `nivel` varchar(20) NOT NULL,
  UNIQUE KEY `id_nivel` (`id_nivel`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of niveles
-- ----------------------------
INSERT INTO `niveles` VALUES ('1', 'admin');
INSERT INTO `niveles` VALUES ('2', 'usuario');

-- ----------------------------
-- Table structure for productos
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id_producto` int(50) NOT NULL AUTO_INCREMENT,
  `id_marca` int(50) NOT NULL,
  `nombre` varchar(100) NOT NULL DEFAULT '',
  `presentacion` varchar(100) NOT NULL DEFAULT '',
  `precio` decimal(7,2) NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  UNIQUE KEY `id_producto` (`id_producto`),
  KEY `productos_marcas` (`id_marca`),
  CONSTRAINT `productos_marcas` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of productos
-- ----------------------------
INSERT INTO `productos` VALUES ('1', '1', 'Pure de tomate', 'Brick x 520 g', '28.00', '1.jpg');
INSERT INTO `productos` VALUES ('2', '2', 'Pure de tomate', 'Brick x 520 g', '25.00', '2.jpg');
INSERT INTO `productos` VALUES ('3', '1', 'Tomate Perita entero', 'Lata x 400 g', '23.00', '3.jpg');
INSERT INTO `productos` VALUES ('4', '2', 'Tomate Perita entero', 'Lata x 400 g', '25.00', '4.jpg');
INSERT INTO `productos` VALUES ('5', '3', 'Tomate Cubeteado', 'Lata x 400 g', '29.00', '5.jpg');
INSERT INTO `productos` VALUES ('6', '4', 'Pure de tomate', 'Brick x 520 g', '21.00', '6.jpg');
INSERT INTO `productos` VALUES ('7', '3', 'Tomate Perita con pure', 'Lata 415 g', '32.00', '7.jpg');
INSERT INTO `productos` VALUES ('8', '5', 'Papas Fritas', 'Paquete x 120 g', '62.00', '8.jpg');
INSERT INTO `productos` VALUES ('9', '6', 'Papas Fritas', 'Paquete x 140 g', '68.00', '9.jpg');
INSERT INTO `productos` VALUES ('10', '7', 'Papas Fritas Pizza', 'Tubo x 137 g', '72.00', '10.jpg');
INSERT INTO `productos` VALUES ('11', '8', 'Papas Fritas', 'Bolsa x 300 g', '74.00', '11.jpg');
INSERT INTO `productos` VALUES ('12', '5', 'Palitos de maíz', 'Paquete x 65 g', '71.00', '12.jpg');
INSERT INTO `productos` VALUES ('13', '9', 'Palitos de maíz - queso', 'Bolsa x 29 g', '35.00', '13.jpg');
INSERT INTO `productos` VALUES ('14', '5', 'Palitos salados', 'Paquete x 65 g', '32.00', '14.jpg');
INSERT INTO `productos` VALUES ('15', '10', 'Palitos salados', 'Bolsa x 40 g', '28.00', '15.jpg');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(50) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) NOT NULL DEFAULT '',
  `clave` varchar(10) NOT NULL,
  `nombre` varchar(20) NOT NULL DEFAULT '',
  `apellido` varchar(20) NOT NULL DEFAULT '',
  `id_localidad` int(50) NOT NULL,
  `id_nivel` int(10) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  KEY `usuarios_localidades` (`id_localidad`),
  KEY `usuarios_niveles` (`id_nivel`),
  CONSTRAINT `usuarios_localidades` FOREIGN KEY (`id_localidad`) REFERENCES `localidades` (`id_localidad`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usuarios_niveles` FOREIGN KEY (`id_nivel`) REFERENCES `niveles` (`id_nivel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('1', 'pepe@pepe.com', '123', 'Juan', 'Pérez', '3', '1');
INSERT INTO `usuarios` VALUES ('2', 'ana@ana.com', '123', 'Ana', 'García', '1', '2');
INSERT INTO `usuarios` VALUES ('3', 'ceci@ceci.com', '123', 'Cecilia', 'Florez', '1', '2');
INSERT INTO `usuarios` VALUES ('4', 'car@car.com', '123', 'Carlos', 'Juarez', '2', '2');
INSERT INTO `usuarios` VALUES ('5', 'rob@rob.com', '123', 'Roberto', 'López', '3', '2');
INSERT INTO `usuarios` VALUES ('6', 'ram@ram.com', '123', 'Ramiro', 'García', '5', '2');
INSERT INTO `usuarios` VALUES ('7', 'gri@gri.com', '123', 'Griselda', 'Totora', '4', '2');
INSERT INTO `usuarios` VALUES ('8', 'clau@clau.com', '123', 'Claudia', 'Ceres', '5', '2');
INSERT INTO `usuarios` VALUES ('9', 'van@van.com', '123', 'Vanina', 'Mieres', '3', '2');
INSERT INTO `usuarios` VALUES ('10', 'an@an.com', '123', 'Andrés', 'López', '2', '2');
INSERT INTO `usuarios` VALUES ('11', 'pepe@grillo', '123', 'pepe', 'grillo', '3', '1');
INSERT INTO `usuarios` VALUES ('12', 'pepe@grillo', '123', 'pepe', 'grillo', '3', '1');
