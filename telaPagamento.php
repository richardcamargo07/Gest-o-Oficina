<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tela de Pagamento</title>
  <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
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

      <!-- Lista de serviços -->
      <section class="services">
        <h3>Serviços</h3>
        <ul>
          <li>Item 1</li>
          <li>Item 2</li>
          <li>Item 3</li>
        </ul>
      </section>

      <!-- Botão de pagamento -->
      <div class="payment-area">
        <input type="text" placeholder="R$">
        <button>Pagar</button>
      </div>
    </main>
  </div>
</body>
</html>