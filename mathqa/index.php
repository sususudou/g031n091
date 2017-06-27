<?php
require 'vendor/autoload.php';

$base = '/mathqa/';
$handlers = function(FastRoute\RouteCollector $r) use($base) {
    // 実際に表示されるページ
    $r->addRoute('GET', $base, 'index');

    $r->addRoute('GET', $base.'login', 'login');
    $r->addRoute('GET', $base.'login/', 'login');

    $r->addRoute('POST', $base.'login', 'login');
    $r->addRoute('POST', $base.'login/', 'login');

    $r->addRoute('GET', $base.'logout', 'logout');
    $r->addRoute('GET', $base.'logout/', 'logout');

    $r->addRoute('GET', $base.'question', 'question');
    $r->addRoute('GET', $base.'question/', 'question');

    $r->addRoute('GET', $base.'question/{question_id}', 'question');
    $r->addRoute('GET', $base.'question/{question_id}/', 'question');

    // questionのリソース操作　API部　
    $r->addRoute('POST', $base.'question', 'insert_question');
    $r->addRoute('POST', $base.'question/', 'insert_question');

    $r->addRoute('PUT', $base.'question/{question_id}', 'update_question');
    $r->addRoute('PUT', $base.'question/{question_id}/', 'update_question');

    $r->addRoute('DELETE', $base.'question/{question_id}', 'delete_question');
    $r->addRoute('DELETE', $base.'question/{question_id}/', 'delete_question');

    // replyのリソース操作 API部
    $r->addRoute('POST', $base.'question/{question_id}/reply', 'insert_reply');
    $r->addRoute('POST', $base.'question/{question_id}/reply/', 'insert_reply');

    $r->addRoute('PUT', $base.'question/{question_id}/reply/{reply_id}', 'update_reply');
    $r->addRoute('PUT', $base.'question/{question_id}/reply/{reply_id}/', 'update_reply');

    $r->addRoute('DELETE', $base.'question/{question_id}/reply/{reply_id}', 'delete_reply');
    $r->addRoute('DELETE', $base.'question/{question_id}/reply/{reply_id}/', 'delete_reply');

    //質問と返信の更新フォーム呼び出し
    $r->addRoute('GET', $base.'edit/question/{question_id}', 'edit_question');
    $r->addRoute('GET', $base.'edit/question/{question_id}/', 'edit_question');

    $r->addRoute('GET', $base.'edit/question/{question_id}/reply/{reply_id}', 'edit_reply');
    $r->addRoute('GET', $base.'edit/question/{question_id}/reply/{reply_id}/', 'edit_reply');
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
// ページ表示前、リソース操作前に呼ばれる関数

  //login状態でなかったらloginページにリダイレクトする
  function check_logged_in(){
    session_start();
    if(!isset($_SESSION['user_id'])){
      header('Location: http://localhost:8888/mathqa/login/');
    }
  }

  //当該IDのquestionが存在するか確かめる
  function exists_question($id){
    /*
      query
    */
    //1件のみ取得できた場合true
    if($mysqli->affected_row == 1){
      return true;
    }
    return false;
  }

  //questionを操作したいユーザーが編集する権限を持っているかを確認する
  function question_authority_exists($id){
    /*
      query
     */
     foreach ($result as $row) {
       if($row['users_id'] == $_SESSION['user_id']){
         //作成者とログインユーザーが同じならtrueを返す
         return true;
       }
     }
     return false;
  }

  //当該IDのreplyが存在するか確かめる
  function exsits_reply($question_id,$reply_id){
    //親の質問がなかったらfalseを返す
    if(!exists_question($question_id)){
      return false;
    }
    /*
      query
    */
    //1件のみ取得できた場合true
    if($mysqli->affected_row == 1){
      return true;
    }
    return false;
  }

  //replyを操作したいユーザーが編集する権限を持っているかを確認する
  function reply_authority_exists($id){
    /*
      query
     */
     foreach ($result as $row) {
       if($row['users_id'] == $_SESSION['user_id']){
         //作成者とログインユーザーが同じならtrueを返す
         return true;
       }
     }
     return false;
  }
// ページをレンダリングする関数
  //トップページ
  function index($vars){
      //check_logged_in();
      include './view/index.php';
  }
  // ログインページ
  function login($vars){
      include './view/login.php';
  }

  function logout($vars){
      session_start();
      $_SESSION = array();
      session_destroy();
      check_logged_in();
  }
  // 質問一覧及び質問詳細
  function question($vars){
    check_logged_in();
    if(isset($vars['question_id'])){
      echo 'question '.$vars['question_id'];
    }else{
      echo 'questions list';
    }
  }
// リソースを操作する関数
  //返信を挿入する関数
  function insert_reply($vars){
    //親の質問がなければ終了
    if(!exsits_question($vars['question_id'])){
      return false;
    }
    /*
      query
    */
    return $mysqli->affected_row;
  }
  //返信を更新する
  function update_reply($vars){
    //返信そのものがないか更新権限がなければ終了
    if(!(exsits_reply($vars['question_id'],$vars['reply_id']) and reply_authority_exists($vars['reply_id']))){
      return false;
    }
    /*
      query
    */
    return $mysqli->affected_row;
  }

  //返信を削除する
  function delete_reply($vars){
    //返信そのものがないか更新権限がなければ終了
    if(!(exsits_reply($vars['question_id'],$vars['reply_id']) and reply_authority_exists($vars['reply_id']))){
      return false;
    }
    /*
      query
    */
    return $mysqli->affected_row;
  }
 ?>
