<html>
  <head>
    <title></title>
    <meta charset="UTF-8">
  </head>
  <body>
    <form id="form_id" action="form3.php" method="post">
      <p>
        あなたの好きな食べ物はなんですか？
      </p>
      <input type="checkbox" name="res2[]" value="わんこそば">わんこそば
      <input type="checkbox" name="res2[]" value="盛岡冷麺">盛岡冷麺
      <input type="checkbox" name="res2[]" value="じゃじゃ麺">じゃじゃ麺
      <?php
      if(!empty($_POST['res1'])){
        foreach($_POST['res1'] as $val){
          echo '<input type="hidden" name="res1[]" value="'.$val.'">'.PHP_EOL;
        }
      }
      ?>
      <input type="submit">
    </form>
  </body>
</html>
