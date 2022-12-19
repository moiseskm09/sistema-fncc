-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Dez-2022 às 14:30
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teste`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_documentos`
--

DROP TABLE IF EXISTS `categoria_documentos`;
CREATE TABLE IF NOT EXISTS `categoria_documentos` (
  `cod_categoria` int(10) NOT NULL AUTO_INCREMENT,
  `categoria` char(50) NOT NULL,
  PRIMARY KEY (`cod_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria_documentos`
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
-- Estrutura da tabela `cooperativas`
--

DROP TABLE IF EXISTS `cooperativas`;
CREATE TABLE IF NOT EXISTS `cooperativas` (
  `cod_coop` int(10) NOT NULL AUTO_INCREMENT,
  `cooperativa` char(100) NOT NULL,
  `logo_coop` varchar(50) NOT NULL DEFAULT 'logo_fncc.png',
  PRIMARY KEY (`cod_coop`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cooperativas`
--

INSERT INTO `cooperativas` (`cod_coop`, `cooperativa`, `logo_coop`) VALUES
(1, 'COGEM', 'logo_fncc.png'),
(2, 'COOP FECOM/ SESC/ SENAC', 'logo_fncc.png'),
(3, 'COOPERFEMSA', 'logo_fncc.png'),
(4, 'CREDI SG', 'logo_fncc.png'),
(5, 'COOPERICSSON', 'logo_fncc.png'),
(6, 'COOPCARGILL', 'logo_fncc.png'),
(7, 'COOP RB', 'logo_fncc.png'),
(8, 'CREDIBASF', 'logo_fncc.png'),
(9, 'COOPERMC', 'logo_fncc.png'),
(10, 'COOP SCHAEFFLER', 'logo_fncc.png'),
(11, 'CREDIVISTA', 'logo_fncc.png'),
(12, 'COOPERJOHNSON', 'logo_fncc.png'),
(13, 'COOPERABRIL', 'logo_fncc.png'),
(14, 'COOPUNESP', 'logo_fncc.png'),
(15, 'COOPOWENS', 'logo_fncc.png'),
(16, 'COOPRICLAN', 'logo_fncc.png'),
(17, 'COOPERFEIS', 'logo_fncc.png'),
(18, 'COOPOIB', 'logo_fncc.png'),
(19, 'COOPERBOMBRIL', 'logo_fncc.png'),
(20, 'COOPAZ', 'logo_fncc.png'),
(21, 'COOPERPPG', 'logo_fncc.png'),
(22, 'COOPERPLASCAR', 'logo_fncc.png'),
(23, 'CREDITA', 'logo_fncc.png'),
(24, 'COOP AKZONOBEL', 'logo_fncc.png'),
(25, 'COOPERJSS', 'logo_fncc.png'),
(26, 'COOPERTEL', 'logo_fncc.png'),
(27, 'COOPERNITRO', 'logo_fncc.png'),
(28, 'COOPERFAC', 'logo_fncc.png'),
(29, 'COOP MWM', 'logo_fncc.png'),
(30, 'CREDICEBRACE', 'logo_fncc.png'),
(31, 'CREDISCOOP', 'logo_fncc.png'),
(32, 'COOPER-SEKURIT', 'logo_fncc.png'),
(33, 'CREDIAFAM', 'logo_fncc.png'),
(34, 'COOPERALESP', 'logo_fncc.png'),
(35, 'COOPERCRED-CBA', 'logo_fncc.png'),
(36, 'COOPER AVIBRAS', 'logo_fncc.png'),
(37, 'COOPASPACER', 'logo_fncc.png'),
(38, 'COOPERALPINA', 'logo_fncc.png'),
(39, 'COOPERPILKINGTON', 'logo_fncc.png'),
(40, 'COOPERMEL', 'logo_fncc.png'),
(41, 'PILONCRED', 'logo_fncc.png'),
(42, 'CREDCOL', 'logo_fncc.png'),
(43, 'TENARIS', 'logo_fncc.png'),
(44, 'COOPERPAK', 'logo_fncc.png'),
(45, 'COOPHARMA', 'logo_fncc.png'),
(46, 'COOPSELENE', 'logo_fncc.png'),
(47, 'CREDI NESTLÉ\n', 'logo_fncc.png'),
(48, 'CREDIUNIFI', 'logo_fncc.png'),
(49, 'COOPERCREDI GRUPO FLEURY', 'logo_fncc.png'),
(50, 'COOPINCOR', 'logo_fncc.png'),
(51, 'COOPLUIZA', 'logo_fncc.png'),
(52, 'COOPERSKF', 'logo_fncc.png'),
(53, 'USICRED', 'logo_fncc.png'),
(54, 'VILLARES METALS', 'logo_fncc.png'),
(55, 'CREDMIL', 'logo_fncc.png'),
(56, 'CREDIFISCO', 'logo_fncc.png'),
(57, 'FNCC', 'logo_fncc.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(10) NOT NULL AUTO_INCREMENT,
  `menu` char(30) NOT NULL,
  `caminho_drop` varchar(35) NOT NULL,
  `icone` varchar(30) NOT NULL,
  `caminho_submenu` varchar(40) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `menu`
--

INSERT INTO `menu` (`id_menu`, `menu`, `caminho_drop`, `icone`, `caminho_submenu`) VALUES
(1, 'CHAMADOS', 'chamados', 'uil uil-ticket', ''),
(2, 'RELATÓRIOS', 'relatorios', 'uil uil-file-info-alt', ''),
(3, 'CADASTRO', 'cadastro', 'uil uil-user-plus', ''),
(4, 'FINANCEIRO', 'financeiro', 'uil uil-bill', ''),
(5, 'MODELOS DE DOCUMENTOS', 'modelo_documentos', 'uil uil-file-edit-alt', ''),
(6, 'CONFIGURAÇÕES', 'configuracoes', 'uil uil-setting', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelos_de_documentos`
--

DROP TABLE IF EXISTS `modelos_de_documentos`;
CREATE TABLE IF NOT EXISTS `modelos_de_documentos` (
  `cod_documento` int(10) NOT NULL AUTO_INCREMENT,
  `categoria_documento` int(10) NOT NULL,
  `titulo_documento` varchar(100) NOT NULL,
  `nome_documento` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_documento`),
  KEY `categoria_documento` (`categoria_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modelos_de_documentos`
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
-- Estrutura da tabela `nivel_acesso`
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
-- Extraindo dados da tabela `nivel_acesso`
--

INSERT INTO `nivel_acesso` (`cod_perfil`, `codMenu`, `codSubmenu`, `marcado`) VALUES
(1, 1, 1, 1),
(1, 1, 2, 1),
(1, 2, 3, 1),
(1, 2, 4, 1),
(1, 3, 5, 1),
(1, 3, 6, 1),
(1, 2, 7, 1),
(1, 2, 8, 1),
(1, 4, 9, 1),
(1, 4, 10, 1),
(1, 4, 11, 1),
(1, 5, 12, 1),
(1, 5, 13, 1),
(1, 5, 14, 1),
(1, 5, 15, 1),
(1, 5, 16, 1),
(1, 5, 17, 1),
(1, 6, 18, 1),
(1, 6, 19, 1),
(2, 1, 1, 0),
(2, 1, 2, 0),
(2, 2, 3, 0),
(2, 2, 4, 0),
(2, 2, 7, 1),
(2, 2, 8, 1),
(2, 3, 5, 0),
(2, 3, 6, 0),
(2, 4, 9, 0),
(2, 4, 10, 1),
(2, 4, 11, 1),
(2, 5, 12, 0),
(2, 5, 13, 0),
(2, 5, 14, 0),
(2, 5, 15, 0),
(2, 5, 16, 0),
(2, 5, 17, 0),
(2, 6, 18, 0),
(2, 6, 19, 0),
(3, 1, 1, 0),
(3, 1, 2, 1),
(3, 2, 3, 0),
(3, 2, 4, 0),
(3, 2, 7, 0),
(3, 2, 8, 0),
(3, 3, 5, 0),
(3, 3, 6, 0),
(3, 4, 9, 0),
(3, 4, 10, 0),
(3, 4, 11, 0),
(3, 5, 12, 0),
(3, 5, 13, 0),
(3, 5, 14, 0),
(3, 5, 15, 0),
(3, 5, 16, 0),
(3, 5, 17, 0),
(3, 6, 18, 0),
(3, 6, 19, 0),
(4, 1, 1, 0),
(4, 1, 2, 1),
(4, 2, 3, 0),
(4, 2, 4, 0),
(4, 2, 7, 0),
(4, 2, 8, 0),
(4, 3, 5, 0),
(4, 3, 6, 0),
(4, 4, 9, 0),
(4, 4, 10, 0),
(4, 4, 11, 0),
(4, 5, 12, 0),
(4, 5, 13, 0),
(4, 5, 14, 0),
(4, 5, 15, 0),
(4, 5, 16, 0),
(4, 5, 17, 0),
(4, 6, 18, 0),
(4, 6, 19, 0),
(5, 1, 1, 1),
(5, 1, 2, 1),
(5, 2, 3, 0),
(5, 2, 4, 0),
(5, 2, 7, 0),
(5, 2, 8, 0),
(5, 3, 5, 0),
(5, 3, 6, 0),
(5, 4, 9, 1),
(5, 4, 10, 1),
(5, 4, 11, 1),
(5, 5, 12, 1),
(5, 5, 13, 1),
(5, 5, 14, 1),
(5, 5, 15, 1),
(5, 5, 16, 1),
(5, 5, 17, 1),
(5, 6, 18, 0),
(5, 6, 19, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfis_usuarios`
--

DROP TABLE IF EXISTS `perfis_usuarios`;
CREATE TABLE IF NOT EXISTS `perfis_usuarios` (
  `p_cod` int(10) NOT NULL AUTO_INCREMENT,
  `perfil` char(30) NOT NULL,
  PRIMARY KEY (`p_cod`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `perfis_usuarios`
--

INSERT INTO `perfis_usuarios` (`p_cod`, `perfil`) VALUES
(1, 'Administrador'),
(2, 'Administrativo'),
(3, 'Técnico'),
(4, 'Jurídico'),
(5, 'Cooperativa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `submenu`
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `submenu`
--

INSERT INTO `submenu` (`cod_submenu`, `submenu`, `cod_menu`, `icone_sub`, `caminho`) VALUES
(1, 'NOVO', 1, '', 'abertura.php'),
(2, 'LISTAR', 1, '', 'listar.php'),
(3, 'ATENDIMENTOS', 2, '', 'atendimentos.php'),
(4, 'SATISFAÇÃO', 2, '', 'satisfacao.php'),
(5, 'USUÁRIOS', 3, 'uil uil-users-alt', 'cad-usuarios.php'),
(6, 'COOPERATIVAS', 3, '', 'cooperativas'),
(7, 'GERENCIAMENTO DE RISCOS', 2, '', 'GRS'),
(8, 'CANAL DE INDÍCIOS DE ILICITUDE', 2, '', 'canaldenuncias'),
(9, 'BOLETO', 4, '', 'BOLETO'),
(10, 'EXTRATO DE CAPITAL', 4, '', 'EXTRATO'),
(11, 'BALANCETE', 4, '', 'BALANCETE'),
(12, 'VISUALIZAR', 5, 'uil uil-file-copy-alt', 'visualizar_doc.php'),
(13, 'INCLUIR', 5, '', 'mregulamentos'),
(18, 'PERFIS', 6, 'uil uil-user-square', 'perfis-usuarios.php'),
(19, 'GRUPOS', 6, '', 'grupos.php');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
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
  `u_status` int(1) NOT NULL DEFAULT 1 COMMENT '1-ativo 0-inativo',
  `data_cadastro` date NOT NULL DEFAULT '2022-12-16',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `sobrenome`, `email`, `usuario`, `senha`, `user_coop`, `user_nivel`, `u_status`, `data_cadastro`) VALUES
(1, 'Moises', 'Pequeno', 'moiseskm09@gmail.com', 'moises', '90f80b22f53a5d4d72f7b126ef4b1f44', 34, 1, 1, '2022-12-16'),
(2, 'Karina', 'Pequeno', 'nina.rocha91@gmail.com', 'karina', '90f80b22f53a5d4d72f7b126ef4b1f44', 57, 1, 1, '2022-12-16'),
(3, 'Emanuelle', 'Pequeno', 'emanuelle@gmail.com', 'emanuelle', '90f80b22f53a5d4d72f7b126ef4b1f44', 57, 1, 1, '2022-12-16'),
(4, 'Benício', 'Pequeno', 'benicio@gmail.com', 'benicio', '90f80b22f53a5d4d72f7b126ef4b1f44', 57, 2, 1, '2022-12-16'),
(5, 'Adriana', 'Caldeira', 'moiseskm09@gmail.com', 'adriana', '90f80b22f53a5d4d72f7b126ef4b1f44', 57, 1, 0, '2022-12-17'),
(6, 'bruna', 'msis', 'bemktech1217@gmail.com', 'bru', '90f80b22f53a5d4d72f7b126ef4b1f44', 57, 2, 0, '2022-12-17'),
(7, 'elvis', 'card', 'emanuelle@gmail.com', 'elvis', '90f80b22f53a5d4d72f7b126ef4b1f44', 1, 1, 0, '2022-12-17');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `modelos_de_documentos`
--
ALTER TABLE `modelos_de_documentos`
  ADD CONSTRAINT `modelos_de_documentos_ibfk_1` FOREIGN KEY (`categoria_documento`) REFERENCES `categoria_documentos` (`cod_categoria`);

--
-- Limitadores para a tabela `nivel_acesso`
--
ALTER TABLE `nivel_acesso`
  ADD CONSTRAINT `nivel_acesso_ibfk_1` FOREIGN KEY (`cod_perfil`) REFERENCES `perfis_usuarios` (`p_cod`),
  ADD CONSTRAINT `nivel_acesso_ibfk_2` FOREIGN KEY (`codMenu`) REFERENCES `menu` (`id_menu`),
  ADD CONSTRAINT `nivel_acesso_ibfk_3` FOREIGN KEY (`codSubmenu`) REFERENCES `submenu` (`cod_submenu`);

--
-- Limitadores para a tabela `submenu`
--
ALTER TABLE `submenu`
  ADD CONSTRAINT `submenu_ibfk_1` FOREIGN KEY (`cod_menu`) REFERENCES `menu` (`id_menu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
