<html>
  <head>
    <title></title>
  </head>
  <body>
    <form id="form_id" action="radio.php" method="post">
      <p>
        アインシュタインがノーベル物理学賞を受賞した研究は？
      </p>
      <input type="radio" name="res" value="0">ブラウン運動
      <input type="radio" name="res" value="1">一般相対性理論
      <input type="radio" name="res" value="2">特殊相対性理論
      <input type="radio" name="res" value="3">光電効果
      <input type="submit" >
    </form>
    <p>
    <?php
      if(!empty($_POST)){
        $answer = "3";
        $res_set = ["ブラウン運動","一般相対性理論","特殊相対性理論","光電効果"];
        echo "あなたの答え:".$res_set[$_POST['res']]."\t";
        if($answer === $_POST['res']){
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
