<?php
require 'config.inc.php';

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
            // Cria a pasta se não existir
            if (!is_dir($pasta)) {
                mkdir($pasta, 0777, true);
            }

            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoCompleto)) {
                $imagem = $caminhoCompleto;
            } else {
                echo "<p style='color:red;'>❌ Erro ao fazer upload da imagem!</p>";
            }
        } else {
            echo "<p style='color:red;'>❌ Tipo de arquivo inválido! Envie JPG, PNG ou GIF.</p>";
        }
    }

    $sql = "INSERT INTO produtos (nome, descricao, preco, categoria, imagem) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssdss", $nome, $descricao, $preco, $categoria, $imagem);
    $stmt->execute();

    echo "<p style='color:green;'>✅ Produto cadastrado com sucesso!</p>";
}
?>

<div class="formulario">
    <h2>Cadastrar Produto</h2>
    <form method="post" enctype="multipart/form-data">
        Nome: <input type="text" name="nome" required><br><br>
        Descrição: <textarea name="descricao"></textarea><br><br>
        Preço: <input type="number" min="0.0" step="0.01" name="preco" required><br><br>

        Categoria:
        <select name="categoria" required>
            <option value="">Selecione</option>
            <option value="MPB">MPB</option>
            <option value="Rock">Rock</option>
            <option value="Pop">Pop</option>
            <option value="Jazz">Jazz</option>
        </select><br><br>

        Foto do Produto:
        <input type="file" name="imagem" accept="image/*"><br><br>

        <button type="submit">Salvar</button>
    </form>
</div>
