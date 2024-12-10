<?php
include_once('config_o.php');

// Receber dados do pagamento
$json = file_get_contents('php://input');
$data = json_decode($json, true);

$response = ['sucesso' => false, 'mensagem' => ''];

if (isset($data['servicoId'])) {
    try {
        // Iniciar transação
        $conexao->begin_transaction();

        // Se houver peças para baixar
        if (isset($data['pecas']) && is_array($data['pecas'])) {
            foreach ($data['pecas'] as $pecaId) {
                // Baixar quantidade da peça
                $updatePeca = "UPDATE produtos SET quantidade = quantidade - 1 WHERE id = ?";
                $stmt = $conexao->prepare($updatePeca);
                $stmt->bind_param('i', $pecaId);
                
                if (!$stmt->execute()) {
                    throw new Exception("Erro ao atualizar estoque da peça $pecaId");
                }
                $stmt->close();
            }
        }

        // Se for para finalizar o serviço
        if (isset($data['finalizarServico']) && $data['finalizarServico'] === true) {
            // Remover serviço
            $deleteServico = "DELETE FROM servicos WHERE id = ?";
            $stmt = $conexao->prepare($deleteServico);
            $stmt->bind_param('i', $data['servicoId']);
            
            if (!$stmt->execute()) {
                throw new Exception("Erro ao remover serviço");
            }
            $stmt->close();
        }

        // Commitar transação
        $conexao->commit();

        $response['sucesso'] = true;
        $response['mensagem'] = 'Processamento concluído com sucesso';
    } catch (Exception $e) {
        // Rollback em caso de erro
        $conexao->rollback();
        $response['mensagem'] = $e->getMessage();
    }
} else {
    $response['mensagem'] = 'Dados inválidos';
}

// Enviar resposta
header('Content-Type: application/json');
echo json_encode($response);
$conexao->close();
?>