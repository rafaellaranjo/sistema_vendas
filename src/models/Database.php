<?php

class Database {
    private static $instance;
    private $conn;

    private function __construct() {
        $env = file_get_contents('../.env');
        $env_lines = explode("\n", $env);

        foreach ($env_lines as $line) {
            if (!empty($line)) {
                list($key, $value) = explode('=', $line);
                $_ENV[$key] = trim($value);
            }
        }

        try {
            $dsn = "mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_NAME']}";
            $this->conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,    PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            error_log("Erro na conexão com o banco de dados: " . $e->getMessage());
            throw new Exception("Erro na conexão com o banco de dados. Por favor, tente novamente mais tarde.");
        }
    }
    
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

    public function close() {
        $this->conn = null;
    }
}

?>
