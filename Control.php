<?php

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['email']) || !isset($_SESSION['nivel_acesso'])) {
    header('Location: telaLogin.html');
    exit();
}

// Verifica se o usuário tem nível de acesso de gerente para acessar a página
if ($_SESSION['nivel_acesso'] !== 'gerente') {
    echo "<script>alert('Acesso negado. Somente gerentes podem acessar esta página.'); window.location.href = 'telaLogin.html';</script>";
    exit();
}



include_once('config_o.php');



if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT * FROM cadastro WHERE id LIKE '%$data%' or nome LIKE '%$data%' or email LIKE '%$data%' or sexo LIKE '%$data%' or end_cidade LIKE '%$data%' or end_estado LIKE '%$data%'  ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM cadastro ORDER BY id DESC";
}



$result = $conexao->query($sql);

//print_r($result);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEMA | RC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            
            color: black;
            text-align: center;
        }

        .table-bg {
            background: gray;
            border-radius: 15px ;
            
        }

        .box-search {
            display: flex;
            justify-content: center;
            gap: .1%;
        }

        nav {
            background: black;
        }

        .nav-link {
            display: block;
            padding: .5rem 1rem;
            color: gray;
            text-decoration: none;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out;
        }

        .nav-link:hover {
            color: orangered;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="telaLogin.html">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="telaCadastro.php">Cadastrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Control.php">Control</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="telaPagamentoMod.php">Pagamentos</a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="telaServicos.php">Seriços</a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="telaEstoque.php">Estoque</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <?php
    echo "<h1>Bem vindo </h1>";
    ?>
    <br>
    <div class="box-search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
        <button class="btn btn-primary" onClick="searchData()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                viewBox="0 0 16 16">
                <path
                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
            </svg>
        </button>
    </div>
    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Senha</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">Data de nascimento</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Cep</th>
                    <th scope="col">Salario</th>
                    <th scope="col">CPF</th>
                    <th scope="col">RG</th>
                    <th scope="col">...</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($user_data = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $user_data['id'] . "</td>";
                    echo "<td>" . $user_data['nome'] . "</td>";
                    echo "<td>" . $user_data['email'] . "</td>";
                    echo "<td>" . $user_data['senha'] . "</td>";
                    echo "<td>" . $user_data['telefone'] . "</td>";
                    echo "<td>" . $user_data['sexo'] . "</td>";
                    echo "<td>" . $user_data['data_nasc'] . "</td>";
                    echo "<td>" . $user_data['end_cidade'] . "</td>";
                    echo "<td>" . $user_data['end_estado'] . "</td>";
                    echo "<td>" . $user_data['end_cep'] . "</td>";
                    echo "<td>" . $user_data['salario'] . "</td>";
                    echo "<td>" . $user_data['rg'] . "</td>";
                    echo "<td>" . $user_data['cpf'] . "</td>";
                    echo "<td> 
             <a class='btn btn-sm btn-primary' href='edit.php?id=$user_data[id]'>
             <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
            <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325'/>
            </svg>
            </a>
            <a class='btn btn-sm btn-danger' href='del.php?id=$user_data[id]'>
            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
            </svg>
            </a>
            </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function (event) {
        if (event.key == "Enter") {
            searchData()
        }
    });

    function searchData() {
        window.location = 'Control.php?search=' + search.value;
    }

</script>

</html>