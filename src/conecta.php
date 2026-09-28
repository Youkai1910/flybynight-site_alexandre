<?php
// src/conecta.php

//Parâmetros de conexão ao servidor MySQL
$servidor = "localhost";
$banco = "flybynight";
$usuario = "root";
$senha = "senacpenha";

//Usamos o try/catch para realizar as operações de conexão ao servidor
try {
    // Criando um objeto de class PDO
    // PDO -> PHP Data Objetos
    // PDO é uma classe de recursos para manipulação de banco de dados
    $conexao = new PDO(
        "mysql:host=$servidor;dbname=$banco;charset=utf8mb4",
        $usuario,
        $senha
    );

    //Garantido que erros/coneção serão lançadas/exibidades em qulauqer falhe na conexão
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Garantidoque resultados de operações SELECT sejam retornadas como array associativo
    $conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $erro) {
    //"Logar/Registrar" o  erro e exibir no terminal
    error_log($erro->getMessage());

    // Na interface pública, exibimos uma mensagem genérica para o usuário
    exit("Não foi possivel conectar ao banco.");
}

