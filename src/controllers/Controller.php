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
        $params = handleJsonRequest($this->fields);
        $response = $this->repository->create($this->table, $params);
        $this->respondSuccess(['id' => $response]);
    }

    public function update() {
        $params = handleJsonRequest($this->fields);
        $response = $this->repository->update($this->table, $_GET['id'], $params);
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
