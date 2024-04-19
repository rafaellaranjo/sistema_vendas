<?php
class TipoProdutoController {
    private static $instance;
    private $db;

    private function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new TipoProdutoController();
        }
        return self::$instance;
    }

    public function create($nome) {
        $stmt = $this->db->prepare("INSERT INTO tipos_produto (nome) VALUES (?)");
        $stmt->execute([$nome]);

        return $this->db->lastInsertId();
    }

    public function update($id, $nome) {
        $stmt = $this->db->prepare("UPDATE tipos_produto SET nome = ? WHERE id = ?");
        $stmt->execute([$nome, $id]);
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function list() {
        $stmt = $this->db->query("SELECT * FROM tipos_produto WHERE deleted_at IS NULL");
        $tiposProdutos = [];
        while ($row = $stmt->fetch()) {
            $tiposProdutos[] = new TipoProduto($row['id'], $row['nome'], $row['created_at'], $row['updated_at'], $row['deleted_at']);
        }

        return $tiposProdutos;
    }

    public function show($id) {
        $stmt = $this->db->prepare("SELECT * FROM tipos_produto WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        if ($row) {
            $tipoProduto = new TipoProduto($row['id'], $row['nome'], $row['created_at'], $row['updated_at'], $row['deleted_at']);
            return $tipoProduto;
        } else {
            return null;
        }
    }
}
