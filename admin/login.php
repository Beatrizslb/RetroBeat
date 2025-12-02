<?php 
session_start(); ?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Login - Administrador</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { height: 100%; }
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(180deg, #E5D0B1 0%, #8C6B42 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .formulario {
        width: 380px;
        background: rgba(242,242,242,0.95);
        border-radius: 14px;
        padding: 36px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.18);
        transition: 0.3s ease;
    }

    h1 {
        font-size: 22px;
        font-weight: 600;
        text-align: center;
        margin-bottom: 20px;
        color: #222;
    }

    label {
        display: block;
        font-weight: 500;
        margin-bottom: 8px;
        color: #111;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 12px 14px;
        border-radius: 8px;
        border: none;
        background: #dedede;
        margin-bottom: 18px;
        font-size: 15px;
        outline: none;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.6);
    }

    .btn {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 8px;
        background: #8C6B42;
        color: #fff;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: transform .12s ease, box-shadow .12s ease, opacity .12s ease;
        box-shadow: 0 4px 0 rgba(0,0,0,0.08);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        opacity: 0.98;
    }

    .erro {
        color: #ff4d4f;
        text-align: center;
        margin-top: 14px;
        font-weight: 500;
    }

    @media (max-width: 480px) {
        .formulario {
            width: 100%;
            padding: 26px;
            border-radius: 12px;
        }
        h1 { font-size: 20px; }
        .btn { font-size: 15px; }
    }

    /* CELULAR GRANDE / TABLET VERTICAL (481–768px) */
    @media (min-width: 481px) and (max-width: 768px) {
        .formulario {
            width: 70%;
            padding: 32px;
        }
        h1 { font-size: 24px; }
        .btn { font-size: 17px; }
    }

    @media (min-width: 769px) and (max-width: 1024px) {
        .formulario {
            width: 450px;
            padding: 40px;
        }
        h1 { font-size: 24px; }
    }
    </style>
</head>
<body>

    <div class="formulario">
        <form method="post" action="verifica_login.php">
            <h1>Login do Administrador</h1>

            <label>Usuário:</label>
            <input type="text" name="usuario" required>

            <label>Senha:</label>
            <input type="password" name="senha" required>

            <button type="submit" class="btn">Entrar</button>
        </form>

        <?php if (isset($_GET['erro'])): ?>
            <p class="erro">Usuário ou senha incorretos!</p>
        <?php endif; ?>
    </div>

</body>
</html>
