<?php
require 'config.inc.php';
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');


body {
    font-family: "Poppins", sans-serif;
    background: #f1e9deff;
    margin: 0;
    padding: 0;
}


h2 {
    font-size: 28px;
    color: #5f3c23;
    margin-bottom: 20px;
    font-weight: 600;
    text-align: center;
}


.add-btn {
    display: inline-block;
    padding: 10px 18px;
    background: #6b9347ff;
    color: white;
    text-decoration: none;
    border-radius: 10px;
    font-weight: 500;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    transition: .2s;
}
.add-btn:hover {
    background: #3f932eff;
}


.lista-produtos {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
    padding: 0 20px 40px 20px;
    margin-top: 25px;
    justify-items: center;
}


.prod-card {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    width: 100%;
    max-width: 300px;
}

.prod-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
}


.prod-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    display: block;
    transition: 0.3s ease;
}

.prod-card:hover img {
    transform: scale(1.05);
}


.sem-foto {
    width: 100%;
    height: 180px;
    background: #d9c7a6;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #5f3c23;
    font-weight: 500;
    font-size: 18px;
    border-radius: 12px;
}


.prod-card strong {
    color: #732E08;
    font-size: 1.2rem;
    margin-top: 10px;
    display: block;
    text-align: center;
}


.prod-card .categoria {
    color: #732E08;
    font-size: 0.9rem;
    text-align: center;
    margin-top: -5px;
    opacity: 0.8;
}


.prod-card em {
    color: #555;
    font-size: 0.95rem;
    display: block;
    margin: 10px auto;
    text-align: center;
    min-height: 40px;
}


.preco {
    text-align: center;
    margin-bottom: 15px;
}

.preco span {
    padding: 8px 15px;
    background-color: #DAAA50;
    color: #000;
    font-weight: 600;
    border-radius: 50px;
    font-size: 1rem;
    transition: background 0.3s;
}
.preco span:hover {
    background-color: #732E08;
    color: #fff;
}


.prod-card-buttons {
    text-align: center;
    margin-bottom: 18px;
}

.action-btn {
    padding: 7px 12px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    color: white;
    margin: 5px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    transition: .2s;
    display: inline-block;
}


.edit-btn {
    background: #6b9347ff;
}
.edit-btn:hover {
    background: #3f932eff;
}


.delete-btn {
    background: #B6465F;
    font-family: "Poppins", sans-serif;
}
.delete-btn:hover {
    background: #9c3c52;
}

</style>

<h2>Lista de Produtos</h2>
<p style="text-align:center;">
    <a href='?pg=produtos-cadastrar' class="add-btn">+ Adicionar Novo Produto</a>
</p>

<?php
$sql = "SELECT * FROM produtos ORDER BY categoria, nome";
$result = mysqli_query($conexao, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<div class='lista-produtos'>";

    while ($dados = mysqli_fetch_assoc($result)) {

        echo "<div class='prod-card'>";

        if (!empty($dados['imagem']) && file_exists($dados['imagem'])) {
            echo "<img src='{$dados['imagem']}' alt='Imagem do produto'>";
        } else {
            echo "<div class='sem-foto'>Sem foto</div>";
        }

        echo "<strong>{$dados['nome']}</strong>";
        echo "<div class='categoria'>({$dados['categoria']})</div>";
        echo "<em>{$dados['descricao']}</em>";

        echo "<div class='preco'><span>R$ " . number_format($dados['preco'], 2, ',', '.') . "</span></div>";

        echo "<div class='prod-card-buttons'>";
        echo "<a class='action-btn edit-btn' href='?pg=produtos-editar&id={$dados['id']}'>Editar</a>";
        echo "<a class='action-btn delete-btn' href='?pg=produtos-excluir&id={$dados['id']}'>Excluir</a>";
        echo "</div>";

        echo "</div>";
    }

    echo "</div>";
} else {
    echo "<p style='text-align:center;font-weight:bold;color:#732E08;'>Nenhum produto cadastrado ainda.</p>";
}
?>
