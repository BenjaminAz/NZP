/*
 Navicat Premium Data Transfer

 Source Server         : base
 Source Server Type    : MySQL
 Source Server Version : 100408
 Source Host           : localhost:3306
 Source Schema         : base

 Target Server Type    : MySQL
 Target Server Version : 100408
 File Encoding         : 65001

 Date: 02/12/2019 19:42:39
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for autos
-- ----------------------------
DROP TABLE IF EXISTS `autos`;
CREATE TABLE `autos`  (
  `id_auto` int(50) NOT NULL AUTO_INCREMENT,
  `id_marca` int(50) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `detalles` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `imagen` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `precio` decimal(7, 2) NOT NULL,
  PRIMARY KEY (`id_auto`) USING BTREE,
  UNIQUE INDEX `id_auto`(`id_auto`) USING BTREE,
  INDEX `autos_marcas`(`id_marca`) USING BTREE,
  CONSTRAINT `autos_marca` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 91 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of autos
-- ----------------------------
INSERT INTO `autos` VALUES (1, 1, '', '', NULL, 0.00);
INSERT INTO `autos` VALUES (2, 2, '', '', NULL, 0.00);
INSERT INTO `autos` VALUES (3, 4, '', '', NULL, 0.00);
INSERT INTO `autos` VALUES (4, 4, '', '', NULL, 0.00);
INSERT INTO `autos` VALUES (5, 5, '', '', NULL, 0.00);
INSERT INTO `autos` VALUES (6, 6, '', '', NULL, 0.00);
INSERT INTO `autos` VALUES (7, 5, '', '', NULL, 0.00);
INSERT INTO `autos` VALUES (8, 6, '', '', NULL, 0.00);
INSERT INTO `autos` VALUES (9, 5, '', '', NULL, 0.00);
INSERT INTO `autos` VALUES (10, 3, '', '', NULL, 0.00);
INSERT INTO `autos` VALUES (11, 8, '', '', NULL, 0.00);
INSERT INTO `autos` VALUES (12, 5, '', '', NULL, 0.00);
INSERT INTO `autos` VALUES (13, 9, '', '', NULL, 0.00);
INSERT INTO `autos` VALUES (14, 3, '', '', NULL, 0.00);
INSERT INTO `autos` VALUES (15, 10, '', '', NULL, 0.00);
INSERT INTO `autos` VALUES (16, 11, '', '', NULL, 0.00);

-- ----------------------------
-- Table structure for comentarios
-- ----------------------------
DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE `comentarios`  (
  `id_comentario` int(50) NOT NULL AUTO_INCREMENT,
  `id_auto` int(50) NOT NULL,
  `comentario` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `fecha` date NULL DEFAULT NULL,
  `id_usuario` int(255) NOT NULL,
  PRIMARY KEY (`id_comentario`) USING BTREE,
  UNIQUE INDEX `id_comentario`(`id_comentario`) USING BTREE,
  INDEX `com_autos`(`id_auto`) USING BTREE,
  INDEX `comentarios_usuario`(`id_usuario`) USING BTREE,
  CONSTRAINT `comentarios_autos` FOREIGN KEY (`id_auto`) REFERENCES `autos` (`id_auto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comentarios_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comentarios
-- ----------------------------
INSERT INTO `comentarios` VALUES (1, 1, 'holaque tal', '2019-12-04', 2);

-- ----------------------------
-- Table structure for localidades
-- ----------------------------
DROP TABLE IF EXISTS `localidades`;
CREATE TABLE `localidades`  (
  `id_localidad` int(50) NOT NULL AUTO_INCREMENT,
  `localidad` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id_localidad`) USING BTREE,
  UNIQUE INDEX `id_localidad`(`id_localidad`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of localidades
-- ----------------------------
INSERT INTO `localidades` VALUES (1, 'Once');
INSERT INTO `localidades` VALUES (2, 'Boedo');
INSERT INTO `localidades` VALUES (3, 'Colegiales');
INSERT INTO `localidades` VALUES (4, 'Parque Patricios');
INSERT INTO `localidades` VALUES (5, 'Palermo');
INSERT INTO `localidades` VALUES (6, 'Recoleta');
INSERT INTO `localidades` VALUES (7, 'Parque Chacabuco');
INSERT INTO `localidades` VALUES (8, 'Caballito');

-- ----------------------------
-- Table structure for marcas
-- ----------------------------
DROP TABLE IF EXISTS `marcas`;
CREATE TABLE `marcas`  (
  `id_marca` int(50) NOT NULL AUTO_INCREMENT,
  `marca` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_marca`) USING BTREE,
  UNIQUE INDEX `id_marca`(`id_marca`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of marcas
-- ----------------------------
INSERT INTO `marcas` VALUES (1, 'Citroën');
INSERT INTO `marcas` VALUES (2, 'Chevrolet');
INSERT INTO `marcas` VALUES (3, 'Alfa Romeo');
INSERT INTO `marcas` VALUES (4, 'Ford');
INSERT INTO `marcas` VALUES (5, 'Audi');
INSERT INTO `marcas` VALUES (6, 'BMW');
INSERT INTO `marcas` VALUES (7, 'Dodge');
INSERT INTO `marcas` VALUES (8, 'Minicooper');
INSERT INTO `marcas` VALUES (9, 'Aston Martin');
INSERT INTO `marcas` VALUES (10, 'Fiat');
INSERT INTO `marcas` VALUES (11, 'Renault');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id_usuario` int(50) NOT NULL AUTO_INCREMENT,
  `e-mail` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `clave` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `apellido` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `id_localidad` int(50) NOT NULL,
  `rol` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE,
  UNIQUE INDEX `id_usuario`(`id_usuario`) USING BTREE,
  INDEX `usuarios_localidades`(`id_localidad`) USING BTREE,
  CONSTRAINT `usuarios_localidades` FOREIGN KEY (`id_localidad`) REFERENCES `localidades` (`id_localidad`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 'tomasnigro18@gmail.com', '123', 'Tomás', 'Nigro', 8, 'admin');
INSERT INTO `usuarios` VALUES (2, 'pepeescalera@gmail.com', '234', 'Pepe', 'Escalera', 4, 'user');

SET FOREIGN_KEY_CHECKS = 1;
