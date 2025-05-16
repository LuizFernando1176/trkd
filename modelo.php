<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Produto | Traquinagem Kids</title>
  <link rel="stylesheet" href="/css/style.css" />
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    :root {
      --rosa: #dc017b;
      --verde: #8db546;
      --laranja: #f96d30;
      --amarelo: #fff3c4;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      background-color: #fff;
      color: #333;
    }

    .container {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 1rem;
      display: flex;
      gap: 2rem;
    }

    .image-section {
      flex: 1;
    }

    .image-section img {
      width: 100%;
      max-width: 500px;
      height: auto;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .details-section {
      flex: 1;
    }

    .details-section h1 {
      color: var(--rosa);
      font-size: 2rem;
    }

    .price {
      font-size: 1.5rem;
      font-weight: bold;
      color: var(--verde);
      margin: 1rem 0;
    }

    .description {
      font-size: 1rem;
      margin-bottom: 1rem;
    }

    .sizes label {
      margin-right: 0.5rem;
    }

    .buy-button {
      display: inline-block;
      background-color: var(--laranja);
      color: white;
      padding: 1rem 2rem;
      border: none;
      font-size: 1rem;
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .buy-button:hover {
      background-color: #d5561d;
    }

    #carrinho {
      background-color: #fef9c3;
      padding: 20px;
      border-radius: 12px;
      margin: 30px auto;
      max-width: 500px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    #carrinho h2 {
      text-align: center;
      color: #333;
    }

    #lista-carrinho li {
      margin: 5px 0;
    }

    .icone-voador {
      position: fixed;
      bottom: 20px;
      right: 20px;
      font-size: 2rem;
      display: none;
    }

    .icone-voador.mostrar {
      display: block;
      animation: flutuar 0.8s ease-in-out;
    }

    @keyframes flutuar {
      0% {
        transform: translateY(20px);
        opacity: 0;
      }

      50% {
        transform: translateY(-5px);
        opacity: 1;
      }

      100% {
        transform: translateY(0);
        opacity: 0;
      }
    }

    .animado {
      background-color: #fff9c4;
      transition: background-color 0.5s;
    }

    button.remover-btn {
      background-color: #f87171;
      color: white;
      padding: 5px 10px;
      border: none;
      border-radius: 4px;
      margin-left: 10px;
      cursor: pointer;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="image-section">
      <img src="http://localhost/trkd/img/portfolio/cake.png" alt="Conjunto Infantil Ninja Verde Lima">
    </div>

    <div class="details-section">
      <h1>Conjunto Infantil Menino Verão Ninja Kangulu Verde Lima</h1>
      <div class="price">R$ 32,99 <span style="text-decoration: line-through; color: #888; font-size: 1rem;">R$ 52,99</span></div>
      <div class="description">
        Conjunto super confortável e divertido, ideal para os dias quentes. Camiseta em malha leve com estampa de ninja e bermuda moletom com ajuste na cintura.
      </div>

      <div class="sizes">
        <p><strong>Tamanho:</strong></p>
        <label><input type="radio" name="tamanho" value="1"> 1</label>
        <label><input type="radio" name="tamanho" value="2"> 2</label>
        <label><input type="radio" name="tamanho" value="3"> 3</label>
        <label><input type="radio" name="tamanho" value="4"> 4</label>
        <label><input type="radio" name="tamanho" value="6"> 6</label>
      </div>

      <div style="margin-top: 1.8rem;">
        <div class="quantity">
          <p><strong>Quantidade:</strong></p>
          <input type="number" id="quantidade" name="quantidade" value="1" min="1" style="width: 60px; padding: 0.3rem;">
        </div>
        <button
          class="buy-button"
          onclick="adicionarAoCarrinho(this)"
          data-id="produto-ninja-lima"
          data-nome="Conjunto Infantil Ninja Lima"
          data-preco="32.99" style="margin-top: 1.8rem;">
          COMPRAR AGORA
        </button>

      </div>
    </div>
  </div>

  <section id="carrinho">
    <h2>🛒 Carrinho de Compras</h2>
    <ul id="lista-carrinho"></ul>
    <p><strong>Total:</strong> R$ <span id="total">0.00</span></p>
    <button onclick="limparCarrinho()" class="buy-button" style="background-color: #f87171;">🧹 Limpar Carrinho</button>
  </section>

  <div id="iconeCarrinho" class="icone-voador">🛍️</div>

  <script>
    let carrinho = [];
    let total = 0;

    window.onload = () => {
      const carrinhoSalvo = localStorage.getItem("carrinho");
      if (carrinhoSalvo) {
        carrinho = JSON.parse(carrinhoSalvo);
        atualizarCarrinho();
      }
    };

    function adicionarAoCarrinho(botao) {
      const tamanhoSelecionado = document.querySelector('input[name="tamanho"]:checked');
      const quantidadeInput = document.getElementById('quantidade');

      if (!tamanhoSelecionado) {
        Swal.fire({
          icon: 'warning',
          title: 'Tamanho não selecionado!',
          text: 'Por favor, selecione um tamanho antes de continuar.'
        });
        return;
      }

      const tamanho = tamanhoSelecionado.value;
      const quantidade = parseInt(quantidadeInput.value);

      if (isNaN(quantidade) || quantidade < 1) {
        Swal.fire({
          icon: 'error',
          title: 'Quantidade inválida!',
          text: 'Por favor, insira uma quantidade válida.'
        });
        return;
      }

      const idBase = botao.dataset.id;
      const nome = botao.dataset.nome;
      const preco = parseFloat(botao.dataset.preco);

      const id = `${idBase}-t${tamanho}`;

      const itemExistente = carrinho.find(prod => prod.id === id);

      if (itemExistente) {
        itemExistente.quantidade += quantidade;
      } else {
        carrinho.push({
          id: id,
          nome: nome,
          preco: preco,
          quantidade: quantidade,
          tamanho: tamanho
        });
      }

      salvarCarrinho();
      atualizarCarrinho();

      Swal.fire({
        icon: 'success',
        title: 'Produto adicionado!',
        text: 'Seu produto foi adicionado ao carrinho com sucesso.',
        showCancelButton: true,
        confirmButtonText: 'Ver carrinho',
        cancelButtonText: 'Continuar comprando',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          // Lógica para mostrar o carrinho ou redirecionar para a página do carrinho
          window.location.href = '/carrinho.html'; // ou abra um modal
        }
      });

      animarCarrinho();
    }

    function salvarCarrinho() {
      localStorage.setItem("carrinho", JSON.stringify(carrinho));
    }

    function atualizarCarrinho() {
      const lista = document.getElementById("lista-carrinho");
      lista.innerHTML = "";
      total = 0;

      carrinho.forEach((item, index) => {
        const li = document.createElement("li");
        li.textContent = `${item.nome} (Tam: ${item.tamanho}) x${item.quantidade} - R$ ${(item.preco * item.quantidade).toFixed(2)}`;

        const btnRemover = document.createElement("button");
        btnRemover.textContent = "Remover";
        btnRemover.className = "remover-btn";
        btnRemover.onclick = () => removerDoCarrinho(index);

        li.appendChild(btnRemover);
        lista.appendChild(li);

        total += item.preco * item.quantidade;
      });

      document.getElementById("total").textContent = total.toFixed(2);
    }

    function removerDoCarrinho(index) {
      carrinho.splice(index, 1);
      salvarCarrinho();
      atualizarCarrinho();
    }

    function limparCarrinho() {
      Swal.fire({
        title: 'Tem certeza?',
        text: "Você está prestes a limpar todo o carrinho.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim, limpar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          carrinho = [];
          salvarCarrinho();
          atualizarCarrinho();

          Swal.fire({
            icon: 'success',
            title: 'Carrinho limpo!',
            showConfirmButton: false,
            timer: 1500
          });
        }
      });
    }

    function animarCarrinho() {
      const lista = document.getElementById("lista-carrinho");
      const ultimo = lista.lastElementChild;

      if (ultimo) {
        ultimo.classList.add("animado");
        setTimeout(() => ultimo.classList.remove("animado"), 500);
      }

      const icone = document.getElementById("iconeCarrinho");
      if (icone) {
        icone.classList.add("mostrar");
        setTimeout(() => icone.classList.remove("mostrar"), 800);
      }
    }
  </script>

</body>

</html>