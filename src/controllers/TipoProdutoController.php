<?php
class TipoProdutoController extends Controller {
    private static $instance;
    private $tipoProdutoRepository;
    private $table = 'tipos_produto';
    private $request_fields = ['nome'];

    public function __construct() {
        $this->tipoProdutoRepository = new TipoProdutoRepository();
        parent::__construct($this->tipoProdutoRepository, $this->table, $this->request_fields);
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new TipoProdutoController();
        }
        return self::$instance;
    }
}

?>
