let firsttablehtml;

function swap(array, index1, index2) {
    let array2 = [array[index2], array[index2] = array[index1]];
    //alert(array2);

    array[index1] = array2[0];

    return array;
}

function getKeyByValue(object, value) {
    return Object.keys(object).find((key) => object[key] === value);
}


$(function () {
    /*
    // 変数に要素を入れる
    var open = $('.modal-open'),
        close = $('.modal-close'),
        container = $('.modal-container');

    //開くボタンをクリックしたらモーダルを表示する
    open.on('click', function () {
        if ($(this).data('modal') == 'bpcc') {
            if ($('.reserve-selected').html() != undefined) {
                $('#modal-' + $(this).data('modal')).addClass('active');
            }
        } else {
            $('#modal-' + $(this).data('modal')).addClass('active');
        }
        return false;
    });

    //閉じるボタンをクリックしたらモーダルを閉じる
    close.on('click', function () {
        container.removeClass('active');
    });

    //モーダルの外側をクリックしたらモーダルを閉じる
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.modal-body').length) {
            container.removeClass('active');
        }
    });
    */


    $('.modal-open').click(function () {
        $('#modal-'+$(this).data('modal')).fadeIn();
    });
    $('.modal-close').click(function () {
        $(this).parents('.modal-container').fadeOut();
    });
    $('.modal-container').click(function (e) {
        if(e.target==this) {
        $(this).fadeOut();
        }
    });

    firsttablehtml = $('#process-table').html();

});



$(document).on('click', '.row', function () {

    /* serial-mode での処理*/
    if ($('#serial-mode-panel').css('display') != 'none') {
        if ($(this).hasClass('serial-selected')) {
            $('.property-table').hide();
            $('.row').removeClass('serial-selected');
        } else {
            $('.property-table').hide();
            $('.row').removeClass('serial-selected');
            let id = $(this).data('id');
            $('#property-table-' + id).show();
            if ($(this).hasClass('status-reserve') || $(this).hasClass('status-null')) {
                $(this).addClass('serial-selected');
            }
        }
    }

    /* reserve-mode change-mode での処理*/
    if ($('#reserve-mode-panel').css('display') != 'none' || $('#change-mode-panel').css('display') != 'none') {
        if ($(this).hasClass('status-null')) {
            $('#change-mode-panel').hide();
            $('#reserve-mode-panel').show();
        }
        if ($(this).hasClass('status-reserve')) {
            $('#reserve-mode-panel').hide();
            $('#change-mode-panel').show();
        }
        if ($(this).hasClass('reserve-selected')) {
            $('.property-table').hide();
            $('.row').removeClass('reserve-selected');
            $('#change-mode-panel').hide();
            $('#reserve-mode-panel').show();
        } else {
            $('.property-table').hide();
            $('.row').removeClass('reserve-selected');
            let id = $(this).data('id');
            $('#property-table-' + id).show();
            if ($(this).hasClass('status-null') || $(this).hasClass('status-reserve')) {
                $(this).addClass('reserve-selected');
            }
        }
    }

});

$(document).on('click', '#serial-up-button', function () {
    if (
        ($('.serial-selected').hasClass('status-reserve') && $('.serial-selected').prev().hasClass('status-reserve')) ||
        ($('.serial-selected').hasClass('status-null') && $('.serial-selected').prev().hasClass('status-null'))
    ) {
        let serialsubmit = $('#serialsubmit').val();
        serialsubmit = JSON.parse(serialsubmit);
        let previd = $('.serial-selected').prev().data('id');
        let thisid = $('.serial-selected').data('id');
        swap(serialsubmit, getKeyByValue(serialsubmit, previd), getKeyByValue(serialsubmit, thisid));
        $('#serialsubmit').val(JSON.stringify(serialsubmit));

        $('.serial-selected').insertBefore($('.serial-selected').prev());

    }
});

$(document).on('click', '#serial-down-button', function () {
    if (
        ($('.serial-selected').hasClass('status-reserve') && $('.serial-selected').next().hasClass('status-reserve')) ||
        ($('.serial-selected').hasClass('status-null') && $('.serial-selected').next().hasClass('status-null'))
    ) {
        let serialsubmit = $('#serialsubmit').val();
        serialsubmit = JSON.parse(serialsubmit);
        let nextid = $('.serial-selected').next().data('id');
        let thisid = $('.serial-selected').data('id');
        swap(serialsubmit, getKeyByValue(serialsubmit, nextid), getKeyByValue(serialsubmit, thisid));
        $('#serialsubmit').val(JSON.stringify(serialsubmit));

        $('.serial-selected').insertAfter($('.serial-selected').next());
    }
});

$(document).on('click', "#change-to-serial-mode-button", function () {
    $('.serial-selected').removeClass('serial-selected');
    $('.reserve-selected').removeClass('reserve-selected');
    $("#serial-mode-panel").fadeIn();
    $("#reserve-mode-panel").hide();
    $("#change-mode-panel").hide();

    $('#process-table').html(firsttablehtml)
});

$(document).on('click', "#change-to-reserve-mode-button", function () {
    $('.serial-selected').removeClass('serial-selected');
    $('.reserve-selected').removeClass('reserve-selected');
    $("#serial-mode-panel").hide();
    $("#reserve-mode-panel").fadeIn();

    $('#process-table').html(firsttablehtml)
});


$(document).on('click', 'input[name="bp"]', function () {
    var bp = $('input[name="bp"]:checked').val();
    if (bp == 'bp1') {
        $('#cc1').prop('checked', true);
    }
    if (bp == 'bp2') {
        $('#cc2').prop('checked', true);
    }
});


$(document).on('click', '#confirm-reserve-button', function () {
    let id = $('.reserve-selected').data('id');
    let bp = $('input[name="bp"]:checked').val();
    let cc = $('input[name="cc"]:checked').val();

    $.post("ipad/run-reserve",
        {
            'id': id, 'bp': bp, 'cc': cc,
            "_csrfToken": $("#_csrfToken").val(),

        }, function () {
            alert('更新しました');
            location.reload();
        }
    );
});


$(document).on('click', '#confirm-cancel-button', function () {
    let id = $('.reserve-selected').data('id');
    $.post("ipad/cancel-reserve",
        {
            'id': id,
            "_csrfToken": $("#_csrfToken").val(),
        }, function () {
            alert('更新しました');
            location.reload();
        }
    );
});

$(document).on('click', '#confirm-serial-button', function () {
    let serialsubmit = $('#serialsubmit').val();
    $.post("ipad/change-serial",
        {
            'serialsubmit': serialsubmit,
            "_csrfToken": $("#_csrfToken").val(),
        }, function () {
            alert('更新しました');
            location.reload();
        }
    );
});