
<?php

header("Content-Type: application/json");

require "conexao.php";

$metodo = $_SERVER["REQUEST_METHOD"];

if ($metodo == "POST") {

    $json = file_get_contents("php://input");

    $dados = json_decode($json, true);

    $sql = "INSERT INTO quartos (numero, categoria, capacidade, valor_diaria) VALUES (?, ?, ?, ?)";

    $comando = $pdo->prepare($sql);

    $comando->execute([
        $dados["numero"],
        $dados["categoria"],
        $dados["capacidade"],
        $dados["valor_diaria"]
    ]);

    echo json_encode(["Mensagem" => "Quarto cadastrado com sucesso!"]);
};

if ($metodo == "GET") {

    $sql = "SELECT * FROM quartos ORDER BY id";

    $comando = $pdo->query($sql);

    $quartos = $comando->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($quartos);
};

if ($metodo == "PUT") {

    $json = file_get_contents("php://input");

    $dados = json_decode($json, true);

    $sql = "UPDATE quartos SET numero=?, categoria=?, capacidade=?, valor_diaria=? WHERE id=?";

    $comando = $pdo->prepare($sql);

    $comando->execute([
        $dados["numero"],
        $dados["categoria"],
        $dados["capacidade"],
        $dados["valor_diaria"],
        $dados["id"]
    ]);

    echo json_encode([
        "Mensagem" => "Quarto atualizado com sucesso!"
    ]);
};

if ($metodo == "DELETE") {

    $json = file_get_contents("php://input");

    $dados = json_decode($json, true);

    $sql = "DELETE FROM quartos WHERE id = ?";

    $comando = $pdo->prepare($sql);

    $comando->execute([
        $dados["id"]
    ]);

    echo json_encode([
        "Mensagem" => "Quarto deletado com sucesso!"
    ]);
};

?>