<?php
class VendaController {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function exibirFormulario() {
        // Lógica para exibir o formulário de venda
    }

    public function processarVenda() {
        // Lógica para processar a venda
    }    
}