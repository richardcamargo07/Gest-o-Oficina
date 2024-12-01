<?php
include_once('config_o.php');



$sql = "SELECT * FROM servicos ORDER BY id DESC";
$result = $conexao->query($sql);




?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Sistema de Vendas</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .profile-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .photo-placeholder {
            width: 60px;
            height: 60px;
            border: 2px solid #ccc;
            position: relative;
        }

        .photo-placeholder::after {
            content: "X";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 24px;
            color: #ccc;
        }

        .name-placeholder {
            width: 100px;
            height: 20px;
            border: 2px solid #ccc;
            position: relative;
        }

        .name-placeholder::after {
            content: "X";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #ccc;
        }

        .salary-section {
            flex-grow: 1;
            height: 100px;
            border: 2px solid #ccc;
            margin: 0 20px;
            position: relative;
        }

        .salary-section::after {
            content: "X";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 36px;
            color: #ccc;
        }

        .notification-section {
            width: 60px;
            height: 60px;
            border: 2px solid #ccc;
            position: relative;
        }

        .notification-section::after {
            content: "X";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 24px;
            color: #ccc;
        }

        .search-section {
            margin: 20px 0;
        }

        .icons-row {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .icon {
            width: 30px;
            height: 30px;
            border: 2px solid #ccc;
            position: relative;
        }

        .icon::after {
            content: "X";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #ccc;
        }

        .search-bar {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .sales-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .sales-table th,
        .sales-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .sales-table th {
            background-color: #f8f8f8;
        }

        .table-caption {
            margin-top: 10px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        /* Modal */
        .modal {
            display: none;
            /* Garantir que esteja sempre oculto por padrão */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            align-items: center;
            justify-content: center;
            /* Centralizar horizontalmente */
        }

        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
            max-width: 500px;
            border-radius: 10px;
            position: relative;
            text-align: center;
            /* Centralizar conteúdo interno */
            transform: scale(0.7);
            /* Efeito de escala inicial */
            opacity: 0;
            /* Inicialmente invisível */
            transition: all 0.3s ease;
            /* Animação suave */
        }

        .modal.show .modal-content {
            transform: scale(1);
            /* Escala completa quando modal está visível */
            opacity: 1;
            /* Totalmente visível */
        }

        .fechar {
            position: absolute;
            right: 20px;
            top: 10px;
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .modal-content form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .modal-content input,
        .modal-content textarea {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .modal-content button[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="profile-section">
                <div class="photo-placeholder"></div>
                <div class="name-placeholder"></div>
            </div>
            <div class="salary-section"></div>
            <div class="notification-section"></div>
        </div>

        <div class="search-section">
            <div class="icons-row">
                <div class="icon"></div>
                <div class="icon"></div>
                <div class="icon"></div>
                <p>
                    <button class="btn-adicionar" onclick="abrirModal()">
                        <img src="uploads/adicionarr.png" alt="" style="width: 25px; height: 25px;">
                    </button>
                </p>
            </div>
            <input type="text" class="search-bar" placeholder="Pesquisa">
        </div>

        <div id="modalCadastro" class="modal">
            <div class="modal-content">
                <span class="fechar" onclick="fecharModal()">&times;</span>
                <h2>Cadastrar Novo Serviço</h2>
                <form id="formCadastroServ" action="saveServ.php" method="POST" enctype="multipart/form-data">
                    <label for="nome">Nome do Cliente:</label>
                    <input type="text" id="nome_cliente" name="nome_cliente" required>

                    <label for="nome">Telefone do Cliente:</label>
                    <input type="text" id="tell_cliente" name="tell_cliente" required>

                    <label for="categoria">Seriços:</label>
                    <select id="tipo_servico" name="tipo_servico" required>
                        <option value="Troca de óleo">Troca de óleo</option>
                        <option value="Alinhamento mecânico">Alinhamento mecânico</option>
                        <option value="Regulagem de motor">Regulagem de motor</option>
                        <option value="Troca de lanternas">Troca de lanternas</option>
                        <option value="Inspeção dos freios">Inspeção dos freios</option>
                        <option value="Outro">Outro</option>
                    </select>

                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao_servico" name="descricao_servico" required></textarea>

                    <label for="quantidade">Preço serviço:</label>
                    <input type="number" id="preco_servico" name="preco_servico" required>



                    <button type="submit" name="submit" id="submit">Cadastrar</button>
                </form>
            </div>
        </div>



        <table class="sales-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Serviço</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Cliente</th>
                    <th>Cliente Telefone</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($user_data = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $user_data['id'] . "</td>";
                    echo "<td>" . $user_data['tipoServ'] . "</td>";
                    echo "<td>" . $user_data['descricao'] . "</td>";
                    echo "<td>" . $user_data['preco'] . "</td>";
                    echo "<td>" . $user_data['nomeCliente'] . "</td>";
                    echo "<td>" . $user_data['telCliente'] . "</td>";

                    echo "<td> 
                    <a class='btn btn-sm btn-danger' href='deleteServ.php?id=$user_data[id]'>
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
    <script>
        function abrirModal() {
            const modal = document.getElementById('modalCadastro');
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.classList.add('show');
            }, 10);
        }

        function fecharModal() {
            const modal = document.getElementById('modalCadastro');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        }

        window.onclick = function (event) {
            const modal = document.getElementById('modalCadastro');
            if (event.target == modal) {
                fecharModal();
            }
        }

        document.getElementById('formCadastroServ').addEventListener('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            fetch('saveServ.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(result => {
                    console.log(result);
                    if (result.includes("sucesso")) {
                        alert('Serviço cadastrado com sucesso!');
                        fecharModal();
                        location.reload();
                    } else {
                        alert('Erro ao cadastrar: ' + result);
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert('Erro ao cadastrar o serviço');
                });
        });
    </script>
</body>

</html>