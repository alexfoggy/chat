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

