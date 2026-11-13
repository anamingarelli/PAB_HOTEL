
<?php

header("Content-Type: application/json");

require "conexao.php";

$metodo = $_SERVER["REQUEST_METHOD"];

if ($metodo == "POST") {

    $json = file_get_contents("php://input");

    $dados = json_decode($json, true);

    $senha = password_hash($dados["senha"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha, perfil) VALUES (?, ?, ?, ?)";

    $comando = $pdo->prepare($sql);

    $comando->execute([
        $dados["nome"],
        $dados["email"],
        $senha,
        $dados["perfil"]
    ]);

    echo json_encode(["Mensagem" => "Usuário cadastrado com sucesso!"]);
};

if ($metodo == "GET") {

    $sql = "SELECT id, nome, email, perfil FROM usuarios ORDER BY id";

    $comando = $pdo->query($sql);

    $usuarios = $comando->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($usuarios);
};

if ($metodo == "PUT") {

    $json = file_get_contents("php://input");

    $dados = json_decode($json, true);

    $senha = password_hash($dados["senha"], PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios SET nome=?, email=?, senha=?, perfil=? WHERE id=?";

    $comando = $pdo->prepare($sql);

    $comando->execute([
        $dados["nome"],
        $dados["email"],
        $senha,
        $dados["perfil"],
        $dados["id"]
    ]);

    echo json_encode([
        "Mensagem" => "Usuário atualizado com sucesso!"
    ]);
};

if ($metodo == "DELETE") {

    $json = file_get_contents("php://input");

    $dados = json_decode($json, true);

    $sql = "DELETE FROM usuarios WHERE id = ?";

    $comando = $pdo->prepare($sql);

    $comando->execute([
        $dados["id"]
    ]);

    echo json_encode([
        "Mensagem" => "Usuário deletado com sucesso!"
    ]);
};

?>