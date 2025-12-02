<?php
require 'config.inc.php'; // inicia sessão
include 'auth.php';       // verifica login


// Total de produtos
$sqlProdutos = "SELECT COUNT(*) AS total FROM produtos";
$resultProdutos = mysqli_query($conexao, $sqlProdutos);
$totalProdutos = mysqli_fetch_assoc($resultProdutos)['total'];

// Produtos por categoria
$sqlCategorias = "SELECT categoria, COUNT(*) AS qtd FROM produtos GROUP BY categoria";
$resultCategorias = mysqli_query($conexao, $sqlCategorias);

$categorias = [];
$quantidades = [];

while ($row = mysqli_fetch_assoc($resultCategorias)) {
    $categorias[] = $row['categoria'];
    $quantidades[] = $row['qtd'];
}
?>

<h2 style="color:#8C6B42; display:flex; align-items:center; gap:6px;">
    Visão Geral
</h2>


<div style="
    display:flex;
    justify-content:center;
    align-items:flex-start;
    gap:20px;
    flex-wrap:wrap;
    margin-top:30px;
    width:100%;
">


    <div style="
        flex:1;
        min-width:400px;
        max-width:50%;
        background:white;
        padding:20px;
        border-radius:12px;
        box-shadow:0 4px 10px rgba(0,0,0,0.1);
    ">
        <canvas id="graficoTotal" style="width:100%; height:300px;"></canvas>
    </div>

    
    <div style="
        flex:1;
        min-width:400px;
        max-width:50%;
        background:white;
        padding:20px;
        border-radius:12px;
        box-shadow:0 4px 10px rgba(0,0,0,0.1);
    ">
        <canvas id="graficoCategorias" style="width:100%; height:300px;"></canvas>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// GRÁFICO — TOTAL DE PRODUTOS
const totalCtx = document.getElementById('graficoTotal').getContext('2d');
new Chart(totalCtx, {
    type: 'bar',
    data: {
        labels: ['Total de Produtos'],
        datasets: [{
            data: [<?= $totalProdutos ?>],
            backgroundColor: ['#8C6B42'],
            borderColor: ['#6A512F'],
            borderWidth: 2
        }]
    },
    options: {
        plugins: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Total de Produtos',
                color: '#8C6B42',
                font: { size: 16, weight: 'bold' }
            }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});

// GRÁFICO — PRODUTOS POR CATEGORIA
const catCtx = document.getElementById('graficoCategorias').getContext('2d');

new Chart(catCtx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($categorias) ?>,
        datasets: [{
            label: 'Produtos por categoria',
            data: <?= json_encode($quantidades) ?>,
            backgroundColor: [
                '#8C6B42', '#9B7A53', '#B89870', '#6A512F'
            ],
            borderColor: '#6A512F',
            borderWidth: 2
        }]
    },
    options: {
        plugins: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Distribuição por Categoria',
                color: '#8C6B42',
                font: { size: 16, weight: 'bold' }
            }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>
