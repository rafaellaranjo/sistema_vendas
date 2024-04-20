<?php
class VendaProdutoRoutes {
    public static function create() {
        if (!isset($_POST['venda_id']) || !isset($_POST['produto_id']) || !isset($_POST['quantidade'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetros incompletos']);
            return;
        }

        $venda_id = $_POST['venda_id'];
        $produto_id = $_POST['produto_id'];
        $quantidade = $_POST['quantidade'];

        $vendaProdutosController = VendaProdutosController::getInstance();
        $vendaProdutoId = $vendaProdutosController->create($venda_id, $produto_id, $quantidade);

        echo json_encode(['venda_produto_id' => $vendaProdutoId]);
    }

    public static function update() {
        $body = file_get_contents('php://input');
        parse_str($body, $data);

        if (!isset($data['id']) || !isset($data['venda_id']) || !isset($data['produto_id']) || !isset($data['quantidade'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetros incompletos']);
            return;
        }

        $id = $data['id'];
        $venda_id = $data['venda_id'];
        $produto_id = $data['produto_id'];
        $quantidade = $data['quantidade'];

        $vendaProdutosController = VendaProdutosController::getInstance();
        $success = $vendaProdutosController->update($id, $venda_id, $produto_id, $quantidade);

        if ($success) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao atualizar o item da venda']);
        }
    }

    public static function list() {
        $vendaProdutosController = VendaProdutosController::getInstance();
        $vendaProdutos = $vendaProdutosController->list();

        echo json_encode($vendaProdutos);
    }

    public static function show() {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID do item da venda não especificado']);
            return;
        }

        $id = $_GET['id'];

        $vendaProdutosController = VendaProdutosController::getInstance();
        $vendaProduto = $vendaProdutosController->show($id);

        if ($vendaProduto) {
            echo json_encode($vendaProduto);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Item da venda não encontrado']);
        }
    }

    public static function delete() {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID do item da venda não especificado']);
            return;
        }

        $id = $_GET['id'];

        $vendaProdutosController = VendaProdutosController::getInstance();
        $success = $vendaProdutosController->delete($id);

        if ($success) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao excluir o item da venda']);
        }
    }
}

?>
