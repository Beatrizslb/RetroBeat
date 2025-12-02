<?php
require 'config.inc.php';
include 'auth.php';

$id = $_GET['id'] ?? 0;
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

    body {
        font-family: "Poppins", sans-serif;
        background: #E5D0B1;
        margin: 0;
        padding: 0;
    }

    .card-excluir {
        max-width: 420px;
        margin: 60px auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 14px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        text-align: center;
        animation: fade 0.3s ease;
        font-family: "Poppins", sans-serif;
    }

    @keyframes fade {
        from {opacity: 0; transform: translateY(10px);}
        to {opacity: 1; transform: translateY(0);}
    }

    h2 {
        margin-top: 0;
        color: #5f3c23;
        font-size: 24px;
        font-weight: 600;
        font-family: "Poppins", sans-serif;
    }

    p {
        font-size: 16px;
        color: #3d2d23;
        font-family: "Poppins", sans-serif;
    }

    form {
        margin-top: 25px;
        font-family: "Poppins", sans-serif;
    }

    button {
        font-family: "Poppins", sans-serif;
        padding: 12px 25px;
        margin: 5px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-size: 15px;
        transition: 0.2s;
    }

    .btn-sim {
        background: #B6465F;
        color: white;
        box-shadow: 0 2px 6px rgba(182,70,95,0.5);
    }
    .btn-sim:hover {
        background: #9c3c52;
    }

    .btn-nao {
        background: #8E9775;
        color: white;
        box-shadow: 0 2px 6px rgba(142,151,117,0.5);
    }
    .btn-nao:hover {
        background: #788463;
    }

    .mensagem {
        max-width: 420px;
        margin: 40px auto;
        text-align: center;
        font-size: 18px;
        color: #5f3c23;
        font-family: "Poppins", sans-serif;
    }
</style>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    echo "<div class='mensagem'>";

    if ($_POST['confirmar'] === 'Sim') {

        $sql = "DELETE FROM produtos WHERE id=?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        echo "<p>✅ Produto excluído com sucesso!</p>";

    } else {
        echo "<p>❎ Exclusão cancelada.</p>";
    }

    echo "</div>";

} else {
    ?>
    <div class="card-excluir">
        <h2>Confirmar Exclusão</h2>
        <p>Deseja realmente excluir este produto?</p>

        <form method="post">
            <button type="submit" name="confirmar" value="Sim" class="btn-sim">Sim</button>
            <button type="submit" name="confirmar" value="Não" class="btn-nao">Não</button>
        </form>
    </div>
<?php
}
?>
