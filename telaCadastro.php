<?php
if(isset($_POST['submit']))
{
    //print_r('Nome:' . $_POST['nome']);
    //print_r('<br>');
    //print_r('Email:' . $_POST['email']);
    //print_r('<br>');
    //print_r('Telefone:' . $_POST['telefone']);
    
    include_once('config_o.php');

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
    

    $result = mysqli_query($conexao, "INSERT INTO cadastro(nome,email,senha,telefone,rg,cpf,salario,sexo,data_nasc,end_cidade,end_estado,end_cep) VALUES ('$nome','$email','$senha','$telefone','$rg','$cpf','$salario','$sexo','$data_nasc','$end_cidade','$end_estado','$end_cep')");

    header('Location: Control.php');
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Cadastro Func | AutoMecnik</title>
    <style>
        body
        {
            background:linear-gradient(to right, rgb(255,69,0), rgb(255,140,0), rgb(112,128,144)) ;

        }
        nav
        {
            background: black;
        }
        .box{
            position: absolute;
            top: 50%;
            left: 30%;
            transform: translate(-50%, -50%);
            background-color: black;
            padding: 15px;
            border-radius: 15px;
            width: 700px;
            color: white;
           
        }

        fieldset{
            border: 3px solid rgb(255,69,0) ;
            border-radius: 10px;
            padding: 20px;
        }

       

        .inputBox-12{
            position:relative;
            width: 100%;
            flex: 0 0 auto;

        }
        .inputBox-6{
            position:relative;
            width: 50%;
            flex: 0 0 auto;

        }
        .inputBox-4{
            position:relative;
            width: 33.33333333%;
            flex: 0 0 auto;

        }
        .inputBox-2{
            position:relative;
            width: 16.66666667%;
            flex: 0 0 auto;

        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }

        .labelinput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
            margin-bottom: .5rem;
            display: inline-block;
            cursor: default;
            margin-left:10px ;
        }

        
        .labelinput-0{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
            display: inline-block;
            cursor: default;
            margin-left:38px ;
            margin-top: 35px;
        }
       

        .inputUser:focus ~ .labelinput,
        .inputUser:valid ~ .labelinput{
            top: -20px;
            font-size: 12px;
            color: rgb(255,69,0);
        }

        #data_nascimento{
            border: none;
            padding: 8px;
            border-radius: 10px;
            outline: none;
            font-size: 15px;

        }

        #submit{
            background-color:rgb(255,140,0);
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 15px;
            color: white;
            font-size: 15px;
        }
        #submit:hover{
            background-color: rgb(255,69,0);
            color: black;
            cursor: pointer;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="telaCadastro.php">Cadastrar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Control.php">Control</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="box">
        <fieldset>
            <form  method="POST" action="" class="row g-3">
            <div  class="inputBox-12">
                <input type="text" name="nome" id="nome" class="inputUser" required>
                <label for="nome" class="labelinput">Nome Completo</label>
            </div>
            <br><br>
            <div class="inputBox-12">
                <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                <label for="telefone" class="labelinput">Telefone</label>
            </div>
            <br><br>
            <div  class="inputBox-12">
                <input type="text" name="email" id="email" class="inputUser" required>
                <label for="email" class="labelinput">E-mail</label>
            </div>
            <br><br>
            <div class="inputBox-12">
                <input type="password" name="senha" id="senha" class="inputUser" required>
                <label for="senha" class="labelinput">Senha</label>
            </div><br><br>
            <div  class="inputBox-4">
                <input type="text" name="rg" id="rg" class="inputUser" required>
                <label for="rg" class="labelinput">RG</label>
            </div><br><br>
            <div  class="inputBox-4">
                <input type="text" name="cpf" id="cpf" class="inputUser" required>
                <label for="cpf" class="labelinput">CPF</label>
            </div>
            <br><br>
            <div  class="inputBox-4">
                <input type="text" name="salario" id="salario" class="inputUser" required>
                <label for="salario" class="labelinput">Salário</label>
            </div>
            <br><br><br>
            
            <div class="inputBox-6">
            <p>Sexo:</p>
                <input type="radio" name="genero" id="feminino" value="feminino" required>
                <label for="feminino">Feminino</label>
                <br>
                <input type="radio" name="genero" id="masculino" value="masculino" required>
                <label for="masculino">Masculino</label>
                <br>
                <input type="radio" name="genero" id="outro" value="outro" required>
                <label for="outro">Outro</label>
            </div>
                <div class="inputBox-6">
                    <label for="data_nascimento" style=" margin-left:100px;"><b>Data de nascimento</b></label>
                    <br><br>
                    <input type="date" name="data_nascimento" id="data_nascimento" style="width: 250px; margin-left:50px;" required>
                </div>
            
        <br><br><br><br><br><br>
            <div class="inputBox-12">
                <input type="text" name="cidade" id="cidade" class="inputUser" required>
                <label for="cidade" class="labelinput">Cidade</label>
            </div>
            <br><br>
            <div class="inputBox-6">
                <input type="text" name="estado" id="estado" class="inputUser" required>
                <label for="estado" class="labelinput">Estado</label>
            </div>
            <br><br>
            <div class="inputBox-6">
                <input type="text" name="cep" id="cep" class="inputUser" required>
                <label for="cep" class="labelinput">CEP</label>
            </div>
            <br><br><br>
            <input type="submit" name="submit" id="submit" value="Cadastrar">
            </form>
            </fieldset>
        
      </div>
</body>
</html>