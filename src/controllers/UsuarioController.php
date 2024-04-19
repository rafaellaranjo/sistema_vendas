<?php
class UsuarioController {
    public function registrar($username, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $hashedPassword]);

        return $conn->lastInsertId();
    }

    public function login($username, $password) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user['id'];
        } else {
            return false;
        }
    }
}
