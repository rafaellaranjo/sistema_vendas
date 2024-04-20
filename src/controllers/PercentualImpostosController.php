<?php
class PercentualImpostoController {
    private $table;
    private static $instance;
    private $percentualImpostoRepository;

    public function __construct() {
        $this->table = 'percentuais_imposto';
        $this->percentualImpostoRepository = new PercentualImpostoRepository();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new PercentualImpostoController();
        }
        return self::$instance;
    }

    public function create($nome, $valor, $tipoProdutoId) {
        return $this->percentualImpostoRepository->create($this->table, ['nome' => $nome, 'valor' => $valor, 'tipo_produto_id' => $tipoProdutoId]);
    }

    public function update($id, $nome, $valor, $tipoProdutoId) {
        return $this->percentualImpostoRepository->update($this->table, $id, ['nome' => $nome, 'valor' => $valor, 'tipo_produto_id' => $tipoProdutoId]);
    }

    public function list() {
        return $this->percentualImpostoRepository->list($this->table);
    }

    public function show($id) {
        return $this->percentualImpostoRepository->show($this->table, $id);
    }

    public function delete($id) {
        return $this->percentualImpostoRepository->delete($this->table, $id);
    }
}

?>
