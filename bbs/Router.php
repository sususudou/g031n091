<?php
//URLをルーティングするクラス
class Router{
  // public function __construct(){
  //   require_once('routing_config.php');
  // }
  public function redirect(){
    include('./view/index.php');
  }
  public function route($req){
    //受け取ったURIから空文字を取り除いた配列を生成
    $params = array_values(array_filter(explode('/',$req),"strlen"));
    var_dump($params);
    //１つ目のパラメータ名と一致するviewファイルを呼び出す
    include('./view/'.$params[1].'.php');
    //2

    //コントローラークラスの読み込み
    require_once('./controller/'.ucfirst($params[1]).'Controller.php');
    $ctrl_class = ucfirst($params[1])."Controller";
    $controller = new $ctrl_class();
  }
  public function get_path(){
    return $_SERVER['SCRIPT_NAME'];
  }
  private $default_root;
  private $view_root;
  private $model_root;
  private $controller_root;
}

?>
