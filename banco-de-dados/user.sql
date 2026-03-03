-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/03/2026 às 20:55
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `inventory`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first name` varchar(50) NOT NULL,
  `last name` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `created-at` datetime NOT NULL,
  `updated-at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `user`
--

INSERT INTO `user` (`id`, `first name`, `last name`, `password`, `email`, `created-at`, `updated-at`) VALUES
(6, 'carlos', 'daniel', '$2y$10$Swjgs/ax2HuvIk64oSGb6ePYY1zGswvJTFOEgy0DbLm/G1biW7Le.', 'carlosdaniel@gmail.com', '2026-03-03 17:35:45', '2026-03-03 17:35:45'),
(8, 'joão', 'victor', '$2y$10$3J6387IkDyDvGidUzeZHnOyW5QUpxrPSJ8.zGjbkChxmvlZy7YXPK', 'joaovictor@gmail.com', '2026-03-03 20:11:54', '2026-03-03 20:11:54'),
(9, 'carlos', 'eduardo', '$2y$10$lvP4D1LZyhH/RzCKVm5JLeek7CcIFi4VC4T..IngQOk2ao9ebSy4K', 'carloseduardo@gmail.com', '2026-03-03 20:35:08', '2026-03-03 20:35:08');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
