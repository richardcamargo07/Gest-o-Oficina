<?php

    if(!empty($_GET['id']))
    {
        include_once('config_o.php');

        $id = $_GET['id'];

        $sqlSelect = "SELECT *  FROM produtos WHERE id=$id";

        $result = $conexao->query($sqlSelect);

        if($result->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM produtos WHERE id=$id";
            $resultDelete = $conexao->query($sqlDelete);
        }
    }
    header('Location: telaEstoque.php');
   
?>