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

    /*
    var nome = $('#nome').val();
        var cpf = $('#cpf').val();
        var email = $('#email').val();
        var telefone = $('#telefone').val();
        var cep = $('#cep').val();
        var logra = $('#logra').val();
        var numeroCasa = $('#numeroCasa').val();
        var cidade = $('#bairro').val();
        var complemento = $('#complemento').val();
        var senha = $('#senha').val();
        var confirmSenha = $('#confirmSenha').val();
    */ 

    ){

        $conexao = new mysqli($host, $usuario, $senha, $nome_do_banco);

        if($conexao->$conexao_error){

            die('Falha na conexão com o banco'. $conexao->$conexao_error);
        }

        $sql = "INSERT INTO CADASTRO (NOME_CLI, CPF_CLI, EMAIL_CLI, TELEFONE_CLI, CEP_CLI, LOGRADOURO_CLI, NUMERO_CADA_CLI, CIDADE_CLI, BAIRRO_CLI, COMPLEMENTO_CLI, SENHA_CLI) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);

        $stmt->bind_param("ssSSSSSSSSS", $nome, $cpf, $email, $telefone, $cep, $logra, $numeroCasa, $cidade, $bairro, $complemento, $senha);

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

        http_response_code(400);
        echo json_encode(['erro' => 'Dados invalidos' . ' '. $nome .' '. $endereco .' ']);
    }

} else if($_SERVER['REQUEST_METHOD'] === 'GET'){

} else if($_SERVER['REQUEST_METHOD'] === 'DELETE'){

} else if($_SERVER['REQUEST_METHOD'] === 'PATCH'){

} else {

    http_response_code(405);
    echo json_encode(['echo' => "Metodo nao permitido"]);
}

?>