<html>
  <head>
    <title></title>
    <meta charset="UTF-8">
  </head>
  <body>
    <form id="form_id" action="res.php" method="post">
      <p>
        好きな言語はなんですか？
      </p>
      <input type="checkbox" name="res3[]" value="JavaScript">JavaScript
      <input type="checkbox" name="res3[]" value="PHP">PHP
      <input type="checkbox" name="res3[]" value="Ruby">Ruby
      <input type="checkbox" name="res3[]" value="Python">Python
      <?php
      if(!empty($_POST['res1'])){
      foreach($_POST['res1'] as $val){
        echo '<input type="hidden" name="res1[]" value="'.$val.'">'.PHP_EOL;
      }
    }
      ?>
      <?php
      if(!empty($_POST['res2'])){
        foreach($_POST['res2'] as $val){
          echo '<input type="hidden" name="res2[]" value="'.$val.'">'.PHP_EOL;
        }
      }
      ?>
      <input type="submit">
    </form>
  </body>
</html>
