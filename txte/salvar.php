<?php
// Conectar ao banco de dados
$host = 'localhost'; // ou o endereço do seu servidor MySQL
$user = 'root';      // seu usuário do MySQL
$password = '';      // sua senha do MySQL
$dbname = 'seu_banco'; // o nome do seu banco de dados

$conn = new mysqli($host, $user, $password, $dbname);

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aro = $_POST['aro'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];

    // Preparar e executar a inserção dos dados
    $stmt = $conn->prepare("INSERT INTO produtos (aro, quantidade, preco) VALUES (?, ?, ?)");
    $stmt->bind_param("iid", $aro, $quantidade, $preco); // 'i' para inteiro, 'd' para decimal

    if ($stmt->execute()) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro ao inserir dados: " . $stmt->error;
    }

    // Fechar a declaração e a conexão
    $stmt->close();
    $conn->close();
}
?>
