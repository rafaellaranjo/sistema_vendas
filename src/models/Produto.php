<?php
class Produto {
    private $id;
    private $nome;
    private $quantidade;
    private $valor;
    private $tipoProdutoId;
    private $created_at;
    private $updated_at;
    private $deleted_at;

    public function __construct($id, $nome, $quantidade, $valor, $tipoProdutoId, $created_at = null, $updated_at = null, $deleted_at = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->quantidade = $quantidade;
        $this->valor = $valor;
        $this->tipoProdutoId = $tipoProdutoId;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->deleted_at = $deleted_at;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function getTipoProdutoId() {
        return $this->tipoProdutoId;
    }

    public function setTipoProdutoId($tipoProdutoId) {
        $this->tipoProdutoId = $tipoProdutoId;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }

    public function getDeletedAt() {
        return $this->deleted_at;
    }

    public function setDeletedAt($deleted_at) {
        $this->deleted_at = $deleted_at;
    }
}
