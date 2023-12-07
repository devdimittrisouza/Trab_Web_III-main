<?php

$host = "devweb2sql.mysql.dbaas.com.br";
$usuario = "devweb2sql";
$senha = "g2023_FaTEC#$";
$nome_do_banco = "devweb2sql";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    if($data && isset($data['nome']) && isset($data['endereco'])){

        $nome = $data['nome'];
        $endereco = $data['endereco'];

        $conexao = new mysqli($host, $usuario, $senha, $nome_do_banco);

        if($conexao->$conexao_error){

            die('Falha na conexão com o banco'. $conexao->$conexao_error);
        }

        $sql = "INSERT INTO CADASTRO (NOME, ENDERECO) VALUES (?, ?)";
        $stmt = $conexao->prepare($sql);

        $stmt->bind_param("ss", $nome, $endereco);

        if($stmt->execute()){

            $response = ['mensagem' => 'Dados gravados com sucesso'];
            echo json_encode($response);
        } else{

            http_response_code(500);
            $response = ['erro' => 'Erro ao na gravação dos dados: ' . $stmt->error];
            echo json_encode($response);
        }

        echo ''. $nome .''. $endereco .'';
    } else {

        http_response_code(400);
        echo json_encode(['erro' => 'Dados invalidos']);
    }

} else if($_SERVER['REQUEST_METHOD'] === 'GET'){

} else if($_SERVER['REQUEST_METHOD'] === 'DELETE'){

} else if($_SERVER['REQUEST_METHOD'] === 'PATCH'){

} else {

    http_response_code(405);
    echo json_encode(['echo' => "Metodo nao permitido"]);
}

?>