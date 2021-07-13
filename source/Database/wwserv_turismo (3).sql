-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 13/07/2021 às 14:04
-- Versão do servidor: 5.7.34
-- Versão do PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `wwserv_turismo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nome_categoria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nome_categoria`) VALUES
(1, 'Adulto'),
(2, 'Criança'),
(3, 'Criança - Colo'),
(4, 'Criança - 4 à 10 anos ');

-- --------------------------------------------------------

--
-- Estrutura para tabela `comissoes`
--

CREATE TABLE `comissoes` (
  `id_comissao` int(11) NOT NULL,
  `id_responsavel_fk` int(11) NOT NULL,
  `id_vendedor_fk` int(11) NOT NULL,
  `valor_enviado` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `comissoes`
--

INSERT INTO `comissoes` (`id_comissao`, `id_responsavel_fk`, `id_vendedor_fk`, `valor_enviado`, `created_at`) VALUES
(2, 14, 23, 100, '2021-04-20 13:33:49');

-- --------------------------------------------------------

--
-- Estrutura para tabela `destinos`
--

CREATE TABLE `destinos` (
  `id_destino` int(11) NOT NULL,
  `nome_destino` varchar(50) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `fk_login_destino_loja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `destinos`
--

INSERT INTO `destinos` (`id_destino`, `nome_destino`, `endereco`, `fk_login_destino_loja`) VALUES
(22, '3 PRAIS EM 1 DIAS ', '', 14),
(23, 'CANOA QUEBRADA', '', 14),
(24, 'MORRO BRANCO', '', 14),
(25, 'AGUAS BELAS', '', 14),
(26, 'COMBUCO', '', 14),
(27, 'TRASFER BEACH PARK', '', 14),
(28, 'LAGOINHA ', '', 14),
(29, 'MUNDAU OU FLECHEIRAS', '', 14),
(30, 'JERI 1 DIA COM OU SEM BURACO', '', 14),
(31, 'JERI TRASFER COM PASSEIO E BURACO', '', 14),
(32, 'LAGOINHA ', '', 14),
(33, 'JERY TRAFER SEM PASSEIO', '', 14);

-- --------------------------------------------------------

--
-- Estrutura para tabela `familia`
--

CREATE TABLE `familia` (
  `id_familia` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `rg` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefone1` varchar(20) NOT NULL,
  `telefone2` varchar(20) NOT NULL,
  `id_destino_fk` int(11) DEFAULT NULL,
  `id_veiculo_fk` int(11) DEFAULT NULL,
  `id_passagem_fk` int(11) DEFAULT NULL,
  `id_vendedor_fk` int(11) DEFAULT NULL,
  `valor_na_epoca` float DEFAULT NULL,
  `valor_de_venda` float DEFAULT NULL,
  `codigo_familia` varchar(20) NOT NULL,
  `dia` date NOT NULL,
  `dia_viagem` date DEFAULT NULL,
  `fk_login_familia_loja` int(11) NOT NULL,
  `viagem_finalizada` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `familia`
--

INSERT INTO `familia` (`id_familia`, `nome`, `rg`, `email`, `telefone1`, `telefone2`, `id_destino_fk`, `id_veiculo_fk`, `id_passagem_fk`, `id_vendedor_fk`, `valor_na_epoca`, `valor_de_venda`, `codigo_familia`, `dia`, `dia_viagem`, `fk_login_familia_loja`, `viagem_finalizada`) VALUES
(337, 'João Victo Sousa da Silva', '2313213131', 'vjoao3340@gmail.com', '(85)46548-5486', '(85)46548-5486', 1, 2, 53, 23, 100, 200, 'aced800f', '2021-05-24', '2021-05-24', 14, 'NAO'),
(338, 'Joao', '45646465', '---', '---', '---', 1, 2, 54, 23, 20, 40, 'aced800f', '2021-05-24', '2021-05-24', 14, 'NAO'),
(339, 'Melicia', '888888888', '---', '---', '---', 1, 2, 53, 23, 100, 150, 'aced800f', '2021-05-24', '2021-05-24', 14, 'NAO'),
(340, 'asdasdasda', '1351315156', 'vjoao3340@gmail.com', '(85)99801-0284', '(85)99801-0284', 1, 2, 53, 23, 100, 200, 'bc9f9f7a', '2021-05-24', '2021-05-24', 14, 'NAO'),
(341, 'Karla', '88888888', '---', '---', '---', 1, 2, 54, 23, 20, 40, 'bc9f9f7a', '2021-05-24', '2021-05-24', 14, 'NAO'),
(342, 'Melicia', '9999999999', '---', '---', '---', 1, 2, 53, 23, 100, 250, 'bc9f9f7a', '2021-05-24', '2021-05-24', 14, 'NAO'),
(343, 'adfasdasdas', '9999999', 'vjoao3340@gmail.com', '(41)75488-5484', '(55)41565-6584', 1, 0, 53, 23, 100, 200, '044ce82e', '2021-05-24', '2021-05-19', 14, 'NAO'),
(344, 'João Victo Sousa da Silva', '6445646456456', 'vjoao3340@gmail.com', '(85)46548-5485', '----', 1, 0, 53, 23, 100, 200, '29c190a8', '2021-05-25', '2021-06-01', 14, 'NAO'),
(345, 'Jonas', '88888888888', '---', '---', '---', 1, 0, 54, 23, 20, 40, '29c190a8', '2021-05-25', '2021-06-01', 14, 'NAO'),
(346, 'Lorenzo ', '272727', 'lorenzo@redtagmobile.com.br', '(85)98612-7884', '----', 22, 0, 65, 23, 40, 80, '747eafc9', '2021-05-26', '2021-05-27', 14, 'NAO'),
(347, 'Gianni ', '273736', 'mekr.ge@gmail.com', '(85)98612-7884', '----', 22, 0, 65, 23, 40, 80, 'e61679e0', '2021-06-01', '2021-06-02', 14, 'NAO'),
(348, 'Maria ', '72727', '---', '---', '---', 22, 0, 65, 23, 40, 80, 'e61679e0', '2021-06-01', '2021-06-02', 14, 'NAO'),
(349, 'Gianni ', '3737377', 'mrk.ge@gmail.com', '(85)98712-7884', '----', 22, 0, 65, 23, 40, 80, 'e32348e2', '2021-06-01', '2021-06-15', 14, 'NAO'),
(350, 'Marisb', '383838388', '---', '---', '---', 22, 0, 65, 23, 40, 80, 'e32348e2', '2021-06-01', '2021-06-15', 14, 'NAO'),
(351, 'Joao Victo Sousa da Silva', '32131211202', 'vjoao3340@gmail.com', '(85)99801-0284', '(08)59095-2312', 22, 2, 65, 30, 40, 80, '195113fc', '2021-06-13', '2021-06-30', 14, 'NAO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `hotel`
--

CREATE TABLE `hotel` (
  `id_hotel` int(11) NOT NULL,
  `nome_hotel` varchar(200) NOT NULL,
  `fk_login_hotel_loja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `hotel`
--

INSERT INTO `hotel` (`id_hotel`, `nome_hotel`, `fk_login_hotel_loja`) VALUES
(0, 'não quis hotel', NULL),
(2, 'Disney\'s Grand Floridian Resort & Spa', 14),
(3, 'Fairmont Mayakoba Riviera Maya', 14),
(4, 'JW Marriott San Antonio Resort & Spa', 14);

-- --------------------------------------------------------

--
-- Estrutura para tabela `hotel_familia`
--

CREATE TABLE `hotel_familia` (
  `id_hotel_familia` int(11) NOT NULL,
  `id_destino_fk` int(11) DEFAULT NULL,
  `id_hotel_fk` int(11) DEFAULT NULL,
  `id_vendedor_fk` int(11) DEFAULT NULL,
  `codigo_familia` varchar(100) NOT NULL,
  `n_apartamento` text,
  `valor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `hotel_familia`
--

INSERT INTO `hotel_familia` (`id_hotel_familia`, `id_destino_fk`, `id_hotel_fk`, `id_vendedor_fk`, `codigo_familia`, `n_apartamento`, `valor`) VALUES
(176, 1, 3, 23, 'aced800f', '26 andar 2', 400),
(177, 1, 0, 23, 'bc9f9f7a', '-----', 0),
(178, 1, 3, 23, '044ce82e', '1321321', 200),
(179, 1, 3, 23, '29c190a8', '26 ', 400),
(180, 22, 0, 23, '747eafc9', '-----', 0),
(181, 22, 0, 23, 'e61679e0', '-----', 0),
(182, 22, 0, 23, 'e32348e2', '-----', 0),
(183, 22, 0, 30, '195113fc', '-----', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `nivel_acesso_fk` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `telefone2` varchar(20) NOT NULL,
  `telefone3` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `site` varchar(256) NOT NULL,
  `cnpj` varchar(100) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `nome_loja` varchar(200) DEFAULT NULL,
  `fk_login_loja` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `login`
--

INSERT INTO `login` (`id_login`, `nivel_acesso_fk`, `email`, `senha`, `telefone`, `telefone2`, `telefone3`, `nome`, `site`, `cnpj`, `endereco`, `nome_loja`, `fk_login_loja`, `status`) VALUES
(13, 3, 'admin@sistema.com', '21232f297a57a5a743894a0e4a801fc3', '', '', '', 'João Victo Sousa da Silva', '', '', '', 'SDI- Sintrome da dorsal Imaginaria', 13, NULL),
(14, 1, 'planeta.tur@hotmail.com', 'ad14a84ec93b82ec36c4cc84c723cccf', '(85) 9662-6929', '(85) 8687-5597', '(85) 3081-7101', 'Seu marcos ', 'www.planeta.turviagens.com', '145071040001-00', 'Osvaldo Cruz Nº1 Sala 13 Fortaleza - CE', 'Planeta Tur', 13, 'ativo'),
(23, 2, 'mateus@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', 'Matheus Feitosa', '', '', '', NULL, 14, NULL),
(26, 2, 'lucas@gmail.com', 'fb57741ccfb34321f0fc17eee416f735', '', '', '', 'Lucas Silva', '', '', '', NULL, 14, NULL),
(29, 1, 'luigi@gmail.com', 'e9da82f4c252e7f1745ae88f2624fc07', '', '', '', 'luigi', '', '', '', 'Teste de loja', 13, 'ativo'),
(30, 2, 'john@gmail.com', '1f9d9a9efc2f523b2f09629444632b5c', '', '', '', 'John', '', '', '', NULL, 14, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `nivel_acesso`
--

CREATE TABLE `nivel_acesso` (
  `id_nivel_acesso` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `nivel_acesso`
--

INSERT INTO `nivel_acesso` (`id_nivel_acesso`, `nome`, `nivel`) VALUES
(1, 'Admin', 1),
(2, 'Vendedor', 2),
(3, 'Master', 3),
(4, 'administrador loja', 4),
(5, 'asdfas sdfg', 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `passagem`
--

CREATE TABLE `passagem` (
  `id_passagem` int(11) NOT NULL,
  `id_destino_fk` int(11) NOT NULL,
  `id_categoria_fk` int(11) NOT NULL,
  `valor` float(10,2) NOT NULL,
  `data_ir` date DEFAULT NULL,
  `data_voltar` date DEFAULT NULL,
  `id_loja_login_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `passagem`
--

INSERT INTO `passagem` (`id_passagem`, `id_destino_fk`, `id_categoria_fk`, `valor`, `data_ir`, `data_voltar`, `id_loja_login_fk`) VALUES
(65, 22, 1, 40.00, NULL, NULL, 14),
(66, 22, 2, 0.00, NULL, NULL, 14),
(67, 22, 3, 0.00, NULL, NULL, 14),
(68, 22, 4, 0.00, NULL, NULL, 14),
(69, 23, 1, 45.00, NULL, NULL, 14),
(70, 23, 2, 0.00, NULL, NULL, 14),
(71, 23, 3, 0.00, NULL, NULL, 14),
(72, 23, 4, 0.00, NULL, NULL, 14),
(73, 24, 1, 35.00, NULL, NULL, 14),
(74, 24, 2, 0.00, NULL, NULL, 14),
(75, 24, 3, 0.00, NULL, NULL, 14),
(76, 24, 4, 0.00, NULL, NULL, 14),
(77, 25, 1, 35.00, NULL, NULL, 14),
(78, 25, 2, 0.00, NULL, NULL, 14),
(79, 25, 3, 0.00, NULL, NULL, 14),
(80, 25, 4, 0.00, NULL, NULL, 14),
(81, 27, 1, 30.00, NULL, NULL, 14),
(82, 27, 2, 0.00, NULL, NULL, 14),
(83, 27, 3, 0.00, NULL, NULL, 14),
(84, 27, 4, 0.00, NULL, NULL, 14),
(85, 28, 1, 40.00, NULL, NULL, 14),
(86, 28, 2, 0.00, NULL, NULL, 14),
(87, 28, 3, 0.00, NULL, NULL, 14),
(88, 28, 4, 0.00, NULL, NULL, 14),
(89, 29, 1, 50.00, NULL, NULL, 14),
(90, 29, 2, 0.00, NULL, NULL, 14),
(91, 29, 3, 0.00, NULL, NULL, 14),
(92, 29, 4, 0.00, NULL, NULL, 14),
(93, 30, 1, 100.00, NULL, NULL, 14),
(94, 30, 2, 0.00, NULL, NULL, 14),
(95, 30, 3, 0.00, NULL, NULL, 14),
(96, 30, 4, 0.00, NULL, NULL, 14),
(97, 31, 1, 80.00, NULL, NULL, 14),
(98, 31, 2, 0.00, NULL, NULL, 14),
(99, 31, 3, 0.00, NULL, NULL, 14),
(100, 31, 4, 0.00, NULL, NULL, 14),
(101, 33, 1, 70.00, NULL, NULL, 14),
(102, 33, 2, 0.00, NULL, NULL, 14),
(103, 33, 3, 0.00, NULL, NULL, 14),
(104, 33, 4, 0.00, NULL, NULL, 14);

-- --------------------------------------------------------

--
-- Estrutura para tabela `passeio`
--

CREATE TABLE `passeio` (
  `id_passeio` int(11) NOT NULL,
  `id_destino_fk` int(11) NOT NULL,
  `id_veiculo_fk` int(11) NOT NULL,
  `responsavel` varchar(200) NOT NULL,
  `categoria` int(11) NOT NULL,
  `dia_viagem` date NOT NULL,
  `fk_login_passeio_loja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `passeio`
--

INSERT INTO `passeio` (`id_passeio`, `id_destino_fk`, `id_veiculo_fk`, `responsavel`, `categoria`, `dia_viagem`, `fk_login_passeio_loja`) VALUES
(18, 1, 4, ' Larry Page ', 1, '2021-06-01', 14),
(19, 1, 4, 'MarkZuquerBerg', 2, '2021-06-01', 14),
(20, 1, 2, ' Larry Page ', 1, '2021-05-24', 14),
(21, 1, 2, 'Mateus Sousa', 2, '2021-05-24', 14);

-- --------------------------------------------------------

--
-- Estrutura para tabela `passeio2`
--

CREATE TABLE `passeio2` (
  `id_passeio` int(11) NOT NULL,
  `id_destino_fk` int(11) NOT NULL,
  `data_ir` date NOT NULL,
  `data_voltar` date NOT NULL,
  `id_passeio_loja_fk` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ponto_de_encontro`
--

CREATE TABLE `ponto_de_encontro` (
  `id_ponto_encontro` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `horario` varchar(100) NOT NULL,
  `id_destino_fk` int(11) NOT NULL,
  `id_loja_ponto_encontro_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `ponto_de_encontro`
--

INSERT INTO `ponto_de_encontro` (`id_ponto_encontro`, `descricao`, `horario`, `id_destino_fk`, `id_loja_ponto_encontro_fk`) VALUES
(5, 'Marcados do Peixes', '11:00', 1, 14),
(9, 'Praia Beira Mar', '10:10', 1, 14),
(10, 'jaaj', '22:37', 1, 14),
(11, 'fdhgdfshgdsfhg', '15:24', 21, 14),
(12, 'aaaaaa', '17:41', 14, 14),
(13, 'beira mar', '15:59', 22, 14);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ponto_encontro`
--

CREATE TABLE `ponto_encontro` (
  `id_ponto_encontro` int(11) NOT NULL,
  `codigo_familia` varchar(100) NOT NULL,
  `id_destino_fk` int(11) NOT NULL,
  `id_vendedor_fk` int(11) NOT NULL,
  `id_ponto_de_encontro_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `ponto_encontro`
--

INSERT INTO `ponto_encontro` (`id_ponto_encontro`, `codigo_familia`, `id_destino_fk`, `id_vendedor_fk`, `id_ponto_de_encontro_fk`) VALUES
(115, 'aced800f', 1, 23, 9),
(116, 'bc9f9f7a', 1, 23, 10),
(117, '044ce82e', 1, 23, 5),
(118, '29c190a8', 1, 23, 5),
(119, '747eafc9', 22, 23, 13),
(120, 'e61679e0', 22, 23, 13),
(121, 'e32348e2', 22, 23, 13),
(122, '195113fc', 22, 30, 13);

-- --------------------------------------------------------

--
-- Estrutura para tabela `transacoes`
--

CREATE TABLE `transacoes` (
  `id_transacao` int(11) NOT NULL,
  `id_responsavel_fk` int(11) NOT NULL,
  `id_vendedor_fk` int(11) NOT NULL,
  `valor_enviado` float NOT NULL,
  `categoria` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `transacoes`
--

INSERT INTO `transacoes` (`id_transacao`, `id_responsavel_fk`, `id_vendedor_fk`, `valor_enviado`, `categoria`, `created_at`) VALUES
(19, 14, 30, 80, 2, '2021-06-13 16:16:19'),
(20, 14, 30, 40, 1, '2021-06-13 16:16:51');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vaucher`
--

CREATE TABLE `vaucher` (
  `id_vaucher` int(11) NOT NULL,
  `id_vendedor_fk` int(11) NOT NULL,
  `codigo_familia` varchar(200) NOT NULL,
  `entrada` float NOT NULL,
  `restante` float NOT NULL,
  `forma_de_pagamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `vaucher`
--

INSERT INTO `vaucher` (`id_vaucher`, `id_vendedor_fk`, `codigo_familia`, `entrada`, `restante`, `forma_de_pagamento`) VALUES
(143, 23, 'aced800f', 200, 0, 3),
(144, 23, 'bc9f9f7a', 400, 0, 3),
(145, 23, '044ce82e', 400, 0, 3),
(146, 23, '29c190a8', 200, 0, 3),
(147, 23, '747eafc9', 10, 0, 1),
(148, 23, 'e61679e0', 60, 0, 1),
(149, 23, 'e32348e2', 40, 0, 1),
(150, 30, '195113fc', 100, 0, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `id_veiculo` int(11) NOT NULL,
  `nome_veiculo` varchar(30) NOT NULL,
  `placa` varchar(200) NOT NULL,
  `capacidade` int(11) NOT NULL,
  `id_destino_fk` int(11) DEFAULT NULL,
  `disponivel` varchar(100) NOT NULL,
  `fk_login_veiculo_loja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `veiculo`
--

INSERT INTO `veiculo` (`id_veiculo`, `nome_veiculo`, `placa`, `capacidade`, `id_destino_fk`, `disponivel`, `fk_login_veiculo_loja`) VALUES
(0, 'sem veiculo', '', 2147483647, NULL, '', NULL),
(2, 'Mini Vann', 'BRAOS19', 31, NULL, 'SIM', 14),
(3, 'Onibus mega', 'BRA2E19', 70, NULL, 'SIM', 14),
(4, 'Onibus mega grandão', 'J84R5BRA', 90, NULL, 'SIM', 14);

-- --------------------------------------------------------

--
-- Estrutura para tabela `veiculo_familia`
--

CREATE TABLE `veiculo_familia` (
  `id_veiculo_familia` int(11) NOT NULL,
  `id_veiculo_fk` int(11) NOT NULL,
  `codigo_familia` varchar(70) NOT NULL,
  `fk_login_veiculo_familia_loja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id_vendas` int(11) NOT NULL,
  `id_passagem_fk` int(11) NOT NULL,
  `id_vendedor_login_fk` int(11) NOT NULL,
  `dia` date NOT NULL,
  `valor_na_epoca` float NOT NULL,
  `valor_de_venda` float DEFAULT NULL,
  `fk_login_vendas_loja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices de tabela `comissoes`
--
ALTER TABLE `comissoes`
  ADD PRIMARY KEY (`id_comissao`);

--
-- Índices de tabela `destinos`
--
ALTER TABLE `destinos`
  ADD PRIMARY KEY (`id_destino`),
  ADD KEY `fk_login_destino_loja` (`fk_login_destino_loja`);

--
-- Índices de tabela `familia`
--
ALTER TABLE `familia`
  ADD PRIMARY KEY (`id_familia`);

--
-- Índices de tabela `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id_hotel`),
  ADD KEY `fk_login_hotel_loja` (`fk_login_hotel_loja`);

--
-- Índices de tabela `hotel_familia`
--
ALTER TABLE `hotel_familia`
  ADD PRIMARY KEY (`id_hotel_familia`),
  ADD KEY `id_hotel_familia` (`id_hotel_fk`);

--
-- Índices de tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`),
  ADD KEY `fk_login_loja` (`fk_login_loja`);

--
-- Índices de tabela `nivel_acesso`
--
ALTER TABLE `nivel_acesso`
  ADD PRIMARY KEY (`id_nivel_acesso`);

--
-- Índices de tabela `passagem`
--
ALTER TABLE `passagem`
  ADD PRIMARY KEY (`id_passagem`),
  ADD KEY `id_destino_fk` (`id_destino_fk`),
  ADD KEY `id_categoria_fk` (`id_categoria_fk`),
  ADD KEY `id_loja_login_fk` (`id_loja_login_fk`);

--
-- Índices de tabela `passeio`
--
ALTER TABLE `passeio`
  ADD PRIMARY KEY (`id_passeio`);

--
-- Índices de tabela `passeio2`
--
ALTER TABLE `passeio2`
  ADD PRIMARY KEY (`id_passeio`),
  ADD KEY `id_destino_fkdij` (`id_destino_fk`),
  ADD KEY `id_passeio_loja_fk21` (`id_passeio_loja_fk`);

--
-- Índices de tabela `ponto_de_encontro`
--
ALTER TABLE `ponto_de_encontro`
  ADD PRIMARY KEY (`id_ponto_encontro`);

--
-- Índices de tabela `ponto_encontro`
--
ALTER TABLE `ponto_encontro`
  ADD PRIMARY KEY (`id_ponto_encontro`);

--
-- Índices de tabela `transacoes`
--
ALTER TABLE `transacoes`
  ADD PRIMARY KEY (`id_transacao`);

--
-- Índices de tabela `vaucher`
--
ALTER TABLE `vaucher`
  ADD PRIMARY KEY (`id_vaucher`);

--
-- Índices de tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`id_veiculo`),
  ADD KEY `fk_login_veiculo_loja` (`fk_login_veiculo_loja`),
  ADD KEY `id_destino_fksda` (`id_destino_fk`);

--
-- Índices de tabela `veiculo_familia`
--
ALTER TABLE `veiculo_familia`
  ADD PRIMARY KEY (`id_veiculo_familia`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id_vendas`),
  ADD KEY `id_vendedor_login_fk` (`id_vendedor_login_fk`),
  ADD KEY `id_passagem_fk` (`id_passagem_fk`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `comissoes`
--
ALTER TABLE `comissoes`
  MODIFY `id_comissao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `destinos`
--
ALTER TABLE `destinos`
  MODIFY `id_destino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `familia`
--
ALTER TABLE `familia`
  MODIFY `id_familia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- AUTO_INCREMENT de tabela `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id_hotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `hotel_familia`
--
ALTER TABLE `hotel_familia`
  MODIFY `id_hotel_familia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `nivel_acesso`
--
ALTER TABLE `nivel_acesso`
  MODIFY `id_nivel_acesso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `passagem`
--
ALTER TABLE `passagem`
  MODIFY `id_passagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de tabela `passeio`
--
ALTER TABLE `passeio`
  MODIFY `id_passeio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `passeio2`
--
ALTER TABLE `passeio2`
  MODIFY `id_passeio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `ponto_de_encontro`
--
ALTER TABLE `ponto_de_encontro`
  MODIFY `id_ponto_encontro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `ponto_encontro`
--
ALTER TABLE `ponto_encontro`
  MODIFY `id_ponto_encontro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT de tabela `transacoes`
--
ALTER TABLE `transacoes`
  MODIFY `id_transacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `vaucher`
--
ALTER TABLE `vaucher`
  MODIFY `id_vaucher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT de tabela `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `id_veiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `veiculo_familia`
--
ALTER TABLE `veiculo_familia`
  MODIFY `id_veiculo_familia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id_vendas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `hotel_familia`
--
ALTER TABLE `hotel_familia`
  ADD CONSTRAINT `id_hotel_familia` FOREIGN KEY (`id_hotel_fk`) REFERENCES `hotel` (`id_hotel`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `passagem`
--
ALTER TABLE `passagem`
  ADD CONSTRAINT `passagem_ibfk_1` FOREIGN KEY (`id_destino_fk`) REFERENCES `destinos` (`id_destino`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `passagem_ibfk_2` FOREIGN KEY (`id_categoria_fk`) REFERENCES `categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `passagem_ibfk_3` FOREIGN KEY (`id_loja_login_fk`) REFERENCES `login` (`id_login`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `passeio2`
--
ALTER TABLE `passeio2`
  ADD CONSTRAINT `id_destino_fkasda` FOREIGN KEY (`id_destino_fk`) REFERENCES `destinos` (`id_destino`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_passeio_loja_fk21` FOREIGN KEY (`id_passeio_loja_fk`) REFERENCES `login` (`id_login`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`id_vendedor_login_fk`) REFERENCES `login` (`id_login`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `vendas_ibfk_2` FOREIGN KEY (`id_passagem_fk`) REFERENCES `passagem` (`id_passagem`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
