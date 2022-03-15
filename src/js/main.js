let chatasisit = $(document).find('#chatassist');
let checkAns = '';

$(document).on('click', '.open-close', function () {
    $('#chatassist').toggleClass('active');
})

let key = $('#dataKey').attr('data-key');

function gobot() {
    //scroll to bottom
    let d = $('.body-assist');
    d.scrollTop(d.prop("scrollHeight"));

}

$(document).on('click', '#sendMessage', function (e) {

    e.preventDefault();
    let msg = $(document).find('#textChatAssist').val();
    $(document).find('#textChatAssist').val('');
    let url = "https://chat/api/sendmessage";
    key = $('#chatme').attr('data-key');
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            'msg': msg,
            'key': key
        },
        success: function (data) {
            $('#dataKey').attr('data-key', data.key);
            $('.body-assist').append(data.userText);
            gobot();
        }
    });
})


function history() {

    let url = "https://chat/api/history";
    $.ajax({
        type: 'POST',
        url: url,
        success: function (data) {
            if (data.status == true) {
                $('.body-assist').append(data.userText);
                gobot();
            } else {
                console.log('key is not got');
            }
        }
    });
}


$(document).ready(function () {
    let sitekey = $('#chatme').attr('data-key');
    let url = "https://chat/api/checkme";
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            'key': sitekey
        },
        success: function (data) {
            if (data.status == true) {
                $('head').append('<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet"> ');

                let appendBlock = '<div id="chatassist">' +
                    '  <div class="open-close">' +
                    ' <div class="open-assist">' +
                    ' <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                    '   <path d="M10 19C14.9706 19 19 14.9706 19 10C19 5.02944 14.9706 1 10 1C5.02944 1 1 5.02944 1 10C1 11.4876 1.36093 12.891 2 14.1272L1 19L5.8728 18C7.10904 18.6391 8.51237 19 10 19Z" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
                    ' </svg>' +
                    ' </div>' +
                    ' <div class="close-assist">' +
                    '<svg width="6" height="6" viewBox="0 0 6 6" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                    ' <path d="M1 1L5 5M1 5L5 1" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
                    ' </svg>' +
                    ' </div>' +
                    '</div>' +
                    ' <div class="wrapper">' +
                    '  <div class="head-assist">' +
                    ' <div class="image-assist">' +
                    ' <img src="'+data.image+'" alt="">' +
                    ' </div>' +
                    ' <div class="">' +
                    '<div class="name-assist">' +
                    data.name +
                    ' </div>' +
                    ' <div class="work-assist">' +
                    data.role +
                    ' </div>' +
                    ' </div>' +
                    ' </div>' +
                    ' <div class="body-assist">' +
                    ' </div>' +
                    ' <div class="foot-assist">' +
                    ' <form>' +
                    ' <input name="" id="textChatAssist" placeholder="Text here...">' +
                    '<button id="sendMessage">' +
                    '<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                    '<path d="M2 9L1.39589 3.56299C1.22297 2.0067 2.82469 0.864325 4.23983 1.53465L16.1842 7.19252C17.7093 7.91494 17.7093 10.0851 16.1842 10.8075L4.23983 16.4653C2.82469 17.1357 1.22297 15.9933 1.39589 14.437L2 9ZM2 9H9" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
                    ' </svg>' +
                    ' </button>' +
                    '</form>' +
                    '<div class="corpAuthors">Yolly</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                $('body').append(appendBlock);

                history();



                checkAns = setInterval(function () {
                    if (key == '') {
                        key = $('#dataKey').attr('data-key');
                    }
                    let url = "https://chat/api/checkResponse";
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            'key': key
                        },
                        success: function (data) {
                            if (data.status == true) {
                                if (data.userText) {
                                    $('.body-assist').append(data.userText);
                                    gobot();
                                }
                            } else {
                                console.log('key is not got');
                            }
                        },
                    });
                }, 4000);



            } else {
                console.log('your sitekey is incorrect');
            }
        },
        error: function () {
            console.log('some error appeared');
        }
    });





});
