<?php
//DBの設定ファイルから変数をロード
require_once("../../db_config.php");
// MySQLに接続
if(!isset($mysqli)){
  $mysqli = new mysqli('localhost', $db_user, $db_pass, $db_name);
  $mysqli->set_charset("utf8");
  $result_message = '';
}
//メッセージの更新
if($_SERVER['REQUEST_METHOD'] == 'PUT'){
  //PUTメソッドで受け取ったパラメーターをupdate_paramに格納
  parse_str(file_get_contents('php://input'), $update_param);
  if(!empty($update_param['password']) and !empty($update_param['update_id']) and !empty($update_param['thread_id']) and !empty($update_param['update_name']) and !empty($update_param['update_msg'])){
    //受け取ったidでレコードを取得
    $update_id = $mysqli->real_escape_string($update_param['update_id']);
    $body = $mysqli->real_escape_string($update_param['update_msg']);
    $name = $mysqli->real_escape_string($update_param['update_name']);
    $update_pass = $mysqli->real_escape_string($update_param['password']);
    $result = $mysqli->query("update `messages` set `body` = '{$body}',`name` = '{$name}' where `id` = '{$update_id}' and `password` = '{$update_pass}'");
    if($mysqli->affected_rows!==0){
      $result_message="更新成功";
    }
    else{
      $result_message="更新失敗";
    }
  }else{
    $result_message = "すべてのテキストボックスに入力してください";
  }
}
//Requestメソッドが違う
else{
  $result_message = 'HTTP Request Error';
}
echo $result_message;
?>
