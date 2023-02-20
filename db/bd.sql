-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.27-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para organize
CREATE DATABASE IF NOT EXISTS `organize` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `organize`;

-- Copiando estrutura para tabela organize.atividade
CREATE TABLE IF NOT EXISTS `atividade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarefa_id` int(11) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `data_cadatro` datetime NOT NULL,
  `data_prazo` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela organize.atividade: ~7 rows (aproximadamente)
INSERT INTO `atividade` (`id`, `tarefa_id`, `descricao`, `data_cadatro`, `data_prazo`) VALUES
	(1, 1, 'Realizar uma inserção de descrição de atividade', '2023-02-19 00:50:32', NULL),
	(2, 1, 'Avaliar Inserção44', '2023-02-19 01:22:04', NULL),
	(3, 1, 'Teste Comentario', '2023-02-19 02:05:58', NULL),
	(4, 1, 'Teste Comentario23', '2023-02-19 02:06:11', NULL),
	(6, 7, 'Testar conexao', '2023-02-19 02:18:57', NULL),
	(7, 3, 'Testar conexao', '2023-02-19 02:19:54', NULL),
	(11, 4, 'Teste', '2023-02-19 03:10:15', NULL),
	(12, 9, 'Começar', '2023-02-19 12:15:34', NULL);

-- Copiando estrutura para tabela organize.cartao
CREATE TABLE IF NOT EXISTS `cartao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `lista_fk` int(11) NOT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `data_conclusao` date DEFAULT NULL,
  `concluido` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela organize.cartao: ~7 rows (aproximadamente)
INSERT INTO `cartao` (`id`, `nome`, `lista_fk`, `data_cadastro`, `data_conclusao`, `concluido`) VALUES
	(1, 'Cartao primay', 6, '2023-02-18 00:00:00', '2023-02-08', 1),
	(2, 'Segundo cartao', 1, '2023-02-18 00:00:00', NULL, 0),
	(3, 'Meu Cartão', 2, '2023-02-18 23:28:34', '2023-02-23', 0),
	(5, 'Tarefa Quadrada', 6, '2023-02-18 23:44:42', NULL, 0),
	(6, 'Coletar Requisitos', 14, '2023-02-19 02:08:47', NULL, 0),
	(7, 'Testar modem', 13, '2023-02-19 02:18:45', NULL, 0),
	(9, 'Corrigir rotina', 13, '2023-02-19 12:15:26', NULL, 0);

-- Copiando estrutura para tabela organize.listas
CREATE TABLE IF NOT EXISTS `listas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cor` varchar(100) NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `data_conclusao` datetime DEFAULT NULL,
  `quadro_fk` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela organize.listas: ~7 rows (aproximadamente)
INSERT INTO `listas` (`id`, `nome`, `cor`, `data_cadastro`, `data_conclusao`, `quadro_fk`) VALUES
	(1, 'Pendente2', '#ee82ee', '2023-02-18 12:23:08', '0000-00-00 00:00:00', 1),
	(2, 'Andamento', '#FFA500', '2023-02-18 12:36:39', NULL, 1),
	(6, 'Concluido', '#008000', '2023-02-18 14:34:05', NULL, 1),
	(7, 'Pendente', '#ffa500', '2023-02-18 14:40:15', NULL, 4),
	(10, 'Pendente', '#af12af', '2023-02-18 17:57:57', NULL, 2),
	(11, 'Concluido', '#ff0000', '2023-02-18 18:00:31', NULL, 2),
	(13, 'Em Decisao', '#4b0082', '2023-02-18 23:45:43', NULL, 1),
	(14, 'Demanda Alfa', '#ffa500', '2023-02-19 02:08:34', NULL, 5);

-- Copiando estrutura para tabela organize.quadros
CREATE TABLE IF NOT EXISTS `quadros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `data_cadastro` date NOT NULL,
  `data_conclusao` date DEFAULT NULL,
  `arquivado` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela organize.quadros: ~4 rows (aproximadamente)
INSERT INTO `quadros` (`id`, `login`, `nome`, `descricao`, `data_cadastro`, `data_conclusao`, `arquivado`) VALUES
	(1, 1000, 'Corrigir Bug', 'Bug de listagem de faturas', '2023-02-17', NULL, 0),
	(2, 1000, 'Realizar Query', 'Observação', '2023-02-17', NULL, 0),
	(3, 1000, 'Realizar Query', 'lalala', '2023-02-17', NULL, 0),
	(4, 1000, 'Titulo', 'Observação 456', '2023-02-18', NULL, 0),
	(5, 1000, 'Titulo', 'Observação 789', '2023-02-18', NULL, 0),
	(6, 1000, 'Mais um Quadro', 'geladeira', '2023-02-18', NULL, 0);

-- Copiando estrutura para tabela organize.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `admin` tinyint(4) DEFAULT 0,
  `ativo` tinyint(4) DEFAULT 1,
  `login` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela organize.usuario: ~3 rows (aproximadamente)
INSERT INTO `usuario` (`id`, `nome`, `password`, `admin`, `ativo`, `login`) VALUES
	(1, 'Ricardo', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, 1000),
	(3, 'Maria', '250cf8b51c773f3f8dc8b4be867a9a02', 0, 1, 1002),
	(4, 'João', '250cf8b51c773f3f8dc8b4be867a9a02', 0, 1, 1003);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
