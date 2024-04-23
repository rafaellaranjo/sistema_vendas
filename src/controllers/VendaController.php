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

    public function list() {
        $result = $this->repository->list($this->table);
        $vendaProdutosController = VendaProdutosController::getInstance();

        foreach ($result as $key => $item) {

            $produtoVenda = json_decode(json_encode($vendaProdutosController->customizeProdutosVenda($item['id'])), true);

            $item['valor'] = $item['imposto'] = 0;
            $item['produtos'] = [];
            foreach ($produtoVenda as $value) {
                $item['valor'] += $value['valor'];
                $item['imposto'] += $value['imposto'];
                $item['produtos'][] = $value['produto'];   
            }

            $item['produtos'] = $item['produtos'];

            $result[$key] = $item;
        }

        if ($result) {
            $this->respondSuccess($result);
        } else {
            $this->respondError(404, 'Não encontrado');
        }
    }
}

?>
