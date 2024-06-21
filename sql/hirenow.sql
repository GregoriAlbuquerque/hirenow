-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/06/2024 às 20:04
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
-- Banco de dados: `hirenow`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `candidatos`
--

CREATE TABLE `candidatos` (
  `id_usuario_candidato` int(11) NOT NULL,
  `data_nasc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `candidatos`
--

INSERT INTO `candidatos` (`id_usuario_candidato`, `data_nasc`) VALUES
(2, '2000-05-12'),
(4, '1999-03-12'),
(5, '2003-09-19');

-- --------------------------------------------------------

--
-- Estrutura para tabela `chat`
--

CREATE TABLE `chat` (
  `idchat` int(11) NOT NULL,
  `mensagem` varchar(300) NOT NULL,
  `data_msg` date NOT NULL,
  `destino` int(11) NOT NULL,
  `destinatario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `curriculo`
--

CREATE TABLE `curriculo` (
  `idCurriculo` int(11) NOT NULL,
  `id_candidato` int(11) NOT NULL,
  `escolaridade` varchar(45) NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `linguas_estrangeiras` varchar(28) DEFAULT NULL,
  `habilidades_interpessoais` varchar(105) DEFAULT NULL,
  `descricao` longtext NOT NULL,
  `portifolio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `curriculo`
--

INSERT INTO `curriculo` (`idCurriculo`, `id_candidato`, `escolaridade`, `sexo`, `linguas_estrangeiras`, `habilidades_interpessoais`, `descricao`, `portifolio`) VALUES
(1, 2, 'Regular do Ensino Médio', 'Masculino', 'Inglês,Espanhol,Francês', 'Liderança,Confiança,Comunicação,Proatividade', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut massa sapien. Donec at turpis metus. Praesent congue dolor quam, finibus placerat ante molestie eu. Morbi ipsum orci, semper at accumsan non, venenatis et ante. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec fermentum nibh massa, eu dignissim sem porttitor sit amet. Cras hendrerit nisl nisl, a iaculis nisi blandit consectetur. Curabitur enim odio, mattis scelerisque commodo ut, ultricies in dui. Duis dui massa, consequat id mattis at, congue at leo. Donec pretium, enim eget congue vestibulum, dolor tortor pretium nibh, eu ultricies purus erat at odio. Etiam tempus sagittis est, quis cursus purus malesuada ac. Vestibulum urna eros, molestie fermentum turpis eget, suscipit tempor metus. Pellentesque eu rutrum purus. Nullam ac nulla eu tortor aliquam interdum eu tincidunt sapien. Aliquam odio diam, lobortis at laoreet non, pharetra id est. ', '../../arquivos_portifolio/666f1f55415c2_Capturas de Tela.zip'),
(2, 4, 'Ensino superior', 'Feminino', 'Inglês', 'Liderança,Confiança,Disposição,Comunicação,Trabalho em equipe', 'Duis nec rhoncus nulla, eget placerat massa. Sed ut nunc rutrum felis tincidunt condimentum. Integer justo ligula, egestas feugiat rhoncus ut, eleifend eu quam. Nullam et massa scelerisque, finibus lorem at, consequat sem. Quisque id imperdiet metus, et condimentum urna. Duis quis metus finibus, euismod arcu vitae, vehicula augue. Proin suscipit laoreet efficitur. ', '../../arquivos_portifolio/666f21108b6c4_portifolio.zip');

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresas`
--

CREATE TABLE `empresas` (
  `id_usuarios_empresa` int(11) NOT NULL,
  `cnpj` double NOT NULL,
  `area_atuacao` varchar(45) DEFAULT NULL,
  `descricao_empresa` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `empresas`
--

INSERT INTO `empresas` (`id_usuarios_empresa`, `cnpj`, `area_atuacao`, `descricao_empresa`) VALUES
(3, 1234567898765, 'Edição audiovisual', 'Curabitur bibendum, nisi in varius condimentum, ante risus condimentum odio, rhoncus pharetra sapien nisi sit amet erat. Praesent euismod blandit elit. Aliquam aliquet vulputate tellus in sagittis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ultricies a tortor congue posuere. Integer odio augue, tincidunt vel tincidunt eu, congue sit amet ex. '),
(6, 987896543243, 'Finanças', 'Empresa voltada para Duis molestie porta convallis. Pellentesque facilisis sollicitudin tempor. Proin luctus ut turpis non facilisis. Morbi volutpat eget eros et tempor. Fusce sit amet mi eu mi facilisis laoreet a sed nisl. Nulla at consequat risus. Maecenas dignissim tempus ipsum, sed dignissim odio maximus in. Aliquam dapibus dolor ipsum, sed molestie mauris porta at. Ut suscipit vestibulum nibh ut feugiat. Curabitur placerat mi eget elementum pretium. Vivamus egestas hendrerit tortor, vel eleifend ex sollicitudin consectetur. Nam neque mauris, vestibulum eget suscipit in, aliquam vestibulum magna. Vivamus non urna sit amet lorem commodo sagittis. Sed augue dolor, ultrices id elementum eget, bibendum sit amet leo. Nullam congue, lorem a malesuada dapibus, turpis elit eleifend tortor, varius feugiat est odio tincidunt dolor. Praesent suscipit risus vitae iaculis sagittis. ');

-- --------------------------------------------------------

--
-- Estrutura para tabela `interessados`
--

CREATE TABLE `interessados` (
  `idInteressados` int(11) NOT NULL,
  `id_vaga` int(11) NOT NULL,
  `proposta` longtext NOT NULL,
  `id_candidato` int(11) NOT NULL,
  `nome_interessado` varchar(45) NOT NULL,
  `curriculo_candidato` int(11) DEFAULT NULL,
  `status_interesse` int(1) NOT NULL,
  `selecionado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `interessados`
--

INSERT INTO `interessados` (`idInteressados`, `id_vaga`, `proposta`, `id_candidato`, `nome_interessado`, `curriculo_candidato`, `status_interesse`, `selecionado`) VALUES
(1, 1, 'Tenho interesse em Vivamus ultricies felis diam, consectetur feugiat quam molestie eget. Vestibulum urna neque, tincidunt sit amet quam quis, vestibulum tristique odio. Praesent vitae lectus quis quam imperdiet mollis. Vivamus orci ligula, elementum vel enim sed, pellentesque sodales purus. Nullam placerat venenatis placerat. Nulla non pretium mi, nec blandit ex. Aliquam nec varius velit. Maecenas commodo dapibus laoreet. Donec egestas sodales est quis mollis. Aliquam quam ante, euismod a volutpat at, commodo eu lorem. Maecenas ac urna ipsum. In ipsum odio, pellentesque non neque eu, tincidunt interdum leo. Nulla et dui id libero maximus efficitur in eu eros. Integer at commodo dui. Ut a diam sodales, consectetur lorem fermentum, eleifend felis. ', 2, 'João Gabriel', 1, 0, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuarios` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `tipo` int(1) DEFAULT NULL COMMENT 'Lenda:\n1 = Candidatos;\n2 = Administradores;\n3 = Empresas.\n',
  `status_usuario` int(1) NOT NULL COMMENT '0 - Ativo\r\n1 - Inativo\r\n2 - Inativado pelo Adm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `nome`, `email`, `senha`, `tipo`, `status_usuario`) VALUES
(1, 'Administrador', 'adm@gmail.com', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1, 0),
(2, 'João Gabriel', 'joao@gmail.com', '5ebe2294ecd0e0f08eab7690d2a6ee69', 2, 0),
(3, 'CBN', 'cbn@gmail.com', '5ebe2294ecd0e0f08eab7690d2a6ee69', 3, 0),
(4, 'Maria Joaquina', 'maria@gmail.com', '5ebe2294ecd0e0f08eab7690d2a6ee69', 2, 0),
(5, 'Matheus', 'matheus@gmail.com', '5ebe2294ecd0e0f08eab7690d2a6ee69', 2, 0),
(6, 'Jonnes Investimentos', 'jonnes@gmail.com', '5ebe2294ecd0e0f08eab7690d2a6ee69', 3, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vagas`
--

CREATE TABLE `vagas` (
  `idVagas` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `nome_empresa` varchar(60) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `area` varchar(45) NOT NULL,
  `tipo` int(1) NOT NULL COMMENT '1 - Onlide\n2 - Presencial',
  `requisitos` varchar(255) NOT NULL,
  `descricao` longtext NOT NULL,
  `pagamento` decimal(8,2) NOT NULL,
  `status_vaga` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vagas`
--

INSERT INTO `vagas` (`idVagas`, `id_empresa`, `nome_empresa`, `titulo`, `area`, `tipo`, `requisitos`, `descricao`, `pagamento`, `status_vaga`) VALUES
(1, 3, '', 'Podcast', 'Edição audiovisual', 2, 'Conhecimentos avançados em editores de vídeo e plataformas de stream.', 'Edição de vídeos, Curabitur aliquam lectus non cursus gravida. Nam scelerisque commodo metus id elementum. Nulla mi sapien, luctus vel lacinia sit amet, aliquam ut velit. Ut tortor felis, placerat sit amet scelerisque ut, tempus id leo. Pellentesque nec mi placerat, dignissim dui non, ornare felis. Nullam lacinia turpis a eros pretium, id aliquet nisi dictum. Etiam et velit non ante congue sollicitudin id sit amet arcu. Suspendisse quis sagittis lacus. Morbi non arcu porta ante egestas euismod a vitae ex.', 425.00, 1),
(2, 3, '', 'Gravação de reportagens', 'Edição audiovisual', 2, 'Experiência com gravação de vídeos profissionais.', 'Sed sagittis nulla eu ipsum laoreet, ut consectetur nunc venenatis. Maecenas a lacus at metus placerat laoreet. Integer nisl diam, dapibus eu leo sed, rhoncus tincidunt odio. Donec et felis urna. Fusce faucibus orci at volutpat consequat. Pellentesque viverra enim non tellus blandit, eget posuere mauris facilisis. Nulla id tempus sem. Vivamus auctor cursus metus ut sagittis. Morbi felis purus, porta sed hendrerit ac, blandit facilisis dui. Integer ut eros neque. Donec et fermentum metus. Sed sed pharetra ipsum, nec lobortis massa. ', 675.00, 0),
(3, 6, '', 'Gerenciamento de investimentos imobiliários', 'Finanças', 2, 'Conhecimentos em finanças e economia.', 'Necessito de Integer pharetra consequat elit sit amet fringilla. Vivamus in leo bibendum, mollis turpis at, hendrerit leo. Fusce rhoncus auctor lectus eu aliquam. Sed venenatis tellus non consectetur commodo. Fusce laoreet lacinia dolor, a bibendum enim porttitor a. Aenean dictum at diam a efficitur. Phasellus at massa id urna mollis sodales quis vitae odio. Suspendisse ac vestibulum ante. Donec ultrices iaculis nibh et viverra. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tincidunt vulputate tincidunt. Sed rhoncus ornare blandit. ', 930.00, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `candidatos`
--
ALTER TABLE `candidatos`
  ADD PRIMARY KEY (`id_usuario_candidato`),
  ADD KEY `fk_Candidato_Usuarios1_idx` (`id_usuario_candidato`);

--
-- Índices de tabela `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idchat`),
  ADD KEY `destino_msg_idx` (`destino`),
  ADD KEY `destinatario_idx` (`destinatario`);

--
-- Índices de tabela `curriculo`
--
ALTER TABLE `curriculo`
  ADD PRIMARY KEY (`idCurriculo`),
  ADD UNIQUE KEY `id_candidato_UNIQUE` (`id_candidato`);

--
-- Índices de tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_usuarios_empresa`),
  ADD UNIQUE KEY `cnpj_UNIQUE` (`cnpj`),
  ADD KEY `fk_Empresas_Usuarios1_idx` (`id_usuarios_empresa`);

--
-- Índices de tabela `interessados`
--
ALTER TABLE `interessados`
  ADD PRIMARY KEY (`idInteressados`),
  ADD KEY `vaga_01_idx` (`id_vaga`),
  ADD KEY `currículo_interessados_idx` (`curriculo_candidato`),
  ADD KEY `proposta_candidato_idx` (`id_candidato`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuarios`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Índices de tabela `vagas`
--
ALTER TABLE `vagas`
  ADD PRIMARY KEY (`idVagas`),
  ADD KEY `id_empresa_idx` (`id_empresa`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `chat`
--
ALTER TABLE `chat`
  MODIFY `idchat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `curriculo`
--
ALTER TABLE `curriculo`
  MODIFY `idCurriculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `interessados`
--
ALTER TABLE `interessados`
  MODIFY `idInteressados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `vagas`
--
ALTER TABLE `vagas`
  MODIFY `idVagas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `candidatos`
--
ALTER TABLE `candidatos`
  ADD CONSTRAINT `fk_Candidato_Usuarios1` FOREIGN KEY (`id_usuario_candidato`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `destinatario` FOREIGN KEY (`destinatario`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `destino_msg` FOREIGN KEY (`destino`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `curriculo`
--
ALTER TABLE `curriculo`
  ADD CONSTRAINT `id_candidato` FOREIGN KEY (`id_candidato`) REFERENCES `candidatos` (`id_usuario_candidato`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `fk_Empresas_Usuarios1` FOREIGN KEY (`id_usuarios_empresa`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `interessados`
--
ALTER TABLE `interessados`
  ADD CONSTRAINT `currículo_interessados` FOREIGN KEY (`curriculo_candidato`) REFERENCES `curriculo` (`idCurriculo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proposta_candidato` FOREIGN KEY (`id_candidato`) REFERENCES `candidatos` (`id_usuario_candidato`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vaga_id` FOREIGN KEY (`id_vaga`) REFERENCES `vagas` (`idVagas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `vagas`
--
ALTER TABLE `vagas`
  ADD CONSTRAINT `id_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_usuarios_empresa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
