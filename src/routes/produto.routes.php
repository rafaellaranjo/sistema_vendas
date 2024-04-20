<?php
class ProdutoRoutes {
    public static function create() {
        if (!isset($_POST['nome']) || !isset($_POST['quantidade']) || !isset($_POST['valor']) || !isset($_POST['tipo_produto_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetros incompletos']);
            return;
        }

        $nome = $_POST['nome'];
        $quantidade = $_POST['quantidade'];
        $valor = $_POST['valor'];
        $tipoProdutoId = $_POST['tipo_produto_id'];

        $produtoController = ProdutoController::getInstance();
        $produtoId = $produtoController->create($nome, $quantidade, $valor, $tipoProdutoId);

        echo json_encode(['produto_id' => $produtoId]);
    }

    public static function update() {
        $body = file_get_contents('php://input');
        parse_str($body, $data);

        if (!isset($data['id']) || !isset($data['nome']) || !isset($data['quantidade']) || !isset($data['valor']) || !isset($data['tipo_produto_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetros incompletos']);
            return;
        }

        $id = $data['id'];
        $nome = $data['nome'];
        $quantidade = $data['quantidade'];
        $valor = $data['valor'];
        $tipoProdutoId = $data['tipo_produto_id'];

        $produtoController = ProdutoController::getInstance();
        $success = $produtoController->update($id, $nome, $quantidade, $valor, $tipoProdutoId);

        if ($success) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao atualizar o produto']);
        }
    }

    public static function list() {
        $produtoController = ProdutoController::getInstance();
        $produtos = $produtoController->list();

        echo json_encode($produtos);
    }

    public static function show() {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID do produto não especificado']);
            return;
        }

        $id = $_GET['id'];

        $produtoController = ProdutoController::getInstance();
        $produto = $produtoController->show($id);

        if ($produto) {
            echo json_encode($produto);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Produto não encontrado']);
        }
    }

    public static function delete() {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID do produto não especificado']);
            return;
        }

        $id = $_GET['id'];

        $produtoController = ProdutoController::getInstance();
        $success = $produtoController->delete($id);

        if ($success) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao excluir o produto']);
        }
    }
}

?>
