<?php

  //DBの設定ファイルから変数をロード
  require_once("../../db_config.php");

  // MySQLに接続
  $mysqli = new mysqli('localhost', $db_user, $db_pass, $db_name);
  $mysqli->set_charset("utf8");
  $result_message = '';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // フォームで受け取ったメッセージをデータベースに登録
    if (!empty($_POST['message']) and !empty($_POST['pass'])) {
      $body = $mysqli->real_escape_string($_POST['message']);
      $pass = $mysqli->real_escape_string($_POST['pass']);
      $mysqli->query("insert into `messages` (`body`,`pass`) values ('{$body}','{$pass}')");
      $result_message = 'データベースに登録しました！XD';
    } else {
      $result_message = 'メッセージを入力してください...XO';
    }

    // メッセージの削除
    if (!empty($_POST['delete'])&&!empty($_POST['id'])) {
      //受け取ったidでレコードを取得
      $del_id = $mysqli->real_escape_string($_POST['id']);
      $result = $mysqli->query("select * from `messages` where `id` = {$del_id}");
      //POSTされた削除パスワードとDBの削除パスワードを比較
      //一致していたら削除
      foreach($result as $row){
        if($row['pass'] == $_POST['del_pass']){
          $mysqli->query("delete from `messages` where `id` = {$del_id}");
          $result_message = 'メッセージを削除しました ;)';
        } else{
          $result_message = '削除パスワードが違います XO';
        }
      }
    }
    //メッセージの更新
    else if(!empty($_POST['update'])&&!empty($_POST['id'])){
      //受け取ったidでレコードを取得
      $del_id = $mysqli->real_escape_string($_POST['id']);
      $body = $mysqli->real_escape_string($_POST['update_msg']);
      $result = $mysqli->query("select * from `messages` where `id` = {$del_id}");
      //POSTされたパスワードとDBのパスワードを比較
      //一致していたら更新
      foreach($result as $row){
        if($row['pass'] == $_POST['del_pass']){
          $mysqli->query("update `messages` set `body` = '{$body}' where `id` = {$del_id}");
          $result_message = 'メッセージを更新しました ;)';
        } else{
          $result_message = '更新パスワードが違います XO';
        }
      }
    }
  }
  // データベースからレコード取得
  $result = $mysqli->query('select * from `messages` order by `id` desc');
?>

<html>
  <head>
    <meta charset="UTF-8">
    <!-- bootstrapを使う -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
      *{
        margin:5px;
        padding:5px;
      }
    </style>
  </head>

  <body>
    <p><?php echo $result_message; ?></p>
    <form action="" method="post">
      <input type="text" name="message" value="" />
      <input type="password" name="pass" value="">
      <input type="submit" />
    </form>

    <table>
      <tr>
        <th>Message</th>
        <th>Password</th>
      </tr>
    <?php foreach ($result as $row) : ?>
      <tr>
        <form action="" method="post">
          <td><input type="text" name="update_msg" value="<?php echo htmlspecialchars($row['body']); ?>"></td>
          <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
          <td><input type="password" name="del_pass" value=""></td>
          <td><input class="btn btn-success" type="submit" name="update" value="update"></td>
          <td><input class="btn btn-danger" type="submit" name="delete" value="delete" /></td>
        </form>
      </tr>
    <?php endforeach; ?>
    </table>
  </body>
</html>
