<?php
class TipoProdutoController {
    private $table;
    private static $instance;
    private $tipoProdutoRepository;

    public function __construct() {
        $this->table = 'tipos_produto';
        $this->tipoProdutoRepository = new TipoProdutoRepository();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new TipoProdutoController();
        }
        return self::$instance;
    }

    public function create($nome) {
        return $this->tipoProdutoRepository->create($this->table, ['nome' => $nome]);
    }

    public function update($id, $nome) {
        return $this->tipoProdutoRepository->update($this->table, $id, ['nome' => $nome]);
    }

    public function list() {
        return $this->tipoProdutoRepository->list($this->table);
    }

    public function show($id) {
        return $this->tipoProdutoRepository->show($this->table, $id);
    }

    public function delete($id) {
        return $this->tipoProdutoRepository->delete($this->table, $id);
    }
}

?>
