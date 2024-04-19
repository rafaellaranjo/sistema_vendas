<?php
class TipoProdutoRoutes {
    public static function create() {
        if (!isset($_POST['nome'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetros incompletos']);
            return;
        }

        $tipoProdutoController = TipoProdutoController::getInstance();
        $nome = $_POST['nome'];
        $tipoProdutoId = $tipoProdutoController->create($nome);
        echo json_encode(['tipo_produto_id' => $tipoProdutoId]);
    }

    public static function update() {
        $body = file_get_contents('php://input');
        parse_str($body, $data);

        if (!isset($data['id']) || !isset($data['nome'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetros incompletos']);
            return;
        }

        $id = $data['id'];
        $nome = $data['nome'];
    
        $tipoProdutoController = TipoProdutoController::getInstance();
        $tipoProdutoId = $tipoProdutoController->update($id, $nome);

        echo json_encode(['sucesso' => $tipoProdutoId]);
    }
    

    public static function list() {
        $tipoProdutoController = TipoProdutoController::getInstance();
        $tiposProdutos = $tipoProdutoController->list();
        echo json_encode($tiposProdutos);
    }

    public static function show() {
        $tipoProdutoController = TipoProdutoController::getInstance();
        $id = $_GET['id'];
        $tipoProduto = $tipoProdutoController->show($id);

        if ($tipoProduto) {
            echo json_encode($tipoProduto);
        } else {
            echo json_encode(['error' => 'Tipo de produto não encontrado']);
        }
    }

}

?>
