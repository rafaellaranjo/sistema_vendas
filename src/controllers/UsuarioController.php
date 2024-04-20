<?php
class UsuarioController {
    private $table;
    private static $instance;
    private $usuarioRepository;

    public function __construct() {
        $this->table = 'tipos_produto';
        $this->usuarioRepository = new UsuarioRepository();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new UsuarioController();
        }
        return self::$instance;
    }

    public function registrar($username, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $this->usuarioRepository->create($this->table, ['username' => $username, 'password' => $hashedPassword]);
    }

    public function login($username, $password) {
        return $this->usuarioRepository->login($username, $password);
    }
}
