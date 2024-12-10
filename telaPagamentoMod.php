<?php
session_start();

include_once('config_o.php');

// Fetch services from database
$sql = "SELECT * FROM servicos ORDER BY id DESC";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tela de Pagamento</title>
  <link rel="stylesheet" href="CSS/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    .services-list {
      max-height: 300px;
      overflow-y: auto;
      border: 1px solid #ccc;
      margin-bottom: 15px;
    }

    .services-list .service-item {
      display: flex;
      justify-content: space-between;
      padding: 10px;
      border-bottom: 1px solid #eee;
      cursor: pointer;
    }

    .services-list .service-item:hover {
      background-color: #f0f0f0;
    }

    .selected-service {
      background-color: #e0e0e0;
    }

    .pecas-usadas {
      margin-top: 15px;
    }

    .pecas-usadas select {
      width: 100%;
      margin-bottom: 10px;
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
          <?php if (isset($_SESSION['nivel_acesso']) && $_SESSION['nivel_acesso'] == 'gerente'): ?>
            <li class="nav-item">
              <a class="nav-link" href="telaCadastro.php">Cadastrar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Control.php">Control</a>
            </li>
          <?php endif; ?>

          <li class="nav-item">
            <a class="nav-link" href="telaLogin.html">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="telaPagamentoMod.php">Pagamentos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="telaServicos.php">Serviços</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="telaEstoque.php">Estoque</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <!-- Barra do navegador -->
    <header class="browser-bar">
      <div class="nav-icons">
        <button>←</button>
        <button>⟳</button>
      </div>
      <div class="address-bar">
        <input type="text" placeholder="Digite o endereço do site">
      </div>
    </header>

    <!-- Conteúdo principal -->
    <main class="main-content">
      <!-- Lista de Serviços -->
      <section class="services-list">
        <?php
        if ($result->num_rows > 0) {
          while ($servico = $result->fetch_assoc()) {
            echo "<div class='service-item' data-id='{$servico['id']}' data-tipo='{$servico['tipoServ']}' data-preco='{$servico['preco']}' data-cliente='{$servico['nomeCliente']}'>";
            echo "<span>{$servico['tipoServ']} - {$servico['nomeCliente']}</span>";
            echo "<span>R$ {$servico['preco']}</span>";
            echo "</div>";
          }
        } else {
          echo "<p>Nenhum serviço encontrado.</p>";
        }
        ?>
      </section>

      <!-- Detalhes do Serviço Selecionado -->
      <section class="service-details" style="display:none;">
        <h3>Detalhes do Serviço</h3>
        <p>ID: <span id="servicoId"></span></p>
        <p>Tipo: <span id="servicoTipo"></span></p>
        <p>Preço: R$ <span id="servicoPreco"></span></p>
        <p>Cliente: <span id="servicoCliente"></span></p>

        <!-- Peças Usadas -->
        <div class="pecas-usadas">
          <h4>Peças Utilizadas</h4>
          <select id="pecasSelect" multiple>
            <?php
            // Fetch products from database
            $produtos_sql = "SELECT id, nome, quantidade, categoria FROM produtos";
            $produtos_result = $conexao->query($produtos_sql);

            if ($produtos_result->num_rows > 0) {
              while ($produto = $produtos_result->fetch_assoc()) {
                echo "<option value='{$produto['id']}' data-quantidade='{$produto['quantidade']}' data-nome='{$produto['nome']}'>{$produto['nome']} (Estoque: {$produto['quantidade']})</option>";
              }
            }
            ?>
          </select>
          <button onclick="adicionarPecas()">Adicionar Peças</button>
        </div>
      </section>

      <!-- Opções de pagamento -->
      <section class="payment-options">
        <div class="option">
          <input type="text" placeholder="Digite o valor">
          <label><input type="checkbox"> Débito</label>
        </div>
        <div class="option">
          <input type="text" placeholder="Digite o valor">
          <label><input type="checkbox"> Crédito</label>
        </div>
        <div class="option">
          <input type="text" placeholder="Digite o valor">
          <label><input type="checkbox"> PIX</label>
        </div>
        <div class="option">
          <input type="text" placeholder="Digite o valor">
          <label><input type="checkbox"> Boleto</label>
        </div>
        <div class="option">
          <input type="text" placeholder="Digite o valor">
          <label><input type="checkbox"> Dinheiro</label>
        </div>
      </section>

      <!-- Botão de pagamento -->
      <div class="payment-area">
        <input type="text" id="valorTotal" placeholder="R$" readonly>
        <button onclick="finalizarPagamento()">Pagar</button>
      </div>
    </main>
  </div>

  <script>
    // Selecionar serviço
    document.querySelectorAll('.service-item').forEach(item => {
      item.addEventListener('click', function () {
        // Remove seleção anterior
        document.querySelectorAll('.service-item').forEach(el => el.classList.remove('selected-service'));
        this.classList.add('selected-service');

        // Mostrar detalhes do serviço
        const serviceDetails = document.querySelector('.service-details');
        serviceDetails.style.display = 'block';

        // Preencher detalhes
        document.getElementById('servicoId').textContent = this.dataset.id;
        document.getElementById('servicoTipo').textContent = this.dataset.tipo;
        document.getElementById('servicoPreco').textContent = this.dataset.preco;
        document.getElementById('servicoCliente').textContent = this.dataset.cliente;

        // Atualizar valor total
        document.getElementById('valorTotal').value = this.dataset.preco;
      });
    });

    function adicionarPecas() {
      const pecasSelect = document.getElementById('pecasSelect');
      const selectedPecas = Array.from(pecasSelect.selectedOptions).map(option => ({
        id: option.value,
        nome: option.dataset.nome,
        quantidade: parseInt(option.dataset.quantidade)
      }));

      if (selectedPecas.length === 0) {
        alert('Selecione pelo menos uma peça');
        return;
      }

      // Validar quantidade
      const pecasValidas = selectedPecas.filter(peca => peca.quantidade > 0);
      if (pecasValidas.length !== selectedPecas.length) {
        alert('Algumas peças selecionadas estão sem estoque');
        return;
      }

      // Confirmação de uso
      const confirmacao = confirm(`Deseja realmente usar as seguintes peças?\n${selectedPecas.map(p => p.nome).join(', ')}`);

      if (confirmacao) {
        // Preparar dados para enviar ao servidor
        const dadosEnvio = {
          servicoId: document.getElementById('servicoId').textContent,
          pecas: selectedPecas.map(p => p.id)
        };

        // Enviar requisição para atualizar estoque e serviço
        fetch('processar_pagamento.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(dadosEnvio)
        })
          .then(response => response.json())
          .then(data => {
            if (data.sucesso) {
              alert('Peças baixadas do estoque com sucesso!');
              location.reload(); // Recarregar página
            } else {
              alert('Erro ao processar pagamento: ' + data.mensagem);
            }
          })
          .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao processar pagamento');
          });
      }
    }

    function finalizarPagamento() {
      const servicoId = document.getElementById('servicoId').textContent;
      if (!servicoId) {
        alert('Selecione um serviço primeiro');
        return;
      }

      // Lógica de pagamento
      const confirmacao = confirm('Deseja finalizar o pagamento deste serviço?');

      if (confirmacao) {
        fetch('processar_pagamento.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            servicoId: servicoId,
            finalizarServico: true
          })
        })
          .then(response => response.json())
          .then(data => {
            if (data.sucesso) {
              alert('Serviço finalizado com sucesso!');
              location.reload(); // Recarregar página
            } else {
              alert('Erro ao finalizar serviço: ' + data.mensagem);
            }
          })
          .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao finalizar serviço');
          });
      }
    }

    // Função para adicionar produto temporariamente
    function adicionarProduto(produtoId, nome, preco) {
      // Adicionar à lista de selecionados sem baixar do estoque
      const listaProdutos = document.getElementById('listaProdutos');
      const novoProduto = document.createElement('li');
      novoProduto.innerHTML = `
        ${nome} - R$ ${preco} 
        <button onclick="removerProduto(this, ${produtoId})">Remover</button>
    `;
      novoProduto.dataset.produtoId = produtoId;
      listaProdutos.appendChild(novoProduto);
    }

    // Função para remover produto da lista
    function removerProduto(botao, produtoId) {
      botao.closest('li').remove();
    }

    // Função de pagamento
    function processarPagamento() {
      const listaProdutos = document.getElementById('listaProdutos');
      const produtos = Array.from(listaProdutos.children).map(li =>
        parseInt(li.dataset.produtoId)
      );

      const dadosPagamento = {
        servicoId: servicoAtualId, // ID do serviço atual
        pecas: produtos,
        finalizarServico: true
      };

      fetch('processar_pagamento.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(dadosPagamento)
      })
        .then(response => response.json())
        .then(data => {
          if (data.sucesso) {
            alert('Pagamento processado com sucesso!');
            // Limpar lista de produtos
            listaProdutos.innerHTML = '';
            // Atualizar lista de produtos/estoque na página
            location.reload();
          } else {
            alert('Erro no processamento: ' + data.mensagem);
          }
        })
        .catch(error => {
          console.error('Erro:', error);
          alert('Erro no processamento do pagamento');
        });
    }
  </script>
</body>

</html>