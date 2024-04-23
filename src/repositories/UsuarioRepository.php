<?php
class UsuarioRepository  extends Repository {
    private static $instance;

    public function __construct() {
        parent::__construct();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new UsuarioRepository();
        }
        return self::$instance;
    }

    public function login($username, $password) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // if ($user && password_verify($password, $user['password'])) {
            return $user['id'];
        // } else {
        //     return false;
        // }
    }
}

?>