<?php
require 'config.inc.php';

$id = $_GET['id'] ?? 0;

$sql = "SELECT * FROM produtos WHERE id=?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$produto = $result->fetch_assoc();

if (!$produto) {
    echo "<p style='color:red;'>Produto não encontrado.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $imagem = $produto['imagem'];

    if (!empty($_FILES['imagem']['name'])) {
        $pasta = 'uploads/produtos/';
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
                if ($produto['imagem'] && file_exists($produto['imagem'])) {
                    unlink($produto['imagem']);
                }
                $imagem = $caminhoCompleto;
            } else {
                echo "<p style='color:red;'>❌ Erro ao fazer upload da imagem!</p>";
            }
        } else {
            echo "<p style='color:red;'>❌ Tipo de arquivo inválido! Envie JPG, PNG ou GIF.</p>";
        }
    }

    $sql = "UPDATE produtos SET nome=?, descricao=?, preco=?, categoria=?, imagem=? WHERE id=?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssdssi", $nome, $descricao, $preco, $categoria, $imagem, $id);
    $stmt->execute();

    echo "<p style='color:green;'>✅ Produto atualizado com sucesso!</p>";

    $produto['nome'] = $nome;
    $produto['descricao'] = $descricao;
    $produto['preco'] = $preco;
    $produto['categoria'] = $categoria;
    $produto['imagem'] = $imagem;
}
?>

<div class="formulario">
    <h2>Editar Produto</h2>
    <form method="post" enctype="multipart/form-data">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required><br><br>

        <label>Descrição:</label>
        <textarea name="descricao"><?= htmlspecialchars($produto['descricao']) ?></textarea><br><br>

        <label>Preço:</label>
        <input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>" required><br><br>

        <label>Categoria:</label>
        <select name="categoria" required>
            <?php
            $categorias = ['Espetinhos', 'Bebidas', 'Petiscos', 'Caldinhos'];
            foreach ($categorias as $cat) {
                $selected = ($cat == $produto['categoria']) ? 'selected' : '';
                echo "<option $selected>$cat</option>";
            }
            ?>
        </select><br><br>

        <?php if ($produto['imagem']): ?>
            <p>Imagem atual:</p>
            <img src="<?= $produto['imagem'] ?>" width="150" alt="Imagem do produto"><br><br>
        <?php endif; ?>

        <label>Trocar imagem:</label>
        <input type="file" name="imagem" accept="image/*"><br><br>

        <button type="submit">Salvar Alterações</button>
    </form>
</div>
