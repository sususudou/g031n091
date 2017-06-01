//Formのサブミットイベントを乗っ取てRequestメソッドをPUTに書き換える
$(document).ready(function(){
  $(document).on('submit','.update',(function(e){
    //submitボタンの動作を止めておく
    e.preventDefault();
    $.ajax({
      type:"PUT",
      url:"update_message.php",
      data: {
        //パラメータを設定してdelete.phpに送る
        thread_id:$('[name=thread_id]',this).val(),
        password : $('[name=pass]',this).val(),
        update_msg:$('[name=update_msg]',this).val(),
        update_name:$('[name=update_name]',this).val(),
        update_id:$('[name=update_id]',this).val()
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
