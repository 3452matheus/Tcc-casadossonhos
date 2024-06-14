-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Jun-2024 às 03:16
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `site`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cdarquiteto`
--

CREATE TABLE `cdarquiteto` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `rg` int(11) DEFAULT NULL,
  `cpf` int(11) DEFAULT NULL,
  `cau` int(11) DEFAULT NULL,
  `senha` varchar(220) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cdarquiteto`
--

INSERT INTO `cdarquiteto` (`id`, `nome`, `email`, `rg`, `cpf`, `cau`, `senha`) VALUES
(7, 'matheus rufino ', 'rufinomatheus2@gmail.com', 5879597, 2147483647, 0, '$2y$10$bQpMWFpeaYViKCRlLTfYSeLsm7crMcdJp7zCS68Hzpwo9PRug2t9S'),
(16, 'teste', 'test@test.com', 0, 0, 0, '$2y$10$7LJ4YxaKZU/9ChRYM/t9VOujEFKez2c/XfQKZyAbQpKXxz1FiISWW'),
(17, 'admin@admin.com', 'admin@admin.com', NULL, NULL, 0, '$2y$10$j4vSspuA/8hH/iTSHTfRtudgyBP/g.hQM66.6OLOI5P9mZKiP9ABK');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cdarquiteto`
--
ALTER TABLE `cdarquiteto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cdarquiteto`
--
ALTER TABLE `cdarquiteto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
