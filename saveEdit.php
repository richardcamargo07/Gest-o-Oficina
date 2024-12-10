<?php
    
    include_once('config_o.php');
    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $telefone = $_POST['telefone'];
        $rg = $_POST['rg'];
        $cpf = $_POST['cpf'];
        $salario = $_POST['salario'];
        $sexo = $_POST['genero'];
        $data_nasc = $_POST['data_nascimento'];
        $end_cidade = $_POST['cidade'];
        $end_estado = $_POST['estado'];
        $end_cep = $_POST['cep'];
        
        $sqlInsert = "UPDATE cadastro SET nome='$nome',senha='$senha',email='$email',telefone='$telefone',sexo='$sexo',data_nasc='$data_nasc',end_cidade='$end_cidade',end_estado='$end_estado',end_cep='$end_cep',rg='$rg',cpf='$cpf',salario='$salario' WHERE id=$id";
        $result = $conexao->query($sqlInsert);
        //print_r($result);
    }
    header('Location: Control.php');

?>