<?php

    if(!empty($_GET['id']))
    {
        include_once('config_o.php');

        $id = $_GET['id'];

        $sqlSelect = "SELECT *  FROM servicos WHERE id=$id";

        $result = $conexao->query($sqlSelect);

        if($result->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM servicos WHERE id=$id";
            $resultDelete = $conexao->query($sqlDelete);
        }
    }
    header('Location: telaServicos.php');
   
?>