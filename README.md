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
CREATE DATABASE retrobeat;
USE retrobeat;

-- Tabela de administradores
CREATE TABLE admins (
  id INT(11) NOT NULL AUTO_INCREMENT,
  usuario VARCHAR(50) NOT NULL,
  senha VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY usuario (usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de produtos
CREATE TABLE produtos (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  descricao TEXT DEFAULT NULL,
  preco DECIMAL(10,2) NOT NULL,
  categoria ENUM('MPB','Rock','Pop','Jazz') NOT NULL,
  imagem VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
---
## 🎓 Colaboradores

* Ana Beatriz Linhares  
* Daniel de Lima  
* Kauã Victor Marinho  
* Stephany Lima
