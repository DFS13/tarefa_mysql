<?php
require 'bd.php';

// Verificar se o ID foi passado via URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar o produto pelo ID
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        echo "Produto não encontrado!";
        exit;
    }
} else {
    echo "ID não fornecido!";
    exit;
}

// Verificar se o formulário foi enviado para editar o produto
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber os dados do formulário
    $aro = $_POST['aro'];
    $quantidade = $_POST['quantidade'];
    $marca = $_POST['marca'];
    $preco = $_POST['preco'];

    // Atualizar os dados no banco de dados
    $stmt = $pdo->prepare("UPDATE produtos SET aro = :aro, quantidade = :quantidade, marca = :marca, preco = :preco WHERE id = :id");
    $stmt->bindParam(':aro', $aro);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':marca', $marca);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: princi.php"); // Redireciona para a página principal após salvar
        exit;
    } else {
        echo "Erro ao atualizar produto.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="editar.css">
</head>
<body>
    <h1>Editar Produto</h1>

    <form method="POST">
        <label for="aro">Aro:</label>
        <input type="text" id="aro" name="aro" value="<?= htmlspecialchars($produto['aro']) ?>" required><br>

        <label for="quantidade">Quantidade:</label>
        <input type="number" id="quantidade" name="quantidade" value="<?= htmlspecialchars($produto['quantidade']) ?>" required><br>

        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" value="<?= htmlspecialchars($produto['marca']) ?>" required><br>

        <label for="preco">Preço:</label>
        <input type="number" step="0.01" id="preco" name="preco" value="<?= htmlspecialchars($produto['preco']) ?>" required><br>

        <button type="submit">Salvar Alterações</button>
    </form>

    <a href="princi.php">Voltar</a>
</body>
</html>

