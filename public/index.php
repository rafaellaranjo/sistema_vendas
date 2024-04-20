<?php
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

// routes
require_once '../routes.php';

Routes::route();
?>
