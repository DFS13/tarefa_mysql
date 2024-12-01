<?php
// Configurações do banco de dados
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'lista_tarefas';

// Conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = $_POST['task'];
    $taskdate = $_POST['taskdate'];

    // Insere a nova tarefa no banco de dados
    $sql = "INSERT INTO tarefas (descricao, data_criacao) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $task, $taskdate);
    if ($stmt->execute()) {
        // Redireciona para a página inicial após salvar a tarefa
        header('Location: tarefa.php');
        exit(); // Certifique-se de que o código PHP pare de ser executado após o redirecionamento
    } else {
        echo "Erro ao salvar a tarefa.";
    }

    $stmt->close();
}

$conn->close();
?>

