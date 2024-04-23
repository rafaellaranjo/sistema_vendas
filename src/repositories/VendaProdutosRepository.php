<?php
class VendaProdutosRepository extends Repository {
    private static $instance;

    public function __construct() {
        parent::__construct();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new VendaProdutosRepository();
        }
        return self::$instance;
    }

    public function getProdutosVenda($table, $venda_id) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM $table WHERE venda_id = ?");
        $stmt->execute([$venda_id]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    }
}

?>