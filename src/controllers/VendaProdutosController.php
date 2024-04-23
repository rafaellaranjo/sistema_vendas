<?php
class VendaProdutosController extends Controller {
    private static $instance;
    private $vendaProdutosRepository;
    private $percentualImpostoRepository;
    private $produtoRepository;
    private $table = 'venda_produtos';
    private $request_fields = ['venda_id', 'produto_id', 'quantidade'];

    public function __construct() {
        $this->vendaProdutosRepository = new VendaProdutosRepository();
        $this->percentualImpostoRepository = new PercentualImpostoRepository();
        $this->produtoRepository = new ProdutoRepository();
        parent::__construct($this->vendaProdutosRepository, $this->table, $this->request_fields);
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new VendaProdutosController();
        }
        return self::$instance;
    }

    public function getProdutosVenda($venda_id = null) {
        if ($venda_id == null) {
            if ($_GET['venda_id']) {
                $venda_id = $_GET['venda_id'];
            } else {
                $this->respondError(400, 'ID não especificado');
                return;
            }
        }
        $result = $this->customizeProdutosVenda($venda_id);

        if ($result) {
            $this->respondSuccess($result);
        } else {
            $this->respondError(404, 'Não encontrado');
        }
    }

    public function customizeProdutosVenda($venda_id = null) {
        $result = $this->vendaProdutosRepository->getProdutosVenda($this->table, $venda_id);

        foreach ($result as $key => $item) {
            $produto = $this->produtoRepository->show('produtos', $item['produto_id']);
            $impostos = $this->percentualImpostoRepository->getImpostos('percentuais_imposto', $produto['tipo_produto_id']);
            $item['valor'] = $produto['valor'] * $item['quantidade'];
            $item['produto'] = $produto['nome'];
            
            $valor_imposto = 0;
            foreach ($impostos as $imposto) {
                $valor_imposto += $imposto['valor'];
            }

            $item['imposto'] = $item['valor'] * $valor_imposto / 100;
            $result[$key] = $item;
        }

        return $result;
    }
}

?>
