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
CREATE DATABASE IF NOT EXISTS retrobeat
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE retrobeat;

CREATE TABLE IF NOT EXISTS admins (
    id INT(11) NOT NULL AUTO_INCREMENT,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS produtos (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT DEFAULT NULL,
    preco DECIMAL(10,2) NOT NULL,
    categoria ENUM('MPB','Rock','Pop','Jazz') NOT NULL,
    imagem VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO admins (usuario, senha) VALUES
('admin', '$2y$10$WYpYvia8vj40AKfOHC4ULOw2J/2B25X4wNVV1rAbT7h7kcp/ndWtK');

INSERT INTO produtos (nome, descricao, preco, categoria, imagem) VALUES
('The Tortured Poets Departament', 'Um disco de vinil', 200.00, 'Pop', 'uploads/produtos/produto_1.jpg'),
('Elis Regina – Elis (1972)', 'A intensidade vocal de Elis no auge.', 149.90, 'MPB', 'uploads/produtos/produto_2.jpg'),
('Pink Floyd – The Dark Side of the Moon (1973)', 'Experiência sonora imersiva e atemporal.', 199.90, 'Rock', 'uploads/produtos/produto_3.jpg'),
('Dua Lipa – Future Nostalgia (2020)', 'Pop dançante com estética retrô e hits marcantes.', 199.90, 'Pop', 'uploads/produtos/produto_4.png'),
('Milton Nascimento – Clube da Esquina (1972)', 'Sonoridade única que marcou gerações.', 179.90, 'MPB', 'uploads/produtos/produto_5.jpg');

---
## 🎓 Colaboradores

* Ana Beatriz Linhares  
* Daniel de Lima  
* Kauã Victor Marinho  
* Stephany Lima
