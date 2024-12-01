<?php
if(!empty($_GET['id']))
{
   
    
    include_once('config_o.php');

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM cadastro WHERE id=$id";

    $result = $conexao->query($sqlSelect);

    if($result->num_rows > 0 ){
    
        while($user_data = mysqli_fetch_assoc($result)){
    
            $nome = $user_data['nome'];
            $email = $user_data['email'];
            $senha = $user_data['senha'];
            $telefone = $user_data['telefone'];
            $sexo = $user_data['sexo'];
            $data_nasc = $user_data['data_nasc'];
            $end_cidade = $user_data['end_cidade'];
            $end_estado = $user_data['end_estado'];
            $end_cep = $user_data['end_cep'];
            $salario = $user_data['salario'];
            $rg = $user_data['rg'];
            $cpf = $user_data['cpf'];
    
}
    }else{
        header('Location: Control.php');
    
    }  
}else{
    header('Location: Control.php');
}

?>

<!DOCTYPE html>
<html lang="en">
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
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 15px;
            width: 800px;
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
            color: dodgerblue;
        }

        #data_nascimento{
            border: none;
            padding: 8px;
            border-radius: 10px;
            outline: none;
            font-size: 15px;

        }

        #update{
            background-color:rgb(255,140,0);
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 15px;
            color: white;
            font-size: 15px;
        }
        #update:hover{
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
                <a class="nav-link" href="#">Control</a>
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
        <form action="saveEdit.php" method="POST" class="row g-3">
            <div  class="inputBox-6">
                <input type="text" name="nome" id="nome" class="inputUser" value="<?php echo $nome ?>" required>
                <label for="nome" class="labelinput">Nome Completo</label>
            </div>
            <br><br>
            <div class="inputBox-6">
                <input type="tel" name="telefone" id="telefone" class="inputUser" value="<?php echo $telefone ?>" required>
                <label for="telefone" class="labelinput">Telefone</label>
            </div>
            <br><br>
            <div  class="inputBox-6">
                <input type="text" name="email" id="email" class="inputUser" value="<?php echo $email ?>" required>
                <label for="email" class="labelinput">E-mail</label>
            </div>
            <br><br>
            <div class="inputBox-6">
                <input type="password" name="senha" id="senha" class="inputUser" value="<?php echo $senha ?>" required>
                <label for="senha" class="labelinput">Senha</label>
            </div><br><br>
            <div  class="inputBox-4">
                <input type="text" name="rg" id="rg" class="inputUser" value="<?php echo $rg ?>" required>
                <label for="rg" class="labelinput">RG</label>
            </div><br><br>
            <div  class="inputBox-4">
                <input type="text" name="cpf" id="cpf" class="inputUser" value="<?php echo $cpf ?>" required>
                <label for="cpf" class="labelinput">CPF</label>
            </div>
            <br><br>
            <div  class="inputBox-4">
                <input type="text" name="salario" id="salario" class="inputUser" value="<?php echo $salario ?>" required>
                <label for="salario" class="labelinput">Salário</label>
            </div>
            <br><br><br>
            
            <div class="inputBox-6">
            <p>Sexo:</p>
                <input type="radio" name="genero" id="feminino" value="feminino" <?php echo $sexo == 'feminino' ? 'checked' : '' ?>  required>
                <label for="feminino">Feminino</label>
                <br>
                <input type="radio" name="genero" id="masculino" value="masculino" <?php echo $sexo == 'masculino' ? 'checked' : '' ?> required>
                <label for="masculino">Masculino</label>
                <br>
                <input type="radio" name="genero" id="outro" value="outro" <?php echo $sexo == 'outro' ? 'checked' : '' ?> required>
                <label for="outro">Outro</label>
            </div>
                <div class="inputBox-6">
                    <label for="data_nascimento" style=" margin-left:100px;"><b>Data de nascimento</b></label>
                    <br><br>
                    <input type="date" name="data_nascimento" id="data_nascimento" style="width: 250px; margin-left:50px;" value="<?php echo $data_nasc ?>" required>
                </div>
            
        <br><br><br><br><br><br>
            <div class="inputBox-6">
                <input type="text" name="cidade" id="cidade" class="inputUser" value="<?php echo $end_cidade ?>" required>
                <label for="cidade" class="labelinput">Cidade</label>
            </div>
            <br><br>
            <div class="inputBox-4">
                <input type="text" name="estado" id="estado" class="inputUser" value="<?php echo $end_estado ?>" required>
                <label for="estado" class="labelinput">Estado</label>
            </div>
            <br><br>
            <div class="inputBox-2">
                <input type="text" name="cep" id="cep" class="inputUser" value="<?php echo $end_cep ?>" required>
                <label for="cep" class="labelinput">CEP</label>
            </div>
            <br><br><br>
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="submit" name="update" id="update">
            </form>
            </fieldset>
        
      </div>
</body>
</html>