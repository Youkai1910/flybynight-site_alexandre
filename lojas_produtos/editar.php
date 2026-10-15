<?php

require_once "../src/loja_produto_crud.php";
 $lojas_protudos = buscarLojasProdutos($conexao);
 

<<<<<<< Updated upstream
$lojaIdAntiga = filter_input(INPUT_GET, 'loja_id', FILTER_VALIDATE_INT);
$produtoIdAntigo = filter_input(INPUT_GET, 'produto_id', FILTER_VALIDATE_INT);

$lojas = buscarLojas($conexao);
$produtos = buscarProdutos($conexao);
$lojas_produtos = buscarLojasProdutosPorId($conexao, $lojaIdAntiga, $produtoIdAntigo);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $lojaIdNova = (int)$_POST['loja'];
    $produtoIdNovo = (int)$_POST['produto'];
    $estoque = (int)$_POST['estoque'];

    atualizarLojasProdutos($conexao, $lojaIdAntiga, $produtoIdAntigo, $lojaIdNova, $produtoIdNovo, $estoque);
    header("Location: listar.php");
    exit;
}
=======
>>>>>>> Stashed changes
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar produto em uma loja - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'lojas_produtos';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Editar produto em uma loja</h2>
<<<<<<< Updated upstream

        <!-- Mantém os IDs originais na URL para o processo de atualização (POST) saber quem alterar -->
        <form action="editar.php?loja_id=<?= $lojaIdAntiga ?>&produto_id=<?= $produtoIdAntigo ?>" method="post">

=======
        <!-- Modelo visual: os campos não são enviados nem persistidos. -->
        <!-- Os campos serão preenchidos com os dados do registro selecionado. -->
        <form action="" method="post">
            
>>>>>>> Stashed changes
            <div>
                <label for="loja">Loja:</label>
                <select name="loja" id="loja" required>
                    <option value="">Selecione</option>
<<<<<<< Updated upstream
                    <?php foreach ($lojas as $loja): ?>
                        <!-- 3. Programar a exibição e fazer a loja vir selecionada -->
                        <option value="<?= $loja['id'] ?>" <?= $loja['id'] == $lojas_produtos['loja_id'] ? 'selected' : '' ?>>
                            <?= $loja['nome'] ?>
                        </option>
                    <?php endforeach; ?>
=======
                    <!-- As opções serão preenchidas com os registros do banco de dados. -->
                     <?php foreach ($lojas_protudos as $loja_produto):?> 
                        <option <?= $loja_produto['$loja_id'] ? 'selected' : '' ?> value=""></option>
                        <?php endforeach; ?>
>>>>>>> Stashed changes
                </select>
            </div>

            <div>
                <label for="produto">Produto:</label>
                <select name="produto" id="produto" required>
                    <option value="">Selecione</option>
<<<<<<< Updated upstream
                    <?php foreach ($produtos as $produto): ?>
                        <!-- 3. Programar a exibição e fazer o produto vir selecionado -->
                        <option value="<?= $produto['id'] ?>" <?= $produto['id'] == $lojas_produtos['produto_id'] ? 'selected' : '' ?>>
                            <?= $produto['nome_produto'] ?>
                        </option>
                    <?php endforeach; ?>
=======
                    <!-- As opções serão preenchidas com os registros do banco de dados. -->
                     <?php foreach ($lojas_protudos as $loja_produto):?> 
                        <option <?= $loja_produto['$produto_id'] ? 'selected' : '' ?> value="<?= $produto[id] ?>"></option>
                        <?php endforeach; ?>
                     
>>>>>>> Stashed changes
                </select>
            </div>
            <div>
                <label for="estoque">Estoque:</label>
                <input type="number" name="estoque" id="estoque" min="0" step="1"
<<<<<<< Updated upstream
                    value="<?= $lojas_produtos['estoque'] ?>" required>
=======
                    value="" required>
>>>>>>> Stashed changes
            </div>
            <button type="submit">Atualizar</button>
        </form>
        <a href="listar.php">← Voltar</a>
    </main>
</body>

</html>
