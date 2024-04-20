<?php
class VendaRoutes {
    public static function create() {
        if (!isset($_POST['cliente']) || !isset($_POST['status'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetros incompletos']);
            return;
        }

        $cliente = $_POST['cliente'];
        $status = $_POST['status'];

        $vendaController = VendaController::getInstance();
        $vendaId = $vendaController->create($cliente, $status);

        echo json_encode(['venda_id' => $vendaId]);
    }

    public static function update() {
        $body = file_get_contents('php://input');
        parse_str($body, $data);

        if (!isset($data['id']) || !isset($data['cliente']) || !isset($data['status'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetros incompletos']);
            return;
        }

        $id = $data['id'];
        $cliente = $data['cliente'];
        $status = $data['status'];

        $vendaController = VendaController::getInstance();
        $success = $vendaController->update($id, $cliente, $status);

        if ($success) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao atualizar a venda']);
        }
    }

    public static function list() {
        $vendaController = VendaController::getInstance();
        $vendas = $vendaController->list();

        echo json_encode($vendas);
    }

    public static function show() {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID da venda não especificado']);
            return;
        }

        $id = $_GET['id'];

        $vendaController = VendaController::getInstance();
        $venda = $vendaController->show($id);

        if ($venda) {
            echo json_encode($venda);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Venda não encontrada']);
        }
    }

    public static function delete() {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID da venda não especificado']);
            return;
        }

        $id = $_GET['id'];

        $vendaController = VendaController::getInstance();
        $success = $vendaController->delete($id);

        if ($success) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao excluir a venda']);
        }
    }
}

?>
