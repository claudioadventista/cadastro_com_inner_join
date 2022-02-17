-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Fev-2022 às 04:09
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `inner_join_mysqli_tres_tabelas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aparelho`
--

CREATE TABLE `aparelho` (
  `id` int(11) NOT NULL,
  `nome_aparelho` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id` int(11) NOT NULL,
  `ordem_servico` varchar(5) NOT NULL,
  `id_cliente` varchar(5) NOT NULL,
  `id_aparelho` varchar(5) NOT NULL,
  `id_marca` varchar(5) NOT NULL,
  `modelo` varchar(150) NOT NULL,
  `numeroSerie` varchar(100) NOT NULL,
  `id_estado` varchar(5) NOT NULL,
  `defeitoReclamado` varchar(200) NOT NULL,
  `dataEntrada` date NOT NULL,
  `dataPronto` date NOT NULL,
  `dataSaida` date NOT NULL,
  `orcamento` float NOT NULL,
  `material` varchar(254) NOT NULL,
  `acessorio` varchar(200) NOT NULL,
  `obs` varchar(254) NOT NULL,
  `foto` varchar(40) NOT NULL,
  `barra` varchar(11) NOT NULL,
  `excluir` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `telefone2` varchar(15) NOT NULL,
  `cpf` varchar(12) NOT NULL,
  `dataNascimento` date NOT NULL,
  `dataCadastro` date NOT NULL,
  `foto` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `barra` varchar(12) NOT NULL,
  `excluir` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `nome_estado` varchar(50) NOT NULL,
  `sigla_estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `estado`
--

INSERT INTO `estado` (`id`, `nome_estado`, `sigla_estado`) VALUES
(1, 'PARA ORÇAMENTO', 'PO'),
(2, 'SERVIÇO PRONTO', 'SP'),
(3, 'APARELHO SAIU', 'AS'),
(4, 'RETORNOU', 'RT'),
(5, 'DEVOLVEU', 'DV'),
(6, 'COMPROU', 'CO'),
(7, 'DOOU', 'DO'),
(8, 'AGUARDANDO', 'AG');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nome_marca` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aparelho`
--
ALTER TABLE `aparelho`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aparelho`
--
ALTER TABLE `aparelho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de tabela `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
