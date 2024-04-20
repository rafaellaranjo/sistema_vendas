<?php
class VendaProdutosController extends Controller {
    private static $instance;
    private $vendaProdutosRepository;
    private $table = 'venda_produtos';
    private $request_fields = ['venda_id', 'produto_id', 'quantidade'];

    public function __construct() {
        $this->vendaProdutosRepository = new VendaProdutosRepository();
        parent::__construct($this->vendaProdutosRepository, $this->table, $this->request_fields);
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new VendaProdutosController();
        }
        return self::$instance;
    }
}

?>
