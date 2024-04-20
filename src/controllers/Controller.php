<?php
abstract class Controller {
    protected $repository;
    private $table;
    private $fields;

    public function __construct($repository, $table, $fields) {
        $this->repository = $repository;
        $this->table = $table;
        $this->fields = $fields;
    }

    public function create() {
        $requestData = $this->validateRequestData($_POST, $this->fields);
        if (!$requestData) {
            $this->respondError(400, 'Parâmetros incompletos');
            return;
        }

        $response = $this->repository->create($this->table, $requestData);
        $this->respondSuccess(['id' => $response]);
    }

    public function update() {
        $body = file_get_contents('php://input');
        parse_str($body, $requestData);

        $requestData = $this->validateRequestData($requestData, $this->fields);
        if (!$requestData || !isset($requestData['id'])) {
            $this->respondError(400, 'Parâmetros incompletos');
            return;
        }

        $response = $this->repository->update($this->table, $requestData['id'], $requestData);
        if ($response) {
            $this->respondSuccess(['success' => true]);
        } else {
            $this->respondError(500, 'Erro ao atualizar');
        }
    }

    public function list() {
        $result = $this->repository->list($this->table);
        $this->respondSuccess($result);
    }

    public function show() {
        if (!isset($_GET['id'])) {
            $this->respondError(400, 'ID não especificado');
            return;
        }

        $id = $_GET['id'];
        $result = $this->repository->show($this->table, $id);
        if ($result) {
            $this->respondSuccess($result);
        } else {
            $this->respondError(404, 'Não encontrado');
        }
    }

    public function delete() {
        if (!isset($_GET['id'])) {
            $this->respondError(400, 'ID não especificado');
            return;
        }

        $id = $_GET['id'];
        $response = $this->repository->delete($this->table, $id);
        if ($response) {
            $this->respondSuccess($response);
        } else {
            $this->respondError(404, 'Não encontrado');
        }
    }

    protected function validateRequestData($requestData, $requiredFields) {
        foreach ($requiredFields as $field) {
            if (!isset($requestData[$field])) {
                http_response_code(400);
                echo json_encode(['error' => "Campo '$field' não especificado"]);
                return false;
            }
        }
        return true;
    }

    protected function respondError($statusCode, $message) {
        http_response_code($statusCode);
        echo json_encode(['error' => $message]);
    }

    protected function respondSuccess($data) {
        echo json_encode($data);
    }
}

?>
