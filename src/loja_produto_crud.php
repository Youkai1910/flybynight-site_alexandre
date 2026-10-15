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
            FROM lojas_produtos
            JOIN lojas ON lojas.id = lojas_produtos.loja_id
            JOIN produtos ON produtos.id = lojas_produtos.produto_id
            ORDER BY nome_produto";

    $consulta = $conexao->query($sql);
    return $consulta->fetchAll();
}

function inserirLojaProduto(
    PDO $conexao,
    string $lojaId,
    string $produtoId,
    int $estoque
): void {
    $sql = "INSERT INTO lojas_produtos (loja_id, produto_id, estoque)
            VALUES (:loja_id, :produto_id, :estoque)";

    $consulta = $conexao->prepare($sql);
    $consulta->execute([
        ":loja_id" => $lojaId,
        ":produto_id" => $produtoId,
        ":estoque" => $estoque
    ]);
}

function buscarLojasProdutosPorId(PDO $conexao, int $lojaId, int $produtoId): array
{
    $sql = "SELECT *
            FROM lojas_produtos
            WHERE loja_id = :loja_id AND produto_id = :produto_id";

    $consulta = $conexao->prepare($sql);
    $consulta->execute([
        ":loja_id" => $lojaId,
        ":produto_id" => $produtoId
    ]);

    return $consulta->fetch() ?: [];
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
    $consulta->execute([
        ":loja_id_nova" => $lojaIdNova,
        ":produto_id_novo" => $produtoIdNovo,
        ":estoque" => $estoque,
        ":loja_id_antiga" => $lojaIdAntiga,
        ":produto_id_antigo" => $produtoIdAntigo
    ]);
}

function excluirLojasProdutos(PDO $conexao, int $lojaId, int $produtoId): void
{
    $sql = "DELETE FROM lojas_produtos
            WHERE loja_id = :loja_id AND produto_id = :produto_id";

    $consulta = $conexao->prepare($sql);
    $consulta->execute([
        ":loja_id" => $lojaId,
        ":produto_id" => $produtoId
    ]);
}
