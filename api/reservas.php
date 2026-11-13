
<?php

header("Content-Type: application/json");

require "conexao.php";

$metodo = $_SERVER["REQUEST_METHOD"];

if ($metodo == "POST") {

    $json = file_get_contents("php://input");

    $dados = json_decode($json, true);

    $sql = "INSERT INTO reservas (usuario_id, quarto_id, data_entrada, data_saida, valor_total) VALUES (?, ?, ?, ?, ?)";

    $comando = $pdo->prepare($sql);

    $comando->execute([
        $dados["usuario_id"],
        $dados["quarto_id"],
        $dados["data_entrada"],
        $dados["data_saida"],
        $dados["valor_total"]
    ]);

    echo json_encode(["Mensagem" => "Reserva cadastrada com sucesso!"]);
};

if ($metodo == "GET") {

    $sql = "SELECT * FROM reservas ORDER BY id";

    $comando = $pdo->query($sql);

    $reservas = $comando->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($reservas);
};

if ($metodo == "PUT") {

    $json = file_get_contents("php://input");

    $dados = json_decode($json, true);

    $sql = "UPDATE reservas SET usuario_id=?, quarto_id=?, data_entrada=?, data_saida=?, valor_total=? WHERE id=?";

    $comando = $pdo->prepare($sql);

    $comando->execute([
        $dados["usuario_id"],
        $dados["quarto_id"],
        $dados["data_entrada"],
        $dados["data_saida"],
        $dados["valor_total"],
        $dados["id"]
    ]);

    echo json_encode([
        "Mensagem" => "Reserva atualizada com sucesso!"
    ]);
};

if ($metodo == "DELETE") {

    $json = file_get_contents("php://input");

    $dados = json_decode($json, true);

    $sql = "DELETE FROM reservas WHERE id = ?";

    $comando = $pdo->prepare($sql);

    $comando->execute([
        $dados["id"]
    ]);

    echo json_encode([
        "Mensagem" => "Reserva deletada com sucesso!"
    ]);
};

?>
