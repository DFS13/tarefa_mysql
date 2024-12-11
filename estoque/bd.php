<?php
$host = 'localhost';  // Endereço do banco de dados
$dbname = 'autenticacao';  // Nome do banco de dados
$username = 'root';  // Nome de usuário do banco de dados
$password = '';  // Senha do banco de dados
$porta = '3306';  // Porta do MySQL

try {
    // Criar a conexão com o banco de dados usando PDO
    $dsn = "mysql:host=$host;dbname=$dbname;port=$porta";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    exit;
}
?>
