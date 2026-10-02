<?php
// src/loja_crud.php

// Garante que o arquivo conecta.php (que cria a variável $conexao) seja incluído
require_once __DIR__ . "/../src/conecta.php";

function buscarLojas(PDO $conexao): array {
    $sql = "SELECT id, nome FROM lojas ORDER BY nome";
    $consulta = $conexao->query($sql);
    return $consulta->fetchAll();
}

function inserirLoja(PDO $conexao, string $nome): void {
    $sql = "INSERT INTO lojas (nome) VALUES (:nome)";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":nome", $nome, PDO::PARAM_STR);
    $consulta->execute();
}

function buscarLojaPorId(PDO $conexao, int $id): ?array {
    $sql = "SELECT id, nome FROM lojas WHERE id = :id";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":id", $id, PDO::PARAM_INT);
    $consulta->execute();
    $resultado = $consulta->fetch();
    return $resultado ?: null;
}

function atualizarLoja(PDO $conexao, int $id, string $nome): void {
    $sql = "UPDATE lojas SET nome = :nome WHERE id = :id";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":nome", $nome, PDO::PARAM_STR);
    $consulta->bindValue(":id", $id, PDO::PARAM_INT);
    $consulta->execute();
}

function excluirLoja(PDO $conexao, int $id): void {
    $sql = "DELETE FROM lojas WHERE id = :id";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":id", $id, PDO::PARAM_INT);
    $consulta->execute();
}
