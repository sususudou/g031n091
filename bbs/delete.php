<?php
//DBの設定ファイルから変数をロード
require_once("../db_config.php");
// MySQLに接続
$mysqli = new mysqli('localhost', $db_user, $db_pass, $db_name);
$mysqli->set_charset("utf8");
$result_message = '';
if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
  // メッセージの削除
  //requestパラメータをdelete_param変数に格納する
  parse_str(file_get_contents('php://input'), $delete_param);
  //threadの削除
  if (!empty($delete_param['thread_id']) and !empty($delete_param['password']) and empty($delete_param['message_id'])) {
    $del_id = $mysqli->real_escape_string($delete_param['thread_id']);
    $del_pass = $mysqli->real_escape_string($delete_param['password']);
    //delete methodで送られてきたパスワードとidがDBで一致していたら削除
    $result = $mysqli->query("delete from `threads` where `id` = {$del_id} AND `password` = '{$del_pass}' ");
    if($mysqli->affected_rows!==0){
      $result_message = '削除に成功しました';
    }
    else{
      $result_message = '削除に失敗しました';
    }
  }
  //messageの削除
  else if (!empty($delete_param['message_id']) and !empty($delete_param['password'])) {
    $del_id = $mysqli->real_escape_string($delete_param['message_id']);
    $del_pass = $mysqli->real_escape_string($delete_param['password']);
    //delete methodで送られてきたパスワードとidがDBで一致していたら削除
    $result = $mysqli->query("delete from `messages` where `id` = {$del_id} and `password` = '{$del_pass}' ");
    if($mysqli->affected_rows!==0){
      $result_message = '削除に成功しました';
    }
    else{
      $result_message = '削除に失敗しました';
    }
  }
  else{
    $result_message = 'パスワードを入力してください...XO';
  }
}
//Requestメソッドが違う
else{
  $result_message = 'HTTP Request Error';
}
//ajaxに成功の有無を返す
echo $result_message;
?>
