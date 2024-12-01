<?php

    
    
    include_once('config_o.php');

    $servico = $_POST['tipo_servico'];
    $descricao = $_POST['descricao_servico'];
    $preco = $_POST['preco_servico'];
    $nome_cliente = $_POST['nome_cliente'];
    $tel_cliente = $_POST['tell_cliente'];
    
   
    
    

    $sql = mysqli_query($conexao, "INSERT INTO servicos (tipoServ, descricao, preco, nomeCliente, telCliente) VALUES ('$servico','$descricao','$preco','$nome_cliente','$tel_cliente')");

    
    
    header('Location: telaServicos.php');






?>