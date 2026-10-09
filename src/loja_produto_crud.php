<?php
require_once "conecta.php";

function buscarLojasProdutos(PDO $conexao): array
{
    $sql = "SELECT  
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
