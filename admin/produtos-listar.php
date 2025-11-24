<?php
require 'config.inc.php';

echo "<h2>Lista de Produtos</h2>";
echo "<p><a href='?pg=produtos-cadastrar'>Adicionar Novo Produto</a></p>";

$sql = "SELECT * FROM produtos ORDER BY categoria, nome";
$result = mysqli_query($conexao, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($dados = mysqli_fetch_assoc($result)) {

        echo "<div>";

        if (!empty($dados['imagem']) && file_exists($dados['imagem'])) {
            echo "<img src='{$dados['imagem']}' alt='Imagem do produto'>";
        } else {
            echo "<div>Sem foto</div>";
        }

        echo "<div>";
        echo "<strong>{$dados['nome']}</strong> ({$dados['categoria']})<br>";
        echo "Preço: R$ " . number_format($dados['preco'], 2, ',', '.') . "<br>";
        echo "<a href='?pg=produtos-editar&id={$dados['id']}'>Editar</a> | ";
        echo "<a href='?pg=produtos-excluir&id={$dados['id']}'>Excluir</a>";
        echo "</div>";

        echo "</div><hr>";
    }
} else {
    echo "<p>Nenhum produto cadastrado ainda.</p>";
}
?>
