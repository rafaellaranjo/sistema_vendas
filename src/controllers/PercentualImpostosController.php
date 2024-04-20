<?php
class PercentualImpostoController extends Controller {
    private static $instance;
    private $percentualImpostoRepository;
    private $table = 'percentuais_imposto';
    private $request_fields = ['nome', 'valor', 'tipo_produto_id'];

    public function __construct() {
        $this->percentualImpostoRepository = new PercentualImpostoRepository();
        parent::__construct($this->percentualImpostoRepository, $this->table, $this->request_fields);
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new PercentualImpostoController();
        }
        return self::$instance;
    }
}

?>
