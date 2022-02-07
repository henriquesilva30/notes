-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Dez-2021 às 14:55
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `221b`
--
CREATE DATABASE IF NOT EXISTS `221b` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `221b`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `apontamento`
--

CREATE TABLE `apontamento` (
  `id_apontamento` int(11) NOT NULL,
  `descricao` varchar(64) NOT NULL,
  `nota` varchar(255) NOT NULL,
  `id_tipo_apontamento` int(11) NOT NULL,
  `registo` date NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `visualizar` int(1) NOT NULL,
  `id_utilizador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `apontamento`
--

INSERT INTO `apontamento` (`id_apontamento`, `descricao`, `nota`, `id_tipo_apontamento`, `registo`, `imagem`, `visualizar`, `id_utilizador`) VALUES
(41, 'rosa', 'y-m-d', 7, '2021-12-08', '1', 1, 2),
(51, 'Bug na combo', 'no editar não atribui valor ao buscar id do apontamento', 5, '2021-12-13', '1', 0, 1),
(53, 'Fazer filtro', 'registo, tipos de apontamento, apontamentos em que se pode visua', 4, '2021-12-13', '0', 1, 1),
(54, 'Email não edita quando modificado', 'editar os valores da cookie', 4, '2021-12-13', '1', 1, 1),
(56, 'Terceira edica', 'mudar valor para não e o tipo de apontamentosXX', 3, '2021-12-18', '0', 0, 1),
(66, 'Teste', 'imagem', 3, '2021-12-24', 'https://s1.static.brasilescola.uol.com.br/be/conteudo/images/imagem-em-lente-convexa.jpg', 1, 19),
(68, 'Primeiro', 'teste', 1, '2021-12-27', '1', 1, 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_apontamento`
--

CREATE TABLE `tipo_apontamento` (
  `id_tipo_apontamento` int(11) NOT NULL,
  `descricao` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipo_apontamento`
--

INSERT INTO `tipo_apontamento` (`id_tipo_apontamento`, `descricao`) VALUES
(1, 'Objeto'),
(2, 'Documento'),
(3, 'Livro'),
(4, 'Aniversário'),
(5, 'Data importante'),
(6, 'Reunião'),
(7, 'Recado importante'),
(8, 'Nota');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE `utilizador` (
  `id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(16) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `ativo` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`id`, `email`, `password`, `nome`, `ativo`) VALUES
(1, 'hsa@ipvc.pt', 'qwerty', 'Henrique Joel Lima da Silva', '0'),
(2, 'test@ipvc.pt', 'test', 'UserTeste', '0'),
(19, 'test@ativo', 'ativo', 'Joel', '1'),
(20, 'novo@ativo', '123', 'joel', '1'),
(21, '123@test', '123', '123', '1'),
(22, 'abr@ab', 'ab', 'abr', '1');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `apontamento`
--
ALTER TABLE `apontamento`
  ADD PRIMARY KEY (`id_apontamento`),
  ADD KEY `id_tipo_apontamento` (`id_tipo_apontamento`,`id_utilizador`),
  ADD KEY `id_utilizador` (`id_utilizador`);

--
-- Índices para tabela `tipo_apontamento`
--
ALTER TABLE `tipo_apontamento`
  ADD PRIMARY KEY (`id_tipo_apontamento`);

--
-- Índices para tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `apontamento`
--
ALTER TABLE `apontamento`
  MODIFY `id_apontamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `tipo_apontamento`
--
ALTER TABLE `tipo_apontamento`
  MODIFY `id_tipo_apontamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `apontamento`
--
ALTER TABLE `apontamento`
  ADD CONSTRAINT `apontamento_ibfk_1` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizador` (`id`),
  ADD CONSTRAINT `apontamento_ibfk_2` FOREIGN KEY (`id_tipo_apontamento`) REFERENCES `tipo_apontamento` (`id_tipo_apontamento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
