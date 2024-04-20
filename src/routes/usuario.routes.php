<?php
class UsuarioRoutes {
    public static function route_registrar() {
        $usuarioController = UsuarioController::getInstance();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['username'], $_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $userId = $usuarioController->registrar($username, $password);

                echo json_encode(['user_id' => $userId]);
            } else {

                echo json_encode(['error' => 'Campos inválidos']);
            }
        } else {

            echo json_encode(['error' => 'Método não permitido']);
        }
    }

    public static function route_login() {
        $usuarioController = UsuarioController::getInstance();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['username'], $_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $userId = $usuarioController->login($username, $password);
                if ($userId) {
                    echo json_encode(['user_id' => $userId]);
                } else {
                    echo json_encode(['error' => 'Nome de usuário ou senha incorretos']);
                }
            } else {
                echo json_encode(['error' => 'Campos inválidos']);
            }
        } else {
            echo json_encode(['error' => 'Método não permitido']);
        }
    }
}
?>