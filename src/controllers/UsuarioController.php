<?php
class UsuarioController {
    private $table;
    private static $instance;
    private $usuarioRepository;

    public function __construct() {
        $this->table = 'usuarios';
        $this->usuarioRepository = new UsuarioRepository();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new UsuarioController();
        }
        return self::$instance;
    }

    public function registrar() {
        $params = handleJsonRequest(['username', 'password']);

        if (isset($params['username'], $params['password'])) {
            $username = $params['username'];
            $password = $params['password'];

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $userId = $this->usuarioRepository->create($this->table, ['username' => $username, 'password' => $hashedPassword]);

            echo json_encode(['user_id' => $userId]);
        } else {

            echo json_encode(['error' => 'Campos inválidos']);
        }
    }

    public function login() {
        $params = handleJsonRequest(['username', 'password']);

        if (isset($params['username'], $params['password'])) {
            $username = $params['username'];
            $password = $params['password'];

            $userId = $this->usuarioRepository->login($username, $password);

            if ($userId) {
                echo json_encode(['user_id' => $userId]);
            } else {
                echo json_encode(['error' => 'Nome de usuário ou senha incorretos']);
            }
        } else {
            echo json_encode(['error' => 'Campos inválidos']);
        }
    }
}
