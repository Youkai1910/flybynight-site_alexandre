<?php
// produtos/listar.php
require_once "../src/produto_crud.php";
$produtos = buscarProdutos($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'produtos';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Produtos</h2>
        <div class="barra-acoes"><a class="botao" href="inserir.php">+ Novo produto</a></div>
        <div class="area-tabela" tabindex="0">
            <table>
                <caption>Relação de Produtos</caption>
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Fornecedor</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($produtos) > 0): ?>
                        <?php foreach ($produtos as $produto): ?>
                            <tr>
                                <td><?= htmlspecialchars($produto['nome_produto'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td>R$ <?= number_format((float) $produto['preco'], 2, ',', '.') ?></td>
                                <td><?= (int) $produto['quantidade'] ?></td>
                                <td><?= htmlspecialchars($produto['nome_fornecedor'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><a href="editar.php?id=<?= (int) $produto['id'] ?>">Editar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Nenhum produto cadastrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>