let chatasisit = $(document).find('#chatassist');
let checkAns = '';

$(document).on('click','.open-close',function(){
    $('#chatassist').toggleClass('active');
})

let key = $('#dataKey').attr('data-key');

    
$(document).on('click','#sendMessage',function(e){

    e.preventDefault();
    let msg = $(document).find('#textChatAssist').val();
    $(document).find('#textChatAssist').val(''); 
    let url = "http://chat/api/sendmessage";
    key = $('#dataKey').attr('data-key');
    $.ajax({
        type:'POST',
        url:url,
        data:{'msg':msg,'key':key},
        success:function(data) {
           $('#dataKey').attr('data-key',data.key);
           $('.body-assist').append(data.userText);
        }
     });
})

checkAns = setInterval(function (){
    if(key == ''){
        key = $('#dataKey').attr('data-key');
    }
        let url = "http://chat/api/checkResponse";
        $.ajax({
            type:'POST',
            url:url,
            data:{'key':key},
            success:function(data) {
                if(data.status == true){
                $('.body-assist').append(data.userText);
                }
                else {
                    console.log('key is not got');
                }
            }
         });
},4000);

$(document).ready(function(){
    let url = "http://chat/api/history";
        $.ajax({
            type:'POST',
            url:url,
            success:function(data) {
                if(data.status == true){
                $('.body-assist').append(data.userText);
                }
                else {
                    console.log('key is not got');
                }
            }
         });
})