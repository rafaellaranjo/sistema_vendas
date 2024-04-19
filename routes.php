<?php
class Routes {
    private $method;
    private $path;

    private function __construct() {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->path = $_SERVER['REQUEST_URI'];
    }

    public static function route() {
        $route = new Routes();
        $route->execute();
    }

    private function execute() {
        if ($this->path == '/venda') {
            $vendaController = new VendaController();
            $vendaController->exibirFormulario();
        } elseif ($this->path == '/processar_venda') {
            $vendaController = new VendaController();
            $vendaController->processarVenda();
        } elseif ($this->path == '/produtos') {
            $produtoController = new ProdutoController();
            $produtoController->exibirLista();
        } elseif (strstr($this->path, '/percentual_impostos')) {
            if ($this->method  === 'POST') {
                PercentualImpostoRoutes::create();

            } elseif ($this->method === 'GET') {
                
                if (isset($_GET['id'])) {
                    PercentualImpostoRoutes::show();

                } else {
                    PercentualImpostoRoutes::list();

                }
            } elseif ($this->method  === 'PUT') {
                PercentualImpostoRoutes::update();
            }
        } elseif (strstr($this->path, '/tipos_produto')) {
            if ($this->method  === 'POST') {
                TipoProdutoRoutes::create();

            } elseif ($this->method === 'GET') {
                
                if (isset($_GET['id'])) {
                    TipoProdutoRoutes::show();

                } else {
                    TipoProdutoRoutes::list();

                }
            } elseif ($this->method  === 'PUT') {
                TipoProdutoRoutes::update();
            }
        } elseif ($this->path == '/register') {
            UsuarioRoutes::route_registrar();

        } elseif ($this->path == '/login') {
            UsuarioRoutes::route_login();

        }
    }
}