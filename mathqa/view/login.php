<?php
  session_start();
  if(isset($_SESSION['user_id'])){
    header('Location: http://localhost:8888/mathqa/');
  }
  if(isset($_POST['user_name']) and isset($_POST['password'])){
    if($_POST['user_name'] == 'test' and $_POST['password'] == 'pass'){

      $_SESSION['user_id'] = 2;
      header('Location: http://localhost:8888/mathqa/');
    }
  }

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Lgoin</title>
  </head>
  <body>
    <form class="" action="" method="post">
      <input type="text" name="user_name" value="">
      <input type="password" name="password" value="">
      <input type="submit" value="login">
    </form>
  </body>
</html>
