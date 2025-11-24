<?php 
session_start(); ?>
  <!doctype html>
  <html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Login - Administrador</title>
  </head>
  <body>
    <div class="formulario">
      <form method="post" action="verifica_login.php">
        <h1>Login do Administrador</h1>
        <label>Usuário:</label><br>
        <input type="text" name="usuario" required><br><br>
        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>
        <button type="submit" class="btn">Entrar</button>
      </form>
    </div>
    <?php if (isset($_GET['erro'])): ?>
      <p style="color:red;">Usuário ou senha incorretos!</p>
    <?php endif; ?>
  </body>
  </html>
