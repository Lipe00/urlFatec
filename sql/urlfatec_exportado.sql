-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Out-2024 às 21:43
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `urlfatec`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `url`
--

CREATE TABLE `url` (
  `idURL` int(11) NOT NULL,
  `urlURL` text NOT NULL,
  `descricaoURL` text NOT NULL,
  `capaURL` varchar(200) NOT NULL,
  `categoriaURL` varchar(50) NOT NULL,
  `dataCadastroURL` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `url`
--

INSERT INTO `url` (`idURL`, `urlURL`, `descricaoURL`, `capaURL`, `categoriaURL`, `dataCadastroURL`) VALUES
(4, 'https://duckduckgo.com', 'Bom para fazer pesquisas, dá resultados melhores que o google', 'imagem_2024-10-22_154239303.png', 'Pesquisas', '2024-10-21'),
(5, 'https://github.com', 'O melhor site para hospedar seus projetos de programação!', 'github.png', 'Programação', '2024-10-21'),
(8, 'https://www.youtube.com', 'Um ótimo site para ver tutoriais de indianos !', 'imagem_2024-10-22_163453540.png', 'Tutoriais', '2024-10-22'),
(9, 'https://remixicon.com', 'Melhor site de ícones open source', 'imagem_2024-10-22_154518093.png', 'Programação', '2024-10-22');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `url`
--
ALTER TABLE `url`
  ADD PRIMARY KEY (`idURL`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `url`
--
ALTER TABLE `url`
  MODIFY `idURL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
