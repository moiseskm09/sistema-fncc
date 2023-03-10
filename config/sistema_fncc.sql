-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13/02/2023 às 10:31
-- Versão do servidor: 10.4.22-MariaDB
-- Versão do PHP: 8.1.2

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
CREATE DATABASE IF NOT EXISTS `sistema_fncc` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `avisos`
--

INSERT INTO `avisos` (`cod_aviso`, `coop_aviso`, `aviso`, `data_aviso`, `link_aviso`) VALUES
(1, 0, 'Nova Circular', '2023-02-07', 'circulares-documentos.php'),
(2, 0, 'Nova Circular', '2023-02-07', 'circulares-documentos.php'),
(3, 57, 'Novo Ext. Capital', '2023-02-08', 'extrato-capital.php'),
(4, 57, 'Novo Ext. Capital', '2023-02-08', 'extrato-capital.php'),
(5, 57, 'Novo Balancete', '2023-02-08', 'listar-balancete.php'),
(6, 57, 'RELATÓRIO GRS', '2023-02-08', 'rel-gerenciamento-de-riscos.php');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `balancete`
--

INSERT INTO `balancete` (`cod_balancete`, `bal_ref_inicial`, `bal_ref_final`, `bal_arquivo`, `bal_coop`, `bal_situacao`) VALUES
(1, '2023-02-01', '2023-02-01', '2023-02-01_2023-02-01_57_154255.docx', 57, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `banco_de_horas`
--

DROP TABLE IF EXISTS `banco_de_horas`;
CREATE TABLE IF NOT EXISTS `banco_de_horas` (
  `cod_bh` bigint(255) NOT NULL AUTO_INCREMENT,
  `bh_dia` date NOT NULL,
  `bh_horas` time NOT NULL,
  `bh_user` bigint(255) NOT NULL,
  PRIMARY KEY (`cod_bh`),
  UNIQUE KEY `bh_dia` (`bh_dia`,`bh_horas`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `banco_de_horas`
--

INSERT INTO `banco_de_horas` (`cod_bh`, `bh_dia`, `bh_horas`, `bh_user`) VALUES
(1, '2023-02-09', '04:47:00', 1),
(3, '2023-02-09', '01:00:00', 2),
(4, '2023-02-11', '00:10:00', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `boleto_situacao`
--

DROP TABLE IF EXISTS `boleto_situacao`;
CREATE TABLE IF NOT EXISTS `boleto_situacao` (
  `cod_bol_s` int(255) NOT NULL AUTO_INCREMENT,
  `situacao` char(30) NOT NULL,
  PRIMARY KEY (`cod_bol_s`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
-- Estrutura para tabela `categoria_circulares`
--

DROP TABLE IF EXISTS `categoria_circulares`;
CREATE TABLE IF NOT EXISTS `categoria_circulares` (
  `cod_categoria` int(255) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `categoria_circulares`
--

INSERT INTO `categoria_circulares` (`cod_categoria`, `categoria`) VALUES
(1, 'CONSULTORIA JURÍDICA'),
(2, 'CONSULTORIA TÉCNICA'),
(3, 'DOCUMENTOS GOVERNAÇA'),
(4, 'NORMATIVOS INTERNOS'),
(5, 'PUBLICAÇÕES FNCC');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria_cooperativa`
--

DROP TABLE IF EXISTS `categoria_cooperativa`;
CREATE TABLE IF NOT EXISTS `categoria_cooperativa` (
  `cod_categoria_coop` int(4) NOT NULL AUTO_INCREMENT,
  `categoria_coop` char(30) NOT NULL,
  PRIMARY KEY (`cod_categoria_coop`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

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
  `col_nome` char(50) NOT NULL,
  `col_area` char(30) NOT NULL,
  `col_email` varchar(50) NOT NULL,
  `col_coop` int(10) NOT NULL,
  PRIMARY KEY (`cod_col`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `conselho_fiscal`
--

DROP TABLE IF EXISTS `conselho_fiscal`;
CREATE TABLE IF NOT EXISTS `conselho_fiscal` (
  `cf_id` int(10) NOT NULL AUTO_INCREMENT,
  `cf_nome` char(50) NOT NULL,
  `cf_cargo` char(30) NOT NULL,
  `cf_telefone` varchar(16) NOT NULL,
  `cf_email` varchar(50) NOT NULL,
  `cf_mandato` date NOT NULL,
  `cf_coop` int(10) NOT NULL,
  PRIMARY KEY (`cf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `controle_de_ponto`
--

DROP TABLE IF EXISTS `controle_de_ponto`;
CREATE TABLE IF NOT EXISTS `controle_de_ponto` (
  `cod_ponto` bigint(255) NOT NULL AUTO_INCREMENT,
  `ponto_user` bigint(255) NOT NULL,
  `ponto_dia` date NOT NULL,
  `ponto_entrada` time NOT NULL DEFAULT '00:00:00',
  `ponto_intervalo_um` time NOT NULL DEFAULT '00:00:00',
  `ponto_intervalo_dois` time NOT NULL DEFAULT '00:00:00',
  `ponto_saida` time NOT NULL DEFAULT '00:00:00',
  `ponto_hora_prevista` time NOT NULL DEFAULT '09:00:00',
  `ponto_hora_executada` time NOT NULL DEFAULT '00:00:00',
  `ponto_hora_atraso` time NOT NULL DEFAULT '00:00:00',
  `ponto_hora_extra` time NOT NULL DEFAULT '00:00:00',
  `ponto_situacao` int(2) NOT NULL DEFAULT 1,
  `ponto_justificado` int(1) NOT NULL DEFAULT 0,
  `ponto_justificativa_aprovada` int(11) NOT NULL,
  PRIMARY KEY (`cod_ponto`),
  UNIQUE KEY `ponto_user` (`ponto_user`,`ponto_dia`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `controle_de_ponto`
--

INSERT INTO `controle_de_ponto` (`cod_ponto`, `ponto_user`, `ponto_dia`, `ponto_entrada`, `ponto_intervalo_um`, `ponto_intervalo_dois`, `ponto_saida`, `ponto_hora_prevista`, `ponto_hora_executada`, `ponto_hora_atraso`, `ponto_hora_extra`, `ponto_situacao`, `ponto_justificado`, `ponto_justificativa_aprovada`) VALUES
(1, 1, '2023-02-09', '10:28:15', '12:10:56', '12:46:10', '21:47:29', '09:00:00', '11:19:00', '02:28:00', '04:47:00', 1, 1, 0),
(2, 1, '2023-02-08', '08:00:00', '12:10:56', '13:10:10', '17:00:00', '09:00:00', '09:00:00', '00:00:00', '00:00:00', 1, 0, 0),
(3, 1, '2023-02-07', '10:28:15', '12:10:56', '12:46:10', '17:00:00', '09:00:00', '07:12:00', '02:28:00', '00:00:00', 1, 1, 1),
(4, 1, '2023-02-10', '09:22:08', '12:51:52', '00:00:00', '00:00:00', '09:00:00', '00:00:00', '01:22:00', '00:00:00', 1, 1, 1),
(5, 2, '2023-02-10', '08:00:00', '14:34:20', '14:34:32', '00:00:00', '09:00:00', '00:00:00', '00:00:00', '00:00:00', 1, 0, 0),
(6, 2, '2023-02-09', '08:00:00', '12:00:00', '13:00:00', '18:00:00', '09:00:00', '10:00:00', '00:00:00', '01:00:00', 1, 1, 0),
(7, 1, '2023-02-11', '17:09:46', '00:00:00', '00:00:00', '17:10:44', '09:00:00', '00:00:00', '09:09:00', '00:10:00', 1, 0, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `cooperativas`
--

INSERT INTO `cooperativas` (`cod_coop`, `coop_matricula`, `coop_razao`, `cooperativa`, `coop_cnpj`, `coop_categoria`, `coop_nire`, `coop_im`, `coop_cep`, `coop_endereco`, `coop_numero_casa`, `coop_complemento`, `coop_bairro`, `coop_cidade`, `coop_estado`, `coop_telefone`, `coop_whatsapp`, `coop_email`, `coop_sistema`, `coop_data_abertura`, `logo_coop`, `coop_status`, `coop_data_cadastro`, `coop_dados_atualizados`) VALUES
(1, '1', 'Cooperativa De Crédito Cogem', 'COGEM', '44.401.800/0001-90', 'Capital e Empréstimo', '35400010711', '000.000.000.000', '09750-730', 'Rua José Versolato', 111, 'Torre B, salas 2607 / 2608', 'Centro', 'São Bernardo Do Campo', 'SP', '(11) 3080-3942', '(11) 9 3080-3942', 'wanderson.oliveira@cogem.com.br', 'Prodaf', '1974-09-16', 'logo_fncc.png', 1, '2022-12-22', 0),
(2, '6', 'Cooperativa De Economia E Credito Mutuo Dos Servidores Da Federacao Do Comercio, Sesc E Senac De Sao Paulo', 'COOP FECOM/ SESC/ SENAC', '62.928.320/0001-63', '3', '35400002115', '000.000.000.000', '01029-000', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 3311-8746', '(00) 0 0000-0000', 'juvenal.francisco@florenciodea', 'Prodaf', '1970-10-09', 'logo_fncc.png', 1, '2022-12-22', 0),
(3, '4', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS EMPREGADOS DO GRUPO FEMSA BRASIL', 'COOPERFEMSA', '43.488.782/0001-62', '3', '35400003987', '000.000.000.000', '04675-901', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 2102-5541', '(00) 0 0000-0000', 'silvana.breda@kof.com.mx', 'Prodaf', '1972-11-14', 'logo_fncc.png', 1, '2022-12-22', 0),
(4, '9', 'COOPERATIVA DE ECON E CREDITO MUTUO DOS COLAB DA SG INDÚSTRIA E COMERCIO DE MATERIAIS DE CONSTRUÇÃO, VIDROS E AFINS.', 'CREDI SG', '61.039.038/0001-62', '3', '35400021187', '000.000.000.000', '01139-000', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 3392-3499', '(00) 0 0000-0000', 'paulo.dias@credisg.com.br', 'Prodaf', '1967-04-24', 'logo_fncc.png', 0, '2022-12-22', 0),
(5, '12', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS FUNCIONARIOS DA ERICSSON', 'COOPERICSSON', '48.718.183/0001-01', '3', '35400001186', '000.000.000.000', '01140-060', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 2224-1312', '(00) 0 0000-0000', 'andre.brone@coopericsson.com.b', 'Prodaf', '1982-02-12', 'logo_fncc.png', 1, '2022-12-22', 0),
(6, '13', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS FUNCIONARIOS DA CARGILL', 'COOPCARGILL', '68.228.006/0001-54', '2', '000.000.000.000', '000.000.000.000', '04711-130', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 5099-2127', '(00) 0 0000-0000', 'Eliane_Molina@cargill.com', 'Prodaf', '1992-08-06', 'logo_fncc.png', 1, '2022-12-22', 0),
(7, '3', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS EMPREGADOS DA RECKITT BENCKISER', 'COOP RB', '44.223.196/0001-59', '3', '3540003863', '000.000.000.000', '05577-900', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 3783-7074', '(00) 0 0000-0000', 'rosa.storoli@reckittbenckiser.', 'Prodaf', '1974-01-17', 'logo_fncc.png', 1, '2022-12-22', 0),
(8, '8', 'COOPERATIVA DE ECON. E CREDITO MUTUO DO GRUPO BASF', 'CREDIBASF', '74.244.344/0001-82', '3', '35400024160', '000.000.000.000', '09844-900', '', 0, NULL, '', 'São Bernardo Do Campo', 'SP', '(11) 4347-1185', '(00) 0 0000-0000', 'priscila.tomaz@basf.com', 'SaveMais', '1994-01-10', 'logo_fncc.png', 1, '2022-12-22', 0),
(9, '5', 'COOPERATIVA DE CAPITAL E EMPRESTIMO COOPERMULTICRED - COOPERMC', 'COOPERMC', '51.010.858/0001-78', '3', '3500001356', '000.000.000.000', '07190-940', '', 0, NULL, '', 'Guarulhos', 'SP', '(11) 2464-8277', '(00) 0 0000-0000', 'marcos.silva@br.abb.com', 'Prodaf', '1982-08-25', 'logo_fncc.png', 1, '2022-12-22', 0),
(10, '11', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS EMPREGADOS DO GRUPO SCHAEFFLER', 'COOP SCHAEFFLER', '62.284.385/0001-13', '3', '35400003529', '000.000.000.000', '18087-101', '', 0, NULL, '', 'Sorocaba', 'SP', '(15) 3335-1979', '(00) 0 0000-0000', 'eliane@coopercreds.com.br', 'Prodaf', '1968-12-06', 'logo_fncc.png', 0, '2022-12-22', 0),
(11, '7', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS SERV. MUNICIP. DE SAO JOAO DA BOA VISTA', 'CREDIVISTA', '74.248.949/0001-41', '2', '35400024151', '000.000.000.000', '13870-020', '', 0, NULL, '', 'São João Da Boa Vista', 'SP', '(19) 3634-6262', '(00) 0 0000-0000', 'delvo@credivista.com.br', 'Próprio', '1994-01-05', 'logo_fncc.png', 1, '2022-12-22', 0),
(12, '10', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS EMPREGADOS DA JOHNSON & JOHNSON', 'COOPERJOHNSON', '45.691.128/0001-87', '3', '35400010371', '000.000.000.000', '12240-907', '', 0, NULL, '', 'São José Dos Campos', 'SP', '(12) 3932-3299', '(00) 0 0000-0000', 'ivo.lara@cooperjohnson.com.br', 'Fácil', '1973-07-30', 'logo_fncc.png', 1, '2022-12-22', 0),
(13, '16', 'CECM DOS FUNCIONÁRIOS DA ABRIL', 'COOPERABRIL', '43.438.662/0001-50', '3', '35400003588', '000.000.000.000', '02909-900', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 3990-1753', '(00) 0 0000-0000', 'TatiMaximo@hotmail.com', 'Prodaf', '1972-10-09', 'logo_fncc.png', 1, '2022-12-22', 0),
(14, '17', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS SERVIDORES DA UNESP', 'COOPUNESP', '69.136.075/0001-09', '2', '000.000.000.000', '000.000.000.000', '13506-900', '', 0, NULL, '', 'Rio Claro', 'SP', '(19) 3523-4962', '(00) 0 0000-0000', 'coopunesp.contabilidade@gmail.', 'Fácil', '1992-11-23', 'logo_fncc.png', 1, '2022-12-22', 0),
(15, '18', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS FUNCIONARIOS DA OWENS CORNING FIBERGLAS AMERICA DO SUL', 'COOPOWENS', '48.172.860/0001-39', '2', '000.000.000.000', '000.000.000.000', '13505-900', '', 0, NULL, '', 'Rio Claro', 'SP', '(19) 3535-9442', '(00) 0 0000-0000', 'cooperativa.owens@gmail.com', 'Fácil', '1976-08-25', 'logo_fncc.png', 1, '2022-12-22', 0),
(16, '19', 'COOPERATIVA DE CRÉDITO MÚTUO DOS FUNCIONÁRIOS DA RICLAN', 'COOPRICLAN', '06.077.760/0001-83', '3', '000.000.000.000', '000.000.000.000', '13501-900', '', 0, NULL, '', 'Rio Claro', 'SP', '(19) 3526-8212', '(00) 0 0000-0000', 'contabilidade@coopriclan.com.b', 'Fácil', '2003-12-22', 'logo_fncc.png', 1, '2022-12-22', 0),
(17, '20', 'CECM DOS SERVIDORES DA FACULDADE DE ENGENHARIA DE ILHA SOLTEIRA', 'COOPERFEIS', '96.409.263/0001-28', '3', '35400023201', '000.000.000.000', '15385-000', '', 0, NULL, '', 'Ilha Solteira', 'SP', '(18) 3742-3117', '(00) 0 0000-0000', 'cooper.feis@unesp.br', 'Fácil', '1995-10-31', 'logo_fncc.png', 1, '2022-12-22', 0),
(18, '21', 'COOPERATIVA ECMFG OWENS-ILLINOIS DO BRASIL', 'COOPOIB', '43.182.278/0001-30', '3', '35400010533', '000.000.000.000', '03822-900', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 2542-8137', '(00) 0 0000-0000', 'cooperativa.sp@o-i.com', 'Fácil', '1972-02-07', 'logo_fncc.png', 1, '2022-12-22', 0),
(19, '23', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DA BOMBRIL', 'COOPERBOMBRIL', '57.038.408/0001-70', '3', '3540001052-5', '000.000.000.000', '09696-000', '', 0, NULL, '', 'São Bernardo Do Campo', 'SP', '(11) 4366-1394', '(00) 0 0000-0000', 'arvelina.nicodemos@cooperbombr', 'Prodaf', '1967-03-15', 'logo_fncc.png', 1, '2022-12-22', 0),
(20, '24', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DA ASTRAZENECA DO BRASIL', 'COOPAZ', '01.288.797/0001-37', '3', '35400041072', '000.000.000.000', '06707-000', '', 0, NULL, '', 'Cotia', 'SP', '(11) 3737-4516', '(00) 0 0000-0000', 'marcia.araujofernandes@astraze', 'Prodaf', '1996-06-28', 'logo_fncc.png', 1, '2022-12-22', 0),
(21, '25', 'COOPERATIVA DE CRÉDITO DOS FUNCIONÁRIOS DO GRUPO PPG', 'COOPERPPG', '03.657.230/0001-16', '3', '35400061651', '000.000.000.000', '13180-480', '', 0, NULL, '', 'Sumaré', 'SP', '(19) 2103-6029', '(00) 0 0000-0000', 'cooperppg2018@gmail.com', 'Fácil', '2000-02-08', 'logo_fncc.png', 1, '2022-12-22', 0),
(22, '26', 'COOPERATIVA DE ECONOMIA E CRÉDITO MUTUO DOS EMPREGADOS DAS EMPRESAS PLASCAR', 'COOPERPLASCAR', '17.411.307/0001-88', '3', '35400075554', '000.000.000.000', '13213-000', '', 0, NULL, '', 'Jundiaí', 'SP', '(11) 2729-4219', '(00) 0 0000-0000', 'cooperplascar@gmail.com', 'Fácil', '1983-03-02', 'logo_fncc.png', 1, '2022-12-22', 0),
(23, '27', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS PÚBLICOS MUNICIPAIS DE ITAPIRA - CREDITA', 'CREDITA', '02.115.870/0001-31', '2', '35400045957', '000.000.000.000', '13970-005', '', 0, NULL, '', 'Itapira', 'SP', '(19) 3863-7594', '(00) 0 0000-0000', 'camila.silvestre@coopcredita.c', 'Prodaf', '1997-09-02', 'logo_fncc.png', 1, '2022-12-22', 0),
(24, '28', 'Cooperativa De Crédito Dos Empregados Do Grupo Akzo Nobel Brasil', 'COOP AKZONOBEL', '57.996.878/0001-46', '3', '35400017627', '000.000.000.000', '09370-901', 'Avenida Papa João XXIII', 0, NULL, 'Vila Carlina', 'Mauá', 'SP', '(11) 2148-2238', '(00) 0 0000-0000', 'ANGELA.FARIA@AKZONOBEL.COM', 'Fácil', '1987-09-15', 'logo_fncc.png', 1, '2022-12-22', 0),
(25, '29', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS EMPREGADOS DA JOYSON SAFETY SYSTEMS', 'COOPERJSS', '47.944.277/0001-36', '3', '35400010134', '000.000.000.000', '13212-240', '', 0, NULL, '', 'Jundiaí', 'SP', '(11) 4585-3710', '(00) 0 0000-0000', 'cooptakatapetri@uol.com.br', 'Fácil', '1976-07-21', 'logo_fncc.png', 1, '2022-12-22', 0),
(26, '30', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS EMPREGADOS DO GRUPO TELEFÔNICA', 'COOPERTEL', '57.598.120/0001-50', '3', '35400010592', '000.000.000.000', '01310-000', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 3016-9860', '(00) 0 0000-0000', 'clodoaldo@coopertel.org.br', 'Fácil', '1969-10-02', 'logo_fncc.png', 1, '2022-12-22', 0),
(27, '31', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO ALIANÇA', 'COOPERNITRO', '52.935.442/0001-23', '3', '35400001640', '000.000.000.000', '08090-000', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 2246-3357', '(00) 0 0000-0000', 'claudionolasco@coopernitro.com', 'Fácil', '1983-09-28', 'logo_fncc.png', 1, '2022-12-22', 0),
(28, '32', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DA FACULDADE DE CIÊNCIAS AGRÁRIAS E VETERINÁRIAS CAMPUS JABOTICABAL/SP', 'COOPERFAC', '57.259.525/0001-63', '2', '35400017473', '000.000.000.000', '14884-900', '', 0, NULL, '', 'Jaboticabal', 'SP', '(16) 3202-7672', '(00) 0 0000-0000', 'j.catelani@unesp.br', 'Fácil', '1987-04-01', 'logo_fncc.png', 1, '2022-12-22', 0),
(29, '33', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DA INTERNATIONAL INDÚSTRIA AUTOMOTIVA DA AMÉRICA DO SUL', 'COOP MWM', '59.620.708/0001-98', '3', '35400017899', '000.000.000.000', '04795-915', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 5687-1901', '(00) 0 0000-0000', 'geani.ramos@navistar.com.br', 'Fácil', '1988-10-20', 'logo_fncc.png', 1, '2022-12-22', 0),
(30, '34', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS COLABORADORES DA CEBRACE', 'CREDICEBRACE', '53.184.438/0001-33', '3', '000.000.000.000', '000.000.000.000', '12311-900', '', 0, NULL, '', 'Jacareí', 'SP', '(12) 2127-9066', '(00) 0 0000-0000', 'marcos.corra@ext.cebrace.com.b', 'Fácil', '1984-01-28', 'logo_fncc.png', 1, '2022-12-22', 0),
(31, '35', 'COOPERATIVA DE CRÉDITO MÚTUO DOS EMPREGADOS EM INSTITUIÇÕES FINANCEIRAS NAS REGIÕES DE SÃO PAULO E CAMPINAS', 'CREDISCOOP', '03.674.133/0001-31', '2', '35400061880', '000.000.000.000', '01010-010', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 3242-3341', '(00) 0 0000-0000', 'luizbernardo@crediscoop.com.br', 'Fácil', '2000-02-23', 'logo_fncc.png', 1, '2022-12-22', 0),
(32, '36', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS EMPREGADOS DA SAINT-GOBAIN DO BRASIL PRODUTOS INDUSTRIAIS E PARA CONSTRUÇÃO DIVISÃO VIDRO PLANO', 'COOPER-SEKURIT', '48.140.925/0001-64', '3', '35400002018', '000.000.000.000', '09390-000', '', 0, NULL, '', 'Mauá', 'SP', '(11) 4544-3161', '(00) 0 0000-0000', 'regina.martins@coopersekurit.c', 'Fácil', '1976-11-11', 'logo_fncc.png', 1, '2022-12-22', 0),
(33, '37', 'COOPERATIVA DE CRÉDITO MÚTUO DOS SERVIDORES DA SEGURANÇA PÚBLICA DE SÃO PAULO - CREDIAFAM', 'CREDIAFAM', '04.804.353/0001-03', '3', '35300022807', '000.000.000.000', '02036-011', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 3328-1505', '(00) 0 0000-0000', 'aburbano@afam.com.br', 'Fácil', '2001-11-22', 'logo_fncc.png', 1, '2022-12-22', 0),
(34, '38', 'COOPERATIVA DE CRÉDITO MÚTUO DOS SERVIDORES DA ASSEMBLEIA LEGISLATIVA DO ESTADO DE SÃO PAULO', 'COOPERALESP', '04.791.645/0001-40', '3', '35400068957', '000.000.000.000', '04097-900', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 3886-6212', '(00) 0 0000-0000', 'cooperalesp@al.sp.gov.br', 'Fácil', '2001-11-01', 'logo_fncc.png', 1, '2022-12-22', 0),
(35, '39', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS EMPREGADOS DA COMPANHIA BRASILEIRA DE ALUMÍNIO', 'COOPERCRED-CBA', '54.335.401/0001-21', '3', '35400031719', '000.000.000.000', '18125-000', '', 0, NULL, '', 'Alumínio', 'SP', '(11) 4715-4242', '(00) 0 0000-0000', 'contato@coopercredcba.com.br', 'Prodaf', '1986-09-16', 'logo_fncc.png', 1, '2022-12-22', 0),
(36, '40', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DO GRUPO AVIBRAS', 'COOPER AVIBRAS', '43.268.960/0001-40', '3', '35400000651', '000.000.000.000', '12315-020', '', 0, NULL, '', 'Jacareí', 'SP', '(12) 3955-5150', '(00) 0 0000-0000', 'cooperavibras@hotmail.com', 'Fácil', '1980-03-28', 'logo_fncc.png', 1, '2022-12-22', 0),
(37, '41', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DAS EMPRESAS DE CERÂMICA - COOPASPACER', 'COOPASPACER', '02.541.707/0001-30', '2', '35400047771', '000.000.000.000', '13510-000', '', 0, NULL, '', 'Santa Gertrudes', 'SP', '(19) 3545-9609', '(00) 0 0000-0000', 'cooperativa@aspacer.com.br', 'Fácil', '1998-01-12', 'logo_fncc.png', 1, '2022-12-22', 0),
(38, '42', 'COOPERATIVA DE CRÉDITO MÚTUO DOS EMPREGADOS DA FIAÇÃO ALPINA - COOPERALPINA', 'COOPERALPINA', '55.319.370/0001-88', '3', '35400017309', '000.000.000.000', '13260-000', '', 0, NULL, '', 'Morumgaba', 'SP', '(11) 4014-4114', '(00) 0 0000-0000', 'alpina.cooperativa@alpinatexti', 'Fácil', '1985-05-06', 'logo_fncc.png', 1, '2022-12-22', 0),
(39, '43', 'COOPERATIVA DE CRÉDITO MÚTUO DOS EMPREGADOS DA PILKINGTON BRASIL', 'COOPERPILKINGTON', '02.104.058/0001-00', '3', '35400045868', '000.000.000.000', '12286-160', '', 0, NULL, '', 'Caçapava', 'SP', '(12) 3221-2306', '(00) 0 0000-0000', 'Adriana.Santos@br.nsg.com', 'Fácil', '1997-08-25', 'logo_fncc.png', 1, '2022-12-22', 0),
(40, '44', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁROIS DAS EMPRESAS MELHORAMENTOS DE SÃO PAULO', 'COOPERMEL', '01.504.952/0001-05', '3', '35400042109', '000.000.000.000', '05051-000', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 3874-0718', '(00) 0 0000-0000', 'COOPERAT@MELHORAMENTOS.COM.BR', 'Fácil', '1996-10-04', 'logo_fncc.png', 1, '2022-12-22', 0),
(41, '45', 'COOPERATIVA DE ECONOMIA E CRÉDITO MUTUO DOS FUNCIONÁRIOS DA USINA SANTA MARIA - PILONCRED', 'PILONCRED', '01.107.759/0001-30', '3', '35400038110', '000.000.000.000', '18520-000', '', 0, NULL, '', 'Cerquilho', 'SP', '(15) 3284-8041', '(00) 0 0000-0000', 'PILONCRE@FASTERNET.COM.BR', 'Fácil', '1995-10-18', 'logo_fncc.png', 1, '2022-12-22', 0),
(42, '46', 'COOPERATIVA DE ECONOMIA E CRÉDITO MUTUO DOS EMPREGADOS DO GRUPO COLORADO', 'CREDCOL', '02.024.442/0001-01', '3', '35400045531', '000.000.000.000', '14790-000', '', 0, NULL, '', 'Guaíra', 'SP', '(17) 3330-3341', '(00) 0 0000-0000', 'jose-antonio.pimenta@colorado.', 'Fácil', '1997-07-25', 'logo_fncc.png', 1, '2022-12-22', 0),
(43, '47', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS EMPREGADOS DA CONFAB', 'TENARIS', '59.305.565/0001-20', '3', '35400003961', '000.000.000.000', '12414-020', '', 0, NULL, '', 'Pindamonhangaba', 'SP', '(12) 3644-9465', '(00) 0 0000-0000', 'rcosta@suppliers.tenaris.com', 'Fácil', '1965-10-07', 'logo_fncc.png', 1, '2022-12-22', 0),
(44, '48', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DA TETRA PAK', 'COOPERPAK', '67.341.487/0001-47', '3', '35400022108', '000.000.000.000', '13190-000', '', 0, NULL, '', 'Monte Mor', 'SP', '(19) 3217-6781', '(00) 0 0000-0000', 'marly.santos@cooperpak.com.br', 'Fácil', '1995-11-30', 'logo_fncc.png', 1, '2022-12-22', 0),
(45, '49', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS EMPREGADOS DA MERCK SHARP & DOHME FARMACÊUTICA', 'COOPHARMA', '02.814.832/0001-77', '3', '35400050721', '000.000.000.000', '04583-110', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 5189-7964', '(00) 0 0000-0000', 'vanda_santos@merck.com', 'Fácil', '1998-05-21', 'logo_fncc.png', 1, '2022-12-22', 0),
(46, '50', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DA SELENE', 'COOPSELENE', '72.952.138/0001-00', '3', '35400023856', '000.000.000.000', '18520-000', '', 0, NULL, '', 'Cerquilho', 'SP', '(15) 3384-8888', '(00) 0 0000-0000', 'cooperativa@selene.com.br', 'Fácil', '1993-09-08', 'logo_fncc.png', 1, '2022-12-22', 0),
(47, '51', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DA NESTLÉ', 'CREDI NESTLÉ', '62.562.012/0001-67', '3', '35400010694', '000.000.000.000', '04730-090', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 5508-7695', '(00) 0 0000-0000', 'Mirella.Campos@BR.nestle.com', 'Fácil', '1969-09-08', 'logo_fncc.png', 1, '2022-12-22', 0),
(48, '52', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS E MPREGADOS DA UNIFI - CREDIUNIFI', 'CREDIUNIFI', '03.685.335/0001-89', '3', '35400061791', '000.000.000.000', '04726-170', '', 0, NULL, '', 'São Paulo', 'SP', '(35) 3299-5011', '(00) 0 0000-0000', 'CrediUnifi@unifi.com.br', 'Fácil', '1999-10-18', 'logo_fncc.png', 1, '2022-12-22', 0),
(49, '53', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS FUNCIONÁRIOS DO FLEURY', 'COOPERCREDI GRUPO FLEURY', '71.965.313/0001-22', '3', '35400023678', '000.000.000.000', '01310-000', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 3285-5132', '(00) 0 0000-0000', 'anamaria.allegretto@grupofleur', 'Fácil', '1993-03-19', 'logo_fncc.png', 1, '2022-12-22', 0),
(50, '54', 'CECMF DA FUNDAÇÃO ZERBINI E DA FUNDAÇÃO FACULDADE DE MEDICINA COOPINCOR', 'COOPINCOR', '01.997.612/0001-63', '3', '35400043890', '000.000.000.000', '05403-000', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 2661-5584', '(00) 0 0000-0000', 'osni.merces@coopincor.com.br', 'Fácil', '1996-12-16', 'logo_fncc.png', 1, '2022-12-22', 0),
(51, '55-8', 'COOPERATIVA DE CRÉDITO MÚTUO DOS EMPREGADOS DO MAGAZINE LUIZA EMPRESAS CONTROLADAS E COLIGADAS', 'COOPLUIZA', '02.093.154/0001-09', '3', '25600040389', '000.000.000.000', '14400-660', '', 0, NULL, '', 'Franca', 'SP', '(16) 3711-2121', '(00) 0 0000-0000', 'jcmendes@coopluiza.com.br', 'Fácil', '1997-04-09', 'logo_fncc.png', 1, '2022-12-22', 0),
(52, '22', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DOS EMPREGADOS SKF E COLIGADAS', 'COOPERSKF', '49.091.119/0001-06', '3', '35400001909', '000.000.000.000', '07790-190', '', 0, NULL, '', 'Cajamar', 'SP', '(11) 4448-8438', '(00) 0 0000-0000', 'ariela.oblasser@skf.com', 'Fácil', '1969-10-09', 'logo_fncc.png', 1, '2022-12-22', 0),
(53, '56-6', 'Cooperativa de Economia e Crédito Mútuo dos Trabalhadores do Grupo São Martinho', 'USICRED', '02.562.412/0001-40', '3', '35400047348', '000.000.000.000', '14850-000', '', 0, NULL, '', 'Pradópolis', 'SP', '(16) 3981.9049', '(00) 0 0000-0000', 'jose.paulo@saomartinho.com.br', 'Fácil', '1997-12-22', 'logo_fncc.png', 1, '2022-12-22', 0),
(54, '57-4', 'COOPERATIVA DE ECONOMIA E CREDITO MUTUO DOS FUNCIONARIOS DA VILLARES METALS', 'VILLARES METALS', '53.846.242/0001-67', '3', '35400001941', '000.000.000.000', '13178-021', '', 0, NULL, '', 'Sumaré', 'SP', '(19) 3303-8254', '(00) 0 0000-0000', 'Creditovm.gil@uol.com.br', 'Fácil', '1984-07-03', 'logo_fncc.png', 1, '2022-12-22', 0),
(55, '58-2', 'COOPERATIVA DE ECONOMIA E CRÉDITO MÚTUO DA POLÍCIA MILITAR DO ESTADO DE SÃO PAULO  DA REGIÃO CENTRO OESTE PAULISTA', 'CREDMIL', '04.152.107/0001-06', '2', '3500063912', '000.000.000.000', '17015-311', '', 0, NULL, '', 'Bauru', 'SP', '(14) 3879-1151', '(00) 0 0000-0000', 'GER.ADMINISTRATIVO@CREDMIL.ORG', 'Fácil', '2000-05-02', 'logo_fncc.png', 1, '2022-12-22', 0),
(56, '59-0', 'COOPERATIVA DE CRÉDITO MÚTUO DE SERVIDORES DO ESTADO DE SÃO PAULO', 'CREDIFISCO', '04.546.162/0001-80', '2', '35400067896', '000.000.000.000', '01017-000', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 3106-1529', '(00) 0 0000-0000', 'valeria.abitte@credifisco.com.', 'Prodaf', '2001-06-19', 'logo_fncc.png', 1, '2022-12-22', 0),
(57, '0', 'FNCC', 'FNCC', '20.151.021/0001-15', '4', '000.000.000.000', '000.000.000.000', '02010-000', '', 0, NULL, '', 'São Paulo', 'SP', '(11) 0000-0000', '(00) 0 0000-0000', 'fncc@fncc.com.br', 'Prodaf', '2014-10-03', 'logo_fncc.png', 1, '2022-12-22', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `diretoria_conselhoadm`
--

DROP TABLE IF EXISTS `diretoria_conselhoadm`;
CREATE TABLE IF NOT EXISTS `diretoria_conselhoadm` (
  `dca_id` int(10) NOT NULL AUTO_INCREMENT,
  `dca_nome` char(50) NOT NULL,
  `dca_cargo` char(30) NOT NULL,
  `dca_telefone` varchar(16) NOT NULL,
  `dca_email` varchar(50) NOT NULL,
  `dca_mandato` date NOT NULL,
  `dca_coop` int(10) NOT NULL,
  PRIMARY KEY (`dca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `documentos_circulares`
--

INSERT INTO `documentos_circulares` (`cod_docc`, `docc_categoria`, `docc_subcategoria`, `docc_titulo`, `docc_arquivo`) VALUES
(1, 1, 11, 'TESTE', 'circulares.pdf'),
(2, 1, 12, 'teste', 'circulares.pdf'),
(3, 1, 13, 'teste', 'circulares.pdf'),
(4, 1, 14, 'teste', 'circulares.pdf'),
(5, 1, 15, 'teste', 'circulares.pdf'),
(6, 1, 16, 'teste', 'circulares.pdf'),
(7, 2, 1, 'teste', 'circulares.pdf'),
(8, 2, 2, 'Sistema de Escrituração Digital das Obrigações Fiscais, Previdenciárias e Trabalhistas – eSocial', 'circulares.pdf'),
(9, 2, 3, 'teste', 'circulares.pdf'),
(10, 2, 4, 'teste', 'circulares.pdf'),
(11, 2, 5, 'teste', 'circulares.pdf'),
(12, 2, 6, 'teste', 'circulares.pdf'),
(13, 3, 7, 'teste', 'circulares.pdf'),
(14, 3, 8, 'teste', 'circulares.pdf'),
(16, 4, 10, 'teste', 'circulares.pdf'),
(17, 5, 9, 'COM 002-2023 – Divulga informações sobre as mensalidades da FNCC', 'circulares.pdf'),
(18, 5, 9, 'Teste Inclusão de Documento Circular', 'Teste_Inclusão_de_Documento_Circular.pdf');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `download_termo_aceito`
--

INSERT INTO `download_termo_aceito` (`cod_dta`, `dta_user`, `dta_arquivo`, `dta_cod_arquivo`, `dta_data`) VALUES
(2, 1, 'Ata-de-Assembleia-Geral-Ordinária-2.docx', 1, '2023-02-07'),
(3, 1, 'Relatório-de-Controles-Internos.docx', 22, '2023-02-07'),
(4, 1, 'Ata-de-Assembleia-Geral-Ordinária-2.docx', 1, '2023-02-08');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `extrato_de_capital`
--

INSERT INTO `extrato_de_capital` (`cod_ext_capital`, `ext_acumulado`, `ext_remuneracao_juros`, `ext_coop`, `ext_arquivo`, `ext_obs`) VALUES
(1, '2023-02-01', '12%', 57, '2023-02-01_12%_57_104103.png', 'Teste de modal'),
(2, '2023-01-31', '15%', 57, '2023-01-31_15%_57_110723.png', 'Teste de modal 2 ajustado');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `gerenciamento_riscos`
--

INSERT INTO `gerenciamento_riscos` (`grs_cod`, `grs_bal`, `grs_coop`, `grs_data_inicial`, `grs_data_final`, `grs_arquivo`) VALUES
(1, 1, 57, '2023-02-01', '2023-02-01', '2023-02-01_2023-02-01_57_1_154332.docx');

-- --------------------------------------------------------

--
-- Estrutura para tabela `grupos_usuarios`
--

DROP TABLE IF EXISTS `grupos_usuarios`;
CREATE TABLE IF NOT EXISTS `grupos_usuarios` (
  `cod_grupo` int(2) NOT NULL AUTO_INCREMENT,
  `grupo` char(30) NOT NULL,
  PRIMARY KEY (`cod_grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
  `just_situacao` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`cod_just`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `justificativa_ponto`
--

INSERT INTO `justificativa_ponto` (`cod_just`, `just_dia`, `just_motivo`, `just_arquivo`, `just_user`, `just_tipo`, `just_situacao`) VALUES
(3, '2023-02-07', 'Atestado Médico', '2023-02-07_Atestado_Médico_203745.png', 1, 'atraso', 1),
(4, '2023-02-10', 'Levei as crianças na escola', NULL, 1, 'atraso', 1),
(5, '2023-02-09', 'Atestado', '2023-02-09_Atestado_130022.png', 1, 'atraso', 0),
(6, '2023-02-09', 'Quis trabalhar mais', NULL, 2, '', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
(8, 'RECURSOS HUMANOS', 'rh', 'bi bi-person-bounding-box', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 2, 8, 0),
(1, 4, 9, 1),
(1, 4, 10, 1),
(1, 5, 12, 1),
(1, 5, 13, 1),
(1, 5, 14, 0),
(1, 5, 15, 0),
(1, 5, 16, 0),
(1, 5, 17, 0),
(1, 6, 18, 1),
(1, 6, 19, 0),
(1, 4, 20, 1),
(1, 4, 21, 1),
(1, 4, 11, 1),
(1, 4, 22, 1),
(1, 7, 23, 1),
(1, 7, 24, 1),
(1, 7, 25, 0),
(2, 1, 1, 0),
(2, 1, 2, 0),
(2, 2, 3, 0),
(2, 2, 4, 0),
(2, 3, 5, 0),
(2, 3, 6, 0),
(2, 2, 7, 0),
(2, 2, 8, 0),
(2, 4, 9, 0),
(2, 4, 10, 0),
(2, 5, 12, 0),
(2, 5, 13, 0),
(2, 5, 14, 0),
(2, 5, 15, 0),
(2, 5, 16, 0),
(2, 5, 17, 0),
(2, 6, 18, 0),
(2, 6, 19, 0),
(2, 4, 20, 0),
(2, 4, 21, 0),
(2, 4, 11, 0),
(2, 4, 22, 0),
(2, 7, 23, 0),
(2, 7, 24, 0),
(2, 7, 25, 0),
(3, 1, 1, 0),
(3, 1, 2, 0),
(3, 2, 3, 0),
(3, 2, 4, 0),
(3, 3, 5, 0),
(3, 3, 6, 0),
(3, 2, 7, 0),
(3, 2, 8, 0),
(3, 4, 9, 0),
(3, 4, 10, 0),
(3, 5, 12, 0),
(3, 5, 13, 0),
(3, 5, 14, 0),
(3, 5, 15, 0),
(3, 5, 16, 0),
(3, 5, 17, 0),
(3, 6, 18, 0),
(3, 6, 19, 0),
(3, 4, 20, 0),
(3, 4, 21, 0),
(3, 4, 11, 0),
(3, 4, 22, 0),
(3, 7, 23, 0),
(3, 7, 24, 0),
(3, 7, 25, 0),
(4, 1, 1, 0),
(4, 1, 2, 0),
(4, 2, 3, 0),
(4, 2, 4, 0),
(4, 3, 5, 0),
(4, 3, 6, 0),
(4, 2, 7, 0),
(4, 2, 8, 0),
(4, 4, 9, 0),
(4, 4, 10, 0),
(4, 5, 12, 0),
(4, 5, 13, 0),
(4, 5, 14, 0),
(4, 5, 15, 0),
(4, 5, 16, 0),
(4, 5, 17, 0),
(4, 6, 18, 0),
(4, 6, 19, 0),
(4, 4, 20, 0),
(4, 4, 21, 0),
(4, 4, 11, 0),
(4, 4, 22, 0),
(4, 7, 23, 0),
(4, 7, 24, 0),
(4, 7, 25, 0),
(5, 1, 1, 0),
(5, 1, 2, 0),
(5, 2, 3, 0),
(5, 2, 4, 0),
(5, 3, 5, 0),
(5, 3, 6, 0),
(5, 2, 7, 0),
(5, 2, 8, 0),
(5, 4, 9, 0),
(5, 4, 10, 0),
(5, 5, 12, 0),
(5, 5, 13, 0),
(5, 5, 14, 0),
(5, 5, 15, 0),
(5, 5, 16, 0),
(5, 5, 17, 0),
(5, 6, 18, 0),
(5, 6, 19, 0),
(5, 4, 20, 0),
(5, 4, 21, 0),
(5, 4, 11, 0),
(5, 4, 22, 0),
(5, 7, 23, 0),
(5, 7, 24, 0),
(5, 7, 25, 0),
(1, 2, 26, 1),
(2, 2, 26, 0),
(3, 2, 26, 0),
(4, 2, 26, 0),
(5, 2, 26, 0),
(1, 8, 27, 1),
(2, 8, 27, 1),
(3, 8, 27, 0),
(4, 8, 27, 0),
(5, 8, 27, 0),
(1, 8, 28, 1),
(2, 8, 28, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfis_usuarios`
--

DROP TABLE IF EXISTS `perfis_usuarios`;
CREATE TABLE IF NOT EXISTS `perfis_usuarios` (
  `p_cod` int(10) NOT NULL AUTO_INCREMENT,
  `perfil` char(30) NOT NULL,
  PRIMARY KEY (`p_cod`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

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
-- Estrutura para tabela `situacao_consultas`
--

DROP TABLE IF EXISTS `situacao_consultas`;
CREATE TABLE IF NOT EXISTS `situacao_consultas` (
  `cod_situacao` int(10) NOT NULL AUTO_INCREMENT,
  `situacao` char(30) NOT NULL,
  PRIMARY KEY (`cod_situacao`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `subcategoria_circulares`
--

INSERT INTO `subcategoria_circulares` (`cod_subcategoria`, `subcategoria`, `id_categoria`) VALUES
(1, 'Calendário de Obrigações', 2),
(2, 'Apesctos Trabalhistas', 2),
(3, 'Aspectos Tributários', 2),
(4, 'Contábil', 2),
(5, 'Controles Gerais', 2),
(6, 'Obrigações Acessórias', 2),
(7, 'Atas de Assembleia', 3),
(8, 'Estatuto Social', 3),
(9, 'Divulgações', 5),
(10, 'Políticas / Manuais', 4),
(11, 'Calendário de Obrigações', 1),
(12, 'Apesctos Trabalhistas', 1),
(13, 'Aspectos Tributários', 1),
(14, 'Contabil', 1),
(15, 'Controles Gerais', 1),
(16, 'Obrigações Acessórias', 1),
(17, 'teste Nova Subcategoria', 6);

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

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
(8, 'CANAL DE INDÍCIOS DE ILICITUDE', 2, '', 'canaldenuncias'),
(9, 'INCLUIR BOLETO', 4, 'bi bi-plus-square-dotted', 'incluir-boleto.php'),
(10, 'INCLUIR EXTRATO', 4, 'bi bi-journal-plus', 'incluir-extrato-capital.php'),
(11, 'BALANCETE', 4, 'bi bi-bank', 'balancete.php'),
(12, 'LISTAR DOCUMENTOS', 5, 'bi bi-file-text', 'visualizar_doc.php'),
(13, 'INCLUIR DOCUMENTOS', 5, 'bi bi-file-earmark-plus', 'incluir-doc.php'),
(18, 'PERFIS', 6, 'bi bi-person-vcard', 'perfis-usuarios.php'),
(19, 'GRUPOS', 6, '', 'grupos.php'),
(20, 'MEUS BOLETOS', 4, 'bi bi-upc-scan', 'meus-boletos.php'),
(21, 'EXTRATO DE CAPITAL', 4, 'bi bi-receipt-cutoff', 'extrato-capital.php'),
(22, 'LISTAR BALANCETE', 4, 'bi bi-list-nested', 'listar-balancete.php'),
(23, 'CIRCULARES E DOCUMENTOS', 7, 'bi bi-folder2-open', 'circulares-documentos.php'),
(24, 'INCLUIR CIRCULAR', 7, 'bi bi-folder-plus', 'incluir-circular-documento.php'),
(25, 'TÉCNICO', 7, 'bi bi-person-video3', ''),
(26, 'DOWNLOADS DOCUMENTOS', 2, 'bi bi-cloud-download', 'rel-downloads-documentos.php'),
(27, 'MARCAR PONTO', 8, 'bi bi-check2-circle', 'controle-ponto.php'),
(28, 'BANCO DE HORAS', 8, 'bi bi-clock-history', 'banco-de-horas.php');

-- --------------------------------------------------------

--
-- Estrutura para tabela `urgencia`
--

DROP TABLE IF EXISTS `urgencia`;
CREATE TABLE IF NOT EXISTS `urgencia` (
  `cod_urgencia` int(255) NOT NULL AUTO_INCREMENT,
  `urgencia` char(20) NOT NULL,
  PRIMARY KEY (`cod_urgencia`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `sobrenome`, `email`, `usuario`, `senha`, `user_coop`, `user_nivel`, `user_grupo`, `u_status`, `user_supervisor`, `user_controla_ponto`, `data_cadastro`) VALUES
(1, 'Moises', 'Pequeno do Rosário', 'bemktech1217@gmail.com', 'moises', '5a07992136c4e91e5cc618f4020dfa90', 57, 1, 1, 1, 1, 1, '2023-02-01'),
(2, 'Karina', 'Rocha Pequeno', 'nina.rocha91@gmail.com', 'karina.pequeno', '5a07992136c4e91e5cc618f4020dfa90', 57, 2, 1, 1, 0, 1, '2023-02-01');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
