

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aro = $_POST['aro'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $db = conectar_db();
    $stmt = $db->prepare("INSERT INTO produtos (aro, quantidade, preco) VALUES (?, ?, ?)");
    $stmt->execute([$aro, $quantidade, $preco]);
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'templates/header.php'; ?>
<body>
    <h1>Adicionar Produto</h1>
    <form method="post">
        <label for="aro">Aro:</label>
        <select name="aro" id="aro" required>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
        </select>
        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" required>
        <label for="preco">Preço:</label>
        <input type="number" step="0.01" name="preco" required>
        <input type="submit" value="Adicionar">
    </form>
</body>
</html>
