<?php
// produtos/listar.php
require_once "../src/loja_produto_crud.php";

$lojas_produtos = buscarLojasProdutos($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos por loja - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'lojas_produtos';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Produtos por loja</h2>
        <p>Gerencie os vínculos e o estoque de cada produto nas lojas. A exclusão remove somente o vínculo.</p>
        <div class="barra-acoes"><a class="botao" href="inserir.php">+ Novo vínculo</a></div>
        <!-- Os registros serão carregados dinamicamente quando o back-end for implementado. -->
        <div class="area-tabela" tabindex="0">
            <table>
                <caption>Relação de Produtos por loja</caption>
                <thead>
                    <tr>
                        <th scope="col">Loja</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Estoque</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aqui serão geradas as linhas com os dados e as ações Editar e Excluir de cada registro. -->
                    <?php
                    foreach ($lojas_produtos as $loja_produto): ?>
                    <tr>
                        <td> <?= $loja_produto['nome_loja'] ?> </td>
                        <td> <?= $loja_produto['nome_produto'] ?> </td>
                        <td> <?= $loja_produto['estoque'] ?> </td>
                        <td>
                            <a href="editar.php?loja_id=<?= $loja_produto['loja_id'] ?>&produto_id=<?= $loja_produto['produto_id'] ?>">Editar</a>
                            <a href="excluir.php?loja_id=<?= $loja_produto['loja_id'] ?>&produto_id=<?= $loja_produto['produto_id'] ?>" style="color: red;">Excluir</a>
                        </td>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>