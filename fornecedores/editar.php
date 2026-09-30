<?php
//fornecedores/editar.php

// Importando o arquivo de funções para fornecedores
require_once "../src/fornecedor_crud.php";

//Acessar a URL e "pegar" o valor do parâmetro (id) existente nela
// ATENÇÃO ao nome do parâmetro que você criou no link dinâmico.
// Deve ser o mesmo
$id = $_GET['id'];

// 1) Chamamos a função e passamos o id para ela
// 2) Ao término, a função DEVOLVE (retorna) um array com os dados  do fornecdor
$fornecedor = buscarFornecedorPorId($conexao, $id);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar fornecedor - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'fornecedores';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Editar fornecedor</h2>
        <!-- Modelo visual: os campos não são enviados nem persistidos. -->
        <!-- Os campos serão preenchidos com os dados do registro selecionado. -->
        <form action="" method="post">
            <div>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" maxlength="100" required>
            </div>
            <button type="submit">Atualizar</button>
        </form>
        <a href="listar.php">← Voltar</a>
    </main>
</body>

</html>