<?php
session_start();
include 'config.inc.php';

$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';

if (!$usuario || !$senha) {
    header("Location: login.php?erro=1");
    exit;
}


$sql = "SELECT * FROM admins WHERE usuario = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $admin = $result->fetch_assoc();
    if (password_verify($senha, $admin['senha'])) {
        $_SESSION['admin'] = $admin['usuario'];
        header("Location: index.php");
        exit;
    }
}


header("Location: login.php?erro=1");
exit;
?>
