<?php
class ProdutoController extends Controller {
    private static $instance;
    private $produtoRepository;
    private $tipoProdutoRepository;
    private $table = 'produtos';
    private $request_fields = ['nome', 'quantidade', 'valor', 'tipo_produto_id'];

    public function __construct() {
        $this->produtoRepository = new ProdutoRepository();
        $this->tipoProdutoRepository = new TipoProdutoRepository();
        parent::__construct($this->produtoRepository, $this->table, $this->request_fields);
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new ProdutoController();
        }
        return self::$instance;
    }

    public function list () {
        $result = $this->repository->list($this->table);

        foreach ($result as $key => $item) {
            $item['tipo_produto'] = $this->tipoProdutoRepository->show('tipos_produto', $item['tipo_produto_id'])['nome'];
            $result[$key] = $item;
        }
        
        $this->respondSuccess($result);
    }
}

?>
