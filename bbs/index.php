<?php
  require_once('Router.php');
  $router = new Router;
  if(!empty($router->get_path())){
      $router->route($_SERVER['REQUEST_URI']);
  }
  else{
    $router->redirect();
  }

?>
