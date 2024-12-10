-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/12/2024 às 14:47
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
-- Banco de dados: `oficina`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `senha` varchar(200) DEFAULT NULL,
  `telefone` varchar(200) DEFAULT NULL,
  `rg` varchar(200) DEFAULT NULL,
  `cpf` varchar(200) DEFAULT NULL,
  `salario` varchar(200) DEFAULT NULL,
  `sexo` varchar(200) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `end_cidade` varchar(200) DEFAULT NULL,
  `end_estado` varchar(200) DEFAULT NULL,
  `end_cep` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro`
--

INSERT INTO `cadastro` (`id`, `nome`, `email`, `senha`, `telefone`, `rg`, `cpf`, `salario`, `sexo`, `data_nasc`, `end_cidade`, `end_estado`, `end_cep`) VALUES
(2, 'Patricia L. Camargo', 'patricialuciana@gmail.com', '0123!Patricia', '11984140536', '000000000x', '30959593896', 'R$5000', 'feminino', '1982-04-24', 'São Paulo', 'SP', '06765270'),
(3, 'RICHARD CAMARGO DOS SANTOS', 'richardcamargo@gmail.com', 'rcds2005', '11930248633', '56809007x', '521.313.828-47', 'R$2000', 'masculino', '2024-09-20', 'Taboão da Serra', 'mg', '06765270');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(250) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `imagem` varchar(1000) DEFAULT NULL,
  `categoria` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `quantidade`, `imagem`, `categoria`) VALUES
(6, 'Volante', 'Volante Ford Ka+ 2008 original', 2, '673fd00f8cb7a-Volante.jfif', 'volante'),
(7, 'Roda', 'Pneu Civic 2016 ', 4, '673fd04c7fff2-Roda.jfif', 'pneu'),
(8, 'Disco de freio', 'Disco de Freio Astra Cendan 2005', 5, '673fd0ae4c6c6-Freio.jfif', 'freio'),
(9, 'Motor', 'Motor Civic TypR 2020', 1, '673fd0dff00d8-Motor.jfif', 'motor'),
(10, 'Motor', 'Motor Onix cedan 2016', 3, '673fd11e24b44-Motor.jfif', 'motor'),
(11, 'Volante', 'Civic 2015', 2, '673fd80b3241f-Volante.jfif', 'volante');

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

CREATE TABLE `servicos` (
  `id` int(11) NOT NULL,
  `tipoServ` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `nomeCliente` varchar(100) NOT NULL,
  `telCliente` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servicos`
--

INSERT INTO `servicos` (`id`, `tipoServ`, `descricao`, `preco`, `nomeCliente`, `telCliente`, `created_at`) VALUES
(2, 'Regulagem de motor', 'i', 6.00, 'Osvaldo', '11930248633', '2024-11-26 00:16:27');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabelaservico`
--

CREATE TABLE `tabelaservico` (
  `nome` varchar(100) DEFAULT NULL,
  `valor` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
