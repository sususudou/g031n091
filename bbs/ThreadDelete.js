//Formのサブミットイベントを乗っ取てRequestメソッドをDELETEに書き換える
$(document).ready(function(){
    $(document).on('submit','.delete',(function(e){
      //submitボタンの動作を止めておく
      e.preventDefault();
    $.ajax({
        type:"DELETE",
        url:"delete.php",
        data: {
          //パラメータを設定してdelete.phpに送る
          thread_id:$('[name=thread_id]',this).val(),
          password : $('[name=pass]',this).val()
        }
      })
      .done(function(data){
        //flushメッセージを受け取る
        $('#flush').text(data);
        //tableタグ内の要素の数が変わるのでtable要素の一行目以外の子要素を空にする
        $('table tr:not(.table-head)').empty();
        //再びthreadを取得する
        getThread();
      });
    }));
});
