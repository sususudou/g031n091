<?php
//DBの設定ファイルから変数をロード
require_once("../../db_config.php");

// MySQLに接続
if(!isset($mysqli)){
  $mysqli = new mysqli('localhost', $db_user, $db_pass, $db_name);
  $mysqli->set_charset("utf8");
  $result_message = '';
}
// データベースからレコード取得
parse_str($mysqli->real_escape_string($_SERVER['QUERY_STRING']),$qs);
$thread_id="";
?>
<?php if(!empty($qs['id'])):
  $thread_id = $qs['id'];
  $result = $mysqli->query("select * from `messages` where `thread_id` = '{$thread_id}' order by `id` desc");
  ?>
  <?php if(isset($result)): ?>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td>
          <?php echo htmlspecialchars($row['name']);?>
        </td>
        <td>
          <?php echo htmlspecialchars($row['body']);?>
        </td>
        <td>
          <button class="btn-success update-confirm-modal">更新</button>
          <div data-modal="hide">
            <strong>確認</strong>
            <p>更新するには設定したパスワードを入力してください</p>
            <form class="update" action="" method="">
              <input type="text" name="update_name" required value="<?php echo htmlspecialchars($row['name']); ?>">
              <input type="text" name="update_msg" required value="<?php echo htmlspecialchars($row['body']); ?>">
              <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>" />
              <input type="hidden" name="thread_id" value="<?php echo $row['thread_id']; ?>" />
              <input type="password" name="pass" required value="">
              <input class="btn btn-success" type="submit" name="update" value="update">
            </form>
          </div>
        </td>
        <td>
          <button class="delete-call delete-confirm-modal">削除</button>
          <div data-modal="hide">
            <strong>確認</strong>
            <p>削除するには設定したパスワードを入力してください</p>
            <form class="delete" action="" method="">
              <input type="hidden" name="message_id" value="<?php echo $row['id']; ?>" />
              <input type="password" name="pass" required value="">
              <input class="btn btn-danger" type="submit" name="delete" value="delete" />
            </form>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <p>不正なthread_idです</p>
  <?php endif; ?>
<?php else:?>
  <p>不正なthread_idです</p>
<?php endif;?>
