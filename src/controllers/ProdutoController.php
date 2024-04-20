<?php
class ProdutoController {
    private $table;
    private static $instance;
    private $produtoRepository;

    public function __construct() {
        $this->table = 'produtos';
        $this->produtoRepository = new ProdutoRepository();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new ProdutoController();
        }
        return self::$instance;
    }

    public function create($nome, $quantidade, $valor, $tipoProdutoId) {
        return $this->produtoRepository->create($this->table, ['nome' => $nome, 'quantidade' => $quantidade, 'valor' => $valor, 'tipoProdutoId' => $tipoProdutoId]);
    }

    public function update($id, $nome, $quantidade, $valor, $tipoProdutoId) {
        return $this->produtoRepository->update($this->table, $id, ['nome' => $nome, 'quantidade' => $quantidade, 'valor' => $valor, 'tipoProdutoId' => $tipoProdutoId]);
    }

    public function list() {
        return $this->produtoRepository->list($this->table);
    }

    public function show($id) {
        return $this->produtoRepository->show($this->table, $id);
    }

    public function delete($id) {
        return $this->produtoRepository->delete($this->table, $id);
    }
}

?>
