# 💽 RetroBeat

**Descrição**

O site será um mostruário de vinil dividido em seções por estilo musical. Cada produto será exibido em cards contendo imagem, nome, descrição e valor.  
A página de administrador terá login de acesso restrito, permitindo que apenas administradores acessem essa área. Nessa parte será possível adicionar, editar e remover produtos do mostruário.

---

## 🧱 Tecnologias utilizadas

| Tecnologia       | Descrição                                                                 |
|------------------|---------------------------------------------------------------------------|
| **GitHub**       | Hospedagem e versionamento do projeto                                     |
| **Git**          | Controle de versão do código                                              |
| **PHP puro**     | Linguagem usada no backend                                                |
| **XAMPP**        | Servidor local que integra Apache, PHP e MySQL                            |
| **MySQL**        | Banco de dados utilizado para armazenar informações dos produtos          |
| **HTML**         | Estrutura das páginas do site                                             |
| **CSS**          | Estilização e layout do site                                              |
| **JavaScript**   | Interatividade e dinamismo nas páginas                                    |

---
## 🗄️ Banco de Dados

Abaixo está o script utilizado para criar o banco de dados e suas tabelas.  
Ele não inclui dados inseridos — apenas a estrutura necessária para o projeto funcionar.

---

### 📦 Script de Criação do Banco e Tabelas (SQL)

```sql
-- Banco de dados: `retrobeat` (resumido)

-- Tabela `admins`
CREATE TABLE `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
);

-- Dados principais
INSERT INTO `admins` (`usuario`, `senha`) VALUES
('admin', '$2y$10$WYpYvia8vj40AKfOHC4ULOw2J/2B25X4wNVV1rAbT7h7kcp/ndWtK');

-- Tabela `produtos`
CREATE TABLE `produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` text,
  `preco` decimal(10,2) NOT NULL,
  `categoria` enum('MPB','Rock','Pop','Jazz') NOT NULL,
  `imagem` varchar(255),
  PRIMARY KEY (`id`)
);

-- Alguns produtos de exemplo
INSERT INTO `produtos` (`nome`, `descricao`, `preco`, `categoria`, `imagem`) VALUES
('The Tortured Poets Departament', 'Um disco de vinil', 200.00, 'Pop', 'uploads/produtos/produto_692dbba7c92027.65252316.jpg'),
('Elis Regina – Elis (1972)', 'A intensidade vocal de Elis no auge.', 149.90, 'MPB', 'uploads/produtos/produto_692e4a41da5d24.31159878.jpg'),
('Pink Floyd – The Dark Side of the Moon (1973)', 'Experiência sonora imersiva e atemporal.', 199.90, 'Rock', 'uploads/produtos/produto_692e50ee27a745.52961720.jpg'),
('Dua Lipa – Future Nostalgia (2020)', 'Pop dançante com estética retrô e hits marcantes.', 199.90, 'Pop', 'uploads/produtos/produto_692e53544e9e83.43477080.png'),
('Taylor Swift - 1989', 'Pop moderno, brilhante e cheio de melodias cativantes.', 289.90, 'Pop', 'uploads/produtos/produto_692e537963ce08.85517824.jpg');
---
## 🎓 Colaboradores

* Ana Beatriz Linhares  
* Daniel de Lima  
* Kauã Victor Marinho  
* Stephany Lima
