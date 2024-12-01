<?php
// Verifica se o ID foi passado via URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Configurações do banco de dados
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'lista_tarefas';
    $porta = '3306';

    // Conexão com o banco de dados
    $conn = new mysqli($host, $user, $password, $database);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Deleta a tarefa do banco de dados
    $sql = "DELETE FROM tarefas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);  // "i" significa que o parâmetro é um inteiro
    if ($stmt->execute()) {
        // Redireciona de volta para a página principal após excluir a tarefa
        header('Location: tarefa.php');
        exit(); // Evita que o código continue após o redirecionamento
    } else {
        echo "Erro ao remover a tarefa.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID da tarefa não fornecido.";
}
?>


