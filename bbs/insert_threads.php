<?php

  //DBの設定ファイルから変数をロード
  require_once("../db_config.php");

  // MySQLに接続
  $mysqli = new mysqli('localhost', $db_user, $db_pass, $db_name);
  $mysqli->set_charset("utf8");
  $result_message = '';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // フォームで受け取ったメッセージをデータベースに登録
    if (!empty($_POST['thread_name']) and !empty($_POST['pass'])) {
      $thread_name = $mysqli->real_escape_string($_POST['thread_name']);
      $thread_pass = $mysqli->real_escape_string($_POST['pass']);
      $result = $mysqli->query("insert into `threads` (`name`,`password`) values ('{$thread_name}','{$thread_pass}')");
      if($result){
        $result_message = 'データベースに登録しました！XD';
      }
      else{
        $result_message = "登録失敗";
      }
    } else {
      $result_message = 'メッセージを入力してください...XO';
    }
  }
  echo $result_message;
?>
