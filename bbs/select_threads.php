<?php

//DBの設定ファイルから変数をロード
  require_once("../db_config.php");

  // MySQLに接続
  $mysqli = new mysqli('localhost', $db_user, $db_pass, $db_name);
  $mysqli->set_charset("utf8");
  $result_message = '';

  $result = $mysqli->query('select * from `threads` order by `id` desc');
  //以下のforeach文で出力されるhtmlをajaxに返す
?>

<?php foreach ($result as $row) : ?>
  <tr>
    <td>
      <a href="thread?id=<?php echo $row['id']; ?>">
      <?php echo htmlspecialchars($row['name']); ?>
    </td>
    <td>
      <?php echo $row['timestamp']; ?>
    </td>
    <td>
      <button class="delete-confirm-modal">削除</button>
      <div data-modal="hide">
        <strong>確認</strong>
        <p>
          削除するには設定したパスワードを入力してください
        </p>
        <form action="" class="delete" data-id="<?php echo $row['id'];?>" method="">
          <input type="password" name="pass" value="">
          <input type="hidden" name="thread_id" value="<?php echo $row['id'];?>">
          <button type="submit" name="button_type" value="delete">削除</button>
        </form>
      </div>
    </td>
  </tr>
<?php endforeach ?>
