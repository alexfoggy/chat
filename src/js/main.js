let chatasisit = $(document).find('#chatassist');

$(document).on('click','.open-close',function(){
    $('#chatassist').toggleClass('active');
})

$(document).on('click','#sendMessage',function(e){

    e.preventDefault();
    let msg = $(document).find('#textChatAssist').val();
    $(document).find('#textChatAssist').val(''); 
    let url = "http://chat/api/sendmessage";
    let key = $('#dataKey').attr('data-key');
    $.ajax({
        type:'POST',
        url:url,
        // contentType: "application/json; charset=utf-8",
        // dataType: "json",
        //data:JSON.stringify({'msg':msg,'key':key}),
        data:{'msg':msg,'key':key},
        success:function(data) {
           $('#dataKey').attr('data-key',data.key);
           $('.body-assist').append(data.userText);
           $("#textChatAssist").scrollTop($("#textChatAssist")[0].scrollHeight);
        }
     });
})
