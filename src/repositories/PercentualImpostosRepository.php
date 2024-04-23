<?php
class PercentualImpostoRepository  extends Repository {
    private static $instance;

    public function __construct() {
        parent::__construct();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new PercentualImpostoRepository();
        }
        return self::$instance;
    }

    public function getImpostos($table, $tipo_produto_id) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM $table WHERE tipo_produto_id = ?");
        $stmt->execute([$tipo_produto_id]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    }
}

?>
