-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema gruposc2_db_scot
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gruposc2_db_scot
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gruposc2_db_scot` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `gruposc2_db_scot` ;

-- -----------------------------------------------------
-- Table `gruposc2_db_scot`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gruposc2_db_scot`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NULL,
  `name` VARCHAR(255) NULL,
  `remember_token` VARCHAR(100) NULL,
  `password` VARCHAR(60) NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gruposc2_db_scot`.`paquetes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gruposc2_db_scot`.`paquetes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  `descripcion` TEXT NULL,
  `dias` INT(3) NULL,
  `noches` INT(3) NULL,
  `activo` TINYINT NULL,
  `caducidad` DATE NULL,
  `destinos` TEXT NULL,
  `id_galeria` INT(5) NULL,
  `id_tipo_promocion` INT(5) NULL,
  `itinerario_id` SMALLINT NULL,
  `cat_paquete` SMALLINT NULL,
  `tags` TINYTEXT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gruposc2_db_scot`.`galeria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gruposc2_db_scot`.`galeria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `images` TEXT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gruposc2_db_scot`.`imagenes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gruposc2_db_scot`.`imagenes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `file_name` VARCHAR(150) NULL,
  `type` VARCHAR(30) NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gruposc2_db_scot`.`promociones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gruposc2_db_scot`.`promociones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gruposc2_db_scot`.`navieras`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gruposc2_db_scot`.`navieras` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  `logo_id_imagen` INT(5) NULL,
  `descripcion` TEXT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gruposc2_db_scot`.`tipo_promocion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gruposc2_db_scot`.`tipo_promocion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  `sort` INT(5) NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gruposc2_db_scot`.`barcos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gruposc2_db_scot`.`barcos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  `descripcion` TEXT NULL,
  `naviera_id` INT(5) NULL,
  `galeria_id` INT(5) NULL,
  `sort` INT(5) NULL,
  `construccion` DATE NULL,
  `remodelacion` DATE NULL,
  `bandera` VARCHAR(100) NULL,
  `capacidad_max` SMALLINT NULL,
  `tripulantes` INT NULL,
  `cabinas_internas` SMALLINT NULL,
  `cabinas_externas` SMALLINT NULL,
  `cabinas_externas_balcon` SMALLINT NULL,
  `cabinas_suite_balcon` SMALLINT NULL,
  `cap_max_cabina` SMALLINT NULL,
  `restriccion_edad` VARCHAR(250) NULL,
  `turnos_comida` SMALLINT NULL,
  `asientos_asignados` TINYINT(1) NULL DEFAULT 0,
  `horario_comida` VARCHAR(150) NULL,
  `vestimenta_comedor` VARCHAR(150) NULL,
  `tonelaje` INT NULL,
  `eslora` INT NULL,
  `manga` INT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gruposc2_db_scot`.`noticias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gruposc2_db_scot`.`noticias` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descripcion` TEXT NULL,
  `activo` TINYINT(1) NULL,
  `update_at` DATETIME NULL,
  `creation_at` DATETIME NULL,
  `galeria_id` INT(5) NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gruposc2_db_scot`.`imagenes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gruposc2_db_scot`.`imagenes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `file_name` VARCHAR(150) NULL,
  `type` VARCHAR(30) NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gruposc2_db_scot`.`convertibilidad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gruposc2_db_scot`.`convertibilidad` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data` TEXT NULL,
  `name` VARCHAR(100) NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gruposc2_db_scot`.`itinerario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gruposc2_db_scot`.`itinerario` (
  `id` INT NOT NULL,
  `data` TEXT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gruposc2_db_scot`.`hoteles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gruposc2_db_scot`.`hoteles` (
  `id` SMALLINT NOT NULL,
  `nombre` VARCHAR(100) NULL,
  `descripcion` TEXT NULL,
  `ubicacion` TEXT NULL,
  `comodidades` TEXT NULL,
  `galeria_id` SMALLINT NULL,
  `vigencia` TEXT NULL,
  `regimen_id` SMALLINT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gruposc2_db_scot`.`regimenes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gruposc2_db_scot`.`regimenes` (
  `id` SMALLINT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gruposc2_db_scot`.`categoria_paquetes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gruposc2_db_scot`.`categoria_paquetes` (
  `id` SMALLINT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gruposc2_db_scot`.`suscripciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gruposc2_db_scot`.`suscripciones` (
  `id` INT NOT NULL,
  `email` VARCHAR(150) NULL,
  `name` VARCHAR(150) NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gruposc2_db_scot`.`password_resets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gruposc2_db_scot`.`password_resets` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
