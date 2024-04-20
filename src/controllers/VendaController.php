<?php
class VendaController extends Controller {
    private static $instance;
    private $vendaRepository;
    private $table = 'vendas';
    private $request_fields = ['cliente', 'status'];

    public function __construct() {
        $this->vendaRepository = new VendaRepository();
        parent::__construct($this->vendaRepository, $this->table, $this->request_fields);
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new VendaController();
        }
        return self::$instance;
    }
}

?>
