<?php
require 'config.inc.php';

$id = $_GET['id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['confirmar'] === 'Sim') {
        $sql = "DELETE FROM produtos WHERE id=?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo "<p>Produto excluído com sucesso!</p>";
    } else {
        echo "<p>Exclusão cancelada.</p>";
    }
} else {
    echo "<h2>Confirmar exclusão</h2>";
    echo "<form method='post'>";
    echo "<p>Deseja realmente excluir este produto?</p>";
    echo "<button type='submit' name='confirmar' value='Sim'>Sim</button>";
    echo "<button type='submit' name='confirmar' value='Não'>Não</button>";
    echo "</form>";
}
?>
