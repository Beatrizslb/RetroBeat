<?php
require_once "admin/config.inc.php";
?>

<div class="page-container">

<?php
$categorias = ['MPB', 'Rock', 'Pop', 'Jazz'];

foreach ($categorias as $cat) {
    echo "<h2 class='categoria-titulo'>" . htmlspecialchars($cat) . "</h2>";
    echo "<div class='produtos-container'>";

    $sql = "SELECT * FROM produtos WHERE categoria='$cat'";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        while ($produto = mysqli_fetch_assoc($resultado)) {

            echo "<div class='produto-card'>";

            echo "<div class='produto-imagem'>";
            if (!empty($produto['imagem'])) {
                echo "<img src='admin/{$produto['imagem']}' alt='".htmlspecialchars($produto['nome'])."'>";
            } else {
                echo "<img src='admin/uploads/produtos/sem-imagem.png' alt='Sem imagem'>";
            }
            echo "</div>";

            echo "<div class='produto-info'>";
            echo "<h3>" . htmlspecialchars($produto['nome']) . "</h3>";
            echo "<p>" . htmlspecialchars($produto['descricao']) . "</p>";
            echo "<span class='produto-preco'>R$ " . number_format($produto['preco'], 2, ',', '.') . "</span>";
            echo "</div>";

            echo "</div>";
        }
    } else {
        echo "<p class='nenhum-produto'>Nenhum produto nesta categoria.</p>";
    }

    echo "</div>";
}
?>

</div>
