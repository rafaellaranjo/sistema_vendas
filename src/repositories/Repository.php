<?php
class Repository {
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($table, $data) {
        $columns = implode(', ', array_keys($data));
        $values = array_values($data);
        $placeholders = rtrim(str_repeat('?, ', count($values)), ', ');

        $stmt = $this->db->prepare("INSERT INTO $table ($columns) VALUES ($placeholders)");
        $stmt->execute($values);

        return $this->db->lastInsertId();
    }

    public function update($table, $id, $data) {
        $currentDateTime = new DateTime();
        $updated_at = $currentDateTime->format('Y-m-d H:i:s'); 
        $setClause = 'updated_at = ?, ';
        $values[] = $updated_at;

        foreach ($data as $key => $value) {
            $setClause .= "$key = ?, ";
            $values[] = $value;
        }
        $setClause = rtrim($setClause, ', ');

        $stmt = $this->db->prepare("UPDATE $table SET $setClause WHERE id = ?");
        $values[] = $id;
        $stmt->execute($values);

        return $stmt->rowCount() > 0;
    }

    public function list($table, $conditions = []) {
        $whereClause = '';
        $values = [];
        if (!empty($conditions)) {
            $whereClause = 'WHERE ';
            foreach ($conditions as $key => $value) {
                $whereClause .= "$key = ? AND ";
                $values[] = $value;
            }
            $whereClause = rtrim($whereClause, 'AND ');
        }

        $stmt = $this->db->prepare("SELECT * FROM $table $whereClause");
        $stmt->execute($values);

        $result = [];
        while ($row = $stmt->fetch()) {
            $result[] = $row;
        }

        return $result;
    }

    public function show($table, $id) {
        $stmt = $this->db->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        return $row ? $row : null;
    }

    public function delete($table, $id) {
        $stmt = $this->db->prepare("DELETE FROM $table WHERE id = ?");
        $stmt->execute([$id]);

        return $stmt->rowCount() > 0;
    }
}

?>
