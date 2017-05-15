<?php

  require_once($_SERVER['DOCUMENT_ROOT']."/db_config.php");

  // MySQLに接続
  $mysqli = new mysqli('localhost', $db_user, $db_pass, $db_name);
  $mysqli->set_charset("utf8");
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['message']) and !empty($_POST['name'])) {
      $mysqli->query("insert into `messages` (`body`,`name`) values ('{$_POST['message']}','{$_POST['name']}')");
      $result_message = 'データベースに登録しました！XD';
    } else {
      $result_message = 'メッセージまたは名前を入力してください...XO';
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
    <div id="flash">
      <strong> <?php echo $result_message; ?> </strong>
    </div>
    <form action="" method="post">
      <input type="text" name="name" value="" placeholder="your name">
      <input type="text" name="message" value="" placeholder="message">
      <input type="submit" >
    </form>
    <ul>
      <?php foreach($results as $result):?>
        <li>
          <?php echo "name:" .$result['name']; ?>
          <?php echo "<br/>"; ?>
          <?php echo "mess:" .$result['body']; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </body>
</html>
