<?php
include 'auth.php'; 
?>
<style>
    /* Cor de fundo geral */
    body {
        background-color: #f1e9deff;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    /* Header — mesma cor dos gráficos (#8C6B42) */
    header {
        background: #8C6B42;
        padding: 5px;
        text-align: center;
        color: white;
        font-weight: bold;
    }

    /* NAV — um pouco mais escuro que o fundo */
    nav {
        background: #D1BA9A; /* tom mais escuro que #E5D0B1 */
        padding: 12px;
        display: flex;
        gap: 20px;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    }

    nav a {
        color: #5A4730;
        font-weight: bold;
        text-decoration: none;
        padding: 6px 12px;
        border-radius: 6px;
        transition: 0.2s;
    }

    nav a:hover {
        background: #C4AA87;
    }

    .logout {
        color: white;
        background: #971414ff;
    }

    .logout:hover {
        background: #b21e1eff;
    }

    main {
        padding: 30px;
    }
</style>

</head>
<body>

<header>
    <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['admin']) ?>!</h1>
</header>

<nav>
    <a href="index.php">Início</a>
    <a href="?pg=produtos-listar">Produtos</a>
    <a href="logout.php" class="logout">Sair</a>
</nav>

<main>
    <?php
        if (empty($_GET['pg'])) {
            $pg = 'dashboard'; 
        } else {
            $pg = str_replace('.php', '', $_GET['pg']);
        }

        $arquivo = $pg . '.php';

        if (file_exists($arquivo)) {
            include_once $arquivo;
        } else {
            echo "<p style='color:red;'>Página não encontrada: <b>$arquivo</b></p>";
        }
    ?>
</main>

</body>
</html>
