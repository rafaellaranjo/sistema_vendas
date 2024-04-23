<?php
class Routes {
    private $method;
    private $path;

    private function __construct() {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public static function route() {
        $route = new Routes();
        $route->execute();
    }

    private function execute() {
        $routes = [
            '/venda' => 'VendaController',
            '/venda_produtos' => 'VendaProdutosController',
            '/produtos' => 'ProdutoController',
            '/percentual_impostos' => 'PercentualImpostoController',
            '/tipos_produto' => 'TipoProdutoController'
        ];

        $user_routes = [
            '/register' => 'registrar',
            '/login' => 'login'
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
                        
                    } else if (isset($_GET['venda_id'])) {
                        $instance->getProdutosVenda();
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
        } else if (isset($user_routes[$this->path])) {
            $instance = UsuarioController::getInstance();
            $function = $user_routes[$this->path];

            switch ($this->method) {
                case 'POST':
                    $instance->$function();
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
