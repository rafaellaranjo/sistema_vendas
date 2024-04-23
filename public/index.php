<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Origin: http://localhost:5173');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Se sim, enviar cabeçalhos CORS e sair
    http_response_code(200);
    exit;
}
// models
require_once '../src/models/Database.php';
require_once '../src/models/Usuario.php';
require_once '../src/models/TipoProduto.php';
require_once '../src/models/Produto.php';
require_once '../src/models/PercentualImpostos.php';
require_once '../src/models/Venda.php';
require_once '../src/models/VendaProdutos.php';

// controllers
require_once '../src/controllers/Controller.php';
require_once '../src/controllers/VendaController.php';
require_once '../src/controllers/VendaProdutosController.php';
require_once '../src/controllers/ProdutoController.php';
require_once '../src/controllers/TipoProdutoController.php';
require_once '../src/controllers/UsuarioController.php';
require_once '../src/controllers/PercentualImpostosController.php';

// repositories
require_once '../src/repositories/Repository.php';
require_once '../src/repositories/TipoProdutoRepository.php';
require_once '../src/repositories/PercentualImpostosRepository.php';
require_once '../src/repositories/UsuarioRepository.php';
require_once '../src/repositories/ProdutoRepository.php';
require_once '../src/repositories/VendaRepository.php';
require_once '../src/repositories/VendaProdutosRepository.php';

// utils
require_once '../src/utils/handleJsonRequest.php';

// routes
require_once '../routes.php';

Routes::route();
?>
