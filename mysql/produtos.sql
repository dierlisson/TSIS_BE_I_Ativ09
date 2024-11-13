-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 13/11/2024 às 03:09
-- Versão do servidor: 5.6.13
-- Versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `produtos`
--
CREATE DATABASE IF NOT EXISTS `produtos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `produtos`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `idproduto` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `data` varchar(10) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `validade` varchar(10) NOT NULL,
  PRIMARY KEY (`idproduto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Fazendo dump de dados para tabela `produtos`
--

INSERT INTO `produtos` (`idproduto`, `descricao`, `data`, `preco`, `validade`) VALUES
(1, 'asdjasdjan', '12/12/1212', '120.00', '12/12/1244'),
(2, 'asdjasdjan', '12/12/1212', '120.00', '12/12/1244'),
(3, 'teste de atualizaÃ§Ã£o', '12/12/1212', '12.00', '12/12/1212'),
(4, 'teste', '12/13/1212', '115.23', '12/31/1212');
(5, 'tesdte', '12/12/1212', '112.23', '12/12/1212');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
