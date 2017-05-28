<?php $result_message=""; ?>
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
    //thread一覧をajaxで取得する
    function getThread(){
      $.ajax({
        url:"select_threads.php"
      }).done(function(data){
        $("table").append(data);
      })
    }
        $(document).ready(function(){
          getThread();
          $(document).on('click','.delete-confirm-modal',(function(e){
            if($(this).next().attr('data-modal')==='is-modal'){
              $(this).remove("#wrapper");
              $(this).next().attr('data-modal',"hide");
            }
            else{
              $(this).next().attr('data-modal',"is-modal");
              $(this).append('<span id="wrapper"></span>');
            }
        }))
        });
        $(document).on('click','#wrapper',function(e){
          $(this).next().attr('data-modal',"hide");
          $(this).remove("#wrapper");
        })
    </script>
    <script src="ThreadDelete.js"></script>
    <script src="ThreadInsert.js"></script>
  </head>

  <body>
    <p id="flush"><?php echo $result_message; ?></p>
    <form action="" class="insert" method="post">
      <input type="text" name="thread_name" value="" required placeholder="掲示板名"/>
      <input type="password" name="pass" value="" required placeholder="パスワード">
      <button class="btn btn-success" type="submit" name="btn_type" value="create">作成</button>
    </form>

    <table>
      <tr class="table-head">
        <th>スレッド名</th>
        <th>作成日時</th>
        <th>削除</th>
      </tr>
    </table>
  </body>
</html>
