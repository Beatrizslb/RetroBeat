<?php
require 'config.inc.php';
include 'auth.php';

if (!isset($_GET['id'])) {
    die("ID do produto não informado.");
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM produtos WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$produto = $resultado->fetch_assoc();

if (!$produto) {
    die("Produto não encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $imagem = $produto['imagem'];

    $pasta = 'uploads/produtos/';

    if (!empty($_FILES['imagem']['name'])) {

        $nomeArquivo = basename($_FILES['imagem']['name']);
        $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
        $novoNome = uniqid('produto_', true) . '.' . $extensao;
        $caminhoCompleto = $pasta . $novoNome;
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

    $sqlUpdate = "UPDATE produtos SET nome = ?, descricao = ?, preco = ?, categoria = ?, imagem = ? WHERE id = ?";
    $stmtUpdate = $conexao->prepare($sqlUpdate);
    $stmtUpdate->bind_param("ssdssi", $nome, $descricao, $preco, $categoria, $imagem, $id);
    $stmtUpdate->execute();

    echo "<p class='mensagem-sucesso'>✅ Produto atualizado com sucesso!</p>";

    $produto['nome'] = $nome;
    $produto['descricao'] = $descricao;
    $produto['preco'] = $preco;
    $produto['categoria'] = $categoria;
    $produto['imagem'] = $imagem;
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
  width: 460px;
  max-width: calc(100% - 40px);
  margin: 50px auto;
  background-color: var(--bg-form);
  padding: 32px;
  border-radius: 16px;
  box-shadow: 0 10px 18px rgba(0,0,0,0.15);
  animation: fadeIn 0.4s ease;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.formulario h2 {
  text-align: center;
  margin-bottom: 22px;
  color: var(--marrom-escuro);
  font-size: 1.6rem;
  font-weight: 600;
}

.formulario label {
  font-weight: 500;
  color: var(--marrom-escuro);
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
  margin-bottom: 16px;
  font-size: 0.95rem;
  background: #fbfbfb;
  transition: 0.25s ease;
}

.formulario input:focus,
.formulario textarea:focus,
.formulario select:focus {
  outline: none;
  border-color: var(--marrom-medio);
  box-shadow: 0 4px 12px rgba(140,107,66,0.25);
}

.formulario button {
  width: 100%;
  background-color: var(--marrom-escuro);
  color: white;
  border: none;
  padding: 12px;
  margin-top: 10px;
  border-radius: 12px;
  cursor: pointer;
  font-weight: 600;
  font-size: 1rem;
  transition: 0.15s;
}

.formulario button:hover {
  background-color: var(--acento);
  color: black;
  transform: translateY(-2px);
}

.mensagem-sucesso {
  color: #1b7a3b;
  font-weight: bold;
  text-align: center;
  margin-bottom: 10px;
}

.mensagem-erro {
  color: #b30000;
  font-weight: bold;
  text-align: center;
  margin-bottom: 10px;
}

.imagem-atual {
  text-align: center;
  margin-bottom: 16px;
}
</style>

<div class="formulario">
    <h2>Editar Produto</h2>

    <form method="post" enctype="multipart/form-data">

        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $produto['nome']; ?>" required>

        <label>Descrição:</label>
        <textarea name="descricao"><?php echo $produto['descricao']; ?></textarea>

        <label>Preço:</label>
        <input type="number" min="0.0" step="0.01" name="preco" value="<?php echo $produto['preco']; ?>" required>

        <label>Categoria:</label>
        <select name="categoria" required>
            <option value="MPB" <?php if($produto['categoria']=='MPB') echo 'selected'; ?>>MPB</option>
            <option value="Rock" <?php if($produto['categoria']=='Rock') echo 'selected'; ?>>Rock</option>
            <option value="Pop"  <?php if($produto['categoria']=='Pop') echo 'selected'; ?>>Pop</option>
            <option value="Jazz" <?php if($produto['categoria']=='Jazz') echo 'selected'; ?>>Jazz</option>
        </select>

        <label>Foto atual:</label>
        <?php if (!empty($produto['imagem'])): ?>
            <div class="imagem-atual">
                <img src="<?php echo $produto['imagem']; ?>" width="160" style="border-radius: 10px;">
            </div>
        <?php endif; ?>

        <label>Enviar nova imagem (opcional):</label>
        <input type="file" name="imagem" accept="image/*">

        <button type="submit">Salvar alterações</button>
    </form>
</div>
