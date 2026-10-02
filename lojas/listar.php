<?php
// lojas/listar.php

require_once __DIR__ . "/../src/loja_crud.php";

// CORRIGIDO: A variável $conexao já vem pronta do conecta.php, não precisa chamar função!
$lojas = buscarLojas($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lojas - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'lojas';
    require __DIR__ . '/../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Lojas</h2>
        <p>Ao excluir uma loja, seus vínculos e estoques por produto também serão removidos. Os produtos continuarão cadastrados.</p>
        <div class="barra-acoes"><a class="botao" href="inserir.php">+ Nova loja</a></div>
        <!-- Os registros serão carregados dinamicamente quando o back-end for implementado. -->
        <div class="area-tabela" tabindex="0">
            <table>
                <caption>Relação de Lojas</caption>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($lojas): ?>
                        <?php foreach ($lojas as $loja): ?>
                            <tr>
                                <td><?= (int) $loja['id'] ?></td>
                                <td><?= htmlspecialchars($loja['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td>
                                    <a href="editar.php?id=<?= (int) $loja['id'] ?>">Editar</a>
                                    <a href="excluir.php?id=<?= (int) $loja['id'] ?>" class="excluir">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">Nenhuma loja cadastrada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>