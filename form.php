<html>
  <head>
    <title></title>
  </head>
  <body>
    <form id="form_id" action="form.php" method="post">
      <p>
        パソコンのキーボードが一ヶ所壊れたら作業ができなくなってしまいました<br>
        さてどのキーが壊れたでしょう？
      </p>
      <input type="text" name="res" value="" required />
      <input type="submit" >
    </form>
    <p>
    <?php
      if(!empty($_POST)){
        $answers = ["s","S","ｓ","えす","エス"];
        echo "あなたの答え:".$_POST['res']."\t";
        if(in_array($_POST['res'],$answers)){
          echo "正解";
        }
        else{
          echo "不正解";
        }
      }
     ?>
   </p>
  </body>
</html>
