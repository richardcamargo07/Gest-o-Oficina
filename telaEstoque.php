
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque</title>
    <link rel="stylesheet" href="CSS/styleEstoque.css">
</head>
<body>
    <div class="container">
        <header>
            <input type="text" placeholder="Search" class="search">
            <button style="width: 40px; height: 40px;"><img src="Imagens/lupa.png"></button>
            <div id="btnCadastro">

            
        </div>
        </header>

        

        <!-- Modal de cadastro existente -->
        <div id="modalCadastro" class="modal">
            <div class="modal-content">
                <span class="fechar" onclick="fecharModal()">&times;</span>
                <h2>Cadastrar Novo Produto</h2>
                <form id="formCadastro" action="saveProd.php" method="POST" enctype="multipart/form-data">
                    <label for="nome">Nome do Produto:</label>
                    <input type="text" id="nome_produto" name="nome_produto" required>

                    <label for="categoria">Categoria:</label>
                    <select id="categoria_produto" name="categoria_produto" required>
                        <option value="volante">Volante</option>
                        <option value="pneu">Pneu</option>
                        <option value="motor">Motor</option>
                        <option value="freio">Freio</option>
                        <!-- Adicione mais categorias conforme necessário -->
                    </select>

                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao_produto" name="descricao_produto" required></textarea>

                    <label for="quantidade">Quantidade:</label>
                    <input type="number" id="preco_produto" name="preco_produto" required>

                    <label for="imagem">Imagem do Produto:</label>
                    <input type="file" id="imagem_produto" name="imagem_produto" accept="image/*" required>

                    <button type="submit">Cadastrar</button>
                </form>
            </div>
        </div>
        
        <aside class="sidebar">
            <p>
                <button class="btn-adicionar" onclick="abrirModal()">
                    <img src="uploads/adicionarr.png" alt="" style="width: 25px; height: 25px;">
                </button>
            </p><br><br>
            <ul id="filtros">
                <li><input type="checkbox" value="volante" onchange="filtrarProdutos()"> Volante</li>
                <li><input type="checkbox" value="pneu" onchange="filtrarProdutos()"> Pneu</li>
                <li><input type="checkbox" value="motor" onchange="filtrarProdutos()"> Motor</li>
                <li><input type="checkbox" value="freio" onchange="filtrarProdutos()"> Freio</li>
                <!-- Adicione mais categorias conforme necessário -->
            </ul>
        </aside>

        <main class="main-content">
            <?php
            include_once('config_o.php');

            // Modificar a query para incluir a categoria
            $sql = "SELECT id, nome, descricao, quantidade, imagem, categoria FROM produtos";
            $result = $conexao->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo '<div class="item" data-categoria="' . $row["categoria"] . '">';
                echo '<img src="uploads/' . $row["imagem"] . '" alt="' . $row["nome"] . '">';
                echo '<h2>' . $row["nome"] . '</h2>';
                echo '<p>' . $row["descricao"] . '</p>';
                echo '<p>Qtd: ' . $row["quantidade"] . '</p>';
                echo '<p>Categoria: ' . $row["categoria"] . '</p>';
                echo "<p>
                    <a class='btn btn-sm btn-danger' href='delete.php?id=$row[id]'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                        </svg>
                    </a>
                </p>";
                echo '</div>';
            }
            $conexao->close();
            ?>
        </main>
    </div>

    <script>
    function filtrarProdutos() {
        const checkboxes = document.querySelectorAll('#filtros input[type="checkbox"]:checked');
        const categoriasSelecionadas = Array.from(checkboxes).map(cb => cb.value);
        const produtos = document.querySelectorAll('.item');

        produtos.forEach(produto => {
            const categoriaProduto = produto.dataset.categoria;
            if (categoriasSelecionadas.length === 0 || categoriasSelecionadas.includes(categoriaProduto)) {
                produto.style.display = 'block';
            } else {
                produto.style.display = 'none';
            }
        });
    }

    
    function abrirModal() {
        document.getElementById('modalCadastro').style.display = 'block';
    }

    function fecharModal() {
        document.getElementById('modalCadastro').style.display = 'none';
    }

    window.onclick = function(event) {
        var modal = document.getElementById('modalCadastro');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    document.getElementById('formCadastro').addEventListener('submit', function(e) {
        e.preventDefault(); 
        
        var formData = new FormData(this);
        
        fetch('saveProd.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            alert('Produto cadastrado com sucesso!');
            fecharModal();
            location.reload(); 
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao cadastrar o produto');
        });
    });
    </script>
</body>
</html>