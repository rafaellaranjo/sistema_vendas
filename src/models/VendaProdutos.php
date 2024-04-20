<?php
class VendaProduto {
    private $id;
    private $venda_id;
    private $produto_id;
    private $quantidade;
    private $created_at;
    private $updated_at;
    private $deleted_at;

    public function __construct($id, $venda_id, $produto_id, $quantidade, $created_at = null, $updated_at = null, $deleted_at = null) {
        $this->id = $id;
        $this->venda_id = $venda_id;
        $this->produto_id = $produto_id;
        $this->quantidade = $quantidade;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->deleted_at = $deleted_at;
    }

    public function getId() {
        return $this->id;
    }

    public function getVendaId() {
        return $this->venda_id;
    }

    public function setVendaId($venda_id) {
        $this->venda_id = $venda_id;
    }

    public function getProdutoId() {
        return $this->produto_id;
    }

    public function setProdutoId($produto_id) {
        $this->produto_id = $produto_id;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
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

?>
