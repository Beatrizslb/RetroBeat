<head>
    <meta charset="UTF-8">
    <title>Retrobeat</title>
    <link rel="stylesheet" href="retrobeat.css">
</head>

<link rel="stylesheet" href="assets/css/global.css">
<header>
    
    <div class="logo">Retrobit</div>

    <div class="toggle">☰</div>

    <nav class="menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="?pg=produtos">Produtos</a></li>
            <li><a href="?pg=quemsomos">Quem somos</a></li>
            <li><a href="?pg=faleconosco">Contato</a></li>
        </ul>
    </nav>
    <script>
    const toggle = document.querySelector(".toggle");
    const menu = document.querySelector(".menu");

    toggle.addEventListener("click", () => {
        menu.classList.toggle("ativo");
    });
    </script>
</header>
