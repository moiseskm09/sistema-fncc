-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/04/2023 às 13:57
-- Versão do servidor: 10.4.27-MariaDB
-- Versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema_fncc`
--
CREATE DATABASE IF NOT EXISTS `sistema_fncc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sistema_fncc`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `arquivos_consultas`
--

DROP TABLE IF EXISTS `arquivos_consultas`;
CREATE TABLE IF NOT EXISTS `arquivos_consultas` (
  `cod_arquivo` bigint(255) NOT NULL AUTO_INCREMENT,
  `arq_nome` varchar(150) NOT NULL,
  `arq_consulta` bigint(255) NOT NULL,
  `arq_data` datetime NOT NULL,
  PRIMARY KEY (`cod_arquivo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `arquivos_consultas`
--

INSERT INTO `arquivos_consultas` (`cod_arquivo`, `arq_nome`, `arq_consulta`, `arq_data`) VALUES
(1, 'fatura_mensal_1via_1fe237xxx746pf_00200000427167000038138954833003420230211202302230000_0011309.pdf', 2, '2023-02-28 20:50:10'),
(2, '_arquivos_modelos_documentos_categoria_1_Ata-de-Assembleia-Geral-OrdinÃ¡ria-2.docx', 1, '2023-03-10 01:26:06'),
(3, 'Relatorio_atendimentos.csv', 1, '2023-03-10 01:26:06'),
(4, '_arquivos_modelos_documentos_categoria_1_Ata-de-Assembleia-Geral-OrdinÃ¡ria-2.docx', 1, '2023-03-10 01:26:06');

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacao_consulta`
--

DROP TABLE IF EXISTS `avaliacao_consulta`;
CREATE TABLE IF NOT EXISTS `avaliacao_consulta` (
  `cod_avaliacao` bigint(255) NOT NULL AUTO_INCREMENT,
  `aval_consulta` bigint(255) NOT NULL,
  `aval_avaliacao` char(8) NOT NULL,
  `aval_data` datetime NOT NULL,
  PRIMARY KEY (`cod_avaliacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `avisos`
--

DROP TABLE IF EXISTS `avisos`;
CREATE TABLE IF NOT EXISTS `avisos` (
  `cod_aviso` int(255) NOT NULL AUTO_INCREMENT,
  `coop_aviso` int(255) NOT NULL DEFAULT 0 COMMENT '0 = Todas as Coop',
  `aviso` text NOT NULL,
  `data_aviso` date NOT NULL,
  `link_aviso` varchar(50) NOT NULL,
  PRIMARY KEY (`cod_aviso`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `avisos`
--

INSERT INTO `avisos` (`cod_aviso`, `coop_aviso`, `aviso`, `data_aviso`, `link_aviso`) VALUES
(1, 0, 'Nova Circular', '2023-02-08', 'circulares-documentos.php'),
(2, 57, 'Nova Consulta', '2023-02-24', 'listar-consultas.php'),
(3, 57, 'Nova Consulta', '2023-02-28', 'listar-consultas.php'),
(4, 57, 'Rel. Denúncia', '2023-03-01', 'rel-canaldenuncias.php'),
(5, 57, 'Nova Consulta', '2023-03-10', 'listar-consultas.php'),
(6, 57, 'Nova Consulta', '2023-04-27', 'listar-consultas.php'),
(7, 57, 'Nova Consulta', '2023-04-27', 'listar-consultas.php'),
(8, 57, 'Nova Consulta', '2023-04-27', 'listar-consultas.php'),
(9, 57, 'Nova Consulta', '2023-04-27', 'listar-consultas.php'),
(10, 57, 'Nova Consulta', '2023-04-27', 'listar-consultas.php'),
(11, 57, 'Nova Consulta', '2023-04-27', 'listar-consultas.php'),
(12, 57, 'Nova Consulta', '2023-04-27', 'listar-consultas.php'),
(13, 57, 'Nova Consulta', '2023-04-27', 'listar-consultas.php'),
(14, 57, 'Nova Consulta', '2023-04-28', 'listar-consultas.php'),
(15, 57, 'Nova Consulta', '2023-04-28', 'listar-consultas.php'),
(16, 57, 'Nova Consulta', '2023-04-28', 'listar-consultas.php'),
(17, 57, 'Nova Consulta', '2023-04-28', 'listar-consultas.php'),
(18, 57, 'Nova Consulta', '2023-04-28', 'listar-consultas.php'),
(19, 57, 'Nova Consulta', '2023-04-28', 'listar-consultas.php');

-- --------------------------------------------------------

--
-- Estrutura para tabela `balancete`
--

DROP TABLE IF EXISTS `balancete`;
CREATE TABLE IF NOT EXISTS `balancete` (
  `cod_balancete` int(255) NOT NULL AUTO_INCREMENT,
  `bal_ref_inicial` date NOT NULL,
  `bal_ref_final` date NOT NULL,
  `bal_arquivo` varchar(100) NOT NULL,
  `bal_coop` int(255) NOT NULL,
  `bal_situacao` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`cod_balancete`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `banco_de_horas`
--

DROP TABLE IF EXISTS `banco_de_horas`;
CREATE TABLE IF NOT EXISTS `banco_de_horas` (
  `bh_dia` date NOT NULL,
  `bh_horas` time NOT NULL,
  `bh_user` bigint(255) NOT NULL,
  UNIQUE KEY `bh_dia` (`bh_dia`,`bh_user`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `banco_de_horas`
--

INSERT INTO `banco_de_horas` (`bh_dia`, `bh_horas`, `bh_user`) VALUES
('2023-03-01', '01:07:00', 2),
('2023-03-02', '00:20:00', 2),
('2023-03-03', '00:17:00', 2),
('2023-03-07', '00:30:00', 2),
('2023-03-08', '00:30:00', 2),
('2023-03-09', '00:00:00', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `boletos`
--

DROP TABLE IF EXISTS `boletos`;
CREATE TABLE IF NOT EXISTS `boletos` (
  `cod_boleto` int(255) NOT NULL AUTO_INCREMENT,
  `bol_competencia` varchar(15) NOT NULL,
  `bol_vencimento` date NOT NULL,
  `arquivo` varchar(150) NOT NULL,
  `bol_situacao` char(30) NOT NULL DEFAULT 'AGUARDANDO PAGAMENTO',
  `bol_coop` int(255) NOT NULL,
  PRIMARY KEY (`cod_boleto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `boleto_situacao`
--

DROP TABLE IF EXISTS `boleto_situacao`;
CREATE TABLE IF NOT EXISTS `boleto_situacao` (
  `cod_bol_s` int(255) NOT NULL AUTO_INCREMENT,
  `situacao` char(30) NOT NULL,
  PRIMARY KEY (`cod_bol_s`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `boleto_situacao`
--

INSERT INTO `boleto_situacao` (`cod_bol_s`, `situacao`) VALUES
(1, 'PAGAMENTO CONFIRMADO'),
(2, 'CONFIRMANDO PAGAMENTO'),
(3, 'AGUARDANDO PAGAMENTO'),
(4, 'VENCIDO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `canal_de_denuncias`
--

DROP TABLE IF EXISTS `canal_de_denuncias`;
CREATE TABLE IF NOT EXISTS `canal_de_denuncias` (
  `cod_denuncia` int(255) NOT NULL AUTO_INCREMENT,
  `cdd_periodo` varchar(50) NOT NULL,
  `cdd_coop` int(255) NOT NULL,
  `cdd_arquivo` varchar(150) NOT NULL,
  PRIMARY KEY (`cod_denuncia`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `canal_de_denuncias`
--

INSERT INTO `canal_de_denuncias` (`cod_denuncia`, `cdd_periodo`, `cdd_coop`, `cdd_arquivo`) VALUES
(1, 'JANEIRO', 57, 'JANEIRO_20230301_57_161440.pdf');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria_circulares`
--

DROP TABLE IF EXISTS `categoria_circulares`;
CREATE TABLE IF NOT EXISTS `categoria_circulares` (
  `cod_categoria` int(255) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `categoria_circulares`
--

INSERT INTO `categoria_circulares` (`cod_categoria`, `categoria`) VALUES
(1, 'Jurídica'),
(2, 'Técnica'),
(3, 'Governança'),
(4, 'Normativos Internos'),
(5, 'Publicações FNCC');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria_cooperativa`
--

DROP TABLE IF EXISTS `categoria_cooperativa`;
CREATE TABLE IF NOT EXISTS `categoria_cooperativa` (
  `cod_categoria_coop` int(4) NOT NULL AUTO_INCREMENT,
  `categoria_coop` char(30) NOT NULL,
  PRIMARY KEY (`cod_categoria_coop`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `categoria_cooperativa`
--

INSERT INTO `categoria_cooperativa` (`cod_categoria_coop`, `categoria_coop`) VALUES
(1, 'Plena'),
(2, 'Clássica'),
(3, 'Capital e Empréstimo'),
(4, 'Federação');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria_documentos`
--

DROP TABLE IF EXISTS `categoria_documentos`;
CREATE TABLE IF NOT EXISTS `categoria_documentos` (
  `cod_categoria` int(10) NOT NULL AUTO_INCREMENT,
  `categoria` char(50) NOT NULL,
  PRIMARY KEY (`cod_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `categoria_documentos`
--

INSERT INTO `categoria_documentos` (`cod_categoria`, `categoria`) VALUES
(1, 'Atas'),
(2, 'Editais'),
(3, 'Estatuto Social'),
(4, 'Manuais / Regulamentos'),
(5, 'Políticas / Código de Ética e Conduta'),
(6, 'Relatórios');

-- --------------------------------------------------------

--
-- Estrutura para tabela `colaboradores_coop`
--

DROP TABLE IF EXISTS `colaboradores_coop`;
CREATE TABLE IF NOT EXISTS `colaboradores_coop` (
  `cod_col` int(100) NOT NULL AUTO_INCREMENT,
  `col_nome` char(50) DEFAULT NULL,
  `col_area` char(30) DEFAULT NULL,
  `col_email` varchar(50) DEFAULT NULL,
  `col_coop` int(10) NOT NULL,
  PRIMARY KEY (`cod_col`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `colaboradores_coop`
--

INSERT INTO `colaboradores_coop` (`cod_col`, `col_nome`, `col_area`, `col_email`, `col_coop`) VALUES
(1, 'MARCELO CARFORA', 'SUPERINTENDENTE', 'MARCELO.CARFORA@FNCC.COM.BR', 57),
(2, 'ADRIANA CALDEIRA', 'COORDENADORA', 'ADRIANA.CALDEIRA@FNCC.COM.BR', 57),
(3, 'TESSIA PIMENTEL', 'CONSULTORA TÉCNICA', 'TESSIA.PIMENTEL@FNCC.COM.BR', 57),
(4, 'ROGÉRIO OLIVEIRA', 'CONSULTOR TÉCNICO', 'ROGERIO.OLIVEIRA@FNCC.COM.BR', 57),
(5, 'ELVIS CARDOSO', 'CONTROLES INTERNOS', 'ELVIS.CARDOSO@FNCC.COM.BR', 57),
(6, 'BRUNA VELOSO', 'ANALISTA ADM', 'BRUNA.VELOSO@FNCC.COM.BR', 57),
(7, 'KARINA PEQUENO', 'ANALISTA ADM', 'KARINA@FNCC.COM.BR', 57);

-- --------------------------------------------------------

--
-- Estrutura para tabela `compensacao`
--

DROP TABLE IF EXISTS `compensacao`;
CREATE TABLE IF NOT EXISTS `compensacao` (
  `cod_comp` bigint(255) NOT NULL AUTO_INCREMENT,
  `comp_dia` date NOT NULL,
  `comp_hora` time NOT NULL,
  `comp_user` bigint(255) NOT NULL,
  `comp_tipo` char(15) NOT NULL,
  PRIMARY KEY (`cod_comp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `conselho_fiscal`
--

DROP TABLE IF EXISTS `conselho_fiscal`;
CREATE TABLE IF NOT EXISTS `conselho_fiscal` (
  `cf_id` int(10) NOT NULL AUTO_INCREMENT,
  `cf_nome` char(50) DEFAULT NULL,
  `cf_cargo` char(30) DEFAULT NULL,
  `cf_telefone` varchar(16) DEFAULT NULL,
  `cf_email` varchar(50) DEFAULT NULL,
  `cf_mandato` date DEFAULT NULL,
  `cf_coop` int(10) NOT NULL,
  PRIMARY KEY (`cf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `conselho_fiscal`
--

INSERT INTO `conselho_fiscal` (`cf_id`, `cf_nome`, `cf_cargo`, `cf_telefone`, `cf_email`, `cf_mandato`, `cf_coop`) VALUES
(1, 'CRISLEY CURCIO', 'EFETIVO', '', '', '2023-03-31', 57),
(2, 'CAMILA SILVESTRE', 'EFETIVO', '', '', '2023-03-31', 57),
(3, 'JACKSON MATOS', 'EFETIVO', '', '', '2023-03-31', 57),
(4, 'ROSA STOROLI', 'SUPLENTE', '', '', '2023-03-31', 57),
(5, 'BARBARA FALSETTI', 'SUPLENTE', '', '', '0000-00-00', 57),
(6, 'MARCUS OLIVEIRA', 'SUPLENTE', '', '', '2023-03-31', 57);

-- --------------------------------------------------------

--
-- Estrutura para tabela `consultas`
--

DROP TABLE IF EXISTS `consultas`;
CREATE TABLE IF NOT EXISTS `consultas` (
  `cod_consulta` bigint(255) NOT NULL AUTO_INCREMENT,
  `cons_coop` int(255) NOT NULL,
  `cons_user` int(255) NOT NULL,
  `cons_grupo` int(10) NOT NULL,
  `cons_urgencia` varchar(12) NOT NULL,
  `cons_visibilidade` varchar(20) NOT NULL,
  `cons_assunto` varchar(70) NOT NULL,
  `cons_desc_principal` text NOT NULL,
  `data_consulta` datetime NOT NULL,
  `cons_situacao` int(2) NOT NULL,
  `user_responsavel` int(255) DEFAULT NULL,
  `data_previsao` datetime DEFAULT NULL,
  `data_conclusao` datetime DEFAULT NULL,
  PRIMARY KEY (`cod_consulta`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `consultas`
--

INSERT INTO `consultas` (`cod_consulta`, `cons_coop`, `cons_user`, `cons_grupo`, `cons_urgencia`, `cons_visibilidade`, `cons_assunto`, `cons_desc_principal`, `data_consulta`, `cons_situacao`, `user_responsavel`, `data_previsao`, `data_conclusao`) VALUES
(1, 57, 1, 3, 'baixa', 'eu', 'Teste', 'Teste', '2023-03-09 22:26:06', 3, 1, '2023-03-12 01:26:06', NULL),
(2, 57, 1, 3, 'baixa', 'eu', 'Teste de email', 'Teste de email', '2023-04-27 16:10:10', 2, 1, '2023-04-29 16:10:10', NULL),
(3, 57, 1, 3, 'baixa', 'eu', 'oi oi moi', 'nijisdjisb sfjgjkbf fdsjghfdjghfd ', '2023-04-27 16:11:01', 2, 1, '2023-04-29 16:11:01', NULL),
(4, 57, 1, 3, 'baixa', 'eu', 'dfdfd', 'dgfgdghyt', '2023-04-27 16:13:55', 4, 1, '2023-04-29 16:13:55', NULL),
(5, 57, 1, 3, 'baixa', 'eu', 'dfdfdf', 'dtreyrt', '2023-04-27 16:14:30', 1, 0, '2023-04-29 16:14:30', NULL),
(6, 57, 1, 3, 'baixa', 'eu', 'Teste de envio de emaukl 2', 'asdfsadv dgsfd dggfdgdfgsd', '2023-04-27 16:14:59', 1, 0, '2023-04-29 16:14:59', NULL),
(7, 57, 1, 3, 'alta', 'minha_coop', 'Teste de envio de email pelo app', 'teste de envio de email bonito', '2023-04-27 16:16:03', 1, 0, '2023-04-29 16:16:03', NULL),
(8, 57, 1, 3, 'baixa', 'eu', 'Teste de envio de email tabela', 'Teste de envio de email se debug', '2023-04-27 16:18:59', 1, 0, '2023-04-29 16:18:59', NULL),
(9, 57, 1, 3, 'baixa', 'eu', 'Teste de envio de email', 'Teste de envio de email padrão', '2023-04-28 09:50:43', 1, 1, '2023-04-30 09:50:43', NULL),
(10, 57, 1, 3, 'baixa', 'eu', 'Teste de email abertura', 'Teste de email abertura', '2023-04-28 09:53:55', 1, 0, '2023-04-30 09:53:55', NULL),
(11, 57, 1, 3, 'baixa', 'eu', 'Teste', 'Teste', '2023-04-28 09:55:08', 1, 0, '2023-04-30 09:55:08', NULL),
(12, 57, 1, 3, 'baixa', 'eu', 'Teste de envio de emaikl', 'teste', '2023-04-28 15:15:46', 1, 0, '2023-04-30 15:15:46', NULL),
(13, 57, 1, 3, 'baixa', 'eu', 'ddd', 'dddd', '2023-04-28 15:16:30', 1, 0, '2023-04-30 15:16:30', NULL),
(14, 57, 1, 3, 'baixa', 'eu', 'Teste', 'Teste', '2023-04-28 15:17:38', 1, 0, '2023-04-30 15:17:38', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `consulta_interacoes`
--

DROP TABLE IF EXISTS `consulta_interacoes`;
CREATE TABLE IF NOT EXISTS `consulta_interacoes` (
  `cod_interacao` bigint(255) NOT NULL AUTO_INCREMENT,
  `inter_user` int(255) NOT NULL,
  `inter_cons` bigint(255) NOT NULL,
  `inter_descricao` text NOT NULL,
  `inter_data` datetime NOT NULL,
  PRIMARY KEY (`cod_interacao`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `consulta_interacoes`
--

INSERT INTO `consulta_interacoes` (`cod_interacao`, `inter_user`, `inter_cons`, `inter_descricao`, `inter_data`) VALUES
(1, 1, 1, 'Teste', '2023-03-10 01:26:57'),
(2, 1, 1, 't', '2023-04-22 18:31:22'),
(3, 1, 1, 'teste', '2023-04-22 18:32:40'),
(4, 1, 9, 'Teste', '2023-04-28 09:56:59'),
(5, 1, 9, 'Teste alteração', '2023-04-28 10:05:28'),
(6, 1, 9, 'Teste alteração 2', '2023-04-28 10:06:20'),
(7, 1, 2, 'andamento', '2023-04-28 10:11:19'),
(8, 1, 2, 'Teste', '2023-04-28 10:12:33'),
(9, 1, 2, 'finalizado', '2023-04-28 10:30:53'),
(10, 1, 2, 'Não era pra ter finalizado', '2023-04-28 10:31:51'),
(11, 1, 2, 'ddd', '2023-04-28 10:42:29'),
(12, 1, 2, 'Teste', '2023-04-28 10:44:26'),
(13, 1, 2, 'teste', '2023-04-28 10:48:04'),
(14, 1, 2, 'Teste de', '2023-04-28 10:50:07'),
(15, 1, 3, 'teste', '2023-04-28 15:14:00'),
(16, 1, 4, 'Teste', '2023-04-28 15:18:45');

-- --------------------------------------------------------

--
-- Estrutura para tabela `controle_de_ponto`
--

DROP TABLE IF EXISTS `controle_de_ponto`;
CREATE TABLE IF NOT EXISTS `controle_de_ponto` (
  `cod_ponto` bigint(255) NOT NULL AUTO_INCREMENT,
  `ponto_user` bigint(255) NOT NULL,
  `ponto_dia` date NOT NULL,
  `ponto_entrada` time DEFAULT NULL,
  `ponto_intervalo_um` time DEFAULT NULL,
  `ponto_intervalo_dois` time DEFAULT NULL,
  `ponto_saida` time DEFAULT NULL,
  `ponto_hora_prevista` time NOT NULL DEFAULT '08:00:00',
  `ponto_hora_executada` time DEFAULT NULL,
  `ponto_hora_atraso` time DEFAULT NULL,
  `ponto_hora_extra` time DEFAULT NULL,
  `ponto_situacao` int(2) NOT NULL DEFAULT 1,
  `ponto_justificado` int(1) NOT NULL DEFAULT 0,
  `ponto_justificativa_aprovada` int(11) NOT NULL DEFAULT 0 COMMENT '0-não 1-sim',
  `horas_compensadas` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`cod_ponto`),
  UNIQUE KEY `ponto_user` (`ponto_user`,`ponto_dia`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `controle_de_ponto`
--

INSERT INTO `controle_de_ponto` (`cod_ponto`, `ponto_user`, `ponto_dia`, `ponto_entrada`, `ponto_intervalo_um`, `ponto_intervalo_dois`, `ponto_saida`, `ponto_hora_prevista`, `ponto_hora_executada`, `ponto_hora_atraso`, `ponto_hora_extra`, `ponto_situacao`, `ponto_justificado`, `ponto_justificativa_aprovada`, `horas_compensadas`) VALUES
(1, 2, '2023-03-01', '07:30:00', '12:34:00', '13:32:00', '17:37:00', '08:00:00', '09:07:00', '00:00:00', '01:07:00', 1, 1, 0, 0),
(3, 2, '2023-03-02', '08:04:00', '12:00:00', '13:04:00', '17:20:00', '08:00:00', '08:16:00', '00:00:00', '00:20:00', 1, 1, 0, 0),
(5, 2, '2023-03-03', '08:19:00', '12:21:00', '13:46:00', '17:17:00', '08:00:00', '07:58:00', '00:19:00', '00:17:00', 1, 1, 0, 0),
(11, 2, '2023-03-06', '08:02:00', '13:28:00', '14:28:00', '17:00:00', '08:00:00', '07:58:00', '00:00:00', '00:00:00', 1, 0, 0, 0),
(13, 2, '2023-03-07', '08:32:00', '13:01:00', '14:01:00', '16:30:00', '08:00:00', '06:58:00', '00:32:00', '00:30:00', 1, 1, 0, 0),
(15, 2, '2023-03-08', '08:10:00', '12:00:00', '13:00:00', '16:30:00', '08:00:00', '07:20:00', '00:10:00', '00:30:00', 1, 1, 0, 0),
(16, 2, '2023-03-09', '08:03:00', '12:24:00', '13:31:00', '17:00:00', '08:00:00', '07:57:00', '00:00:00', '00:00:00', 1, 0, 0, 0),
(17, 2, '2023-03-10', '08:36:00', '12:00:00', '13:00:00', '17:00:00', '08:00:00', '07:24:00', '00:36:00', '00:00:00', 1, 0, 0, 0),
(20, 2, '2023-03-13', '08:00:00', '12:00:00', '13:00:00', '17:00:00', '08:00:00', '08:00:00', '00:00:00', '00:00:00', 1, 0, 0, 0),
(21, 2, '2023-03-14', '08:00:00', '12:00:00', '13:00:00', '17:00:00', '08:00:00', '08:00:00', '00:00:00', '00:00:00', 1, 0, 0, 0),
(22, 2, '2023-03-15', '08:00:00', '12:00:00', '13:00:00', '17:00:00', '08:00:00', '08:00:00', '00:00:00', '00:00:00', 1, 0, 0, 0),
(23, 2, '2023-03-16', '08:00:00', '12:00:00', '13:00:00', '17:00:00', '08:00:00', '08:00:00', '00:00:00', '00:00:00', 1, 0, 0, 0),
(24, 2, '2023-03-17', '08:00:00', '12:00:00', '13:00:00', '17:00:00', '08:00:00', '08:00:00', '00:00:00', '00:00:00', 1, 0, 0, 0),
(25, 2, '2023-03-20', '07:54:00', '12:42:00', '13:52:00', NULL, '08:00:00', NULL, '00:00:00', '00:06:00', 1, 0, 0, 0),
(26, 2, '2023-03-21', '08:00:00', '12:00:00', '13:00:00', '17:00:00', '08:00:00', '08:00:00', '00:00:00', '00:00:00', 1, 0, 0, 0),
(27, 2, '2023-03-22', NULL, NULL, NULL, NULL, '08:00:00', NULL, '08:00:00', NULL, 2, 0, 0, 0),
(28, 2, '2023-03-23', '08:02:00', '12:54:00', '14:16:00', NULL, '08:00:00', NULL, '00:00:00', '00:00:00', 1, 0, 0, 0),
(29, 2, '2023-03-24', '08:05:00', NULL, NULL, NULL, '08:00:00', NULL, '00:00:00', '00:00:00', 1, 0, 0, 0),
(30, 2, '2023-03-27', NULL, NULL, NULL, NULL, '08:00:00', NULL, '08:00:00', NULL, 2, 0, 0, 0),
(31, 2, '2023-03-28', NULL, NULL, NULL, NULL, '08:00:00', NULL, '08:00:00', NULL, 2, 0, 0, 0),
(32, 2, '2023-03-29', NULL, NULL, NULL, NULL, '08:00:00', NULL, '08:00:00', NULL, 2, 0, 0, 0),
(33, 2, '2023-03-30', NULL, NULL, NULL, NULL, '08:00:00', NULL, '08:00:00', NULL, 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cooperativas`
--

DROP TABLE IF EXISTS `cooperativas`;
CREATE TABLE IF NOT EXISTS `cooperativas` (
  `cod_coop` int(10) NOT NULL AUTO_INCREMENT,
  `coop_matricula` varchar(20) DEFAULT NULL,
  `coop_razao` char(150) DEFAULT NULL,
  `cooperativa` char(100) NOT NULL,
  `coop_cnpj` varchar(18) NOT NULL DEFAULT '00.000.000/0000-00',
  `coop_categoria` char(50) DEFAULT NULL,
  `coop_nire` varchar(15) NOT NULL DEFAULT '000.000.000.000',
  `coop_im` varchar(15) NOT NULL DEFAULT '000.000.000.000',
  `coop_cep` varchar(9) NOT NULL DEFAULT '00000-000',
  `coop_endereco` char(50) DEFAULT NULL,
  `coop_numero_casa` int(6) DEFAULT NULL,
  `coop_complemento` varchar(30) DEFAULT NULL,
  `coop_bairro` char(30) DEFAULT NULL,
  `coop_cidade` char(30) DEFAULT NULL,
  `coop_estado` char(2) DEFAULT NULL,
  `coop_telefone` varchar(14) NOT NULL DEFAULT '(00) 0000-0000',
  `coop_whatsapp` varchar(16) NOT NULL DEFAULT '(00) 0 0000-0000',
  `coop_email` varchar(50) DEFAULT NULL,
  `coop_sistema` varchar(30) DEFAULT NULL,
  `coop_data_abertura` date NOT NULL DEFAULT '2022-12-22',
  `logo_coop` varchar(50) NOT NULL DEFAULT 'logo_fncc.png',
  `coop_status` int(1) NOT NULL DEFAULT 1 COMMENT '1-ativo 0-inativo',
  `coop_data_cadastro` date NOT NULL DEFAULT '2022-12-22',
  `coop_dados_atualizados` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`cod_coop`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cooperativas`
--

INSERT INTO `cooperativas` (`cod_coop`, `coop_matricula`, `coop_razao`, `cooperativa`, `coop_cnpj`, `coop_categoria`, `coop_nire`, `coop_im`, `coop_cep`, `coop_endereco`, `coop_numero_casa`, `coop_complemento`, `coop_bairro`, `coop_cidade`, `coop_estado`, `coop_telefone`, `coop_whatsapp`, `coop_email`, `coop_sistema`, `coop_data_abertura`, `logo_coop`, `coop_status`, `coop_data_cadastro`, `coop_dados_atualizados`) VALUES
(1, '1', 'COOPERATIVA DE CRÉDITO COGEM', 'COGEM', '44.401.800/0001-90', 'Capital e Empréstimo', '35400010711', '000.000.000.000', '09750-730', 'Rua José Versolato', 111, 'Torre B, salas 2607 / 2608', 'Centro', 'São Bernardo Do Campo', 'SP', '(11) 3080-3942', '(11) 9 3080-3942', 'wanderson.oliveira@cogem.com.br', 'Prodaf', '1974-09-16', 'cogem.webp', 1, '2022-12-22', 1),
(2, '6', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS SERVIDORES DA FEDERACAO DO COMERCIO, SESC E SENAC DE SAO PAULO', 'COOP FECOM/ SESC/ SENAC', '62.928.320/0001-63', '3', '35400002115', '000.000.000.000', '01029-000', 'Rua Florêncio de Abreu', 305, '', 'Centro', 'São Paulo', 'SP', '(11) 3311-8746', '(00) 0 0000-0000', 'juvenal.francisco@florenciodea', 'Prodaf', '1970-10-09', 'Cooper-SESC.webp', 1, '2022-12-22', 1),
(3, '4', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS EMPREGADOS DO GRUPO FEMSA BRASIL', 'COOPERFEMSA', '43.488.782/0001-62', '3', '35400003987', '000.000.000.000', '04675-085', 'Avenida Engenheiro Alberto de Zagottis', 352, '', 'Jardim Taquaral', 'São Paulo', 'SP', '(11) 2102-5541', '(00) 0 0000-0000', 'silvana.breda@kof.com.mx', 'Prodaf', '1972-11-14', 'cooperfemsa.webp', 1, '2022-12-22', 1),
(4, '9', 'COOPERATIVA DE ECON E CREDITO MUTUO DOS COLAB DA SG INDÚSTRIA E COMERCIO DE MATERIAIS DE CONSTRUÇÃO, VIDROS E AFINS.', 'CREDI SG', '61.039.038/0001-62', '3', '35400021187', '000.000.000.000', '01139-000', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 3392-3499', '(00) 0 0000-0000', 'paulo.dias@credisg.com.br', 'Prodaf', '1967-04-24', 'logo_fncc.png', 0, '2022-12-22', 0),
(5, '12', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS FUNCIONARIOS DA ERICSSON', 'COOPERICSSON', '48.718.183/0001-01', '3', '35400001186', '000.000.000.000', '01140-060', 'Avenida Nicolas Boer', 399, '11º andar', 'Parque Industrial Tomas Edson', 'São Paulo', 'SP', '(11) 2224-1312', '(00) 0 0000-0000', 'andre.brone@coopericsson.com.b', 'Prodaf', '1982-02-12', 'cooperativa-ericsson.webp', 1, '2022-12-22', 1),
(6, '13', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS FUNCIONARIOS DA CARGILL', 'COOPCARGILL', '68.228.006/0001-54', '2', '000.000.000.000', '000.000.000.000', '04711-130', 'Avenida Doutor Chucri Zaidan', 1240, '6º andar', 'Vila São Francisco (Zona Sul)', 'São Paulo', 'SP', '(11) 5099-2127', '(00) 0 0000-0000', 'Eliane_Molina@cargill.com', 'Prodaf', '1992-08-06', 'CoopCargill.webp', 1, '2022-12-22', 1),
(7, '3', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS EMPREGADOS DA RECKITT BENCKISER', 'COOP RB', '44.223.196/0001-59', '3', '3540003863', '000.000.000.000', '05577-900', 'Rodovia Raposo Tavares', 8015, 'KM 18', 'Jardim Cambara', 'São Paulo', 'SP', '(11) 3783-7074', '(00) 0 0000-0000', 'rosa.storoli@reckittbenckiser', 'Prodaf', '1974-01-17', 'CoopRB.webp', 1, '2022-12-22', 1),
(8, '8', 'COOPERATIVA DE ECON. E CREDITO MUTUO DO GRUPO BASF', 'CREDIBASF', '74.244.344/0001-82', '3', '35400024160', '000.000.000.000', '04794-000', 'Avenida das Nações Unidas', 14171, '17º andar – Torre C – Crystal ', 'Vila Gertrudes', 'São Paulo', 'SP', '(11) 4347-1185', '(00) 0 0000-0000', 'priscila.tomaz@basf.com', 'SaveMais', '1994-01-10', 'crediBasf.webp', 1, '2022-12-22', 1),
(9, '5', 'COOPERATIVA DE CAPITAL E EMPRESTIMO COOPERMULTICRED - COOPERMC', 'COOPERMC', '51.010.858/0001-78', '3', '3500001356', '000.000.000.000', '07190-904', 'Avenida Monteiro Lobato', 3411, 'HITACHI ENERGY', 'São Roque', 'Guarulhos', 'SP', '(11) 2464-8277', '(00) 0 0000-0000', 'marcos.silva@br.abb.com', 'Prodaf', '1982-08-25', 'COOPERMC.webp', 1, '2022-12-22', 1),
(10, '11', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS EMPREGADOS DO GRUPO SCHAEFFLER', 'COOP SCHAEFFLER', '62.284.385/0001-13', '3', '35400003529', '000.000.000.000', '18087-101', '', 0, NULL, '', 'Sorocaba', 'SP', '(15) 3335-1979', '(00) 0 0000-0000', 'eliane@coopercreds.com.br', 'Prodaf', '1968-12-06', 'logo_fncc.png', 0, '2022-12-22', 0),
(11, '7', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS SERV. MUNICIP. DE SAO JOAO DA BOA VISTA', 'CREDIVISTA', '74.248.949/0001-41', '2', '35400024151', '000.000.000.000', '13870-020', 'Rua Senador Saraiva', 59, '', 'Centro', 'São João da Boa Vista', 'SP', '(19) 3634-6262', '(00) 0 0000-0000', 'delvo@credivista.com.br', 'Próprio', '1994-01-05', 'cocredivista.webp', 1, '2022-12-22', 1),
(12, '10', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS EMPREGADOS DA JOHNSON & JOHNSON', 'COOPERJOHNSON', '45.691.128/0001-87', '3', '35400010371', '000.000.000.000', '12240-907', 'Rodovia Presidente Dutra', 0, 'KM 154', 'Jardim das Indústrias', 'São José dos Campos', 'SP', '(12) 3932-3299', '(00) 0 0000-0000', 'ivo.lara@cooperjohnson.com.br', 'Fácil', '1973-07-30', 'cooperjohnson.webp', 1, '2022-12-22', 1),
(13, '16', 'CECM DOS FUNCIONÁRIOS DA ABRIL', 'COOPERABRIL', '43.438.662/0001-50', '3', '35400003588', '000.000.000.000', '05050-090', 'Rua Roma', 620, 'cj 182b', 'Lapa', 'São Paulo', 'SP', '(11) 3990-1753', '(00) 0 0000-0000', 'TatiMaximo@hotmail.com', 'Prodaf', '1972-10-09', 'coopabril.webp', 1, '2022-12-22', 1),
(14, '17', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS SERVIDORES DA UNESP', 'COOPUNESP', '69.136.075/0001-09', '2', '000.000.000.000', '000.000.000.000', '13506-900', 'Avenida 24 A', 1515, '', 'Jardim Bela Vista', 'Rio Claro', 'SP', '(19) 3523-4962', '(00) 0 0000-0000', 'coopunesp.contabilidade@gmail.com', 'Fácil', '1992-11-23', 'coopunesp.webp', 1, '2022-12-22', 1),
(15, '18', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS FUNCIONARIOS DA OWENS CORNING FIBERGLAS AMERICA DO SUL', 'COOPOWENS', '48.172.860/0001-39', '2', '000.000.000.000', '000.000.000.000', '13505-900', 'Avenida Brasil', 2567, '', 'Distrito Industrial', 'Rio Claro', 'SP', '(19) 3535-9442', '(00) 0 0000-0000', 'cooperativa.owens@gmail.com', 'Fácil', '1976-08-25', 'CoopOwens.webp', 1, '2022-12-22', 1),
(16, '19', 'COOPERATIVA DE CRÉDITO MÚTUO DOS FUNCIONÁRIOS DA RICLAN', 'COOPRICLAN', '06.077.760/0001-83', '3', '000.000.000.000', '000.000.000.000', '13501-900', 'Avenida Presidente Kennedy', 754, '', 'Município', 'Rio Claro', 'SP', '(19) 3526-8212', '(00) 0 0000-0000', 'contabilidade@coopriclan.com.b', 'Fácil', '2003-12-22', 'CoopPRICLAN.webp', 1, '2022-12-22', 1),
(17, '20', 'CECM DOS SERVIDORES DA FACULDADE DE ENGENHARIA DE ILHA SOLTEIRA', 'COOPERFEIS', '96.409.263/0001-28', 'Capital e Empréstimo', '35400023201', '000.000.000.000', '15385-001', 'AVENIDA BRASIL', 56, '', 'CENTRO', 'ILHA SOLTEIRA', 'SP', '(18) 3742-3117', '(00) 0 0000-0000', 'cooper.feis@unesp.br', 'Fácil', '1995-10-31', 'COOPERFEIS.webp', 1, '2022-12-22', 1),
(18, '21', 'COOPERATIVA ECMFG OWENS-ILLINOIS DO BRASIL', 'COOPOIB', '43.182.278/0001-30', '3', '35400010533', '000.000.000.000', '03822-900', 'Avenida Olavo Egídio de Souza Aranha', 2270, '', 'Parque Císper', 'São Paulo', 'SP', '(11) 2542-8137', '(00) 0 0000-0000', 'cooperativa.sp@o-i.com', 'Fácil', '1972-02-07', 'COOP-OIB.webp', 1, '2022-12-22', 1),
(19, '23', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DA BOMBRIL', 'COOPERBOMBRIL', '57.038.408/0001-70', '3', '3540001052-5', '000.000.000.000', '09696-000', 'Via Anchieta', 0, 'AV MARGINAL DIREITA', 'Rudge Ramos', 'São Bernardo do Campo', 'SP', '(11) 4366-1394', '(00) 0 0000-0000', 'arvelina.nicodemos@cooperbombr', 'Prodaf', '1967-03-15', 'CooperBombril.webp', 1, '2022-12-22', 1),
(20, '24', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DA ASTRAZENECA DO BRASIL', 'COOPAZ', '01.288.797/0001-37', '3', '35400041072', '000.000.000.000', '06707-000', '', 0, NULL, '', 'Cotia', 'SP', '(11) 3737-4516', '(00) 0 0000-0000', 'marcia.araujofernandes@astraze', 'Prodaf', '1996-06-28', 'logo_fncc.png', 0, '2022-12-22', 0),
(21, '25', 'COOPERATIVA DE CRÉDITO DOS FUNCIONÁRIOS DO GRUPO PPG', 'COOPERPPG', '03.657.230/0001-16', '3', '35400061651', '000.000.000.000', '13180-480', 'Rodovia Anhangüera', 0, 'KM 106,5', 'Jardim São Judas Tadeu (Nova V', 'Sumaré', 'SP', '(19) 2103-6029', '(00) 0 0000-0000', 'cooperppg2018@gmail.com', 'Fácil', '2000-02-08', 'COOPERPPG.webp', 1, '2022-12-22', 1),
(22, '26', 'COOPERATIVA DE ECONOMIA E CRÉDITO MUTUO DOS EMPREGADOS DAS EMPRESAS PLASCAR', 'COOPERPLASCAR', '17.411.307/0001-88', '3', '35400075554', '000.000.000.000', '13213-000', 'Rua Wilhelm Winter', 300, '', 'Distrito Industrial', 'Jundiaí', 'SP', '(11) 2729-4219', '(00) 0 0000-0000', 'cooperplascar@gmail.com', 'Fácil', '1983-03-02', 'COOPRLASCAR.webp', 1, '2022-12-22', 1),
(23, '27', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS PÚBLICOS MUNICIPAIS DE ITAPIRA - CREDITA', 'CREDITA', '02.115.870/0001-31', '2', '35400045957', '000.000.000.000', '13970-005', 'Praça Bernardino de Campos', 0, 'box 9', 'Centro', 'Itapira', 'SP', '(19) 3863-7594', '(00) 0 0000-0000', 'camila.silvestre@coopcredita.c', 'Prodaf', '1997-09-02', 'CREDITA.webp', 1, '2022-12-22', 1),
(24, '28', 'Cooperativa De Crédito Dos Empregados Do Grupo Akzo Nobel Brasil', 'COOP AKZONOBEL', '57.996.878/0001-46', '3', '35400017627', '000.000.000.000', '09370-901', 'Avenida Papa João XXIII', 0, NULL, 'Vila Carlina', 'Mauá', 'SP', '(11) 2148-2238', '(00) 0 0000-0000', 'ANGELA.FARIA@AKZONOBEL.COM', 'Fácil', '1987-09-15', 'Coop-AkzoNobel.webp', 1, '2022-12-22', 0),
(25, '29', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS EMPREGADOS DA JOYSON SAFETY SYSTEMS', 'COOPERJSS', '47.944.277/0001-36', '3', '35400010134', '000.000.000.000', '13212-240', 'Rodovia Dom Gabriel Paulino Bueno Couto', 0, 'km 66', 'Medeiros', 'Jundiaí', 'SP', '(11) 4585-3710', '(00) 0 0000-0000', 'cooptakatapetri@uol.com.br', 'Fácil', '1976-07-21', 'CooperJSS.webp', 1, '2022-12-22', 1),
(26, '30', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS EMPREGADOS DO GRUPO TELEFÔNICA', 'COOPERTEL', '57.598.120/0001-50', '3', '35400010592', '000.000.000.000', '01310-000', 'Avenida Paulista', 352, '2º andar - cj 21', 'Bela Vista', 'São Paulo', 'SP', '(11) 3016-9860', '(00) 0 0000-0000', 'clodoaldo@coopertel.org.br', 'Fácil', '1969-10-02', 'COOPERTEL.webp', 1, '2022-12-22', 1),
(27, '31', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO ALIANÇA', 'COOPERNITRO', '52.935.442/0001-23', '3', '35400001640', '000.000.000.000', '08090-000', 'Avenida Doutor José Artur Nova', 951, '', 'Parque Paulistano', 'São Paulo', 'SP', '(11) 2246-3357', '(00) 0 0000-0000', 'claudionolasco@coopernitro.com', 'Fácil', '1983-09-28', 'coopernitro.webp', 1, '2022-12-22', 1),
(28, '32', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DA FACULDADE DE CIÊNCIAS AGRÁRIAS E VETERINÁRIAS CAMPUS JABOTICABAL/SP', 'COOPERFAC', '57.259.525/0001-63', '2', '35400017473', '000.000.000.000', '14887-232', 'Avenida Julio Cesar de Marco', 0, '', 'Jardim São Marcos II', 'Jaboticabal', 'SP', '(16) 3202-7672', '(00) 0 0000-0000', 'j.catelani@unesp.br', 'Fácil', '1987-04-01', 'Cooperfac.webp', 1, '2022-12-22', 1),
(29, '33', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DA INTERNATIONAL INDÚSTRIA AUTOMOTIVA DA AMÉRICA DO SUL', 'COOP MWM', '59.620.708/0001-98', '3', '35400017899', '000.000.000.000', '04795-915', 'Avenida das Nações Unidas', 22002, '', 'Vila Almeida', 'São Paulo', 'SP', '(11) 5687-1901', '(00) 0 0000-0000', 'geani.ramos@navistar.com.br', 'Fácil', '1988-10-20', 'MWM.webp', 1, '2022-12-22', 1),
(30, '34', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS COLABORADORES DA CEBRACE', 'CREDICEBRACE', '53.184.438/0001-33', '3', '000.000.000.000', '000.000.000.000', '12311-900', 'Avenida do Cristal', 540, '', 'Parque Califórnia', 'Jacareí', 'SP', '(12) 2127-9066', '(00) 0 0000-0000', 'marcos.corra@ext.cebrace.com.b', 'Fácil', '1984-01-28', 'CrediCebrace.webp', 1, '2022-12-22', 1),
(31, '35', 'COOPERATIVA DE CRÉDITO MÚTUO DOS EMPREGADOS EM INSTITUIÇÕES FINANCEIRAS NAS REGIÕES DE SÃO PAULO E CAMPINAS', 'CREDISCOOP', '03.674.133/0001-31', '2', '35400061880', '000.000.000.000', '01010-010', 'Praça Antônio Prado', 33, '18º Andar conj. 1801', 'Centro', 'São Paulo', 'SP', '(11) 3242-3341', '(00) 0 0000-0000', 'luizbernardo@crediscoop.com.br', 'Fácil', '2000-02-23', 'CredisCoop.webp', 1, '2022-12-22', 1),
(32, '36', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS EMPREGADOS DA SAINT-GOBAIN DO BRASIL PRODUTOS INDUSTRIAIS E PARA CONSTRUÇÃO DIVISÃO VIDRO PLANO', 'COOPER-SEKURIT', '48.140.925/0001-64', '3', '35400002018', '000.000.000.000', '09390-000', 'Rua Rui Barbosa', 346, '', 'Centro', 'Mauá', 'SP', '(11) 4544-3161', '(00) 0 0000-0000', 'regina.martins@coopersekurit.c', 'Fácil', '1976-11-11', 'Cooper-Sekurit.webp', 1, '2022-12-22', 1),
(33, '37', 'COOPERATIVA DE CRÉDITO MÚTUO DOS SERVIDORES DA SEGURANÇA PÚBLICA DE SÃO PAULO - CREDIAFAM', 'CREDIAFAM', '04.804.353/0001-03', '3', '35300022807', '000.000.000.000', '02036-011', 'Rua Doutor Gabriel Piza', 425, '2º andar ', 'Santana', 'São Paulo', 'SP', '(11) 3328-1505', '(00) 0 0000-0000', 'aburbano@afam.com.br', 'Fácil', '2001-11-22', 'Crediafam.webp', 1, '2022-12-22', 1),
(34, '38', 'COOPERATIVA DE CRÉDITO MÚTUO DOS SERVIDORES DA ASSEMBLEIA LEGISLATIVA DO ESTADO DE SÃO PAULO', 'COOPERALESP', '04.791.645/0001-40', '3', '35400068957', '000.000.000.000', '04097-900', 'Avenida Pedro Álvares Cabral', 201, 'Subsolo, Sala 08, Palácio 9 de', 'Parque Ibirapuera', 'São Paulo', 'SP', '(11) 3886-6212', '(00) 0 0000-0000', 'cooperalesp@al.sp.gov.br', 'Fácil', '2001-11-01', 'cooperalesp.webp', 1, '2022-12-22', 1),
(35, '39', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS EMPREGADOS DA COMPANHIA BRASILEIRA DE ALUMÍNIO', 'COOPERCRED-CBA', '54.335.401/0001-21', '3', '35400031719', '000.000.000.000', '18125-000', '', 21, '', '', 'Alumínio', 'SP', '(11) 4715-4242', '(00) 0 0000-0000', 'contato@coopercredcba.com.br', 'Prodaf', '1986-09-16', 'Coopercred-CBA.webp', 1, '2022-12-22', 1),
(36, '40', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DO GRUPO AVIBRAS', 'COOPER AVIBRAS', '43.268.960/0001-40', '3', '35400000651', '000.000.000.000', '12315-020', 'Estrada Varadouro', 1200, 'km 14', 'Jardim Colônia', 'Jacareí', 'SP', '(12) 3955-5150', '(00) 0 0000-0000', 'cooperavibras@hotmail.com', 'Fácil', '1980-03-28', 'cooper-avibras.webp', 1, '2022-12-22', 1),
(37, '41', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DAS EMPRESAS DE CERÂMICA - COOPASPACER', 'COOPASPACER', '02.541.707/0001-30', '2', '35400047771', '000.000.000.000', '13510-011', 'Rua 4', 470, '', 'Centro', 'Santa Gertrudes', 'SP', '(19) 3545-9609', '(00) 0 0000-0000', 'cooperativa@aspacer.com.br', 'Fácil', '1998-01-12', 'ASPACER.webp', 1, '2022-12-22', 1),
(38, '42', 'COOPERATIVA DE CRÉDITO MÚTUO DOS EMPREGADOS DA FIAÇÃO ALPINA - COOPERALPINA', 'COOPERALPINA', '55.319.370/0001-88', '3', '35400017309', '000.000.000.000', '13260-000', 'Av da Saudade', 197, '', 'São Benedito', 'Morungaba', 'SP', '(11) 4014-4114', '(00) 0 0000-0000', 'alpina.cooperativa@alpinatexti', 'Fácil', '1985-05-06', 'cooperalpina.webp', 1, '2022-12-22', 1),
(39, '43', 'COOPERATIVA DE CRÉDITO MÚTUO DOS EMPREGADOS DA PILKINGTON BRASIL', 'COOPERPILKINGTON', '02.104.058/0001-00', '3', '35400045868', '000.000.000.000', '12286-160', 'Rodovia Presidente Dutra', 0, 'km 131-133', 'Vila Galvão', 'Caçapava', 'SP', '(12) 3221-2306', '(00) 0 0000-0000', 'Adriana.Santos@br.nsg.com', 'Fácil', '1997-08-25', 'Cooper-Pilkington.webp', 1, '2022-12-22', 1),
(40, '44', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁROIS DAS EMPRESAS MELHORAMENTOS DE SÃO PAULO', 'COOPERMEL', '01.504.952/0001-05', '3', '35400042109', '000.000.000.000', '05051-000', 'Rua Tito', 479, '1 andar', 'Vila Romana', 'São Paulo', 'SP', '(11) 3874-0718', '(00) 0 0000-0000', 'COOPERAT@MELHORAMENTOS.COM.BR', 'Fácil', '1996-10-04', 'CooperMel.webp', 1, '2022-12-22', 1),
(41, '45', 'COOPERATIVA DE ECONOMIA E CRÉDITO MUTUO DOS FUNCIONÁRIOS DA USINA SANTA MARIA - PILONCRED', 'PILONCRED', '01.107.759/0001-30', '3', '35400038110', '000.000.000.000', '18527-450', 'Estrada Vicinal Octávio Pilon', 0, '', 'São Francisco', 'Cerquilho', 'SP', '(15) 3284-8041', '(00) 0 0000-0000', 'PILONCRE@FASTERNET.COM.BR', 'Fácil', '1995-10-18', 'PILONCRED.webp', 1, '2022-12-22', 1),
(42, '46', 'COOPERATIVA DE ECONOMIA E CRÉDITO MUTUO DOS EMPREGADOS DO GRUPO COLORADO', 'CREDCOL', '02.024.442/0001-01', '3', '35400045531', '000.000.000.000', '14790-000', 'FAZENDA SÃO JOSÉ DA GLÓRIA ROD SP 425', 0, 'KM 47', '', 'Guaíra', 'SP', '(17) 3330-3341', '(00) 0 0000-0000', 'jose-antonio.pimenta@colorado.com', 'Fácil', '1997-07-25', 'CREDCOL.webp', 1, '2022-12-22', 1),
(43, '47', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS EMPREGADOS DA CONFAB', 'TENARIS', '59.305.565/0001-20', '3', '35400003961', '000.000.000.000', '12414-020', 'Avenida Gastão Vidigal Neto', 475, '', 'Cidade Nova', 'Pindamonhangaba', 'SP', '(12) 3644-9465', '(00) 0 0000-0000', 'rcosta@suppliers.tenaris.com', 'Fácil', '1965-10-07', 'TENARIS.webp', 1, '2022-12-22', 1),
(44, '48', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DA TETRA PAK', 'COOPERPAK', '67.341.487/0001-47', '3', '35400022108', '000.000.000.000', '13190-000', '', 0, NULL, '', 'Monte Mor', 'SP', '(19) 3217-6781', '(00) 0 0000-0000', 'marly.santos@cooperpak.com.br', 'Fácil', '1995-11-30', 'Cooperpak.webp', 1, '2022-12-22', 0),
(45, '49', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS EMPREGADOS DA MERCK SHARP & DOHME FARMACÊUTICA', 'COOPHARMA', '02.814.832/0001-77', '3', '35400050721', '000.000.000.000', '04583-110', 'Avenida Doutor Chucri Zaidan', 296, 'TORRE Z - 13 ANDAR ', 'Vila Cordeiro', 'São Paulo', 'SP', '(11) 5189-7964', '(00) 0 0000-0000', 'vanda_santos@merck.com', 'Fácil', '1998-05-21', 'COOPHARMA.webp', 1, '2022-12-22', 1),
(46, '50', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DA SELENE', 'COOPSELENE', '72.952.138/0001-00', '3', '35400023856', '000.000.000.000', '18528-608', 'Rua do Velho Ramal', 490, '', 'Distrito Industrial', 'Cerquilho', 'SP', '(15) 3384-8888', '(00) 0 0000-0000', 'cooperativa@selene.com.br', 'Fácil', '1993-09-08', 'COOPSELENE.webp', 1, '2022-12-22', 1),
(47, '51', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DA NESTLÉ', 'CREDI NESTLÉ', '62.562.012/0001-67', '3', '35400010694', '000.000.000.000', '04730-903', 'Rua Doutor Rubens Gomes Bueno', 691, 'Conjunto 221 - Bloco A - Condo', 'Várzea de Baixo', 'São Paulo', 'SP', '(11) 5508-7695', '(00) 0 0000-0000', 'Mirella.Campos@BR.nestle.com', 'Fácil', '1969-09-08', 'credi-nestle.webp', 1, '2022-12-22', 1),
(48, '52', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS E MPREGADOS DA UNIFI - CREDIUNIFI', 'CREDIUNIFI', '03.685.335/0001-89', '3', '35400061791', '000.000.000.000', '04726-170', 'Avenida Alfredo Egídio de Souza Aranha', 177, '2º andar', 'Vila Cruzeiro', 'São Paulo', 'SP', '(35) 3299-5011', '(00) 0 0000-0000', 'CrediUnifi@unifi.com.br', 'Fácil', '1999-10-18', 'CREDIUNIFI.webp', 1, '2022-12-22', 1),
(49, '53', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DO FLEURY', 'COOPERCREDI GRUPO FLEURY', '71.965.313/0001-22', '3', '35400023678', '000.000.000.000', '01310-905', 'Avenida Paulista', 352, '1.º ANDAR - SALA 13', 'Bela Vista', 'São Paulo', 'SP', '(11) 3285-5132', '(00) 0 0000-0000', 'anamaria.allegretto@grupofleur', 'Fácil', '1993-03-19', 'FLEURY.webp', 1, '2022-12-22', 1),
(50, '54', 'CECMF DA FUNDAÇÃO ZERBINI E DA FUNDAÇÃO FACULDADE DE MEDICINA COOPINCOR', 'COOPINCOR', '01.997.612/0001-63', '3', '35400043890', '000.000.000.000', '05403-000', 'Avenida Doutor Enéas Carvalho de Aguiar', 44, '', 'Cerqueira César', 'São Paulo', 'SP', '(11) 2661-5584', '(00) 0 0000-0000', 'osni.merces@coopincor.com.br', 'Fácil', '1996-12-16', 'coopincor.webp', 1, '2022-12-22', 1),
(51, '55-8', 'COOPERATIVA DE CRÉDITO MÚTUO DOS EMPREGADOS DO MAGAZINE LUIZA EMPRESAS CONTROLADAS E COLIGADAS', 'COOPLUIZA', '02.093.154/0001-09', '3', '25600040389', '000.000.000.000', '14400-660', 'Rua do Comércio', 1924, '', 'Centro', 'Franca', 'SP', '(16) 3711-2121', '(00) 0 0000-0000', 'jcmendes@coopluiza.com.br', 'Fácil', '1997-04-09', 'coopluiza.webp', 1, '2022-12-22', 1),
(52, '22', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS EMPREGADOS SKF E COLIGADAS', 'COOPERSKF', '49.091.119/0001-06', '3', '35400001909', '000.000.000.000', '07790-190', 'Via de Acesso Norte Km 30.5', 0, 'KM 30', 'Empresarial Itaim (Polvilho)', 'Cajamar', 'SP', '(11) 4448-8438', '(00) 0 0000-0000', 'ariela.oblasser@skf.com', 'Fácil', '1969-10-09', 'COOPERSKF.webp', 1, '2022-12-22', 1),
(53, '56-6', 'COOPERATIVA DE ECONOMIA E CRéDITO MúTUO DOS TRABALHADORES DO GRUPO SãO MARTINHO', 'USICRED', '02.562.412/0001-40', '3', '35400047348', '000.000.000.000', '14850-000', 'FAZENDA SÃO MARTINHO', 0, '', 'ZONA RURAL', 'Pradópolis', 'SP', '(16) 3981-9049', '(00) 0 0000-0000', 'jose.paulo@saomartinho.com.br', 'Fácil', '1997-12-22', 'USICRED.webp', 1, '2022-12-22', 1),
(54, '57-4', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS FUNCIONARIOS DA VILLARES METALS', 'VILLARES METALS', '53.846.242/0001-67', '3', '35400001941', '000.000.000.000', '13178-021', 'Avenida Vereador Antônio Pereira de Camargo Neto', 770, '', 'Jardim Dall Orto', 'Sumaré', 'SP', '(19) 3303-8254', '(00) 0 0000-0000', 'Creditovm.gil@uol.com.br', 'Fácil', '1984-07-03', 'coop-Villares.webp', 1, '2022-12-22', 1),
(55, '58-2', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DA POLÍCIA MILITAR DO ESTADO DE SÃO PAULO  DA REGIÃO CENTRO OESTE PAULISTA', 'CREDMIL', '04.152.107/0001-06', '2', '3500063912', '000.000.000.000', '17015-311', '', 0, NULL, '', 'Bauru', 'SP', '(14) 3879-1151', '(00) 0 0000-0000', 'GER.ADMINISTRATIVO@CREDMIL.ORG', 'Fácil', '2000-05-02', 'CREDMIL.webp', 1, '2022-12-22', 0),
(56, '59-0', 'COOPERATIVA DE CRÉDITO MÚTUO DE SERVIDORES DO ESTADO DE SÃO PAULO', 'CREDIFISCO', '04.546.162/0001-80', '2', '35400067896', '000.000.000.000', '01017-000', 'Avenida Rangel Pestana', 203, '23 andar', 'Brás', 'São Paulo', 'SP', '(11) 3106-1529', '(00) 0 0000-0000', 'valeria.abitte@credifisco.com', 'Prodaf', '2001-06-19', 'CREDIFISCO.webp', 1, '2022-12-22', 1),
(57, '0', 'FNCC - FEDERAÇÃO NACIONAL DAS COOPERATIVAS DE CRÉDITO', 'FNCC', '20.151.021/0001-15', '', '35400169753', '51.323.842', '02010-000', 'Rua Voluntários da Pátria', 654, 'SALA 606', 'Santana', 'São Paulo', 'SP', '(11) 2089-9490', '(11) 9 3730-7909', 'fncc@fncc.com.br', 'Prodaf', '2014-10-03', 'logo_fncc.png', 1, '2022-12-22', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `diretoria_conselhoadm`
--

DROP TABLE IF EXISTS `diretoria_conselhoadm`;
CREATE TABLE IF NOT EXISTS `diretoria_conselhoadm` (
  `dca_id` int(10) NOT NULL AUTO_INCREMENT,
  `dca_nome` char(50) DEFAULT NULL,
  `dca_cargo` char(30) DEFAULT NULL,
  `dca_telefone` varchar(16) DEFAULT NULL,
  `dca_email` varchar(50) DEFAULT NULL,
  `dca_mandato` date DEFAULT NULL,
  `dca_coop` int(10) NOT NULL,
  PRIMARY KEY (`dca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `diretoria_conselhoadm`
--

INSERT INTO `diretoria_conselhoadm` (`dca_id`, `dca_nome`, `dca_cargo`, `dca_telefone`, `dca_email`, `dca_mandato`, `dca_coop`) VALUES
(1, 'IVO LARA RODRIGUES', 'DIRETOR PRESIDENTE', '(12) 9 9169-3553', 'IVO.LARA@COOPERJOHNSON.COM.BR', '2023-03-31', 57),
(2, 'CLODOALDO PALÚ', 'DIRETOR ADMINISTRATIVO', '(11) 9 7626-0743', 'CLODOALDO@COOPERTEL.ORG.BR', '2023-03-31', 57),
(3, 'ANDRÉ LUIZ BRONE', 'DIRETOR FINANCEIRO', '(11) 9 8202-7287', 'ANDRE.BRONE@COOPERICSSON.COM.BR', '2023-03-31', 57);

-- --------------------------------------------------------

--
-- Estrutura para tabela `documentos_circulares`
--

DROP TABLE IF EXISTS `documentos_circulares`;
CREATE TABLE IF NOT EXISTS `documentos_circulares` (
  `cod_docc` int(255) NOT NULL AUTO_INCREMENT,
  `docc_categoria` int(255) NOT NULL,
  `docc_subcategoria` int(255) NOT NULL,
  `docc_titulo` varchar(100) NOT NULL,
  `docc_arquivo` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_docc`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `documentos_circulares`
--

INSERT INTO `documentos_circulares` (`cod_docc`, `docc_categoria`, `docc_subcategoria`, `docc_titulo`, `docc_arquivo`) VALUES
(1, 2, 2, 'MEDIDAS TRABALHISTAS – COVID-19', 'MEDIDAS_TRABALHISTAS_–_COVID-19.pdf');

-- --------------------------------------------------------

--
-- Estrutura para tabela `download_termo_aceito`
--

DROP TABLE IF EXISTS `download_termo_aceito`;
CREATE TABLE IF NOT EXISTS `download_termo_aceito` (
  `cod_dta` bigint(255) NOT NULL AUTO_INCREMENT,
  `dta_user` bigint(255) NOT NULL,
  `dta_arquivo` varchar(100) NOT NULL,
  `dta_cod_arquivo` bigint(255) NOT NULL,
  `dta_data` date NOT NULL,
  PRIMARY KEY (`cod_dta`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `download_termo_aceito`
--

INSERT INTO `download_termo_aceito` (`cod_dta`, `dta_user`, `dta_arquivo`, `dta_cod_arquivo`, `dta_data`) VALUES
(1, 1, 'Ata-de-Assembleia-Geral-Ordinária-2.docx', 1, '2023-03-02'),
(2, 1, 'Ata-de-Assembleia-Geral-Extraordinária-2.docx', 24, '2023-03-02'),
(3, 1, 'Edital-de-Convocação-de-Assembleia-Geral-Ordinária-1.docx', 2, '2023-03-02'),
(4, 1, 'Estatuto-Social.doc', 5, '2023-03-02'),
(5, 2, 'Ata-de-Assembleia-Geral-Ordinária-2.docx', 1, '2023-03-02'),
(6, 1, 'Politica-de-Segurança-da-Informação-5.docx', 13, '2023-04-28');

-- --------------------------------------------------------

--
-- Estrutura para tabela `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(220) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `pessoa` char(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `events`
--

INSERT INTO `events` (`id`, `title`, `color`, `start`, `end`, `pessoa`) VALUES
(1, 'Alinhamento comunicação ', '#ff0000', '2023-03-01 11:00:00', '2023-03-01 12:00:00', 'Karina');

-- --------------------------------------------------------

--
-- Estrutura para tabela `extrato_de_capital`
--

DROP TABLE IF EXISTS `extrato_de_capital`;
CREATE TABLE IF NOT EXISTS `extrato_de_capital` (
  `cod_ext_capital` int(255) NOT NULL AUTO_INCREMENT,
  `ext_acumulado` date NOT NULL,
  `ext_remuneracao_juros` varchar(6) NOT NULL,
  `ext_coop` int(255) NOT NULL,
  `ext_arquivo` varchar(150) NOT NULL,
  `ext_obs` text DEFAULT NULL,
  PRIMARY KEY (`cod_ext_capital`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `feriados`
--

DROP TABLE IF EXISTS `feriados`;
CREATE TABLE IF NOT EXISTS `feriados` (
  `cod_feriado` int(10) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `feriado` char(50) NOT NULL,
  `tipo_feriado` char(25) NOT NULL,
  `facultativo` int(11) NOT NULL,
  PRIMARY KEY (`cod_feriado`),
  UNIQUE KEY `data` (`data`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `feriados`
--

INSERT INTO `feriados` (`cod_feriado`, `data`, `feriado`, `tipo_feriado`, `facultativo`) VALUES
(1, '2024-01-01', 'Ano Novo', 'Feriado Nacional', 0),
(2, '2024-01-25', 'Aniversário de São Paulo', 'Feriado Municipal', 0),
(3, '2024-02-12', 'Carnaval', 'Feriado Facultaivo', 0),
(4, '2024-02-13', 'Carnaval', 'Feriado Facultaivo', 0),
(5, '2024-02-14', 'Carnaval', 'Feriado Facultaivo', 0),
(6, '2023-04-07', 'Sexta-Feira Santa', 'Feriado Nacional', 0),
(7, '2023-04-21', 'Dia de Tiradentes', 'Feriado Nacional', 0),
(8, '2023-05-01', 'Dia do Trabalhador', 'Feriado Nacional', 0),
(9, '2023-06-08', 'Corpus Christi', 'Feriado Municipal', 0),
(10, '2023-07-09', 'Revolução Constitucionalista', 'Feriado Estadual', 0),
(11, '2023-09-07', 'Independência do Brasil', 'Feriado Nacional', 0),
(12, '2023-10-12', 'Dia das Crianças', 'Feriado Nacional', 0),
(13, '2023-10-15', 'Dia do Professor', 'Feriado Facultativo', 1),
(14, '2023-10-28', 'Dia do Servidor Público', 'Feriado Facultativo', 1),
(15, '2023-11-02', 'Dia de Finados', 'Feriado Nacional', 0),
(16, '2023-11-15', 'Proclamação da República', 'Feriado Nacional', 0),
(17, '2023-11-20', 'Consciência Negra', 'Feriado Municipal', 0),
(18, '2023-11-25', 'Natal', 'Feriado Nacional', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `gerenciamento_riscos`
--

DROP TABLE IF EXISTS `gerenciamento_riscos`;
CREATE TABLE IF NOT EXISTS `gerenciamento_riscos` (
  `grs_cod` bigint(255) NOT NULL AUTO_INCREMENT,
  `grs_bal` bigint(255) NOT NULL,
  `grs_coop` bigint(255) NOT NULL,
  `grs_data_inicial` date NOT NULL,
  `grs_data_final` date NOT NULL,
  `grs_arquivo` varchar(100) NOT NULL,
  PRIMARY KEY (`grs_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `grupos_usuarios`
--

DROP TABLE IF EXISTS `grupos_usuarios`;
CREATE TABLE IF NOT EXISTS `grupos_usuarios` (
  `cod_grupo` int(2) NOT NULL AUTO_INCREMENT,
  `grupo` char(30) NOT NULL,
  PRIMARY KEY (`cod_grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `grupos_usuarios`
--

INSERT INTO `grupos_usuarios` (`cod_grupo`, `grupo`) VALUES
(1, 'Atendimento Administrativo'),
(2, 'Consultoria Técnica'),
(3, 'Consultoria Jurídica'),
(4, 'Cooperativas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `jornada`
--

DROP TABLE IF EXISTS `jornada`;
CREATE TABLE IF NOT EXISTS `jornada` (
  `cod_jornada` int(20) NOT NULL,
  `dia` char(25) NOT NULL,
  `dia_abreviado` char(3) NOT NULL,
  `jor_entrada` time DEFAULT NULL,
  `jor_intervalo` time DEFAULT NULL,
  `jor_fim_intervalo` time DEFAULT NULL,
  `jor_saida` time DEFAULT NULL,
  `jor_tolerancia` time DEFAULT NULL,
  PRIMARY KEY (`cod_jornada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `jornada`
--

INSERT INTO `jornada` (`cod_jornada`, `dia`, `dia_abreviado`, `jor_entrada`, `jor_intervalo`, `jor_fim_intervalo`, `jor_saida`, `jor_tolerancia`) VALUES
(1, 'SEGUNDA', 'seg', '08:00:00', '12:00:00', '13:00:00', '17:00:00', '00:05:00'),
(2, 'TERÇA', 'ter', '08:00:00', '12:00:00', '13:00:00', '17:00:00', '00:05:00'),
(3, 'QUARTA', 'qua', '08:00:00', '12:00:00', '13:00:00', '17:00:00', '00:05:00'),
(4, 'QUINTA', 'qui', '08:00:00', '12:00:00', '13:00:00', '17:00:00', '00:05:00'),
(5, 'SEXTA', 'sex', '08:00:00', '12:00:00', '13:00:00', '17:00:00', '00:05:00'),
(6, 'SÁBADO', 'sab', NULL, NULL, NULL, NULL, NULL),
(7, 'DOMINGO', 'dom', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `justificativa_ponto`
--

DROP TABLE IF EXISTS `justificativa_ponto`;
CREATE TABLE IF NOT EXISTS `justificativa_ponto` (
  `cod_just` int(11) NOT NULL AUTO_INCREMENT,
  `just_dia` date NOT NULL,
  `just_motivo` varchar(50) NOT NULL,
  `just_arquivo` varchar(100) DEFAULT NULL,
  `just_user` bigint(255) NOT NULL,
  `just_tipo` char(10) NOT NULL,
  `just_situacao` int(1) NOT NULL DEFAULT 0 COMMENT '0 - não avaliada 1 - recusada 2- aprovada	',
  PRIMARY KEY (`cod_just`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `justificativa_ponto`
--

INSERT INTO `justificativa_ponto` (`cod_just`, `just_dia`, `just_motivo`, `just_arquivo`, `just_user`, `just_tipo`, `just_situacao`) VALUES
(1, '2023-03-01', 'Compensação do dia 20/02', NULL, 2, '', 0),
(2, '2023-03-02', 'Compensação carnaval', NULL, 2, '', 0),
(3, '2023-03-03', 'Compensação ', NULL, 2, '', 0),
(4, '2023-03-07', 'Compensação ', NULL, 2, '', 0),
(5, '2023-03-08', 'Compensação ', NULL, 2, '', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(10) NOT NULL AUTO_INCREMENT,
  `menu` char(30) NOT NULL,
  `caminho_drop` varchar(35) NOT NULL,
  `icone` varchar(30) NOT NULL,
  `caminho_submenu` varchar(40) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `menu`
--

INSERT INTO `menu` (`id_menu`, `menu`, `caminho_drop`, `icone`, `caminho_submenu`) VALUES
(1, 'CONSULTAS', 'consultas', 'uil uil-ticket', ''),
(2, 'ESTATÍSTICAS', 'relatorios', 'uil uil-file-info-alt', ''),
(3, 'CADASTRO', 'cadastro', 'bi bi-person-vcard', ''),
(4, 'FINANCEIRO', 'financeiro', 'bi bi-cash-coin', ''),
(5, 'MODELOS DE DOCUMENTOS', 'modelo_documentos', 'bi bi-file-earmark-font', ''),
(6, 'CONFIGURAÇÕES', 'configuracoes', 'bi bi-gear-wide-connected', ''),
(7, 'CIRCULARES', 'circulares', 'bi bi-columns-gap', ''),
(8, 'RECURSOS HUMANOS', 'RH', 'bi bi-person-bounding-box', ''),
(9, 'CANAL DE DENÚNCIAS', 'denuncias', 'bi bi-megaphone', ''),
(10, 'SITE', 'site', 'bi bi-browser-edge', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `modelos_de_documentos`
--

DROP TABLE IF EXISTS `modelos_de_documentos`;
CREATE TABLE IF NOT EXISTS `modelos_de_documentos` (
  `cod_documento` int(10) NOT NULL AUTO_INCREMENT,
  `categoria_documento` int(10) NOT NULL,
  `titulo_documento` varchar(100) NOT NULL,
  `nome_documento` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_documento`),
  KEY `categoria_documento` (`categoria_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `modelos_de_documentos`
--

INSERT INTO `modelos_de_documentos` (`cod_documento`, `categoria_documento`, `titulo_documento`, `nome_documento`) VALUES
(1, 1, 'Ata de Assembleia Geral Ordinária', 'Ata-de-Assembleia-Geral-Ordinária-2.docx'),
(2, 2, 'Edital de Convocação de Assembleia Geral Ordinária', 'Edital-de-Convocação-de-Assembleia-Geral-Ordinária-1.docx'),
(3, 2, 'Edital de Convocação de Assembleia Geral Extraordinária', 'Edital-de-Convocação-de-Assembleia-Geral-Extraordinária-1.docx'),
(4, 2, 'Edital de Convocação de Assembleia Geral Ordinária e Extraordinária', 'Edital-de-Conovação-de-Assembleia-Geral-Ordinária-e-Extraordinária-1.docx'),
(5, 3, 'Estatuto Social', 'Estatuto-Social.doc'),
(6, 4, 'Regulamento de Auditoria Interna', 'Regulamento-de-Auditoria-Interna.docx'),
(7, 5, 'Politica de Gerenciamento de Risco Socioambiental (PRSA)', 'Politica-de-Gerenciamento-de-Risco-Socioambiental-PRSA-9.docx'),
(8, 5, 'Política de Gerenciamento de Riscos de Crédito', 'Política-de-Gerenciamento-de-Riscos-de-Crédito-8.docx'),
(9, 5, 'Politica de Gerenciamento de Risco de Liquidez e Capital', 'Politica-de-Gerenciamento-de-Risco-de-Liquidez-e-Capital-7.docx'),
(10, 5, 'Politica de Gerenciamento de Risco Operacional', 'Politica-de-Gerenciamento-de-Risco-Operacional-7.docx'),
(11, 5, 'Política de Registro de Perdas e Ocorrências', 'Política-de-Registro-de-Perdas-e-Ocorrências-1.zip'),
(12, 5, 'Politica de Segurança Cibernética', 'Politica-de-Segurança-Cibernética-5.docx'),
(13, 5, 'Politica de Segurança da Informação', 'Politica-de-Segurança-da-Informação-5.docx'),
(14, 5, 'Politica de Seleção e Contratação de Prestadores de Serviços', 'Politica-de-Seleção-e-Contratação-de-Prestadores-de-Serviços.zip'),
(15, 5, 'Politica de Sucessão de Administradores', 'Politica-de-Sucessão-de-Administradores-5.docx'),
(16, 5, 'Politica de Mudanças e Desenvolvimento de Novos Produtos e Serviços', 'Politica-de-Mudanças-e-Desenvolvimento-de-Novos-Produtos-e-Serviços-4.docx'),
(17, 5, 'Politica de Prevenção a Lavagem de Dinheiro e Financ. ao Terrorismo (PLF-FT)', 'Politica-de-Prevenção-a-Lavagem-de-Dinheiro-e-Financ.-ao-Terrorismo-PLF-FT-4.docx'),
(18, 5, 'Relatório de Atribuições da Componentes da Estrutura Organizacional', 'Relatório-de-Atribuições-da-Componentes-da-Estrutura-Organizacional-3.docx'),
(19, 5, 'Politica de Relacionamentos com Assoc_Clientes_ Usuários', 'Politica-de-Relacionamentos-com-Assoc_Clientes_-Usuários-1.docx'),
(20, 5, 'Código de Ética e Conduta', 'Código-de-Ética-e-Conduta.docx'),
(21, 5, 'Politica de Capitalização', 'Politica-de-Capitalização-1-2.docx'),
(22, 6, 'Relatório de Controles Internos', 'Relatório-de-Controles-Internos.docx'),
(23, 6, 'Modelo _ Relatóro de Conformidade _Versão 1', 'Modelo-_-Relatóro-de-Conformidade-_Versão-1.docx'),
(24, 1, 'Ata de Assembleia Geral Extraordinária', 'Ata-de-Assembleia-Geral-Extraordinária-2.docx'),
(25, 1, 'Ata de Assembleia Geral _Ordinária e Extraordinária', 'Ata-de-Assembleia-Geral-_Ordinária-e-Extraordinária-2.docx'),
(26, 1, 'Ata de Posse – Conselho Fiscal', 'Ata-de-Posse-Conselho-Fiscal-3.docx');

-- --------------------------------------------------------

--
-- Estrutura para tabela `nivel_acesso`
--

DROP TABLE IF EXISTS `nivel_acesso`;
CREATE TABLE IF NOT EXISTS `nivel_acesso` (
  `cod_perfil` int(5) NOT NULL,
  `codMenu` int(5) NOT NULL,
  `codSubmenu` int(5) NOT NULL,
  `marcado` int(1) NOT NULL DEFAULT 0 COMMENT '0-Inativo 1-Ativo',
  KEY `cod_perfil` (`cod_perfil`),
  KEY `codMenu` (`codMenu`),
  KEY `codSubmenu` (`codSubmenu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `nivel_acesso`
--

INSERT INTO `nivel_acesso` (`cod_perfil`, `codMenu`, `codSubmenu`, `marcado`) VALUES
(1, 1, 1, 1),
(1, 1, 2, 1),
(1, 2, 3, 1),
(1, 2, 4, 1),
(1, 3, 5, 1),
(1, 3, 6, 1),
(1, 2, 7, 1),
(1, 9, 8, 1),
(1, 4, 9, 1),
(1, 4, 10, 1),
(1, 5, 12, 1),
(1, 5, 13, 1),
(1, 5, 14, 0),
(1, 5, 15, 0),
(1, 5, 16, 0),
(1, 5, 17, 0),
(1, 6, 18, 1),
(1, 8, 19, 1),
(1, 4, 20, 1),
(1, 4, 21, 1),
(1, 4, 11, 1),
(1, 4, 22, 1),
(1, 7, 23, 1),
(1, 7, 24, 1),
(1, 8, 25, 1),
(2, 1, 1, 1),
(2, 1, 2, 1),
(2, 2, 3, 1),
(2, 2, 4, 1),
(2, 3, 5, 1),
(2, 3, 6, 1),
(2, 2, 7, 1),
(2, 9, 8, 1),
(2, 4, 9, 1),
(2, 4, 10, 1),
(2, 5, 12, 1),
(2, 5, 13, 1),
(2, 5, 14, 0),
(2, 5, 15, 0),
(2, 5, 16, 0),
(2, 5, 17, 0),
(2, 6, 18, 1),
(2, 8, 19, 1),
(2, 4, 20, 1),
(2, 4, 21, 1),
(2, 4, 11, 1),
(2, 4, 22, 1),
(2, 7, 23, 1),
(2, 7, 24, 1),
(2, 8, 25, 1),
(3, 1, 1, 0),
(3, 1, 2, 1),
(3, 2, 3, 0),
(3, 2, 4, 0),
(3, 3, 5, 0),
(3, 3, 6, 0),
(3, 2, 7, 0),
(3, 9, 8, 0),
(3, 4, 9, 0),
(3, 4, 10, 0),
(3, 5, 12, 0),
(3, 5, 13, 0),
(3, 5, 14, 0),
(3, 5, 15, 0),
(3, 5, 16, 0),
(3, 5, 17, 0),
(3, 6, 18, 0),
(3, 8, 19, 0),
(3, 4, 20, 0),
(3, 4, 21, 0),
(3, 4, 11, 0),
(3, 4, 22, 0),
(3, 7, 23, 0),
(3, 7, 24, 0),
(3, 8, 25, 0),
(4, 1, 1, 0),
(4, 1, 2, 1),
(4, 2, 3, 0),
(4, 2, 4, 0),
(4, 3, 5, 0),
(4, 3, 6, 0),
(4, 2, 7, 0),
(4, 9, 8, 0),
(4, 4, 9, 0),
(4, 4, 10, 0),
(4, 5, 12, 0),
(4, 5, 13, 0),
(4, 5, 14, 0),
(4, 5, 15, 0),
(4, 5, 16, 0),
(4, 5, 17, 0),
(4, 6, 18, 0),
(4, 8, 19, 0),
(4, 4, 20, 0),
(4, 4, 21, 0),
(4, 4, 11, 0),
(4, 4, 22, 0),
(4, 7, 23, 0),
(4, 7, 24, 0),
(4, 8, 25, 0),
(5, 1, 1, 1),
(5, 1, 2, 1),
(5, 2, 3, 0),
(5, 2, 4, 0),
(5, 3, 5, 0),
(5, 3, 6, 0),
(5, 2, 7, 0),
(5, 9, 8, 0),
(5, 4, 9, 0),
(5, 4, 10, 0),
(5, 5, 12, 1),
(5, 5, 13, 0),
(5, 5, 14, 0),
(5, 5, 15, 0),
(5, 5, 16, 0),
(5, 5, 17, 0),
(5, 6, 18, 0),
(5, 8, 19, 0),
(5, 4, 20, 1),
(5, 4, 21, 1),
(5, 4, 11, 1),
(5, 4, 22, 0),
(5, 7, 23, 0),
(5, 7, 24, 0),
(5, 8, 25, 0),
(1, 2, 26, 1),
(2, 2, 26, 1),
(3, 2, 26, 0),
(4, 2, 26, 0),
(5, 2, 26, 0),
(1, 8, 27, 1),
(2, 8, 27, 1),
(3, 8, 27, 0),
(4, 8, 27, 0),
(5, 8, 27, 0),
(1, 8, 28, 1),
(2, 8, 28, 1),
(3, 8, 28, 0),
(4, 8, 28, 0),
(5, 8, 28, 0),
(1, 6, 30, 1),
(2, 6, 30, 1),
(1, 8, 31, 1),
(2, 8, 31, 1),
(1, 8, 32, 1),
(2, 8, 32, 1),
(3, 8, 32, 0),
(4, 8, 32, 0),
(5, 8, 32, 0),
(3, 8, 31, 0),
(4, 8, 31, 0),
(5, 8, 31, 0),
(3, 6, 30, 0),
(4, 6, 30, 0),
(5, 6, 30, 0),
(1, 8, 29, 1),
(2, 8, 29, 1),
(3, 8, 29, 0),
(4, 8, 29, 0),
(5, 8, 29, 0),
(1, 9, 33, 1),
(2, 9, 33, 1),
(3, 9, 33, 0),
(4, 9, 33, 0),
(5, 9, 33, 0),
(1, 10, 34, 1),
(1, 10, 35, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfis_usuarios`
--

DROP TABLE IF EXISTS `perfis_usuarios`;
CREATE TABLE IF NOT EXISTS `perfis_usuarios` (
  `p_cod` int(10) NOT NULL AUTO_INCREMENT,
  `perfil` char(30) NOT NULL,
  PRIMARY KEY (`p_cod`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `perfis_usuarios`
--

INSERT INTO `perfis_usuarios` (`p_cod`, `perfil`) VALUES
(1, 'Administrador'),
(2, 'Administrativo'),
(3, 'Técnico'),
(4, 'Jurídico'),
(5, 'Cooperativa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `site_editais`
--

DROP TABLE IF EXISTS `site_editais`;
CREATE TABLE IF NOT EXISTS `site_editais` (
  `cod_edital` bigint(255) NOT NULL AUTO_INCREMENT,
  `edital_arquivo` varchar(200) NOT NULL,
  `edital_data` date NOT NULL,
  `edital_coop` bigint(255) NOT NULL,
  PRIMARY KEY (`cod_edital`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `site_editais`
--

INSERT INTO `site_editais` (`cod_edital`, `edital_arquivo`, `edital_data`, `edital_coop`) VALUES
(1, 'Edital_20230423_41_204645.pdf', '2023-04-23', 41),
(2, 'Edital_20230423_17_204700.pdf', '2023-04-23', 17),
(3, 'Edital_20230423_21_204729.pdf', '2023-04-23', 21),
(4, 'Edital_20230423_48_204752.pdf', '2023-04-23', 48),
(5, 'Edital_20230423_53_204829.pdf', '2023-04-23', 53),
(6, 'Edital_20230423_46_204949.pdf', '2023-04-23', 46),
(7, 'Edital_20230423_16_205002.pdf', '2023-04-23', 16),
(8, 'Edital_20230423_15_205014.pdf', '2023-04-23', 15),
(9, 'Edital_20230423_14_205026.pdf', '2023-04-23', 14),
(10, 'Edital_20230423_36_205101.pdf', '2023-04-23', 36),
(11, 'Edital_20230423_54_205138.pdf', '2023-04-23', 54),
(12, 'Edital_20230423_43_205232.pdf', '2023-04-23', 43),
(13, 'Edital_20230423_39_205250.pdf', '2023-04-23', 39),
(14, 'Edital_20230423_25_205302.pdf', '2023-04-23', 25);

-- --------------------------------------------------------

--
-- Estrutura para tabela `site_noticias`
--

DROP TABLE IF EXISTS `site_noticias`;
CREATE TABLE IF NOT EXISTS `site_noticias` (
  `cod_noticia` bigint(255) NOT NULL AUTO_INCREMENT,
  `titulo_noticia` varchar(150) NOT NULL,
  `subtitulo_noticia` varchar(200) NOT NULL,
  `texto_noticia` text NOT NULL,
  `categoria_noticia` char(10) NOT NULL,
  `slug_noticia` varchar(200) NOT NULL,
  `img_noticia` varchar(150) NOT NULL,
  `publicado` int(1) NOT NULL,
  `data_noticia` date NOT NULL,
  `data_publicacao` date DEFAULT NULL,
  PRIMARY KEY (`cod_noticia`),
  UNIQUE KEY `slug_noticia` (`slug_noticia`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `site_noticias`
--

INSERT INTO `site_noticias` (`cod_noticia`, `titulo_noticia`, `subtitulo_noticia`, `texto_noticia`, `categoria_noticia`, `slug_noticia`, `img_noticia`, `publicado`, `data_noticia`, `data_publicacao`) VALUES
(1, 'IVO LARA PARTICIPA DA LIVE ESPECIAL COOPCAFÉ SOBRE O DICC 2022', 'Diretor Presidente da FNCC fala junto a grandes nomes do cooperativismo de crédito', '<p>No dia 1 de novembro de 2022, o Diretor presidente da Federa&ccedil;&atilde;o, Ivo Lara, participou da Live especial CoopCaf&eacute; &ndash; &ldquo;DICC 2022 &ndash; Coops de cr&eacute;dito empoderando seu futuro financeiro&rdquo;.</p>\r\n<p>Esse encontro transmitido ao vivo encerrou as lives de comemora&ccedil;&atilde;o ao Dia Internacional do Cooperativismo de Cr&eacute;dito (DICC) de 2022.</p>\r\n<p>Al&eacute;m de Ivo, a live contou com a participa&ccedil;&atilde;o de Cl&aacute;udio Montenegro, Luiz Lesse Moura Santos, Luiz Antonio, Mauro Toledo Sirimarco, Claudio Rangel e Cledir Magri, presidente da Cresol Confedera&ccedil;&atilde;o.</p>\r\n<p>Essas lideran&ccedil;as do cooperativismo de cr&eacute;dito brasileiro debateram a import&acirc;ncia do setor para o fortalecimento da economia nacional. Al&eacute;m disso, tamb&eacute;m falaram sobre as perspectivas e desafios para o pr&oacute;ximo ano, diante do novo cen&aacute;rio pol&iacute;tico no pa&iacute;s.</p>\r\n<p>Voc&ecirc; pode conferir a live completa no canal do Portal BR Cooperativo, pelo endere&ccedil;o:&nbsp;<a href=\"https://www.youtube.com/@PortalBrcooperativo\" target=\"_blank\" rel=\"noopener\">https://www.youtube.com/@PortalBrcooperativo&nbsp;</a></p>', 'News', 'ivo-lara-participa-da-live-especial-coopcafe-sobre-o-dicc-2022', '2023-04-08_IVO_LARA_PARTICIPA_DA_LIVE_ESPECIAL_COOPCAFÉ_SOBRE_O_DICC_2022_140519.jpg', 1, '2023-04-08', '2022-12-08'),
(2, 'FNCC REALIZA REUNIÃO PARA EXPLICAR A RESOLUÇÃO 5051/22', 'Após reunião com representantes do Banco Central do Brasil e pesquisa junto às associadas, a Resolução contemplou apontamentos da FNCC', '<p>No dia 06 de dezembro, &uacute;ltima ter&ccedil;a-feira, a FNCC realizou uma reuni&atilde;o com gestores, diretores e conselheiros das cooperativas associadas para fazer esclarecimentos sobre os impactos da Resolu&ccedil;&atilde;o 5051/22.</p>\r\n<p>A reuni&atilde;o foi online, contou com a participa&ccedil;&atilde;o de 75 representantes das Cooperativas associadas e foi um momento bastante rico, no qual d&uacute;vidas foram retiradas e os participantes puderam entender mais sobre o papel da FNCC nesse processo de constru&ccedil;&atilde;o da resolu&ccedil;&atilde;o.</p>\r\n<p><em>&ldquo;&Oacute;tima iniciativa da FNCC em proporcionar discuss&atilde;o entre as Cooperativas sobre um tema que gera in&uacute;meras d&uacute;vidas&rdquo;</em>, declara Renata da Costa Paschoalato, da CooperNitro.</p>\r\n<p>A representatividade da FNCC ganha muito mais for&ccedil;a, quando as associadas participam ativamente, respondendo &agrave;s pesquisas e apoiando a Federa&ccedil;&atilde;o na elabora&ccedil;&atilde;o das suas an&aacute;lises e considera&ccedil;&otilde;es.</p>', 'News', 'fncc-realiza-reuniao-para-explicar-a-resolucao-5051-22', '2023-04-08_FNCC_REALIZA_REUNIÃO_PARA_EXPLICAR_A_RESOLUÇÃO_5051_22_140818.jpg', 1, '2023-04-08', '2022-12-08'),
(3, 'EM EVENTO ONLINE, OCB E OCESP FAZEM ESCLARECIMENTOS E DETALHAMENTOS DAS CONQUISTAS DO SISTEMA COOPERATIVO BRASILEIRO', 'Conquistas para as cooperativas de crédito', '<p>O ano est&aacute; quase no fim, mas a FNCC segue trabalhando. No dia 12 de dezembro, segunda-feira, a Federa&ccedil;&atilde;o promoveu um encontro online para esclarecimentos e detalhamentos das conquistas do Sistema Cooperativo Brasileiro, OCB/OCESP para as cooperativas de cr&eacute;dito, tanto de capital e empr&eacute;stimo, quanto as cl&aacute;ssicas.&nbsp;</p>\r\n<p>O encontro reuniu 36 participantes. As apresenta&ccedil;&otilde;es foram realizadas por Thiago Borba Abrantes e Clara Pedroso Maffia, da OCB. Celso Augusto Teixeira e Luis Ant&ocirc;nio Schmidt representaram o Sistema OCESP e Aramis Moutinho o Sescoop/SP. Todos destacaram as a&ccedil;&otilde;es, conquistas e defesas para o cooperativismo de cr&eacute;dito no ano de 2022.</p>\r\n<p>Em cima da quest&atilde;o&nbsp;<em>&ldquo;conquistas e defesa do cooperativismo de cr&eacute;dito&rdquo;</em>&nbsp;foram abordados assuntos como: a import&acirc;ncia da representa&ccedil;&atilde;o institucional pelo Sistema OCB, que se desdobrou em outros t&oacute;picos interessantes.</p>\r\n<p>A representa&ccedil;&atilde;o cooperativista, assim como a representa&ccedil;&atilde;o pol&iacute;tica tamb&eacute;m foram pauta. Al&eacute;m disso, foi explicado como se d&aacute; a atua&ccedil;&atilde;o do Sistema OCB nos tr&ecirc;s poderes. Para que todos pudessem acompanhar, foram citadas tamb&eacute;m as vantagens da organiza&ccedil;&atilde;o sist&ecirc;mica, algo que refor&ccedil;a a import&acirc;ncia do coletivo, da representatividade.</p>\r\n<p>Uma lista de conquistas foi apresentada, sendo explicada de ponto a ponto. Essa a&ccedil;&atilde;o &eacute; de extrema import&acirc;ncia, uma vez que conquistas e defesas podem n&atilde;o ser 100% entendidas pelas cooperativas federadas.&nbsp;</p>\r\n<p>Conquistas como: exclus&atilde;o do ato cooperativo da base de c&aacute;lculo do PIS/PASEP e CONFINS para cooperativas de cr&eacute;dito; entendimento sumulado no CARF de que as aplica&ccedil;&otilde;es financeiras realizadas por cooperativas de cr&eacute;dito no mercado constituem ato cooperativo t&iacute;pico e, por isso, n&atilde;o sofrem a incid&ecirc;ncia de IRPJ e CSLL; Dispensa de contrata&ccedil;&atilde;o da auditoria independente das demonstra&ccedil;&otilde;es cont&aacute;beis para cooperativas de capital e empr&eacute;stimo.</p>\r\n<p>&Eacute; essencial que todos entendam como o trabalho em conjunto e de representa&ccedil;&atilde;o da FNCC est&aacute; gerando resultados positivos para as cooperativas federadas e seus cooperados. Prova disso foi a negocia&ccedil;&atilde;o da FNCC com a OCB via OCESP neste ano, que resultou no desconto de 50% na base de c&aacute;lculo da contribui&ccedil;&atilde;o cooperativista para as cooperativas de capital e empr&eacute;stimo.</p>\r\n<p>Esse trabalho segue sendo bem-feito e a tend&ecirc;ncia &eacute; se aprimorar cada vez mais. &ldquo;Hoje a FNCC j&aacute; representa 25% de todo o cooperativismo de cr&eacute;dito do estado de S&atilde;o Paulo&rdquo;, destaca Ivo Lara, Diretor Presidente da Federa&ccedil;&atilde;o.</p>\r\n<p>Ele ainda completa, &ldquo;ter hoje a OCESP e a OCB para demonstrar quais iniciativas est&atilde;o sendo feitas para auxiliar nossas cooperativas, para prote&ccedil;&atilde;o dos benef&iacute;cios &eacute; algo muito importante e significativo&rdquo;.</p>', 'News', 'em-evento-online-ocb-e-ocesp-fazem-esclarecimentos-e-detalhamentos-das-conquistas-do-sistema-cooperativo-brasileiro', '2023-04-08_EM_EVENTO_ONLINE,_OCB_E_OCESP_FAZEM_ESCLARECIMENTOS_E_DETALHAMENTOS_DAS_CONQUISTAS_DO_SISTEMA_COOPERATIVO_BRASILEIRO_142639.jpg', 1, '2023-04-08', '2022-12-15'),
(4, 'FNCC REALIZA SUA CONFRATERNIZAÇÃO PRESENCIALMENTE E CONTA COM MUITA INTERCOOPERAÇÃO', 'O Momento de celebração reuniu, além dos colaboradores, diretores e conselheiros fiscais da Federação, cooperativas associadas, parceiros e líderes do segmento cooperativista.', '<p>Na &uacute;ltima quinta-feira, 8 de dezembro, a FNCC &ndash; Federa&ccedil;&atilde;o Nacional das Cooperativas de Cr&eacute;dito realizou sua confraterniza&ccedil;&atilde;o de fim de ano. A noite de comemora&ccedil;&atilde;o reuniu n&atilde;o apenas os colaboradores, dirigentes e conselheiros fiscais da Federa&ccedil;&atilde;o, mas tamb&eacute;m representantes das cooperativas associadas. Ao todo foram 107 pessoas presentes no evento, representando 27 cooperativas associadas.</p>\r\n<p>Vale destacar que ap&oacute;s o per&iacute;odo de restri&ccedil;&otilde;es, por conta da pandemia, essa foi a primeira confraterniza&ccedil;&atilde;o presencial da FNCC. Nos &uacute;ltimos dois anos esse momento de encerramento era feito online, atrav&eacute;s do Conecta, tradicional evento da Federa&ccedil;&atilde;o com suas federadas.</p>\r\n<h2><strong>Abertura</strong></h2>\r\n<p>Quem deu as boas-vindas e abriu os trabalhos na confraterniza&ccedil;&atilde;o, foi o Diretor Presidente, Ivo Lara. Ap&oacute;s a chegada dos convidados, ele agradeceu a participa&ccedil;&atilde;o no evento de todos os envolvidos e o engajamento das federadas durante o ano nas a&ccedil;&otilde;es realizadas pela FNCC.</p>\r\n<p>O Diretor Financeiro, Andr&eacute; Brone, tamb&eacute;m destacou a import&acirc;ncia da participa&ccedil;&atilde;o ativa das federadas no evento. &ldquo;Fico muito feliz de ver todo mundo reunido, isso mostra a for&ccedil;a do segmento&rdquo;. Da mesma forma, o Diretor Administrativo, Clodoaldo Pal&uacute;, tamb&eacute;m externou sua satisfa&ccedil;&atilde;o pelo momento de confraterniza&ccedil;&atilde;o. &ldquo;N&atilde;o vou esconder meu contentamento desse evento, pois foram dois longos anos&rdquo;.</p>\r\n<p>A Federa&ccedil;&atilde;o apresentou um v&iacute;deo de retrospectiva, no qual todas as a&ccedil;&otilde;es (cursos, treinamentos, encontros, reuni&otilde;es, f&oacute;runs etc) foram relembradas. Um registro de tudo que a FNCC fez e conquistou neste ano junto (e para) as cooperativas associadas.</p>\r\n<p>Em seguida, alguns membros da equipe discursaram sobre a import&acirc;ncia dessa reuni&atilde;o presencial para celebrar, e claro, sobre a import&acirc;ncia de n&atilde;o perder a ess&ecirc;ncia do cooperativismo. &ldquo;&Eacute; muito bom estar de volta no ber&ccedil;o que eu comecei no cooperativismo, l&aacute; em 1997&rdquo;, comentou Marcelo C&aacute;rfora, Superintendente da FNCC.</p>\r\n<h2><strong>Reconhecimento</strong></h2>\r\n<p>A noite seguiu com a entrega dos certificados &agrave;s associadas. Cada cooperativa teve um representante para receber a homenagem, que era recepcionado com muitos aplausos e mensagens de apoio ao trabalho realizado ao longo do ano.</p>\r\n<p>Al&eacute;m disso, houve tamb&eacute;m a realiza&ccedil;&atilde;o do sorteio de um Smartphone Samsumg S21 FE entre os convidados, e o vencedor foi o Eric Fernando Tomboly, Conselheiro Fiscal da Coopernitro.</p>\r\n<p><em>&ldquo;Gostaria de parabenizar a FNCC pelo evento excepcional, agradecer por toda recep&ccedil;&atilde;o, educa&ccedil;&atilde;o e acolhimento. Fiquei tamb&eacute;m super feliz por ser o felizardo em ganhar no sorteio o Celular Samsung S21&rdquo;</em>, declarou Eric.&nbsp;</p>\r\n<h2><strong>Festa e muita anima&ccedil;&atilde;o</strong></h2>\r\n<p>A noite seguiu e a anima&ccedil;&atilde;o tomou conta do evento. Logo ap&oacute;s o jantar, os convidados se jogaram na pista com o Coral e Banda BSH, que colocou todo mundo para dan&ccedil;ar e agitar o sal&atilde;o. Houve muita divers&atilde;o com a participa&ccedil;&atilde;o dos convidados dan&ccedil;ando, cantando e at&eacute; fazendo uma disputa para ver qual lado era o mais animado.</p>\r\n<p><em>&ldquo;Evento maravilhoso, foi uma festa de fam&iacute;lia!&rdquo;</em>, afirmou M&aacute;rcia Costa, da Cooperfemsa.</p>\r\n<p><em>&ldquo;Estava tudo muito gostoso, festa bem descontra&iacute;da, comida e bebida farta, gar&ccedil;ons sempre prestativos e servindo muito bem, banda boa, enfim nota 10&rdquo;</em>, parabenizou Sandra Lopes, da Piloncred.</p>', 'News', 'fncc-realiza-sua-confraternizacao-presencialmente-e-conta-com-muita-intercooperacao', '2023-04-08_FNCC_REALIZA_SUA_CONFRATERNIZAÇÃO_PRESENCIALMENTE_E_CONTA_COM_MUITA_INTERCOOPERAÇÃO_143014.jpg', 1, '2023-04-08', '2022-12-15'),
(5, 'COOPERFEIS COMPLETA 30 ANOS DE HISTÓRIA', 'Instituição comemora sua terceira década de existência com muito cooperativismo', '<p>Nesse final de 2022, a Cooperativa Cooperfeis, uma das nossas Federadas, chega ao seu 30&ordm; anivers&aacute;rio. Criada em 1992, a Coop existe para atender a comunidade da Feis Unesp, e hoje conta com 390 associados, e o intuito &eacute; seguir crescendo.</p>\r\n<p>A miss&atilde;o da cooperativa &eacute; manter a institui&ccedil;&atilde;o a servi&ccedil;o do cooperativismo, remunerando o capital do associado, oferecer produtos e servi&ccedil;os acess&iacute;veis melhores que o mercado, e claro, gerar resultados financeiros para o cooperado.</p>\r\n<p>Tudo isso pautado no respeito, na &eacute;tica, na transpar&ecirc;ncia e na qualidade de atendimento.</p>\r\n<p>Assim como todas as singulares, o grande desafio dos &uacute;ltimos tempos da Cooperfeis foi passar pela pandemia. Com essa conquista, o trabalho continua para aumentar o n&uacute;mero de s&oacute;cios e emprestar o dinheiro aplicado em bancos.</p>\r\n<p>Para que a Cooperfeis continue promovendo e exercendo o cooperativismo de cr&eacute;dito, a FNCC &eacute; de grande valia na parte de cursos e consultorias sempre que necess&aacute;rio.</p>\r\n<p>A Federa&ccedil;&atilde;o Nacional das Cooperativas de Cr&eacute;dito deseja um feliz anivers&aacute;rio para a Cooperfeis e muito cooperativismo pelos pr&oacute;ximos anos!</p>', 'Express', 'cooperfeis-completa-30-anos-de-historia', '2023-04-08_COOPERFEIS_COMPLETA_30_ANOS_DE_HISTÓRIA_143227.jpg', 1, '2023-04-08', '2022-12-15'),
(6, 'COOPERJOHNSON COMEMORA 50 ANOS DE HISTÓRIA', 'Evolução, inclusão e movimento definem a trajetória da cooperativa', '<p>Em janeiro de 2023 a CooperJohnson, Cooperativa de Cr&eacute;dito dos funcion&aacute;rios da Johnson &amp; Johnson, completa 50 anos de exist&ecirc;ncia.</p>\r\n<p>Essa cooperativa associada a FNCC est&aacute; situada na cidade de S&atilde;o Jos&eacute; dos Campos, conta com 5533 associados, e al&eacute;m dos servi&ccedil;os financeiros, a CooperJohnson tamb&eacute;m oferece produtos e benef&iacute;cios na &aacute;rea social, educacional e t&eacute;cnica.</p>\r\n<p>Nossa for&ccedil;a est&aacute; nas pessoas! &Eacute;tica, respeito, solidez e responsabilidade.</p>\r\n<p>O jeito de ser da CooperJohnson se resume em realizar sonhos, promover o desenvolvimento pessoal e profissional. Al&eacute;m, claro, de promover o bem-estar dos cooperados, beneficiando os mesmos por meio de solu&ccedil;&otilde;es financeiras com responsabilidade, diversidade e inclus&atilde;o.</p>\r\n<p>Nos &uacute;ltimos anos a cooperativa tem se destacado com a&ccedil;&otilde;es que pensam e incluem a todos. Al&eacute;m disso, a CooperJohnson tamb&eacute;m &eacute; not&oacute;ria por promover diversos cursos e eventos educacionais para seus cooperados.</p>\r\n<p><em>&ldquo;50 anos &eacute; a idade de ouro, seja para uma pessoa ou para uma institui&ccedil;&atilde;o que j&aacute; viveu muitas coisas e pode se considerar s&aacute;bia o bastante para ensinar os outros, como a CooperJohnson que j&aacute; ajudou milhares de associados a realizar seus sonhos e se preocupa com a evolu&ccedil;&atilde;o de seus produtos e servi&ccedil;os. Mas &eacute; tamb&eacute;m a idade do esp&iacute;rito jovem, de uma institui&ccedil;&atilde;o que ainda tem muito que crescer e proporcionar experi&ecirc;ncias inovadoras aos seus associados e a comunidade onde atua. Com esta motiva&ccedil;&atilde;o que n&oacute;s da administra&ccedil;&atilde;o procuramos guiar nossas a&ccedil;&otilde;es. Parab&eacute;ns CooperJohnson pelo caminho percorrido com muito aprendizado e vit&oacute;rias&rdquo;</em>, parabeniza a Diretora Jur&iacute;dica da Coop, Adriana Simadon Bertoni.</p>\r\n<p>Para a cooperativa, o associado tem papel fundamental na constru&ccedil;&atilde;o da hist&oacute;ria, eles possuem sentido de propriedade com olhar para a sustentabilidade do neg&oacute;cio. Eles possuem alto grau de comprometimento, participa&ccedil;&atilde;o ativa na vida da cooperativa buscando tamb&eacute;m o desafio do crescimento, isto motiva e impulsiona a Coop a buscar sempre o melhor para os associados, familiares e para a comunidade que estamos inseridos.</p>\r\n<p><em>&ldquo;&Eacute; um marco comemorar os 50 anos e estar a cada ano superando as expectativas dos Cooperados. Desde sua funda&ccedil;&atilde;o, a CooperJohnson visa oferecer aos Cooperados as melhores ofertas de cr&eacute;dito, capacita&ccedil;&atilde;o Educacional, T&eacute;cnica e Social. Hoje somos refer&ecirc;ncia no atendimento e nas ofertas realizadas aos Cooperados. Esse sucesso &eacute; por termos um time engajado que sempre est&aacute; em busca de atualiza&ccedil;&atilde;o profissional, melhores ofertas de cr&eacute;dito, melhores sistemas, sempre com o objetivo de oferecer o melhor para o Cooperado. A CooperJohnson sempre est&aacute; presente na realiza&ccedil;&atilde;o de algum sonho dos Cooperados e seus familiares. Orgulho de pertencer!&rdquo;</em>, declara a Diretora Operacional, Ana L&uacute;cia Prilips Esposito.</p>\r\n<p>Vale destacar que a FNCC &eacute; uma grande parceira no desenvolvimento da Cooper. Seja atrav&eacute;s de capacita&ccedil;&otilde;es da equipe, e tamb&eacute;m cooperados. A Federa&ccedil;&atilde;o oferece consultorias jur&iacute;dicas, t&eacute;cnicas, em busca constante do fortalecimento do cooperativismo perante a sociedade e tamb&eacute;m atrav&eacute;s da intercoopera&ccedil;&atilde;o. Gerando conhecimento e desenvolvimento m&uacute;tuo em todo o cooperativismo.</p>\r\n<p>A CooperJohnson possui um planejamento estrat&eacute;gico bem definido que se iniciou em 2020 e finalizar&aacute; em 2024. Dentro desse planejamento a Coop vai priorizar seus cooperados nos quatro pilares definidos, (Pessoas, Tecnologia, Neg&oacute;cio e Mercado).</p>\r\n<p>A FNCC deseja muito sucesso para a CooperJohnson e que atinja todas as metas do seu planejamento e a satisfa&ccedil;&atilde;o dos seus cooperados.</p>', 'Express', 'cooperjohnson-comemora-50-anos-de-historia', '2023-04-08_COOPERJOHNSON_COMEMORA_50_ANOS_DE_HISTÓRIA_143448.jpg', 1, '2023-04-08', '2023-01-23'),
(7, 'TREINAMENTO DE OUVIDORIA ABRE O ANO DE CAPACITAÇÕES OFERECIDAS PELA FNCC', 'Curso foi de grande importância para as cooperativas associadas', '<p>No &uacute;ltimo dia 23 de janeiro (segunda-feira), a FNCC ofereceu o seu primeiro curso do ano, o Treinamento de Ouvidoria. Ele foi ministrado por Miguel Affonso Gentile, consultor de controles internos e gest&atilde;o em cooperativas de cr&eacute;dito, com 30 anos de experi&ecirc;ncia em auditoria e gest&atilde;o em institui&ccedil;&otilde;es financeiras. O encontro contou com a participa&ccedil;&atilde;o online de 64 representantes das cooperativas singulares.</p>\r\n<p>Segundo Miguel Affonso, o objetivo principal do curso &eacute; &ldquo;estimular o desenvolvimento das compet&ecirc;ncias essenciais da fun&ccedil;&atilde;o de ouvidor para uma atua&ccedil;&atilde;o de excel&ecirc;ncia, observando as diretrizes e normativas legais aplicadas ao ramo de cr&eacute;dito&rdquo;.</p>\r\n<p>Para atingir o objetivo, os pontos sobre ouvidoria abordados no treinamento foram: a ouvidoria a servi&ccedil;o da melhoria da gest&atilde;o das organiza&ccedil;&otilde;es; modelos de ouvidoria; a excel&ecirc;ncia no atendimento e a fala do ouvidor; &eacute;tica, media&ccedil;&atilde;o e solu&ccedil;&atilde;o de conflitos; direitos e a defesa dos consumidores no &acirc;mbito p&uacute;blico e privado; relacionamento da ouvidoria com as demais &aacute;reas de atendimento a clientes.</p>\r\n<p>No treinamento, o palestrante exp&ocirc;s com bastante dinamismo todos os temas citados acima, fez tamb&eacute;m uma &oacute;tima media&ccedil;&atilde;o na hora de responder perguntas. Todas as d&uacute;vidas foram tiradas e foi um momento rico de troca de entendimento acerca do assunto.</p>\r\n<h2>Por que &eacute; t&atilde;o importante um treinamento espec&iacute;fico sobre ouvidoria?</h2>\r\n<p>Em julho de 2007 o Banco Central do Brasil publicou a Resolu&ccedil;&atilde;o 4.860/20, que disp&otilde;e sobre a institui&ccedil;&atilde;o de componente organizacional de ouvidoria pelas institui&ccedil;&otilde;es financeiras e demais institui&ccedil;&otilde;es autorizadas a funcionar pelo Banco Central do Brasil.</p>\r\n<p>Dado esse cen&aacute;rio, a FNCC fornece &agrave;s suas singulares o componente organizacional de ouvidoria, sem que a cooperativa necessite criar estrutura de ouvidoria pr&oacute;pria.</p>\r\n<p>Sendo assim, o treinamento &eacute; importante tanto para que as cooperativas filiadas entendam mais sobre esse servi&ccedil;o oferecido pela Federa&ccedil;&atilde;o, quanto para as singulares que est&atilde;o instalando seu pr&oacute;prio sistema de ouvidoria. &Eacute; um momento de troca importante para todos.</p>\r\n<p><em>&ldquo;Excelente material, did&aacute;tica e conhecimento do palestrante. Parab&eacute;ns ao Miguel Affonso Gentile e a FNCC&rdquo;</em>, elogia Carlos Alberto, Diretor Operacional da Coop MWM.</p>\r\n<p><em>&ldquo;Adorei o treinamento e os exemplos do palestrante. Em todo momento fez link com a realidade que vivemos nas nossas cooperativas&rdquo;</em>, parabenizou Orlando Saraiva da CoopUnesp.</p>\r\n<p>Esse foi apenas o primeiro treinamento do ano, ao longo de 2023 a FNCC seguir&aacute; na promo&ccedil;&atilde;o de treinamentos e capacita&ccedil;&otilde;es como essa para os representantes das suas cooperativas filiadas.</p>', 'Express', 'treinamento-de-ouvidoria-abre-o-ano-de-capacitacoes-oferecidas-pela-fncc', '2023-04-08_TREINAMENTO_DE_OUVIDORIA_ABRE_O_ANO_DE_CAPACITAÇÕES_OFERECIDAS_PELA_FNCC_143638.jpg', 1, '2023-04-08', '2023-01-30'),
(8, 'DIRETOR PRESIDENTE DA FNCC PARTICIPOU DO PROGRAMA LÍDER CRÉDITO SP', 'Ivo Lara representou a Federação em evento do Sescoop/SP', '<p>Nos dias 30 e 31 de janeiro aconteceu o primeiro m&oacute;dulo do Programa L&iacute;der Cr&eacute;dito SP. Evento idealizado pelo Sescoop/SP em parceria com o Instituto de Ensino e Pesquisa (Insper).</p>\r\n<p>Esse programa foi desenvolvido com o intuito de capacitar presidentes e executivos de cooperativas de cr&eacute;dito acerca de assuntos relevantes sobre o segmento. Tudo isso com o apoio de um instituto que &eacute; refer&ecirc;ncia como uma escola de neg&oacute;cios.</p>\r\n<p><em>&ldquo;O segmento das cooperativas de cr&eacute;dito &eacute; muito competitivo e, por isso, &eacute; necess&aacute;rio que esteja em constante atualiza&ccedil;&atilde;o de conceitos&rdquo;</em>, explica Luis Antonio Schmidt, gerente geral do Sistema Ocesp.</p>\r\n<p>Presidentes de cooperativas de cr&eacute;ditos paulistas estiveram nesse primeiro ciclo do evento, assim como o Diretor Presidente da FNCC, Ivo Lara, que foi justamente representando a Federa&ccedil;&atilde;o.</p>\r\n<p><em>&ldquo;A capacita&ccedil;&atilde;o cont&iacute;nua para desenvolvimento de nossas lideran&ccedil;as &eacute; imprescind&iacute;vel, tudo muda muito r&aacute;pido e precisamos seguir atualizados. Al&eacute;m da capacita&ccedil;&atilde;o, as trocas com os demais l&iacute;deres foram muito importantes. O Insper &eacute; uma institui&ccedil;&atilde;o refer&ecirc;ncia no mercado, os professores foram muito pr&aacute;ticos, como devem ser, agrade&ccedil;o ao Sescoop pela oportunidade&rdquo;</em>, declara Ivo Lara.</p>', 'News', 'diretor-presidente-da-fncc-participou-do-programa-lider-credito-sp', '2023-04-08_DIRETOR_PRESIDENTE_DA_FNCC_PARTICIPOU_DO_PROGRAMA_LÍDER_CRÉDITO_SP_143806.jpg', 1, '2023-04-08', '2023-02-07'),
(9, 'TREINAMENTO DE PROCESSOS ASSEMBLEARES É OFERECIDO PELA FNCC', 'Conteúdo foi ministrado em dois dias de treinamento', '<p>Nos dias 13 e 14 de fevereiro aconteceu mais um treinamento oferecido pela FNCC em 2023. O Treinamento de Processos Assembleares &ndash; Aspectos Pr&aacute;ticos. Os encontros se deram de forma online e contou com a participa&ccedil;&atilde;o de 73 representantes das cooperativas associadas.</p>\r\n<p>Quem guiou o treinamento foi Rog&eacute;rio Mesquita, profissional com CRC/SP, OAB/SP e inscri&ccedil;&atilde;o na Ordem dos Advogados em Portugal. Assim como outros cursos da FNCC, esse treinamento foi de extrema import&acirc;ncia, pois &eacute; algo que todas as cooperativas lidam na sua gest&atilde;o.</p>\r\n<p>Al&eacute;m disso, o timming para esse treinamento n&atilde;o poderia ser melhor, uma vez que logo as cooperativas de cr&eacute;dito v&atilde;o entrar em &eacute;poca de Assembleia Geral.</p>\r\n<p>No primeiro dia foram trabalhados tr&ecirc;s m&oacute;dulos: Norma Legal aplic&aacute;vel ao processo assemblear; Procedimentos durante a execu&ccedil;&atilde;o da Assembleia; Elabora&ccedil;&atilde;o da ATA e demais documentos. J&aacute; no segundo foram abordados os m&oacute;dulos 4 e 5: Envio documentos ao BACEN; Procedimentos p&oacute;s homologa&ccedil;&atilde;o do BACEN.</p>\r\n<p>Nos dois dias, Rog&eacute;rio falou passo a passo dos t&oacute;picos abordados em cada m&oacute;dulo, sobre as boas pr&aacute;ticas, o que deve ser feito, o que &eacute; bom ser evitado e assim por diante. Os participantes tiveram suas d&uacute;vidas respondidas e viram exemplos pr&aacute;ticos, que se adequam a realidade das cooperativas singulares.</p>\r\n<p><em>&ldquo;Excelente treinamento, muito esclarecedor. a participa&ccedil;&atilde;o e troca com outras cooperativas &eacute; de bastante ajuda, pois s&atilde;o as mesmas d&uacute;vidas entre todas&rdquo;</em>, elogiou Jackeline Silva de Souza, da Crediunifi.</p>\r\n<p><em>&ldquo;Suma import&acirc;ncia esse curso, visto que estamos em v&eacute;speras de assembleias e teve v&aacute;rias mudan&ccedil;as pelo Bacen&rdquo;</em>, refor&ccedil;ou Delvo Martinelli, da Credivista, sobre o momento mais do que prop&iacute;cio para a realiza&ccedil;&atilde;o desse treinamento.</p>\r\n<p>Esse foi mais um treinamento da FNCC em 2023, que est&aacute; apenas come&ccedil;ando. A Federa&ccedil;&atilde;o oferecer&aacute; mais cursos como esse de extrema utilidade para suas cooperativas associadas.</p>', 'News', 'treinamento-de-processos-assembleares-e-oferecido-pela-fncc', '2023-04-08_TREINAMENTO_DE_PROCESSOS_ASSEMBLEARES_É_OFERECIDO_PELA_FNCC_144037.jpg', 1, '2023-04-08', '2023-02-17'),
(10, 'COOPERPLASCAR COMPLETA 40 ANOS DE HISTÓRIA', 'Cooperativa de crédito celebra a data e ressalta papel dos associados', '<p>No dia 02/03/2023 a Cooperplascar completa 40 anos de exist&ecirc;ncia. Hoje com 355 associados, a cooperativa segue evoluindo, fazendo a diferen&ccedil;a na vida dos cooperados e superando desafios, e eles n&atilde;o s&atilde;o poucos.</p>\r\n<p>Um dos desafios superados foi manter-se firme diante da pandemia do Covid-19, onde muitas fam&iacute;lias perderam entes queridos e tamb&eacute;m suas fontes de renda.</p>\r\n<p><em>&ldquo;O papel dos associados &eacute; de extrema import&acirc;ncia para o crescimento da Cooperativa. Eles s&atilde;o os donos, tomam decis&otilde;es, junto a isso, ainda conseguem realizar sonhos atrav&eacute;s da Cooperativa. Suas sugest&otilde;es de melhorias s&atilde;o sempre bem-vindas e analisadas pela Diretoria&rdquo;</em>, afirma Heidi Domingues, coordenadora da Cooperplascar.</p>\r\n<p>A Cooperplascar agora est&aacute; com o foco em reduzir a burocracia para o seu associado, embarcar na transforma&ccedil;&atilde;o digital com or&ccedil;amento e recursos dispon&iacute;veis, e claro, conquistar e encantar a nova gera&ccedil;&atilde;o de associados, que est&atilde;o em busca de tecnologia, efici&ecirc;ncia e agilidade, sem abrir m&atilde;o da credibilidade.</p>\r\n<p>A Federa&ccedil;&atilde;o se orgulha em ter a Cooperplascar como federada.&nbsp;<em>&ldquo;A FNCC nos auxilia nos mantendo sempre informados das obriga&ccedil;&otilde;es que a Cooperativa precisa realizar. Sempre nos atualizando&rdquo;</em>, completa Heidi.</p>', 'Express', 'cooperplascar-completa-40-anos-de-historia', '2023-04-08_COOPERPLASCAR_COMPLETA_40_ANOS_DE_HISTÓRIA_144317.jpg', 1, '2023-04-08', '2023-03-02'),
(11, '4º FÓRUM INTEGRATIVO CONFEBRAS TEVE SEU INÍCIO COM DIÁLOGO EM FOCO', 'Primeiro ciclo aconteceu em fevereiro', '<p>Contando com a co-realiza&ccedil;&atilde;o da Federa&ccedil;&atilde;o e apoio da OCB, a quarta edi&ccedil;&atilde;o do<br>F&oacute;rum Integrativo Confebras realizou seu primeiro ciclo no &uacute;ltimo dia 15 de fevereiro.<br>A reuni&atilde;o foi online e reuniu 70 representantes de cooperativas de cr&eacute;dito<br>independente.</p>\r\n<p>Na abertura do F&oacute;rum falaram aos participantes do evento o presidente da Confebras,<br>Moacir Krambeck, o presidente da FNCC, Ivo Lara, e o coordenador do Ramo Cr&eacute;dito<br>da OCB, Thiago Borba. Al&eacute;m disso, tamb&eacute;m foram apresentados os integrantes do<br>Grupo de Trabalho do 4&ordm; F&oacute;rum: Agnaldo Garcia, diretor executivo da Barracred,<br>Rafael Costa, diretor financeiro da Poupecredi, e Wanderson de Oliveira, gerente da<br>Cogem.</p>\r\n<p>J&aacute; os resultados da pesquisa feita diretamente com as cooperativas singulares<br>independentes foram apresentados pelo vice-presidente da Confebras, Luiz Lesse, e<br>pela superintendente da Confebras, Telma Galletti.</p>\r\n<p>O objetivo desse evento &eacute; levantar as principais demandas das cooperativas de<br>cr&eacute;dito singulares independentes e trabalharmos juntos. Ou seja, promover a<br>intercoopera&ccedil;&atilde;o em prol do mapeamento e desenvolvimento de solu&ccedil;&otilde;es que ajudem<br>as cooperativas a vencer desafios e crescer com sustentabilidade.<br>Assim como propomos como tema para o evento, a intercoopera&ccedil;&atilde;o ser&aacute; o caminho<br>para concretizarmos os objetivos desenhados para essa edi&ccedil;&atilde;o. N&oacute;s sempre teremos<br>melhores resultados quando trabalhamos juntos.</p>\r\n<p>O primeiro ciclo, Dialogar: para encontrar objetivos comuns, aconteceu agora em<br>fevereiro. As datas dos outros dois ciclos ser&atilde;o:<br>&ndash; Desenvolver: projetos em que todos possam cooperar e crescer juntos &ndash; 30/03<br>&ndash; Materializar: transformar os projetos em realidade &ndash; 16/05.</p>', 'News', '4-forum-integrativo-confebras-teve-seu-inicio-com-dialogo-em-foco', '2023-04-08_4º_FÓRUM_INTEGRATIVO_CONFEBRAS_TEVE_SEU_INÍCIO_COM_DIÁLOGO_EM_FOCO_144504.jpg', 1, '2023-04-08', '2023-03-08'),
(12, 'CHEGAMOS AOS 9 ANOS DE EXISTÊNCIA! E É SÓ O COMEÇO!', 'Neste aniversário da FNCC, veja como estamos evoluindo junto as nossas Associadas:', '<p>Este m&ecirc;s, a FNCC sopra as velas e comemora 9 anos de exist&ecirc;ncia! Os primeiros passos da Federa&ccedil;&atilde;o j&aacute; se mostram grandes, mas tudo isso, claro, s&oacute; foi poss&iacute;vel com a confian&ccedil;a e participa&ccedil;&atilde;o das cooperativas associadas, com o engajamento dos diretores e conselheiros fiscais que passaram e continuam atuando na Federa&ccedil;&atilde;o, com trabalho dedicado dos colaboradores e o empenho de todas as pessoas que visam promover o cooperativismo de cr&eacute;dito no Brasil.</p>\r\n<p>Hoje temos 53 cooperativas associadas, que somam ao todo 154.732 cooperados. Ou seja, mais de 154 mil fam&iacute;lias que, direta ou indiretamente, s&atilde;o impactadas pelos servi&ccedil;os prestados pela FNCC.</p>\r\n<p>Nesses 9 anos, a Federa&ccedil;&atilde;o somou de patrim&ocirc;nio l&iacute;quido R$ 2,8 milh&otilde;es, e representamos 24% das cooperativas independentes do Brasil.</p>\r\n<p>E esses s&atilde;o apenas alguns n&uacute;meros!</p>\r\n<p>Ao longo desses anos, a FNCC, al&eacute;m de representar os interessas das associadas e obter conquistas importantes, ocupando cada vez mais destaque nos principais eventos sobre o cooperativismo, segue oferecendo suporte t&eacute;cnico e jur&iacute;dico para que as cooperativas independentes possam continuar com seu trabalho, que &eacute; extremamente importante na vida dos seus cooperados.</p>\r\n<p>Afinal de contas, a Federa&ccedil;&atilde;o tem como miss&atilde;o representar e prestar servi&ccedil;os de excel&ecirc;ncia, adequados aos interesses e necessidades das nossas federadas.</p>\r\n<p>Como dissemos, esses 9 anos s&atilde;o apenas o come&ccedil;o! E para comemorar, dia 13/03 lan&ccedil;aremos uma campanha que ir&aacute; sortear pr&ecirc;mios para nossas associadas.</p>\r\n<p>Nossos pr&oacute;ximos passos incluem: intensificar a promo&ccedil;&atilde;o e defesa dos interesses das nossas associadas, aprimoramento do portf&oacute;lio de produtos e servi&ccedil;os, aumento da base de federadas e capacitar cada vez mais nossos dirigentes e colaboradores.</p>\r\n<p>Com tudo isso em vista, temos apenas a agradecer a confian&ccedil;a de todos. Juntos somos mais capazes! Juntos, transformamos pessoas por meio do cooperativismo!</p>', 'Express', 'chegamos-aos-9-anos-de-existencia-e-e-so-o-comeco', '2023-04-08_CHEGAMOS_AOS_9_ANOS_DE_EXISTÊNCIA!_E_É_SÓ_O_COMEÇO!_144621.jpg', 1, '2023-04-08', '2023-03-10'),
(13, 'FNCC OFERECE SERVIÇO DE PROCESSOS ASSEMBLEARES', 'Portfólio de produtos e serviços da Federação segue se aprimorando', '<p>A FNCC &ndash; Federa&ccedil;&atilde;o Nacional das Cooperativas de Cr&eacute;dito, oferece para as suas cooperativas associadas a consultoria em Processos Assembleares. Mais um servi&ccedil;o que vem para enriquecer o portf&oacute;lio da Federa&ccedil;&atilde;o e, claro, auxiliar ainda mais as cooperativas singulares.</p>\r\n<p>O novo servi&ccedil;o contempla os seguintes t&oacute;picos:</p>\r\n<ul>\r\n<li>An&aacute;lise de Edital de Convoca&ccedil;&atilde;o</li>\r\n<li>An&aacute;lise de Ata da Assembleia</li>\r\n<li>Confer&ecirc;ncia dos documentos para envio do Banco Central do Brasil (BCB)</li>\r\n<li>Orienta&ccedil;&atilde;o no processo do protocolo de documentos no BCB</li>\r\n<li>Emiss&atilde;o de formul&aacute;rio (GARE/Capa do requerimento etc) no sistema da Jucesp</li>\r\n<li>Orienta&ccedil;&atilde;o no processo do protocolo de documentos na Jucesp</li>\r\n</ul>\r\n<p><em>&ldquo;A Diretoria da FNCC, preocupada com per&iacute;odo das assembleias, que ocorrem nos primeiros quatro meses do exerc&iacute;cio social, saiu na busca de solu&ccedil;&otilde;es para dar atendimento as demandas das associadas, uma vez que o Banco Central do Brasil fez v&aacute;rias mudan&ccedil;as nos normativos, em aten&ccedil;&atilde;o a Lei Complementar 130/09 e 196/22.<br>Para tanto no dia 08 de fevereiro, realizou reuni&atilde;o de alinhamento com o Bacen, onde participaram os representantes da Ger&ecirc;ncia T&eacute;cnica do Deorf de Belo Horizonte, &oacute;rg&atilde;o respons&aacute;vel pela an&aacute;lise e homologa&ccedil;&atilde;o dos processos assembleares, e na sequ&ecirc;ncia, nos dias 13 e 14, o Treinamento de Processos Assembleares &ndash; Aspectos Pr&aacute;ticos, onde 38 associadas receberam os esclarecimentos sobre o assunto e tiveram a oportunidade para tirar suas d&uacute;vidas.<br>Em complemento das informa&ccedil;&otilde;es sobre os processos assembleares, foi realizado no dia 07 de mar&ccedil;o pela FNCC, o Treinamento de Adequa&ccedil;&otilde;es nos Estatutos Sociais frente as Normas Vigentes.<br>Com a finalidade de melhorias na presta&ccedil;&atilde;o dos servi&ccedil;os e principalmente de dar maior apoio &agrave;s Cooperativas nos processos assembleares, a FNCC instituiu o novo servi&ccedil;o de &ldquo;Consultoria de Processos Assembleares&rdquo;, firmando parceria com a Bruske &amp; Verdan Contabilidade Ltda &ndash; EPP, que ser&aacute; a empresa respons&aacute;vel pela realiza&ccedil;&atilde;o dos servi&ccedil;os.<br>Estamos atentos as necessidades das nossas associadas, que s&atilde;o a raz&atilde;o de ser da FNCC.&rdquo;<br></em>Complementa Clodoaldo Pal&uacute;, Diretor Administrativo da FNCC.</p>\r\n<p>Vale destacar que esse novo servi&ccedil;o n&atilde;o tem custo adicional para as cooperativas associadas.</p>\r\n<p>Importante lembrar que em fevereiro a FNCC ofereceu um Treinamento de Processos Assembleares &ndash; Aspectos Pr&aacute;ticos. Treinamento que veio em momento oportuno, uma vez que as cooperativas est&atilde;o ingressando em &eacute;poca de Assembleia Geral.</p>', 'News', 'fncc-oferece-servico-de-processos-assembleares', '2023-04-08_FNCC_OFERECE_SERVIÇO_DE_PROCESSOS_ASSEMBLEARES_144744.jpg', 1, '2023-04-08', '2023-03-15'),
(14, 'TREINAMENTO DE ADEQUAÇÕES NOS ESTATUTOS SOCIAIS FOI REALIZADO PELA FNCC', 'Curso aconteceu no início de março, em formato online', '<p>No dia 6 de mar&ccedil;o, a FNCC ofereceu o Treinamento de Adequa&ccedil;&otilde;es nos Estatutos Sociais frente &agrave;s Normas Vigentes. O encontro foi online e contou com a participa&ccedil;&atilde;o de 66 representantes das cooperativas associadas.</p>\r\n<p>Esse curso foi ministrado por Dr. Reginaldo Ferreira Lima Filho, consultor jur&iacute;dico da FNCC. O objetivo do encontro foi proporcionar aos participantes conhecimentos e esclarecimentos sobre os principais pontos nas adequa&ccedil;&otilde;es de Estatutos Sociais.</p>\r\n<p><em>&ldquo;A necessidade desse treinamento surgiu por conta das novidades do sistema jur&iacute;dico das cooperativas sobre as mudan&ccedil;as na Lei Complementar 130. Isso refletiu na nossa regulamenta&ccedil;&atilde;o, o que consequentemente trouxe altera&ccedil;&otilde;es para o estatuto das cooperativas&rdquo;</em>, explicou Dr. Reginaldo, sobre a import&acirc;ncia dessa a&ccedil;&atilde;o.</p>\r\n<p>Vale destacar que, al&eacute;m da forma&ccedil;&atilde;o e capacita&ccedil;&atilde;o, o treinamento ocorreu num momento oportuno, j&aacute; que nos pr&oacute;ximos meses as cooperativas ter&atilde;o suas Assembleias.</p>\r\n<p>O treinamento foi pautado nos seguintes t&oacute;picos: as altera&ccedil;&otilde;es facultativas dos estatutos, as altera&ccedil;&otilde;es obrigat&oacute;rias e os prazos para as altera&ccedil;&otilde;es serem realizadas nos estatutos sociais das cooperativas.</p>\r\n<p>Durante o evento, os participantes puderam participar da conversa expondo suas d&uacute;vidas e alguns questionamentos.</p>\r\n<p>Esse &eacute; sempre um momento muito importante e rico dos treinamentos, principalmente os mais t&eacute;cnicos, pois as cooperativas de diferentes realidades podem ter contato entre si, solucionar problemas semelhantes e entender mais sobre o trabalho desempenhado por outras cooperativas de cr&eacute;dito.</p>\r\n<p><em>&ldquo;Excelente treinamento, muito esclarecedor. O Dr Reginaldo &eacute; muito claro nas explica&ccedil;&otilde;es e sol&iacute;cito na sana&ccedil;&atilde;o de d&uacute;vidas, visto que houve diversas mudan&ccedil;as. Est&atilde;o sendo extremamente excelentes esses treinamentos antes da realiza&ccedil;&atilde;o das assembleias. A troca com outras cooperativas &eacute; muito engrandecedora&rdquo;</em>, destaca Jackeline Santos, da Crediunifi.</p>\r\n<p>Denise Rocha, da CrediBasf, tamb&eacute;m elogiou o treinamento. Segunda ela, &ldquo;o tema est&aacute; sendo muito bem conduzido, dando total suporte para as cooperativas nesse cen&aacute;rio de mudan&ccedil;as na legisla&ccedil;&atilde;o&rdquo;.</p>\r\n<p>O superintendente da FNCC, Marcelo C&aacute;rfora, refor&ccedil;ou que a FNCC colocou &agrave; disposi&ccedil;&atilde;o das associadas, a partir de mar&ccedil;o, a consultoria nos processos assembleares, sem custo adicional para as cooperativas, via Sistema de Atendimento, aprimorando assim o portf&oacute;lio de produtos e servi&ccedil;os da Federa&ccedil;&atilde;o.</p>\r\n<p>Fique atento na nossa comunica&ccedil;&atilde;o e participe dos pr&oacute;ximos treinamentos do programa de forma&ccedil;&atilde;o e capacita&ccedil;&atilde;o oferecidos pela FNCC.</p>', 'News', 'treinamento-de-adequacoes-nos-estatutos-sociais-foi-realizado-pela-fncc', '2023-04-08_TREINAMENTO_DE_ADEQUAÇÕES_NOS_ESTATUTOS_SOCIAIS_FOI_REALIZADO_PELA_FNCC_144948.jpeg', 1, '2023-04-08', '2023-03-17'),
(15, '30 ANOS DA COOPERCREDI GRUPO FLEURY', 'Confiança dos associados na cooperativa marcam essas três décadas de existência.', '<p>No dia 19 de mar&ccedil;o de 2023 a CooperCredi Grupo Fleury comemora 30 anos de hist&oacute;ria. A cooperativa, que hoje tem 2.263 associados, celebra e valoriza essa data junto aos seus associados.</p>\r\n<p>Assim como muitas cooperativas, nos &uacute;ltimos anos os desafios superados foram muitos, como: manter a estabilidade econ&ocirc;mica e operacional da cooperativa, a qualidade no atendimento durante e ap&oacute;s o per&iacute;odo de pandemia.<br>Com a nova realidade, tivemos que nos reinventar, e as adapta&ccedil;&otilde;es e implementa&ccedil;&otilde;es de tecnologias foram acontecendo, para atendimento remoto aos nossos associados.</p>\r\n<p>A CooperCredi Grupo Fleury prioriza a qualidade no atendimento e a satisfa&ccedil;&atilde;o de seus associados, promovendo inova&ccedil;&otilde;es, e n&atilde;o menos importante, a divulga&ccedil;&atilde;o da cooperativa junto ao grande n&uacute;mero de potencial da empresa mantenedora Fleury, com objetivo de conquistar o maior n&uacute;mero de novos associados.</p>\r\n<p>Somado a tudo isso, para um futuro pr&oacute;ximo, a Diretoria da Coopercredi Fleury tem muitos desafios pela frente: ainda com o foco no crescimento do Quadro Social da Cooperativa, promover produtos, al&eacute;m do financeiro (empr&eacute;stimos), o lazer entre outros.</p>\r\n<p>Para a CooperCredi Grupo Fleury, a parceria junto &agrave; FNCC &eacute; de grande relev&acirc;ncia, segundo Ana Maria G. Allegretto. A&nbsp;<em>&ldquo;Federa&ccedil;&atilde;o&rdquo;</em>&nbsp;nos assessora com direcionamento de normas, orienta&ccedil;&otilde;es jur&iacute;dicas, atendimentos de exig&ecirc;ncias junto ao Banco Central, a Jucesp e demais &oacute;rg&atilde;os, reuni&otilde;es e treinamentos, sempre com zelo e presteza.</p>\r\n<p>A FNCC parabeniza a cooperativa pelos 30 anos e deseja que os pr&oacute;ximos venham com muitos desafios superados, intercoopera&ccedil;&atilde;o e metas alcan&ccedil;adas.</p>', 'Express', '30-anos-da-coopercredi-grupo-fleury', '2023-04-08_30_ANOS_DA_COOPERCREDI_GRUPO_FLEURY_145142.jpeg', 1, '2023-04-08', '2023-03-17'),
(16, 'CONFIRA OS VENCEDORES DO SORTEIO DE ANIVERSÁRIO DA FNCC', 'Contemplados ganharam ingressos para o CoopTech Crédito', '<p>Em 2023 a FNCC completou 9 anos de exist&ecirc;ncia, e para comemorar a Federa&ccedil;&atilde;o<br>promoveu um sorteio de anivers&aacute;rio.</p>\r\n<p>Para participar era preciso responder a um quiz at&eacute; o dia 24/03. Os participantes<br>concorreram a ingressos para o evento CoopTech Cr&eacute;dito, que vai acontecer na<br>cidade de S&atilde;o Paulo nos dias 24 e 25 de maio.</p>\r\n<p>A FNCC ser&aacute; apoiadora do evento, que abordar&aacute; 16 diferentes temas, com a<br>participa&ccedil;&atilde;o de 21 palestrantes e mediadores, entre eles os Diretores da FNCC, Ivo<br>Lara, Superintendente na CooperJohnson, Andr&eacute; Brone, Gerente Administrativo na<br>CoopEricsson, e Clodoaldo Pal&uacute;, Gerente Administrativo na Coopertel.</p>\r\n<p>Vale destacar que os representantes da FNCC no CoopTech Cr&eacute;dito v&atilde;o participar do<br>Painel das Cooperativas Independentes: Peculiaridades, necessidades e<br>oportunidades de intercoopera&ccedil;&atilde;o.</p>\r\n<p><strong>Vencedores do sorteio</strong></p>\r\n<ul>\r\n<li>Priscila Hernandez &ndash; COGEM</li>\r\n<li>Let&iacute;cia Brito &ndash; COOPERMC</li>\r\n<li>T&uacute;lio Correa &ndash; COOPERJOHNSON</li>\r\n<li>Jos&eacute; Paterra &ndash; CREDCOL</li>\r\n<li>Daiana Rocha &ndash; COOPERJOHNSON</li>\r\n</ul>\r\n<p><em>&ldquo;Fiquei muito feliz em participar deste momento especial da FNCC, e a minha</em><br><em>felicidade dobrou quando recebi a not&iacute;cia que fui presenteada com um ingresso para o</em><br><em>Cooptech Cr&eacute;dito &ndash; importante congresso que agregar&aacute; relevante conhecimento para</em><br><em>o nosso segmento&rdquo;</em>, afirma Let&iacute;cia Brito da Coopermc.</p>\r\n<p><em>&ldquo;Parab&eacute;ns FNCC pela sua trajet&oacute;ria de sucesso. S&atilde;o 9 anos cooperando e crescendo</em><br><em>junto com as Cooperativas filiadas. Amei o presente de anivers&aacute;rio! Fiquei muito feliz</em><br><em>em ser uma das contempladas&rdquo;</em>, parabenizou Priscila Hernandez, da Cogem.</p>\r\n<p><em>&ldquo;Estou muito feliz em ter sido uma das ganhadoras do sorteio de anivers&aacute;rio e ansiosa</em><br><em>para participar deste grande evento que trar&aacute; novos conhecimentos, maravilhosas</em><br><em>intera&ccedil;&otilde;es e uma importante vis&atilde;o sobre o que j&aacute; est&aacute; sendo constru&iacute;do para o</em><br><em>cooperativismo financeiro do futuro&rdquo;</em>, declarou Daiana Rocha da CooperJonhson.</p>\r\n<p>A FNCC se orgulha em completar mais um ano de trabalho firme e comprometido<br>junto &agrave;s cooperativas, buscando sempre dar e ser voz daquelas que buscam um<br>crescimento saud&aacute;vel e sustent&aacute;vel.</p>\r\n<p>Link para inscri&ccedil;&atilde;o no evento:<br><a href=\"https://conteudo.coonecta.me/cooptech-credito\">https://conteudo.coonecta.me/cooptech-credito</a></p>', 'News', 'confira-os-vencedores-do-sorteio-de-aniversario-da-fncc', '2023-04-08_CONFIRA_OS_VENCEDORES_DO_SORTEIO_DE_ANIVERSÁRIO_DA_FNCC_145330.jpg', 1, '2023-04-08', '2023-04-03'),
(17, 'FNCC APOIA E PARTICIPA DE EVENTO INÉDITO NO MÊS DE MAIO EM SÃO PAULO', '', '<p>Com apoio da FNCC (Federa&ccedil;&atilde;o Nacional das Cooperativas de Cr&eacute;dito) e<br>participa&ccedil;&atilde;o direta de tr&ecirc;s dos seus diretores, acontece nos dias 24 e 25 de maio<br>(quarta e quinta), em S&atilde;o Paulo, a Coopeth Cr&eacute;dito &ndash; Como construir, hoje, o<br>cooperativismo do futuro. A realiza&ccedil;&atilde;o &eacute; da Coonecta.</p>\r\n<p>O evento abordar&aacute; 16 diferentes temas, com a participa&ccedil;&atilde;o de 21 palestrantes e<br>mediadores, entre eles o Diretor Presidente da FNCC e Superintendente na<br>CooperJohnson, Ivo Lara Rodrigues; o Diretor Financeiro da FNCC e Gerente<br>Administrativo na CoopEricsson, Andr&eacute; Luiz Brone, e o Diretor Administrativo da<br>FNCC e Gerente Administrativo na Coopertel, Clodoaldo Pal&uacute;.</p>\r\n<p>&lsquo;Cooperativas Independentes: como crescer juntos? Peculiaridades, necessidades e<br>oportunidades de intercoopera&ccedil;&atilde;o&rsquo;, este &eacute; o tema que ser&aacute; apresentado pelos<br>diretores da FNCC&rsquo; no eixo Intercooperar, as 9h30, no segundo dia do evento.</p>\r\n<p>A inten&ccedil;&atilde;o &eacute; discutir como promover o crescimento do grupo de cooperativas<br>independentes (n&atilde;o filiadas a centrais ou federa&ccedil;&otilde;es) frente ao mercado financeiro;<br>al&eacute;m de debater suas dificuldades e particularidades, apresentando oportunidades<br>de intercoopera&ccedil;&atilde;o com outras cooperativas.<br>Encontro necess&aacute;rio</p>\r\n<p>O Coopeth Cr&eacute;dito tem o foco em pr&aacute;ticas e a&ccedil;&otilde;es concretas para construir o<br>cooperativismo de cr&eacute;dito do futuro, pois o cen&aacute;rio atual pede agilidade nas a&ccedil;&otilde;es,<br>diante dos desafios e oportunidades. Profissionais de diferentes &aacute;reas<br>compartilhar&atilde;o a&ccedil;&otilde;es concretas e casos pr&aacute;ticos.</p>\r\n<p>A programa&ccedil;&atilde;o est&aacute; dividida em cinco eixos tem&aacute;ticos: Atualizar, Crescer, Cuidar,<br>Inovar e Intercooperar, com os seguintes temas espec&iacute;ficos em destaque (Open<br>Finance, Tecnologia, Gest&atilde;o de Pessoas, Intercoopera&ccedil;&atilde;o, Seguran&ccedil;a da<br>informa&ccedil;&atilde;o e ESG).</p>\r\n<p>A abertura do evento ocorre as 9h do dia 24 (quarta-feira), com uma apresenta&ccedil;&atilde;o<br>da Coonecta, sobre &lsquo;Transforma&ccedil;&atilde;o nos servi&ccedil;os financeiros: o futuro do<br>cooperativismo de cr&eacute;dito no Brasil&rsquo;. Confira aqui a programa&ccedil;&atilde;o completa.</p>\r\n<p><strong>Mais informa&ccedil;&otilde;es:&nbsp;</strong><br>&nbsp;<br><strong>Telefone:</strong>&nbsp;(11) 2089-9490&nbsp;<br><strong>WhatsApp:</strong>&nbsp;(11) 95782-1957 e (11) 93730-7909&nbsp;<br><strong>E-mail:</strong>&nbsp;<a href=\"https://fncc.com.br/\" target=\"_blank\" rel=\"noopener\">fncc@fncc.com.br&nbsp;</a><br> &nbsp;<br><strong>Assessoria de Imprensa&nbsp;</strong><br>(12) 99680 0870&nbsp;<br>atendimento@dbgm.com.br</p>', 'News', 'fncc-apoia-e-participa-de-evento-inedito-no-mes-de-maio-em-sao-paulo', '2023-04-08_FNCC_APOIA_E_PARTICIPA_DE_EVENTO_INÉDITO_NO_MÊS_DE_MAIO_EM_SÃO_PAULO_145533.jpg', 1, '2023-04-08', '2023-04-03');
INSERT INTO `site_noticias` (`cod_noticia`, `titulo_noticia`, `subtitulo_noticia`, `texto_noticia`, `categoria_noticia`, `slug_noticia`, `img_noticia`, `publicado`, `data_noticia`, `data_publicacao`) VALUES
(18, 'COOPERATIVAS ASSOCIADAS APROVAM NOVO SERVIÇO DA FNCC', 'Associadas relatam sua experiência com a consultoria de Processos Assembleares', '<p>Recentemente a FNCC incluiu no seu portf&oacute;lio de servi&ccedil;os a consultoria em Processos<br>Assembleares. Servi&ccedil;o esse que veio em boa hora, uma vez que as cooperativas de<br>cr&eacute;dito est&atilde;o em &eacute;poca de Assembleia Geral Ordin&aacute;ria.</p>\r\n<p>As cooperativas associadas receberam bem o novo servi&ccedil;o e se mostraram satisfeitas<br>com a consultoria.</p>\r\n<p><em>&ldquo;Pedi aux&iacute;lio na an&aacute;lise do nosso edital de assembleia deste ano e fui muito bem<br>orientada. Recomendo a utiliza&ccedil;&atilde;o dos servi&ccedil;os de Consultoria de Processos<br>Assembleares&rdquo;</em>, elogia a Tamara Gianfrancisco da CooperPPG.</p>\r\n<p><em>&ldquo;Essa consultoria &eacute; uma ajuda muito boa, pois direciona o processo para evitar<br>poss&iacute;veis falhas&rdquo;</em>, destaca Valdemir Ferreira da Silva, da Coopermel.</p>\r\n<p>Vale destacar que em fevereiro a FNCC ofereceu um Treinamento de Processos<br>Assembleares &ndash; Aspectos Pr&aacute;ticos, e em mar&ccedil;o ofereceu Treinamento de Adequa&ccedil;&otilde;es<br>nos Estatutos Sociais. Esses cursos tiveram um feedback extremamente positivo e a<br>partir disso, essa consultoria foi aprimorada para ent&atilde;o ser um servi&ccedil;o oferecido para<br>as cooperativas associadas sem custo adicional.</p>\r\n<p><em>&ldquo;Esse ano &eacute; meu segundo ano participando dos processos Assembleares do ramo<br>cooperativista. No ano anterior, tive muito suporte com o atendimento da FNCC para a<br>realiza&ccedil;&atilde;o da AGOE. Esse ano n&atilde;o foi diferente, al&eacute;m de ter um suporte excelente e<br>atencioso, o treinamento realizado no dia 07/03/2023, ministrado pelo Dr. Reginaldo,<br>foi de extrema contribui&ccedil;&atilde;o para n&oacute;s. &Eacute; muito confortante se encontrar com outras<br>cooperativas com as mesmas d&uacute;vidas. Muitas das vezes nos sentimos sozinhos<br>nesses processos, ainda mais que esse ano veio algumas mudan&ccedil;as significativas,<br>mas a Federa&ccedil;&atilde;o oferece as consultorias, atendimentos e treinamentos que s&atilde;o muito<br>eficazes para o planejamento e preparo da Cooperativa, al&eacute;m da troca com as outras<br>cooperativas, que ajuda muito tamb&eacute;m!&rdquo;</em>, declara Jackeline Silva da Crediunifi.</p>\r\n<p>Fique conectado com a FNCC e acompanhe as novidades em produtos e servi&ccedil;os<br>para que sua cooperativa esteja em dia com processos t&eacute;cnicos, jur&iacute;dicos e com o<br>segmento cooperativista.</p>', 'News', 'cooperativas-associadas-aprovam-novo-servico-da-fncc', '2023-04-08_COOPERATIVAS_ASSOCIADAS_APROVAM_NOVO_SERVIÇO_DA_FNCC_145909.jpg', 1, '2023-04-08', '2023-04-03'),
(19, 'CONHEÇA O SERVIÇO DE PUBLICAÇÃO DOS EDITAIS DE CONVOCAÇÃO PARA ASSEMBLEIAS DAS ASSOCIADAS', 'Cooperativas associadas podem contar com o site da FNCC para publicação  de editais de convocação de assembleias gerais', '<p>Agora as cooperativas associadas t&ecirc;m mais um servi&ccedil;o dispon&iacute;vel oferecido pela<br>FNCC sem custo adicional: &eacute; a Publica&ccedil;&atilde;o dos Editais de Convoca&ccedil;&atilde;o das<br>Associadas.</p>\r\n<p>As cooperativas que n&atilde;o possuem site institucional ou reposit&oacute;rio de acesso p&uacute;blico,<br>poder&atilde;o publicar seus editais de convoca&ccedil;&atilde;o de assembleia geral no site da<br>Federa&ccedil;&atilde;o, em &aacute;rea p&uacute;blica e irrestrita, para que dessa forma possam atender a Lei<br>Complementar 196/2022.</p>\r\n<p>Se sua cooperativa se interessa em utilizar este servi&ccedil;o, n&atilde;o perca tempo, associe-se!<br>Marque uma reuni&atilde;o e venha conhecer todos os servi&ccedil;os e parcerias oferecidos pela<br>Federa&ccedil;&atilde;o!</p>\r\n<p>Fique conectado com a FNCC e acompanhe os novos servi&ccedil;os que chegam para<br>aprimorar e aumentar o portf&oacute;lio da Federa&ccedil;&atilde;o, sempre na busca em oferecer o<br>melhor suporte t&eacute;cnico e jur&iacute;dico para suas cooperativas associadas.</p>', 'News', 'conheca-o-servico-de-publicacao-dos-editais-de-convocacao-para-assembleias-das-associadas', '2023-04-08_CONHEÇA_O_SERVIÇO_DE_PUBLICAÇÃO_DOS_EDITAIS_DE_CONVOCAÇÃO_PARA_ASSEMBLEIAS_DAS_ASSOCIADAS_150049.jpg', 1, '2023-04-08', '2023-04-03'),
(20, 'FNCC MOSTRA SUA FORÇA E ELEGE DOIS REPRESENTANTES DE COOPERATIVAS INDEPENDENTES NO CECO', 'Jackson Matos e Claudio Nolasco são os nomes que representam as singulares no Grupo Técnico', '<p>No dia 30 de mar&ccedil;o, a OCB realizou uma elei&ccedil;&atilde;o para escolher representantes de cooperativas independentes para compor o Grupo T&eacute;cnico Executivo do CECO &ndash; Conselho Consultivo Nacional do Ramo Cr&eacute;dito.</p>\r\n<p>Para a elei&ccedil;&atilde;o, tr&ecirc;s grupos foram separados (de acordo com os tamanhos de cooperativas) e tr&ecirc;s representantes foram escolhidos. Sendo eles:</p>\r\n<ul>\r\n<li>Cl&aacute;udio Nolasco (Coopernitro), eleito do grupo com cooperativas com menos de 5 mil associados;</li>\r\n<li>Jackson Andrade de Matos (Cooperativa Sesc Senac/SP), eleito do grupo com cooperativas entre 5 mil e 40 mil associados;</li>\r\n<li>Kedson Pereira Macedo (Cooperforte), eleito do grupo das cinco maiores cooperativas independentes.</li>\r\n</ul>\r\n<p>Nessa elei&ccedil;&atilde;o, 16 cooperativas associadas da FNCC se inscreveram para votar, um n&uacute;mero expressivo, que colaborou na escolha do Cl&aacute;udio e do Jackson.</p>\r\n<p><em>&ldquo;Por conta dessa uni&atilde;o das associadas da Federa&ccedil;&atilde;o, conseguimos eleger dois<br>representantes das cooperativas independentes, uma conquista importante para todas<br>as associadas da FNCC&rdquo;</em>, destacou Marcelo C&aacute;rfora, Superintendente da Federa&ccedil;&atilde;o.</p>\r\n<p><em>&ldquo;Demos mais um passo importante para aumentarmos a representatividade das cooperativas independentes. Estamos muito felizes pela solidifica&ccedil;&atilde;o e desenvolvimento das lideran&ccedil;as da FNCC, parab&eacute;ns Jackson Andrade de Matos e<br>Cl&aacute;udio Nolasco&nbsp;pela escolha entre tantos nomes competentes do nossocooperativismo. O trabalho est&aacute; s&oacute; come&ccedil;ando, contem sempre com apoio da Federa&ccedil;&atilde;o nessa jornada&rdquo;</em>, parabenizou Ivo Lara, Diretor Presidente da FNCC.</p>\r\n<p><em>&ldquo;Estamos em constante evolu&ccedil;&atilde;o para entregar o melhor para nossas cooperativas e, para isso, precisamos aprimorar nosso processo de escuta. Com a presen&ccedil;a de representantes das cooperativas independentes dentro do conselho, apresentando suas particularidades e anseios, certamente teremos uma atua&ccedil;&atilde;o cada vez mais din&acirc;mica e assertiva para promover verdadeira diferen&ccedil;a para todo o cooperativismo de cr&eacute;dito&rdquo;</em>, afirmou Tania Zanella, Superintendente do Sistema OCB.</p>\r\n<p>A FNCC est&aacute; satisfeita com essa elei&ccedil;&atilde;o, afinal, &eacute; mais um espa&ccedil;o no qual a representatividade ganha destaque e ser&aacute; de grande valia para as cooperativas associadas. O trabalho segue com seriedade e comprometimento, com o<br>cooperativismo como foco principal.</p>', 'News', 'fncc-mostra-sua-forca-e-elege-dois-representantes-de-cooperativas-independentes-no-ceco', '2023-04-08_FNCC_MOSTRA_SUA_FORÇA_E_ELEGE_DOIS_REPRESENTANTES_DE_COOPERATIVAS_INDEPENDENTES_NO_CECO_150253.jpg', 1, '2023-04-08', '2023-04-04'),
(21, 'EDITAIS DE CONVOCAÇÃO PARA ASSEMBLEIAS GERAIS', 'Editais de Convocação (AGO/AGE) conforme informação da Cooperativa', '<ul>\r\n<li><strong>Data de Publica&ccedil;&atilde;o: 07/04/2023</strong></li>\r\n</ul>\r\n<p>COOPERATIVA DE ECONOMIA E CR&Eacute;DITO M&Uacute;TUO DOS FUNCION&Aacute;RIOS DA SELENE<br><a href=\"https://fncc.com.br/wp-content/uploads/2050/12/Edital-C.E.C.M.F-da-Selene.pdf\" rel=\"\">Edital C.E.C.M.F da Selene</a></p>\r\n<p>&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</p>\r\n<ul>\r\n<li><strong>Data de Publica&ccedil;&atilde;o: 05/04/2023</strong></li>\r\n</ul>\r\n<p>COOPERATIVA DE ECONOMIA E CR&Eacute;DITO M&Uacute;TUO DOS TRABALHADORES DO GRUPO S&Atilde;O MARTINHO &ndash; USICRED<br><a href=\"https://fncc.com.br/wp-content/uploads/2050/12/Edital-Usicred.pdf\" rel=\"\">Edital Usicred</a></p>\r\n<p>&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</p>\r\n<ul>\r\n<li><strong>Data de Publica&ccedil;&atilde;o: 05/04/2023</strong></li>\r\n</ul>\r\n<p>COOPERATIVA DE ECONOMIA E CR&Eacute;DITO M&Uacute;TUO DOS EMPREGADOS DA UNIFI &ndash; CREDIUNIFI<br><a href=\"https://fncc.com.br/wp-content/uploads/2050/12/Edital-Crediunifi.pdf\" rel=\"\">Edital Crediunifi</a></p>\r\n<p>&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</p>\r\n<ul>\r\n<li><strong>Data de Publica&ccedil;&atilde;o: 03/04/2023</strong></li>\r\n</ul>\r\n<p>COOPERATIVA DE CR&Eacute;DITO DOS FUNCION&Aacute;RIOS DO GRUPO PPG<br><a href=\"https://fncc.com.br/wp-content/uploads/2050/12/Edital-Grupo-PPG.pdf\" rel=\"\">Edital Grupo PPG</a></p>\r\n<p>&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</p>\r\n<ul>\r\n<li><strong>Data de Publica&ccedil;&atilde;o: 03/04/2023</strong></li>\r\n</ul>\r\n<p>C.E.C.M. dos Servidores da Faculdade de Engenharia de Ilha Solteira &ndash; COOPERFEIS<br><a href=\"https://fncc.com.br/wp-content/uploads/2050/12/Edital-Cooperfeis.pdf\" rel=\"\">Edital Cooperfeis</a></p>\r\n<p>&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</p>\r\n<ul>\r\n<li><strong>Data de Publica&ccedil;&atilde;o: 28/03/2023</strong></li>\r\n</ul>\r\n<p>C.E.C.M Dos Funcion&aacute;rios da Usina Santa Maria &ndash; PILONCRED<br><a href=\"https://fncc.com.br/wp-content/uploads/2023/03/Edital-Piloncred.pdf\" rel=\"\">Edital Piloncred</a></p>', 'Express', 'editais-de-convocacao-para-assembleias-gerais', '2023-04-08_EDITAIS_DE_CONVOCAÇÃO_PARA_ASSEMBLEIAS_GERAIS_150407.jpg', 1, '2023-04-08', '2023-04-04');

-- --------------------------------------------------------

--
-- Estrutura para tabela `situacao_consultas`
--

DROP TABLE IF EXISTS `situacao_consultas`;
CREATE TABLE IF NOT EXISTS `situacao_consultas` (
  `cod_situacao` int(10) NOT NULL AUTO_INCREMENT,
  `situacao` char(30) NOT NULL,
  PRIMARY KEY (`cod_situacao`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `situacao_consultas`
--

INSERT INTO `situacao_consultas` (`cod_situacao`, `situacao`) VALUES
(1, 'Aberto'),
(2, 'Em Andamento'),
(3, 'Pendente'),
(4, 'Aguardando'),
(5, 'Fechado'),
(6, 'Concluído');

-- --------------------------------------------------------

--
-- Estrutura para tabela `subcategoria_circulares`
--

DROP TABLE IF EXISTS `subcategoria_circulares`;
CREATE TABLE IF NOT EXISTS `subcategoria_circulares` (
  `cod_subcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `subcategoria` varchar(100) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`cod_subcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `subcategoria_circulares`
--

INSERT INTO `subcategoria_circulares` (`cod_subcategoria`, `subcategoria`, `id_categoria`) VALUES
(1, 'Calendário de Obrigações', 2),
(2, 'Apesctos Trabalhistas', 2),
(3, 'Contábil', 2),
(4, 'Controles Gerais', 2),
(5, 'Obrigações Acessórias', 2),
(6, 'Aspectos Tributários', 2),
(7, 'Divulgações', 5),
(8, 'Políticas', 4),
(9, 'Institucional', 1),
(10, 'Regulamentar (CFN/BC)', 1),
(11, 'Societário', 1),
(12, 'Trabalhista', 1),
(13, 'Tributário', 1),
(14, 'Atas de Assembleia', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `submenu`
--

DROP TABLE IF EXISTS `submenu`;
CREATE TABLE IF NOT EXISTS `submenu` (
  `cod_submenu` int(10) NOT NULL AUTO_INCREMENT,
  `submenu` char(40) NOT NULL,
  `cod_menu` int(10) NOT NULL,
  `icone_sub` varchar(30) NOT NULL,
  `caminho` varchar(50) NOT NULL,
  PRIMARY KEY (`cod_submenu`),
  KEY `cod_menu` (`cod_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `submenu`
--

INSERT INTO `submenu` (`cod_submenu`, `submenu`, `cod_menu`, `icone_sub`, `caminho`) VALUES
(1, 'ABRIR CONSULTA', 1, 'bi bi-folder-plus', 'abrir-consulta.php'),
(2, 'LISTAR CONSULTAS', 1, 'bi bi-list-check', 'listar-consultas.php'),
(3, 'ATENDIMENTOS', 2, 'uil uil-file-landscape-alt', 'rel-atendimentos.php'),
(4, 'AVALIAÇÃO', 2, 'bi bi-bookmark-star', 'rel-avaliacao.php'),
(5, 'USUÁRIOS', 3, 'bi bi-people', 'cad-usuarios.php'),
(6, 'COOPERATIVAS', 3, 'bi bi-ubuntu', 'cad-cooperativas.php'),
(7, 'GERENCIAMENTO DE RISCOS', 2, 'bi bi-building-exclamation', 'rel-gerenciamento-de-riscos.php'),
(8, 'RELATÓRIO DE DENÚNCIAS', 9, 'bi bi-book', 'rel-canaldenuncias.php'),
(9, 'INCLUIR BOLETO', 4, 'bi bi-plus-square-dotted', 'incluir-boleto.php'),
(10, 'INCLUIR EXTRATO', 4, 'bi bi-journal-plus', 'incluir-extrato-capital.php'),
(11, 'BALANCETE', 4, 'bi bi-bank', 'balancete.php'),
(12, 'LISTAR DOCUMENTOS', 5, 'bi bi-file-text', 'visualizar_doc.php'),
(13, 'INCLUIR DOCUMENTOS', 5, 'bi bi-file-earmark-plus', 'incluir-doc.php'),
(18, 'PERFIS', 6, 'bi bi-person-vcard', 'perfis-usuarios.php'),
(19, 'AJUSTE DE PONTO', 8, 'bi bi-stopwatch', 'ajuste-de-ponto.php'),
(20, 'MEUS BOLETOS', 4, 'bi bi-upc-scan', 'meus-boletos.php'),
(21, 'EXTRATO DE CAPITAL', 4, 'bi bi-receipt-cutoff', 'extrato-capital.php'),
(22, 'LISTAR BALANCETE', 4, 'bi bi-list-nested', 'listar-balancete.php'),
(23, 'CIRCULARES E DOCUMENTOS', 7, 'bi bi-folder2-open', 'circulares-documentos.php'),
(24, 'INCLUIR CIRCULAR', 7, 'bi bi-folder-plus', 'incluir-circular-documento.php'),
(25, 'JORNADA', 8, 'bi bi-person-video3', 'jornada-de-trabalho.php'),
(26, 'DOWNLOADS DOCUMENTOS', 2, 'bi bi-cloud-download', 'rel-downloads-documentos.php'),
(27, 'MARCAR PONTO', 8, 'bi bi-check2-circle', 'controle-ponto.php'),
(28, 'BANCO DE HORAS', 8, 'bi bi-clock-history', 'banco-de-horas.php'),
(29, 'AGENDA', 8, 'bi bi-calendar2-week', 'agenda.php'),
(30, 'FERIADOS', 6, 'bi bi-emoji-sunglasses-fill', 'feriados.php'),
(31, 'JUSTIFICATIVA DE PONTO', 8, 'bi bi-newspaper', 'justificativa-de-ponto.php'),
(32, 'COMPENSAÇÃO', 8, 'bi bi-hourglass', 'compensacao.php'),
(33, 'INCLUIR REL DENÚNCIAS', 9, 'bi bi-shield-plus', 'incluir-rel-denuncias.php'),
(34, 'NOTÍCIAS', 10, 'bi bi-newspaper', 'noticias.php'),
(35, 'EDITAIS', 10, 'bi bi-journal-bookmark', 'editais.php');

-- --------------------------------------------------------

--
-- Estrutura para tabela `urgencia`
--

DROP TABLE IF EXISTS `urgencia`;
CREATE TABLE IF NOT EXISTS `urgencia` (
  `cod_urgencia` int(255) NOT NULL AUTO_INCREMENT,
  `urgencia` char(20) NOT NULL,
  PRIMARY KEY (`cod_urgencia`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `urgencia`
--

INSERT INTO `urgencia` (`cod_urgencia`, `urgencia`) VALUES
(1, 'alta'),
(2, 'media'),
(3, 'baixa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(30) NOT NULL AUTO_INCREMENT,
  `nome` char(20) NOT NULL,
  `sobrenome` char(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `senha` varchar(32) NOT NULL DEFAULT '90f80b22f53a5d4d72f7b126ef4b1f44',
  `user_coop` int(10) NOT NULL,
  `user_nivel` int(10) NOT NULL,
  `user_grupo` int(2) NOT NULL,
  `u_status` int(1) NOT NULL DEFAULT 1 COMMENT '1-ativo 0-inativo',
  `user_supervisor` int(1) NOT NULL DEFAULT 0,
  `user_controla_ponto` int(1) NOT NULL DEFAULT 0,
  `data_cadastro` date NOT NULL DEFAULT '2022-12-16',
  `lgpd` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `sobrenome`, `email`, `usuario`, `senha`, `user_coop`, `user_nivel`, `user_grupo`, `u_status`, `user_supervisor`, `user_controla_ponto`, `data_cadastro`, `lgpd`) VALUES
(1, 'Moises', 'Pequeno do Rosário', 'bemktech1217@gmail.com', 'moises', '5a07992136c4e91e5cc618f4020dfa90', 57, 1, 3, 1, 1, 0, '2023-02-01', 1),
(2, 'Karina', 'Rocha Pequeno', 'nina.rocha91@gmail.com', 'karina.pequeno', '5a07992136c4e91e5cc618f4020dfa90', 57, 2, 4, 1, 0, 1, '2023-02-01', 0),
(4, 'CONSULTORIA', 'TÉCNICA', 'nina.rocha91@gmail.com', 'consultoria.tecnica', 'cbbe2fabcd555312827334c4596ea951', 57, 3, 2, 1, 0, 0, '2023-02-06', 0),
(5, 'Bemk', 'Tech', 'bemktech1217@gmail.com', 'bemktech', '792dc8501fb966286e0c8794beae1677', 57, 4, 3, 1, 0, 0, '2023-04-28', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `visibilidade`
--

DROP TABLE IF EXISTS `visibilidade`;
CREATE TABLE IF NOT EXISTS `visibilidade` (
  `cod_visibilidade` int(255) NOT NULL AUTO_INCREMENT,
  `visibilidade` char(30) NOT NULL,
  `visibilidade_valor` varchar(30) NOT NULL,
  PRIMARY KEY (`cod_visibilidade`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `visibilidade`
--

INSERT INTO `visibilidade` (`cod_visibilidade`, `visibilidade`, `visibilidade_valor`) VALUES
(1, 'Só para mim', 'eu'),
(2, 'Minha Cooperativa', 'minha_coop'),
(3, 'Qualquer Um', 'qualquer_um');

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `modelos_de_documentos`
--
ALTER TABLE `modelos_de_documentos`
  ADD CONSTRAINT `modelos_de_documentos_ibfk_1` FOREIGN KEY (`categoria_documento`) REFERENCES `categoria_documentos` (`cod_categoria`);

--
-- Restrições para tabelas `nivel_acesso`
--
ALTER TABLE `nivel_acesso`
  ADD CONSTRAINT `nivel_acesso_ibfk_1` FOREIGN KEY (`cod_perfil`) REFERENCES `perfis_usuarios` (`p_cod`),
  ADD CONSTRAINT `nivel_acesso_ibfk_2` FOREIGN KEY (`codMenu`) REFERENCES `menu` (`id_menu`),
  ADD CONSTRAINT `nivel_acesso_ibfk_3` FOREIGN KEY (`codSubmenu`) REFERENCES `submenu` (`cod_submenu`);

--
-- Restrições para tabelas `submenu`
--
ALTER TABLE `submenu`
  ADD CONSTRAINT `submenu_ibfk_1` FOREIGN KEY (`cod_menu`) REFERENCES `menu` (`id_menu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
