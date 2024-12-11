<?php
// Inclui o arquivo de conexão
require 'bd.php';

try {
    // Consultar todos os produtos da tabela 'produtos'
    $stmt = $pdo->query("SELECT id, aro, quantidade, marca, preco FROM produtos");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao consultar produtos: " . $e->getMessage();
    exit;
}
?>
