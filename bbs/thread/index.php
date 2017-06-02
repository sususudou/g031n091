<?php
$result_message ="";
parse_str($_SERVER['QUERY_STRING'],$qs);
?>

<html>
<head>
  <meta charset="UTF-8">
  <script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
  <!-- Google Fonts -->
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">

  <!-- CSS Reset -->
  <link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">

  <!-- Milligram CSS minified -->
  <link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">

  <!-- You should properly set the path from the main file. -->
  <style>
  *{
    margin:5px;
    padding:5px;
  }
  .btn-success{
    border-color:#4ec99a;
    background-color:#4ec99a;
    appearance:none;
  }
  [data-modal=hide]{
    display:none;
    padding:0;
    margin:0;
  }
  #wrapper{
    position:fixed;
    display:flex;
    width:100%;
    height:100%;
    background-color:rgba(0,0,0,0.5);
    top:0;
    left:0;
    padding:0;
    margin:0;
  }
  [data-modal=is-modal]{
    position:fixed;
    display:flex;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%);
    background-color:white;
    box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
    flex-direction:column;

  }
  </style>
  <script charset="utf-8">
  //message一覧をajaxで取得する
  function getMessage(){
    $("[type=text]").val("");
    $("[type=password]").val("");
    $.ajax({
      url:"select_message.php?<?php echo $_SERVER['QUERY_STRING'];?>"
    }).done(function(data){
      $("table").append(data);
    })
  }
  $(document).ready(function(){
    getMessage();
    $(document).on('click','.update-confirm-modal',(function(e){
      if($(this).next().attr('data-modal')==='is-modal'){
        $(this).remove("#wrapper");
        $(this).next().attr('data-modal',"hide");
      }
      else{
        $(this).next().attr('data-modal',"is-modal");
        $(this).after('<span id="wrapper"></span>');
      }
    }));
    $(document).on('click','.delete-confirm-modal',(function(e){
      if($(this).next().attr('data-modal')==='is-modal'){
        $(this).remove("#wrapper");
        $(this).next().attr('data-modal',"hide");
      }
      else{
        $(this).next().attr('data-modal',"is-modal");
        $(this).after('<span id="wrapper"></span>');
      }
    }))
    $(document).on('click','#wrapper',function(e){
      $(this).next().attr('data-modal',"hide");
      $(this).remove("#wrapper");
    })
  })
  </script>
  <script src="MessageUpdate.js"></script>
  <script src="MessageDelete.js"></script>
  <script src="MessageInsert.js"></script>
</head>
<body>
  <p id="flush"></p>
  <form class="insert" action="" method="post">
    <input type="text" name="name" required value="" placeholder="名前">
    <input type="text" name="message" required value="" placeholder="ひとこと"/>
    <input type="hidden" name="thread_id" value="<?php echo $qs['id']; ?>" />
    <input type="password" name="pass" required value="" placeholder="パスワード">
    <button type="submit" class="btn-success">送信</button>
  </form>

  <table>
    <tr class="table-head">
      <th>Name</th>
      <th>Message</th>
      <th>Update</th>
      <th>Delete</th>
    </tr>
  </table>
</body>
</html>
