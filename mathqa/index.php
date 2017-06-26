<?php
require 'vendor/autoload.php';

$base = '/mathqa/';
$handlers = function(FastRoute\RouteCollector $r) use($base) {
    $r->addRoute('GET', $base, 'index');
    $r->addRoute('GET', $base.'login', 'login');
    $r->addRoute('GET', $base.'login/', 'login');
    $r->addRoute('POST', $base.'login', 'login');
    $r->addRoute('POST', $base.'login/', 'login');
    $r->addRoute('GET', $base.'logout', 'logout');
    $r->addRoute('GET', $base.'logout/', 'logout');
};

// $dispatcher = FastRoute\simpleDispatcher($handlers);

$dispatcher = FastRoute\cachedDispatcher($handlers, [
    'cacheFile' => __DIR__ . '/route.cache',
    'cacheDisabled' => true
]);

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$routeInfo = $dispatcher->dispatch($method, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "NOT FOUND\n";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo "METHOD NOT ALLOWED\n";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        echo $handler($vars);
        break;
}

function check_login(){
  session_start();
  echo $_SESSION['user_id'];
  if(!isset($_SESSION['user_id'])){
    header('Location: http://localhost:8888/mathqa/login/');
  }
}

function index($vars)
{
    check_login();
    include './view/index.php';
}

function login($vars)
{
    include './view/login.php';
}
function logout($vars){
    session_start();
    $_SESSION = array();
    session_destroy();
    check_login();

}


 ?>
