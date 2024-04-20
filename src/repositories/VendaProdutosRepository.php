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
}

?>