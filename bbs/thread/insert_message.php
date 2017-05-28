<?php
  //DBの設定ファイルから変数をロード
  require_once("../../db_config.php");

  // MySQLに接続
  $mysqli = new mysqli('localhost', $db_user, $db_pass, $db_name);
  $mysqli->set_charset("utf8");
  $result_message = '';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // フォームで受け取ったメッセージをデータベースに登録
    if (!empty($_POST['message']) and !empty($_POST['pass']) and !empty($_POST['name'])) {
      $body = $mysqli->real_escape_string($_POST['message']);
      $pass = $mysqli->real_escape_string($_POST['pass']);
      $name = $mysqli->real_escape_string($_POST['name']);
      $thread_id = $mysqli->real_escape_string($_POST['thread_id']);
      $mysqli->query("insert into `messages` (`body`,`password`,`name`,`thread_id`) values ('{$body}','{$pass}','{$name}','{$thread_id}')");
      $result_message = 'データベースに登録しました！XD';
    } else {
      $result_message = 'すべてのボックスに入力をしてください...XO';
    }
  }
 ?>
