<html>
  <head>
    <title></title>
    <meta charset="UTF-8">
  </head>
  <body>
    <p>
      興味のある研究分野を選択してください =>
      <?php
      if(!empty($_POST['res1'])){
        foreach($_POST['res1'] as $key => $val){ echo $val.PHP_EOL;}
      }
      ?>
    </p>
    <p>
      あなたの好きな食べ物はなんですか？ =>
      <?php
      if(!empty($_POST['res2'])){
        foreach($_POST['res2'] as $key => $val){ echo $val.PHP_EOL;}
      }
      ?>
    </p>
    <p>
      好きな言語はなんですか？ =>
      <?php
      if(!empty($_POST['res3'])){
        foreach($_POST['res3'] as $key => $val){ echo $val.PHP_EOL;}
      }
      ?>
    </p>
  </body>
</html>
