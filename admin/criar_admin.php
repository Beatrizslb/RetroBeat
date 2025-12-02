<!-- <?php
include 'config.inc.php';
//É importante que esse arquivo seja executado somente uma vez e depois seja comentado apenas para criar o admin
$usuario = 'admin';
$senha = password_hash('1234', PASSWORD_DEFAULT); // senha: 1234

$sql = "SELECT * FROM admins WHERE usuario = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // cria o admin
    $sql = "INSERT INTO admins (usuario, senha) VALUES (?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $usuario, $senha);
    $stmt->execute();
    echo "Administrador criado com sucesso!";
} else {
    echo "Administrador já existe!";
}
?> -->
