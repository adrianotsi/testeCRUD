SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_crud
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_crud
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_crud` DEFAULT CHARACTER SET utf8 ;
USE `db_crud` ;

-- -----------------------------------------------------
-- Table `db_crud`.`telefone`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_crud`.`telefone` (
  `id_telefone` INT NOT NULL,
  `nome` VARCHAR(25) NOT NULL,
  `numero` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`id_telefone`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_crud`.`endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_crud`.`endereco` (
  `id_endereco` INT NOT NULL,
  `nome` VARCHAR(25) NOT NULL,
  `cep` VARCHAR(9) NOT NULL,
  `logradouro` VARCHAR(100) NOT NULL,
  `bairro` VARCHAR(100) NULL,
  `cidade` VARCHAR(100) NOT NULL,
  `estado` VARCHAR(100) NOT NULL,
  `numero` VARCHAR(10) NULL,
  `ref` VARCHAR(60) NULL,
  PRIMARY KEY (`id_endereco`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_crud`.`p_fisica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_crud`.`p_fisica` (
  `id_fisica` INT NOT NULL,
  `cpf` VARCHAR(14) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `rg` VARCHAR(14) NOT NULL,
  `sexo` VARCHAR(25) NOT NULL,
  `dt_nascimento` DATE NOT NULL,
  `id_telefone` INT NOT NULL,
  `id_endereco` INT NOT NULL,
  PRIMARY KEY (`id_fisica`),
  INDEX `fk_p_fisica_telefone_idx` (`id_telefone` ASC),
  INDEX `fk_p_fisica_endereco1_idx` (`id_endereco` ASC),
  CONSTRAINT `fk_p_fisica_telefone`
    FOREIGN KEY (`id_telefone`)
    REFERENCES `db_crud`.`telefone` (`id_telefone`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_p_fisica_endereco1`
    FOREIGN KEY (`id_endereco`)
    REFERENCES `db_crud`.`endereco` (`id_endereco`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_crud`.`p_juridica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_crud`.`p_juridica` (
  `id_juridico` INT NOT NULL,
  `cnpj` VARCHAR(18) NOT NULL,
  `razao_social` VARCHAR(100) NOT NULL,
  `nome_fantasia` VARCHAR(100) NOT NULL,
  `inscricao_estadual` VARCHAR(11) NOT NULL,
  `dt_fundacao` DATE NOT NULL,
  `id_telefone` INT NOT NULL,
  `id_endereco` INT NOT NULL,
  PRIMARY KEY (`id_juridico`),
  INDEX `fk_p_juridica_telefone1_idx` (`id_telefone` ASC),
  INDEX `fk_p_juridica_endereco1_idx` (`id_endereco` ASC),
  CONSTRAINT `fk_p_juridica_telefone1`
    FOREIGN KEY (`id_telefone`)
    REFERENCES `db_crud`.`telefone` (`id_telefone`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_p_juridica_endereco1`
    FOREIGN KEY (`id_endereco`)
    REFERENCES `db_crud`.`endereco` (`id_endereco`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
