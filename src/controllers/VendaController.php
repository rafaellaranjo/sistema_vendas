<?php
class VendaController {
    private $table;
    private static $instance;
    private $vendaRepository;

    public function __construct() {
        $this->table = 'vendas';
        $this->vendaRepository = new VendaRepository();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new VendaController();
        }
        return self::$instance;
    }

    public function create($cliente, $status) {
        return $this->vendaRepository->create($this->table, ['cliente' => $cliente, 'status' => $status]);
    }

    public function update($id, $cliente, $status) {
        return $this->vendaRepository->update($this->table, $id, ['cliente' => $cliente, 'status' => $status]);
    }

    public function list() {
        return $this->vendaRepository->list($this->table);
    }

    public function show($id) {
        return $this->vendaRepository->show($this->table, $id);
    }

    public function delete($id) {
        return $this->vendaRepository->delete($this->table, $id);
    }
}

?>
