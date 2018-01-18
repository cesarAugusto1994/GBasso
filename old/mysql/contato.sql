-- phpMyAdmin SQL Dump
-- version 2.6.3-pl1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Aug 12, 2011 at 12:03 PM
-- Server version: 4.1.21
-- PHP Version: 5.0.4
-- 
-- Database: `grupobasso`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `contato`
-- 

CREATE TABLE `contato` (
  `seqc` int(11) NOT NULL auto_increment,
  `nome` varchar(80) default NULL,
  `cep` varchar(12) default NULL,
  `endereco` varchar(60) default NULL,
  `numero` varchar(10) default NULL,
  `apartamento` varchar(10) default NULL,
  `bloco` varchar(10) default NULL,
  `bairro` varchar(60) default NULL,
  `cidade` varchar(50) default NULL,
  `estado` varchar(10) default NULL,
  `tel_res` varchar(20) default NULL,
  `tel_cel` varchar(20) default NULL,
  `tel_com` varchar(20) default NULL,
  `email` varchar(80) default NULL,
  `dt_cad` varchar(15) default NULL,
  `obs` text,
  `r_email` char(1) default NULL,
  `r_tel` char(1) default NULL,
  `r_fax` char(1) default NULL,
  `r_correio` char(1) default NULL,
  `data_cadastro` varchar(50) default NULL,
  PRIMARY KEY  (`seqc`)
) ENGINE=MyISAM AUTO_INCREMENT=281 DEFAULT CHARSET=latin1 AUTO_INCREMENT=281 ;

-- 
-- Dumping data for table `contato`
-- 

INSERT INTO `contato` (`seqc`, `nome`, `cep`, `endereco`, `numero`, `apartamento`, `bloco`, `bairro`, `cidade`, `estado`, `tel_res`, `tel_cel`, `tel_com`, `email`, `dt_cad`, `obs`, `r_email`, `r_tel`, `r_fax`, `r_correio`, `data_cadastro`) VALUES (279, 'Re: Lista de Clientes em Potencial', '08730000', 'Fco Franco', 'Mogi das C', NULL, NULL, 'Centro', 'Mogi das Cruzes', 'SP', '', '00000000', '00000000', 'naoresponda@maladireta.inf', NULL, 'Boa tarde, acessei o site da Grupobasso e através do formulário de contato estou enviando esta proposta que pode ser do interesse de sua empresa.\r\n\r\nNossa empresa está a mais de 10 anos no mercado, e é especializada na venda de listas com cadastros de empresas para área comercial, telemarketing e mala direta postal, segmentadas por ramo de atividade e com dados completos como razão social, telefone, email, endereço completo e ramo. Com um investimento baixo você terá acesso à milhares ou até milhões de novos potenciais clientes para o seu negócio, seja qual for o seu mercado!\r\n\r\nSão 7.500.000 de cadastros completos de empresas brasileiras. Acesse nosso site e confira agora! http://www.maladireta.biz\r\n\r\nObs: Não responda diretamente por este email. Para mais detalhes, acesse nosso site http://www.maladireta.biz\r\n\r\nObrigado pela atenção!\r\nEquipe MalaDireta.biz\r\nhttp://www.maladireta.biz\r\n\r\n\r\nObs: Caso não queira mais receber nossas propostas, por favor acesse o link http://www.inacfx.com.br/cancel/cancel.asp?id=nixvoip&mail=Grupobasso.com.br\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 'c', 'c', 'c', 'c', NULL);
INSERT INTO `contato` (`seqc`, `nome`, `cep`, `endereco`, `numero`, `apartamento`, `bloco`, `bairro`, `cidade`, `estado`, `tel_res`, `tel_cel`, `tel_com`, `email`, `dt_cad`, `obs`, `r_email`, `r_tel`, `r_fax`, `r_correio`, `data_cadastro`) VALUES (280, 'Aumente suas vendas divulgando pelo formulario de contato dos sites', 'suporte@goog', 'Guaicurus', 'www.googfx', NULL, NULL, 'Agua Branca', 'www.googfx.com.br', 'www.googfx', '', '11-84076492', '11-84076492', 'suporte@googfx.com.br', NULL, 'Ola Grupobasso, agora vc''s podem enviar divulgacao gratuitamente atraves da ferramenta GoogFX, acesse o site www.googfx.com.br, e baixe o programa, instale na sua maquina e envie apresentacoes como essa, enviada pelo formulario de contato e fale conosco da Grupobasso para todas as empresas dos segmentos que vc''s querem atingir, podendo tb segmentar seu publico alvo por regiao e ramos de atividade... \r\n\r\nPare de perder tempo com o email marketing e com spam , listas prontas que nao dao resultado. \r\n\r\natt \r\nEquipe GoogFX (produto patenteado) \r\nDanilo (desenvolvedor) \r\n11-84076492 \r\nmsn: danilogaglioti@live.com \r\ndownload: www.googfx.com.br\r\n', 'c', 'c', 'c', 'c', NULL);
