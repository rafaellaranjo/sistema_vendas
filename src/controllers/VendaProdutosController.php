<?php
class VendaProdutosController {
    private $table;
    private static $instance;
    private $vendaProdutosRepository;

    public function __construct() {
        $this->table = 'venda_produtos';
        $this->vendaProdutosRepository = new VendaProdutosRepository();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new VendaProdutosController();
        }
        return self::$instance;
    }

    public function create($vendaId, $produtoId, $quantidade) {
        if (!isset($_POST['venda_id']) || !isset($_POST['produto_id']) || !isset($_POST['quantidade'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetros incompletos']);
            return;
        }

        $venda_id = $_POST['venda_id'];
        $produto_id = $_POST['produto_id'];
        $quantidade = $_POST['quantidade'];

        return $this->vendaProdutosRepository->create($this->table, ['venda_id' => $vendaId, 'produto_id' => $produtoId, 'quantidade' => $quantidade]);
    }

    public function update($id, $vendaId, $produtoId, $quantidade) {
        return $this->vendaProdutosRepository->update($this->table, $id, ['venda_id' => $vendaId, 'produto_id' => $produtoId, 'quantidade' => $quantidade]);
    }

    public function list() {
        return json_encode($this->vendaProdutosRepository->list($this->table));
    }

    public function show($id) {
        return $this->vendaProdutosRepository->show($this->table, $id);
    }

    public function delete($id) {
        return $this->vendaProdutosRepository->delete($this->table, $id);
    }
}

?>
