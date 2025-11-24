<?php
include 'auth.php'; 
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta charset="utf-8">
<title>Painel Administrativo</title>
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
