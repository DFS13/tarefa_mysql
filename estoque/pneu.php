
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="pneu.css">
</head>

<body>

    <h1>Adicionar Produto</h1>
    <form method="post" action="salvar.php">
        <label for="aro">Aro:</label>
        <select name="aro" id="aro" required>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
        </select>

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" required>

        <label for="marca">Marca:</label>
        <select name="marca" id="marca" required>
            <option value="Pirelli">Pirelli</option>
            <option value="Michelin">Michelin</option>
            <option value="Bridgestone">Bridgestone</option>
        </select>

        <label for="preco">Preço:</label>
        <input type="number" step="0.01" name="preco" required>

        <input type="submit" value="Adicionar"><br><br>
        <li><a href="princi.php">VOLTAR</a></li>
    </form>
</body>

</html>

