<?php
require_once "admin/config.inc.php";

$categorias = ['MPB', 'Rock', 'Pop', 'Jazz'];

foreach($categorias as $cat){
    echo "<h2 class='categoria-titulo'>".htmlspecialchars($cat)."</h2>";
    echo "<div class='produtos-container'>";

    $sql = "SELECT * FROM produtos WHERE categoria='$cat'";
    $resultado = mysqli_query($conexao, $sql);

    if(mysqli_num_rows($resultado) > 0){
        while($produto = mysqli_fetch_assoc($resultado)){
            $id = $produto['id'];
            $nome = htmlspecialchars($produto['nome']);
            $descricao = htmlspecialchars($produto['descricao']);
            $preco = "R$ ".number_format($produto['preco'], 2, ',', '.');
            $imagem = !empty($produto['imagem']) ? "admin/{$produto['imagem']}" : "admin/uploads/produtos/sem-imagem.png";

            echo "<div class='produto-card' onclick='abrirModal($id)'>";
            echo "<div class='produto-imagem'><img src='$imagem' alt='$nome'></div>";
            echo "<div class='produto-info'>";
            echo "<h3>$nome</h3>";
            echo "<p>$descricao</p>";
            echo "<span class='produto-preco'>$preco</span>";
            echo "</div>";
            echo "</div>";

            echo "<div id='modal-$id' class='modal'>
                    <div class='modal-content'>
                        <span class='close-modal' onclick='fecharModal($id)'>&times;</span>
                        <h3>$nome</h3>
                        <p>$descricao</p>
                        <span class='produto-preco'>$preco</span>
                    </div>
                  </div>";
        }
    } else {
        echo "<p class='nenhum-produto'>Nenhum produto nesta categoria.</p>";
    }

    echo "</div>";
}
?>

<script>
function abrirModal(id) {
    document.getElementById("modal-" + id).style.display = "block";
}

function fecharModal(id) {
    document.getElementById("modal-" + id).style.display = "none";
}

window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if(event.target == modal) {
            modal.style.display = "none";
        }
    });
}
</script>
