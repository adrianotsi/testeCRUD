-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 12-Jan-2020 às 20:46
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_crud`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `id_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `tipoE` varchar(25) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `ref` varchar(60) DEFAULT NULL,
  `id_fisica` int(11) DEFAULT NULL,
  `id_juridico` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_endereco`),
  KEY `fk_endereco_p_fisica1_idx` (`id_fisica`),
  KEY `fk_endereco_p_juridica1_idx` (`id_juridico`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `p_fisica`
--

DROP TABLE IF EXISTS `p_fisica`;
CREATE TABLE IF NOT EXISTS `p_fisica` (
  `id_fisica` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(14) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `rg` varchar(14) NOT NULL,
  `sexo` varchar(25) NOT NULL,
  `dt_nascimento` date NOT NULL,
  PRIMARY KEY (`id_fisica`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `p_juridica`
--

DROP TABLE IF EXISTS `p_juridica`;
CREATE TABLE IF NOT EXISTS `p_juridica` (
  `id_juridico` int(11) NOT NULL AUTO_INCREMENT,
  `cnpj` varchar(18) NOT NULL,
  `razao_social` varchar(100) NOT NULL,
  `nome_fantasia` varchar(100) NOT NULL,
  `inscricao_estadual` varchar(11) NOT NULL,
  `dt_fundacao` date NOT NULL,
  PRIMARY KEY (`id_juridico`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefone`
--

DROP TABLE IF EXISTS `telefone`;
CREATE TABLE IF NOT EXISTS `telefone` (
  `id_telefone` int(11) NOT NULL AUTO_INCREMENT,
  `tipoT` varchar(25) NOT NULL,
  `numero` varchar(25) NOT NULL,
  `id_fisica` int(11) DEFAULT NULL,
  `id_juridico` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_telefone`),
  KEY `fk_telefone_p_fisica_idx` (`id_fisica`),
  KEY `fk_telefone_p_juridica1_idx` (`id_juridico`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `fk_endereco_p_fisica1` FOREIGN KEY (`id_fisica`) REFERENCES `p_fisica` (`id_fisica`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_endereco_p_juridica1` FOREIGN KEY (`id_juridico`) REFERENCES `p_juridica` (`id_juridico`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `telefone`
--
ALTER TABLE `telefone`
  ADD CONSTRAINT `fk_telefone_p_fisica` FOREIGN KEY (`id_fisica`) REFERENCES `p_fisica` (`id_fisica`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_telefone_p_juridica1` FOREIGN KEY (`id_juridico`) REFERENCES `p_juridica` (`id_juridico`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
