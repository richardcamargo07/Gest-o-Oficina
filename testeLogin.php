<?php
    session_start();
    
    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha']))
    {
        // Acessa
        include_once('config_o.php');
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        

        $sql = "SELECT * FROM cadastro WHERE email = '$email' and senha = '$senha'";

        $result = $conexao->query($sql);

        

        if(mysqli_num_rows($result) < 1)
        {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('Location: telaLogin.html
');
        }
        else
        {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: Control.php');
        }
    }
    else
    {
        // Não acessa
        header('Location: telaLogin.html');
    }
?>