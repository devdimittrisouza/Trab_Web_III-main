<?php

$host = "devweb2sql.mysql.dbaas.com.br";
$usuario = "devweb2sql";
$senha = "g2023_FaTEC#$";
$nome_do_banco = "devweb2sql";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    if($data && isset($data['nome']) 
    && isset($data['cpf'])
    && isset($data['email'])
    && isset($data['telefone'])
    && isset($data['cep'])
    && isset($data['logra'])
    && isset($data['numeroCasa'])
    && isset($data['cidade'])
    && isset($data['bairro'])
    && isset($data['complemento'])
    && isset($data['senha'])

    ){

        $conexao = new mysqli($host, $usuario, $senha, $nome_do_banco);

        if($conexao->connect_error){

            die('Falha na conexão com o banco'. $conexao->connect_error);
        }

        $sql = "INSERT INTO CLIENTE (NOME_CLI, CPF_CLI, EMAIL_CLI, TELEFONE_CLI, CEP_CLI, LOGRADOURO_CLI, NUMERO_CADA_CLI, CIDADE_CLI, BAIRRO_CLI, COMPLEMENTO_CLI, SENHA_CLI) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);

        $stmt->bind_param("ssSSSSSSSSS", $data['nome'], $data['cpf'], $data['email'], $data['telefone'], $data['cep'], $data['logra'], $data['numeroCasa'], $data['cidade'], $data['bairro'], $data['complemento'], $data['senha']);

        if($stmt->execute()){

            $response = ['mensagem' => 'Dados gravados com sucesso'];
            echo json_encode($response);
        } else{

            http_response_code(500);
            $response = ['erro' => 'Erro ao na gravação dos dados: ' . $stmt->error];
            echo json_encode($response);
        }

        //
    } else {

        /*
        http_response_code(400);
        echo json_encode(['erro' => 'Dados invalidos' . ' ' . $nome . ' ' . $cpf . ' ' . $telefone]);
        */
        $nome = isset($data['nome']) ? $data['nome'] : '';
        $cpf = isset($data['cpf']) ? $data['cpf'] : '';
        $email = isset($data['email']) ? $data['email'] : '';
        $telefone = isset($data['telefone']) ? $data['telefone'] : '';
        $cep = isset($data['cep']) ? $data['cep'] : '';
        $logra = isset($data['logra']) ? $data['logra'] : '';
        $numeroCasa = isset($data['numeroCasa']) ? $data['numeroCasa'] : '';
        $cidade = isset($data['cidade']) ? $data['cidade'] : '';
        $bairro = isset($data['bairro']) ? $data['bairro'] : '';
        $complemento = isset($data['complemento']) ? $data['complemento'] : '';
        $senha = isset($data['senha']) ? $data['senha'] : '';

        echo json_encode(['erro' => 'Dados inválidos - Nome: ' . $nome . ', CPF: ' . $cpf . ', Email: ' . $email . ', Telefone: ' . $telefone . ', CEP: ' . $cep . ', Logradouro: ' . $logra . ', Numero Casa: ' . $numeroCasa . ', Cidade: ' . $cidade . ', Bairro: ' . $bairro . ', Complemento: ' . $complemento . ', Senha: ' . $senha]);
        
    }

} else if($_SERVER['REQUEST_METHOD'] === 'GET'){

} else if($_SERVER['REQUEST_METHOD'] === 'DELETE'){

} else if($_SERVER['REQUEST_METHOD'] === 'PATCH'){

} else {

    http_response_code(405);
    echo json_encode(['echo' => "Metodo nao permitido"]);
}

?>