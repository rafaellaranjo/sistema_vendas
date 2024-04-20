<?php
class ProdutoController extends Controller {
    private static $instance;
    private $produtoRepository;
    private $table = 'produtos';
    private $request_fields = ['nome', 'quantidade', 'valor', 'tipo_produto_id'];

    public function __construct() {
        $this->produtoRepository = new ProdutoRepository();
        parent::__construct($this->produtoRepository, $this->table, $this->request_fields);
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new ProdutoController();
        }
        return self::$instance;
    }
}

?>
