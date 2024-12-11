<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="princi.css">
</head>
<?php
   require 'bd.php';     // Arquivo de conexão
   require 'consulta.php'; // Arquivo que faz a consulta dos produtos

   // Agregar as quantidades por marca e aro
   $produtosAgrupados = [];

   foreach ($produtos as $produto) {
       // Chave única composta por marca e aro
       $key = $produto['marca'] . ' - Aro ' . $produto['aro'];

       // Se a chave já existir, soma a quantidade
       if (isset($produtosAgrupados[$key])) {
           $produtosAgrupados[$key] += $produto['quantidade'];
       } else {
           // Caso contrário, cria a chave com a quantidade inicial
           $produtosAgrupados[$key] = $produto['quantidade'];
       }
   }

   // Agora temos os dados agrupados
   $nomesAgrupados = array_keys($produtosAgrupados);  // Nomes de marca e aro
   $quantidadesAgrupadas = array_values($produtosAgrupados);  // Quantidades somadas
?>
<body>
    <h1>Gestão de Inventário</h1>
    <nav>
        <ul>
            <li><a href="pneu.php">Adicionar Produto</a></li>
            <li><a href="index.html">Logout</a></li>
        </ul>
    </nav>

    <h2>Produtos no Inventário</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Aro</th>
                <th>Quantidade</th>
                <th>Marca</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= htmlspecialchars($produto['id']) ?></td>
                    <td><?= htmlspecialchars($produto['aro']) ?></td>
                    <td><?= htmlspecialchars($produto['quantidade']) ?></td>
                    <td><?= htmlspecialchars($produto['marca']) ?></td>
                    <td><?= htmlspecialchars($produto['preco']) ?></td>
                    <td>
                        <a href="editar.php?id=<?= $produto['id'] ?>">Editar</a> |
                        <a href="excluir.php?id=<?= $produto['id'] ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <h2>Gráfico de Quantidade de Produtos</h2>
    <canvas id="graficoProdutos" width="400" height="200"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('graficoProdutos').getContext('2d');
        
        // Dados agrupados
        const nomes = <?= json_encode($nomesAgrupados) ?>;  // Nomes das marcas e aros
        const quantidades = <?= json_encode($quantidadesAgrupadas) ?>;  // Quantidades agrupadas

        new Chart(ctx, {
            type: 'bar',  // Tipo de gráfico
            data: {
                labels: nomes,  // Nomes dos produtos agrupados como rótulos
                datasets: [{
                    label: 'Quantidade de Produtos',  // Título do gráfico
                    data: quantidades,  // Quantidades somadas
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',  // Cor das barras
                }]
            }
        });
    </script>
</body>
</html>



