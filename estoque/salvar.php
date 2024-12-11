<?php
// Conexão com o banco de dados (ajuste com suas credenciais)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "autenticacao";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Função para verificar e corrigir o preço
function corrigirPreco($aro, $marca, $precoInformado, $conn) {
    // Consulta a tabela de pneus para obter o preço correto baseado no aro e marca
    $sql = "SELECT preco FROM pneus WHERE aro = ? AND marca = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $aro, $marca);
    $stmt->execute();
    $result = $stmt->get_result();

    // Se encontrar o preço correto
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $precoCorreto = $row['preco'];
        
        // Se o preço informado for diferente do preço correto, corrige
        if (abs($precoInformado - $precoCorreto) > 0.01) {
            return $precoCorreto;
        }
    }

    // Se não houver necessidade de correção, retorna o preço informado
    return $precoInformado;
}

// Coleta os dados do formulário
$aro = $_POST['aro'];
$quantidade = $_POST['quantidade'];
$marca = $_POST['marca'];
$preco = $_POST['preco'];

// Corrige o preço com base na tabela de pneus
$precoCorrigido = corrigirPreco($aro, $marca, $preco, $conn);

// Insere o produto na tabela 'produtos'
$sql = "INSERT INTO produtos (aro, quantidade, marca, preco) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iisd", $aro, $quantidade, $marca, $precoCorrigido);

if ($stmt->execute()) {
    echo "Produto adicionado com sucesso! Preço corrigido para: " . number_format($precoCorrigido, 2, ',', '.');
} else {
    echo "Erro ao adicionar o produto: " . $conn->error;
}

$conn->close();
header('Location: princi.php');
exit();
?>
