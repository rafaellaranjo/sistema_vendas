<?php
class PercentualImpostoController extends Controller {
    private static $instance;
    private $percentualImpostoRepository;
    private $tipoProdutoRepository;
    private $table = 'percentuais_imposto';
    private $request_fields = ['nome', 'valor', 'tipo_produto_id'];

    public function __construct() {
        $this->percentualImpostoRepository = new PercentualImpostoRepository();
        $this->tipoProdutoRepository = new TipoProdutoRepository();
        parent::__construct($this->percentualImpostoRepository, $this->table, $this->request_fields);
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new PercentualImpostoController();
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
