<?php
class PercentualImpostoController {
    private static $instance;
    private $db;

    private function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new PercentualImpostoController();
        }
        return self::$instance;
    }

    public function create($nome, $valor, $tipoProdutoId) {
        try {
            $stmt = $this->db->prepare("INSERT INTO percentuais_imposto (nome, valor, tipo_produto_id) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $valor, $tipoProdutoId]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo "Erro ao criar o percentual de imposto: " . $e->getMessage();
            return false;
        }
    }

    public function update($id, $nome, $valor, $tipoProdutoId) {
        try {
            $stmt = $this->db->prepare("UPDATE percentuais_imposto SET nome = ?, valor = ?, tipo_produto_id = ? WHERE id = ?");
            $stmt->execute([$nome, $valor, $tipoProdutoId, $id]);
            return true;
        } catch (PDOException $e) {
            echo "Erro ao atualizar o percentual de imposto: " . $e->getMessage();
            return false;
        }
    }

    public function list() {
        try {
            $stmt = $this->db->query("SELECT * FROM percentuais_imposto");
            $percentuais = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $percentuais[] = new PercentualImposto($row['id'], $row['nome'], $row['valor'], $row['tipo_produto_id'], $row['created_at'], $row['updated_at'], $row['deleted_at']);
            }
            return $percentuais;
        } catch (PDOException $e) {
            echo "Erro ao listar os percentuais de imposto: " . $e->getMessage();
            return [];
        }
    }

    public function show($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM percentuais_imposto WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new PercentualImposto($row['id'], $row['nome'], $row['valor'], $row['tipo_produto_id'], $row['created_at'], $row['updated_at'], $row['deleted_at']);
            } else {
                return null; // Percentual de imposto não encontrado
            }
        } catch (PDOException $e) {
            echo "Erro ao obter o percentual de imposto: " . $e->getMessage();
            return null;
        }
    }
}

?>
