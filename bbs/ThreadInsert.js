//Formのサブミットイベントを乗っ取てRequestメソッドを送る
$(document).ready(function(){
  $(document).on('submit','.insert',(function(e){
    $.ajax({
      type:"POST",
      url:"insert_threads.php",
      data: {
        //パラメータを設定してdelete.phpに送る
        thread_name:$('[name=thread_name]',this).val(),
        pass : $('[name=pass]',this).val()
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
    return false;
  }));
});
