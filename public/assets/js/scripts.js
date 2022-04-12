function alertAppend(msg, status, msgAttention = '') {
    let alert = '<div class="alert rounded mt-2 alert-solid alert-' + status + ' mg-b-0" role="alert">\n' +
        '              <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
        '                <span aria-hidden="true" class="tx-white">×</span>\n' +
        '              </button>\n' +
        '              <strong>' + msgAttention + '</strong> ' + msg + '.\n' +
        '            </div>';

    $('.errors-block').append(alert);

    setTimeout(function () {
        $('.errors-block .alert')[0].remove();
    }, 5000);
}

$(document).on('click', '.popup-action', function () {
    let action = $(this).data('action');

    $('.prove-button').attr('data-url', action);

    $('.modal-actions').fadeIn();


})

$(document).on('click', '.close-popup', function () {
    $('.modal-actions').fadeOut();

})

$(document).on('click', '.prove-button', function () {
    let url = $(this).data('url');

    $.ajax({
        type: 'POST',
        url: '/api/' + url,
        success: function (response) {
            if (response.status == true) {
                location.reload();
            } else {
                $('.modal-actions').fadeOut();
                alertAppend(response.msg, 'danger');
            }
        }
    });

})

function createNewRowRecord(url, id, appendClass = 'append-container-uploaded') {

    let appendBlockRecordRow = '<div class="jail-color rounded mt-2 d-flex align-items-center justify-content-between position-relative px-4 py-2">' +
        '<div class="align-items-center">' +
        '<h5 class="text-info mb-0 font-weight-bold">Record</h5>' +
        '<a class="deleteRecord" data-id="' + id + '">delete</a></div>' +
        '<div class="playback"><audio src="' + url + '"controls class="hidden"></audio></div>' +
        '<a href="javascript:;" class="btn btn-inline ' + (appendClass == "append-container-uploaded" ? "btn-success" : 'send-for-upload btn-warning') + '"data-id="' + id + '"> ' + (appendClass == "append-container-uploaded" ? "Uploaded" : 'Upload') + ' </a> ' +
        ' </div>';

    $('.' + appendClass).append(appendBlockRecordRow);
}

$(document).on('click', '.loadingStart', function () {
    $('.loading').fadeIn();
    setTimeout(function () {
        $('.loading').fadeOut();
        location.reload();
    }, 15000);
})


$(document).on('click', '.open-popup', function () {
    let open = $(this).data('open');
    $('.' + open).fadeIn();
})

$(document).on('click', '.plenka', function () {
    $(this).parent().fadeOut();
})

$(document).on('click', '.close-it', function () {
    let open = $(this).data('close');
    $('.' + open).fadeOut();
});

$('.lang-change').on('click', function () {
    let lang = $(this).data('lang');

    $.ajax({
        url: "/lang",
        type: "POST",
        data: {lang: lang},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (response) {
            location.reload();
        },
        error: function (error) {

        }
    });

})

$(document).on('change', '.select-action', function () {
    let select = $(this).attr('data-select');
    let appear = $(this).attr('data-appear');

    if (select == $(this).val()) {
        $('.' + appear).show();
    } else {
        $('.' + appear).hide();
    }
})


function start(){
    $( function() {
        $( ".appendPR" ).sortable();
    } );


    $('.select2').select2();
}



let i = -3;

$('.newRow').on('click',function (){

    let row = ('<div class="col-lg-12 mb-3 d-flex align-items-center">'+
        '<span class="px-2 py-1 bg-indigo h-100 d-flex align-items-center tx-white"><i class="icon ion-arrow-move"></i></span>'+
        '<input class="form-control" placeholder="Placehoder" value="Your value" type="text" name="pr['+i+']">'+
        '<select name="valid['+i+']" id="" class="select2 w-25">'+
            '<option value="text">Text</option>'+
            '<option value="number">Number</option>'+
            '<option value="email">Email</option>'+
        '</select>'+
        '<select name="pq['+i+']" id="" class="select2 w-25"><option value="req">Required</option><option value="miss">Not required</option></select>'+
        '<span class="btn-danger ml-4 px-2 py-1 rounded delete-field"><i class="fa fa-close"></i></span></div>');

    $(".appendPR").append(row);

    i--;
    start();

})

$(document).on('click','.delete-field',function (){

    if($('.appendPR .col-lg-12').length > 3) {

        let id = $(this).attr('data-id');

        if(id) {

            let apr = confirm('Are you sure ?');

            if (apr == true) {

                let $this = $(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/cabinet/inputdelete/' + id,
                    success: function (response) {
                        if (response.status == true) {
                            $this.closest('.col-lg-12').remove();
                        } else {
                            alertAppend(response.msg, 'danger');
                        }
                    }
                });
            }
        }
        else {
            $(this).closest('.col-lg-12').remove();
        }
    }
    else
    {
        alertAppend('minimum 3 fields','danger');
    }
})

$(document).ready(function () {

    let selects = $('.select-action');

    selects.each(function () {
        let select = $(this).attr('data-select');
        let appear = $(this).attr('data-appear');

        if (select == $(this).val()) {
            $('.' + appear).show();
        } else {
            $('.' + appear).hide();
        }
    })
})

