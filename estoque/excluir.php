<?php
// Inicia a sessão (caso não tenha iniciado)
session_start();

// Verifica se o ID foi passado na URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtém o ID do produto a ser excluído
    $idProduto = $_GET['id'];

    // Conexão com o banco de dados (certifique-se de que o arquivo bd.php contém as credenciais corretas)
    require 'bd.php';

    // Preparar a consulta SQL para excluir o produto
    $sql = "DELETE FROM produtos WHERE id = :id";

    // Preparar a instrução SQL
    $stmt = $pdo->prepare($sql);

    // Bind do parâmetro
    $stmt->bindParam(':id', $idProduto, PDO::PARAM_INT);

    // Executar a consulta
    if ($stmt->execute()) {
        // Redirecionar para a página de inventário após a exclusão
        header("Location: princi.php"); // Altere "index.php" para o nome do arquivo de exibição de produtos
        exit();
    } else {
        // Caso ocorra algum erro, exibe uma mensagem
        echo "Erro ao excluir o produto.";
    }
} else {
    // Se não passar o ID na URL, exibe um erro
    echo "ID inválido.";
}


?>

