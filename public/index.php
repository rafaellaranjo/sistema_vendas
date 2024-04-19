<?php
// models
require_once '../src/models/Produto.php';
require_once '../src/models/TipoProduto.php';
require_once '../src/models/Venda.php';
require_once '../src/models/Database.php';
require_once '../src/models/PercentualImpostos.php';
require_once '../src/models/Usuario.php';

// controllers
require_once '../src/controllers/VendaController.php';
require_once '../src/controllers/ProdutoController.php';
require_once '../src/controllers/TipoProdutoController.php';
require_once '../src/controllers/UsuarioController.php';
require_once '../src/controllers/PercentualImpostosController.php';

// routes
require_once '../src/routes/usuario.routes.php';
require_once '../src/routes/tipoProduto.routes.php';
require_once '../src/routes/percentualImpostos.route.php';
require_once '../routes.php';

Routes::route();
?>
