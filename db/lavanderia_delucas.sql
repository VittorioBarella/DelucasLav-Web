
CREATE DATABASE lavanderia_delucas;

USE lavanderia_delucas;

-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2018 at 08:25 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lavanderia_delucas`
--

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nomeCliente` varchar(40) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `estoque_material`
--

CREATE TABLE `estoque_material` (
  `idMaterial` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `nomeMaterial` varchar(10) DEFAULT NULL,
  `idFornecedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fornecedor`
--

CREATE TABLE `fornecedor` (
  `idFornecedor` int(11) NOT NULL,
  `nomeFornecedor` varchar(30) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_higienizacao`
--

CREATE TABLE `item_higienizacao` (
  `item` varchar(10) DEFAULT NULL,
  `idItem` int(11) NOT NULL,
  `preco` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_ods`
--

CREATE TABLE `item_ods` (
  `quantidade` int(11) DEFAULT NULL,
  `idItemOds` int(11) NOT NULL,
  `somaTotalItem` float DEFAULT NULL,
  `idOds` int(11) DEFAULT NULL,
  `idItem` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ordem_servico`
--

CREATE TABLE `ordem_servico` (
  `idOds` int(11) NOT NULL,
  `dataEntrega` date DEFAULT NULL,
  `precoTotal` decimal(10,2) DEFAULT NULL,
  `dataRecebimento` date DEFAULT NULL,
  `idCliente` int(11) DEFAULT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) NOT NULL,
  `email` varchar(220) NOT NULL,
  `usuario` varchar(220) NOT NULL,
  `senha` varchar(220) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `usuario`, `senha`) VALUES
(2, 'VittÃ³rio Andrade', 'vittorio.br@hotmail.com', 'VittÃ³rio', '$2y$10$AuPZCOYkrfkagNrkbyjvtu4WuBy60vG.Ju4SsHzfIVxlsiSw4cPp6'),
(4, 'Luciano S. Junior', 'luciano.ssj@hotmail.com', 'lucianossj', '$2y$10$mz1AUfXvN3lP5uuZC/epd.J2535DGA6erA/030JOMqoghK2t1nrA2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indexes for table `estoque_material`
--
ALTER TABLE `estoque_material`
  ADD PRIMARY KEY (`idMaterial`),
  ADD KEY `idFornecedor` (`idFornecedor`);

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`idFornecedor`);

--
-- Indexes for table `item_higienizacao`
--
ALTER TABLE `item_higienizacao`
  ADD PRIMARY KEY (`idItem`);

--
-- Indexes for table `item_ods`
--
ALTER TABLE `item_ods`
  ADD PRIMARY KEY (`idItemOds`),
  ADD KEY `idOds` (`idOds`),
  ADD KEY `idItem` (`idItem`);

--
-- Indexes for table `ordem_servico`
--
ALTER TABLE `ordem_servico`
  ADD PRIMARY KEY (`idOds`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estoque_material`
--
ALTER TABLE `estoque_material`
  MODIFY `idMaterial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `idFornecedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_higienizacao`
--
ALTER TABLE `item_higienizacao`
  MODIFY `idItem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_ods`
--
ALTER TABLE `item_ods`
  MODIFY `idItemOds` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ordem_servico`
--
ALTER TABLE `ordem_servico`
  MODIFY `idOds` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `estoque_material`
--
ALTER TABLE `estoque_material`
  ADD CONSTRAINT `estoque_material_ibfk_1` FOREIGN KEY (`idFornecedor`) REFERENCES `fornecedor` (`idFornecedor`);

--
-- Constraints for table `item_ods`
--
ALTER TABLE `item_ods`
  ADD CONSTRAINT `item_ods_ibfk_1` FOREIGN KEY (`idOds`) REFERENCES `ordem_servico` (`idOds`),
  ADD CONSTRAINT `item_ods_ibfk_2` FOREIGN KEY (`idItem`) REFERENCES `item_higienizacao` (`idItem`);

--
-- Constraints for table `ordem_servico`
--
ALTER TABLE `ordem_servico`
  ADD CONSTRAINT `ordem_servico_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
