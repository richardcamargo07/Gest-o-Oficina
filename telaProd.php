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

// Consulta SQL para buscar os produtos cadastrados
$sql = "SELECT nome, descricao, qunatidade, imagem FROM produtos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Cadastrados</title>
    <style>
        .produto {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            display: inline-block;
            width: 250px;
            text-align: center;
        }
        .produto img {
            max-width: 200px;
            max-height: 200px;
        }
    </style>
</head>
<body>
    <h1>Produtos Cadastrados</h1>
    
    <div class="produtos">
        <?php
        if ($result->num_rows > 0) {
            // Exibe cada produto
            while($row = $result->fetch_assoc()) {
                echo '<div class="produto">';
                echo '<h2>' . $row["nome"] . '</h2>';
                echo '<p>' . $row["descricao"] . '</p>';
                echo '<p>Preço: R$' . number_format($row["quantidade"], 2, ',', '.') . '</p>';
                echo '<img src="uploads/' . $row["imagem"] . '" alt="Imagem do Produto">';
                echo '</div>';
            }
        } else {
            echo "<p>Nenhum produto cadastrado.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
