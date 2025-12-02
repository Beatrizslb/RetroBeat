<?php
require 'config.inc.php'; // inicia sessão
include 'auth.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $imagem = null;

    $pasta = 'uploads/produtos/';

    // Upload da imagem
    if (!empty($_FILES['imagem']['name'])) {
        $nomeArquivo = basename($_FILES['imagem']['name']);
        $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));

        $novoNome = uniqid('produto_', true) . '.' . $extensao;
        $caminhoCompleto = $pasta . $novoNome;

        // Verifica se é uma imagem válida
        $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($extensao, $tiposPermitidos)) {

            if (!is_dir($pasta)) {
                mkdir($pasta, 0777, true);
            }

            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoCompleto)) {
                $imagem = $caminhoCompleto;
            } else {
                echo "<p class='mensagem-erro'>❌ Erro ao fazer upload da imagem!</p>";
            }
        } else {
            echo "<p class='mensagem-erro'>❌ Tipo de arquivo inválido! Envie JPG, PNG ou GIF.</p>";
        }
    }

    $sql = "INSERT INTO produtos (nome, descricao, preco, categoria, imagem) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssdss", $nome, $descricao, $preco, $categoria, $imagem);
    $stmt->execute();

    echo "<p class='mensagem-sucesso'>✅ Produto cadastrado com sucesso!</p>";
}
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

:root{
  --marrom-escuro: #732E08;
  --marrom-medio: #8C6B42;
  --acento: #DAAA50;
  --bg-form: #ffffff;
  --texto: #333333;
}

body {
  font-family: "Poppins", Arial, sans-serif;
}

.formulario {
  width: 420px;
  max-width: calc(100% - 40px);
  margin: 50px auto;
  background-color: var(--bg-form);
  padding: 28px;
  border-radius: 14px;
  box-shadow: 0 8px 16px rgba(0,0,0,0.15);
}

.formulario h2 {
  text-align: center;
  margin-bottom: 20px;
  color: var(--marrom-escuro);
  font-weight: 600;
}

.formulario input[type="text"],
.formulario input[type="number"],
.formulario input[type="file"],
.formulario select,
.formulario textarea {
  width: 100%;
  padding: 10px 12px;
  border-radius: 10px;
  border: 1px solid #d9d6d1;
  margin-top: 6px;
  font-size: 0.95rem;
  background: #fbfbfb;
  transition: 0.2s;
}

.formulario input:focus,
.formulario textarea:focus,
.formulario select:focus {
  outline: none;
  border-color: var(--marrom-medio);
  box-shadow: 0 4px 12px rgba(140,107,66,0.15);
}

.formulario button {
  width: 100%;
  background-color: var(--marrom-escuro);
  color: white;
  border: none;
  padding: 12px;
  margin-top: 20px;
  border-radius: 12px;
  cursor: pointer;
  font-weight: 600;
  font-size: 1rem;
  transition: 0.15s;
}

.formulario button:hover {
  background-color: var(--acento);
  color: black;
  transform: translateY(-1px);
}

.mensagem-sucesso {
  color: #1b7a3b;
  font-weight: bold;
  text-align: center;
  margin-top: 10px;
}

.mensagem-erro {
  color: #b30000;
  font-weight: bold;
  text-align: center;
  margin-top: 10px;
}
</style>


<div class="formulario">
    <h2>Cadastrar Produto</h2>

    <form method="post" enctype="multipart/form-data">

        <label>Nome:</label>
        <input type="text" name="nome" required>

        <label>Descrição:</label>
        <textarea name="descricao"></textarea>

        <label>Preço:</label>
        <input type="number" min="0.0" step="0.01" name="preco" required>

        <label>Categoria:</label>
        <select name="categoria" required>
            <option value="">Selecione</option>
            <option value="MPB">MPB</option>
            <option value="Rock">Rock</option>
            <option value="Pop">Pop</option>
            <option value="Jazz">Jazz</option>
        </select>

        <label>Foto do Produto:</label>
        <input type="file" name="imagem" accept="image/*">

        <button type="submit">Salvar</button>
    </form>
</div>
