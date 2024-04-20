<?php
class PercentualImpostoRoutes {
    public static function create() {
        if (!isset($_POST['nome']) || !isset($_POST['valor']) || !isset($_POST['tipo_produto_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetros incompletos']);
            return;
        }

        $nome = $_POST['nome'];
        $valor = $_POST['valor'];
        $tipoProdutoId = $_POST['tipo_produto_id'];

        $percentualImpostoController = PercentualImpostoController::getInstance();
        $percentualId = $percentualImpostoController->create($nome, $valor, $tipoProdutoId);

        echo json_encode(['percentual_id' => $percentualId]);
    }

    public static function update() {
        $body = file_get_contents('php://input');
        parse_str($body, $data);

        if (!isset($data['id']) || !isset($data['nome']) || !isset($data['valor']) || !isset($data['tipo_produto_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetros incompletos']);
            return;
        }

        $id = $data['id'];
        $nome = $data['nome'];
        $valor = $data['valor'];
        $tipoProdutoId = $data['tipo_produto_id'];

        $percentualImpostoController = PercentualImpostoController::getInstance();
        $success = $percentualImpostoController->update($id, $nome, $valor, $tipoProdutoId);

        if ($success) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao atualizar o percentual de imposto']);
        }
    }

    public static function list() {
        $percentualImpostoController = PercentualImpostoController::getInstance();
        $percentuais = $percentualImpostoController->list();
        echo json_encode($percentuais);
    }

    public static function show() {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID do percentual de imposto não especificado']);
            return;
        }
        
        $id = $_GET['id'];
        
        $percentualImpostoController = PercentualImpostoController::getInstance();
        $percentual = $percentualImpostoController->show($id);
        
        if ($percentual) {
            echo json_encode($percentual);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Percentual de imposto não encontrado']);
        }
    }
}

?>
