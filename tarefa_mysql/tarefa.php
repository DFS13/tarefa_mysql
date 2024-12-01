<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="todo.css">
</head>

<body>
    <h1>Lista de Tarefas</h1>
    <!-- Formulário para adicionar tarefa -->
    <form action="salvar_tarefa.php" method="POST">
        <input type="text" name="task" id="taskInput" placeholder="Digite sua tarefa..." required>
        <input type="date" name="taskdate" id="taskdate" required>
        <button type="submit">Adicionar Tarefa</button>
    </form>

    <ul id="taskList">
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

        // Consulta para selecionar todas as tarefas
        $sql = "SELECT id, descricao, data_criacao FROM tarefas";
        $result = $conn->query($sql);

        // Verifica se há tarefas no banco de dados
        if ($result->num_rows > 0) {
            // Exibe as tarefas
            while ($row = $result->fetch_assoc()) {
                echo "<li data-id='{$row['id']}'>";
                echo "{$row['descricao']} (Criada em: {$row['data_criacao']}) ";
                echo "<a href='remover.php?id={$row['id']}' class='removeTaskButton'>Remover</a>";
                echo "</li>";
            }
        } else {
            // Se não houver tarefas
            echo "<li>Nenhuma tarefa encontrada.</li>";
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
        ?>
    </ul>
</body>

</html>