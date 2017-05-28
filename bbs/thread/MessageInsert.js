//Formのサブミットイベントを乗っ取てRequestメソッドを送る
$(document).ready(function(){
    $(document).on('submit','.insert',(function(e){
      //submitボタンの動作を止めておく
      e.preventDefault();
    $.ajax({
        type:"POST",
        url:"insert_message.php",
        data: {
          //パラメータを設定してdelete.phpに送る
          message:$('[name=message]',this).val(),
          name:$('[name=name]',this).val(),
          pass : $('[name=pass]',this).val(),
          thread_id:$('[name=thread_id]',this).val()
        }
      })
      .done(function(data){
        //flushメッセージを受け取る
        $('#flush').text(data);
        //tableタグ内の要素の数が変わるのでtable要素の一行目以外の子要素を空にする
        $('table tr:not(.table-head)').empty();
        //再びthreadを取得する
        getMessage();
      });
    }));
});
