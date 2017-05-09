<?php

  require_once($_SERVER['DOCUMENT_ROOT']."/db_config.php");

  // MySQLに接続
  $mysqli = new mysqli('localhost', $db_user, $db_pass, $db_name);
  $mysqli->set_charset("utf8");
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['message'])) {
      $mysqli->query("insert into `messages` (`body`) values ('{$_POST['message']}')");
      $result_message = 'データベースに登録しました！XD';
    } else {
      $result_message = 'メッセージを入力してください...XO';
    }
  }



  $results = $mysqli->query('select * from `messages` order by `id` desc');

?>
<!DOCTYPE html>
<html>
  <head>
    <title></title>
    <meta charset="utf-8">
  </head>
  <body>
    <form action="" method="post">
      <input type="text" name="message" value="">
      <input type="submit" >
    </form>
    <ul>
      <?php foreach($results as $result):?>
        <li>
          <?php echo $result['body']; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </body>
</html>
