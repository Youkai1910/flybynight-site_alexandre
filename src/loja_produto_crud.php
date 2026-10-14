<?php
require_once "conecta.php";

function buscarLojasProdutos(PDO $conexao): array
{
$sql = "SELECT
            lojas_produtos.loja_id,
            lojas_produtos.produto_id,
            produtos.nome AS nome_produto,
            lojas_produtos.estoque,
            lojas.nome AS nome_loja
        FROM lojas_produtos JOIN lojas
        ON lojas.id = lojas_produtos.loja_id
        JOIN produtos ON produtos.id = lojas_produtos.produto_id
        ORDER BY nome_produto";
    $consulta = $conexao->query($sql);
    return $consulta->fetchAll();
}
function inserirLojaProduto(
    PDO $conexao,
    string $lojas,
    string $produtos,
    int $estoque   
): void{
    $sql = "INSERT INTO lojas_produtos (loja_id, produto_id, estoque)
            VALUES (:loja_id, :produto_id, :estoque)";
            
$consulta = $conexao->prepare($sql);

    $consulta->bindValue(':loja_id', $lojas);
    $consulta->bindValue(':produto_id', $produtos);
    $consulta->bindValue(':estoque', $estoque);

    $consulta->execute();
  
}

function buscarLojasProdutosPorId(PDO $conexao, int $loja_id, int $produto_id): array
{
    $sql = "SELECT * FROM lojas_produtos WHERE loja_id = :loja_id AND produto_id = :produto_id";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":loja_id", $loja_id);
    $consulta->bindValue(":produto_id", $produto_id);
    $consulta->execute();
    $resultado = $consulta->fetch();
    return $resultado ?: [];
}


function atualizarLojasProdutos(
    PDO $conexao,
    int $lojaIdAntiga,
    int $produtoIdAntigo,
    int $lojaIdNova,
    int $produtoIdNovo,
    int $estoque
): void {
    $sql = "UPDATE lojas_produtos
            SET loja_id = :loja_id_nova,
                produto_id = :produto_id_novo,
                estoque = :estoque
            WHERE loja_id = :loja_id_antiga
              AND produto_id = :produto_id_antigo";

    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":loja_id_nova", $lojaIdNova, PDO::PARAM_INT);
    $consulta->bindValue(":produto_id_novo", $produtoIdNovo, PDO::PARAM_INT);
    $consulta->bindValue(":estoque", $estoque, PDO::PARAM_INT);
    $consulta->bindValue(":loja_id_antiga", $lojaIdAntiga, PDO::PARAM_INT);
    $consulta->bindValue(":produto_id_antigo", $produtoIdAntigo, PDO::PARAM_INT);
    $consulta->execute();
}

function excluirLojaProduto(PDO $conexao, int $lojaId, int $produtoId): void
{
    $sql = "DELETE FROM lojas_produtos WHERE loja_id = :loja_id AND produto_id = :produto_id";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":loja_id", $lojaId, PDO::PARAM_INT);
    $consulta->bindValue(":produto_id", $produtoId, PDO::PARAM_INT);
    $consulta->execute();
}

