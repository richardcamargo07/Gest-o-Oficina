<?php
// Conecte ao banco de dados (substitua pelas suas credenciais)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oficina";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Recebendo os dados do formulário
$nome_produto = $_POST['nome_produto'];
$descricao_produto = $_POST['descricao_produto'];
$preco_produto = $_POST['preco_produto'];
$categoria = $_POST['categoria_produto'];

// Tratando a imagem
$imagem_produto = $_FILES['imagem_produto'];

if ($imagem_produto['error'] === UPLOAD_ERR_OK) {
    // Nome único para a imagem
    $nome_imagem = uniqid() . "-" . basename($imagem_produto['name']);
    $diretorio_destino = "uploads/" . $nome_imagem;

    // Movendo a imagem para o diretório
    if (move_uploaded_file($imagem_produto['tmp_name'], $diretorio_destino)) {
        // Salvando os dados no banco
        $sql = "INSERT INTO produtos (nome, descricao, quantidade, imagem, categoria) VALUES ('$nome_produto', '$descricao_produto', '$preco_produto', '$nome_imagem', '$categoria')";

        if ($conn->query($sql) === TRUE) {
            echo "Produto cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar produto: " . $conn->error;
        }
    } else {
        echo "Falha ao fazer upload da imagem.";
    }
} else {
    echo "Erro no upload da imagem.";
}

$conn->close();
?>
