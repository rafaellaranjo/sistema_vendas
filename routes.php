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
        $routes = [
            '/venda' => 'VendaRoutes',
            '/venda_produtos' => 'VendaProdutosController',
            '/produtos' => 'ProdutoRoutes',
            '/percentual_impostos' => 'PercentualImpostoRoutes',
            '/tipos_produto' => 'TipoProdutoRoutes',
            '/register' => 'UsuarioRoutes',
            '/login' => 'UsuarioRoutes'
        ];

        if (isset($routes[$this->path])) {
            $controller = $routes[$this->path];
            $instance = $controller::getInstance();

            switch ($this->method) {
                case 'POST':
                    $instance->create();
                    break;
                case 'GET':
                    if (isset($_GET['id'])) {
                        $instance->show();
                    } else {
                        $instance->list();
                    }
                    break;
                case 'PUT':
                    $instance->update();
                    break;
                case 'DELETE':
                    $instance->delete();
                    break;
                default:
                    http_response_code(405);
                    echo json_encode(['error' => 'Método HTTP não suportado']);
                    break;
            }
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Rota não encontrada']);
        }
    }
}
?>
