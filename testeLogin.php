<?php
session_start();

if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha']))
{
    include_once('config_o.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM cadastro WHERE email = '$email' and senha = '$senha'";
    $result = $conexao->query($sql);

    if(mysqli_num_rows($result) < 1)
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        unset($_SESSION['nivel_acesso']);
        header('Location: telaLogin.html');
    }
    else
    {
        $user_data = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $_SESSION['nivel_acesso'] = $user_data['nivel_acesso'];
        header('Location: telaServicos.php');
    }
}
else
{
    header('Location: telaLogin.html');
}
?>