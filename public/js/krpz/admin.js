$(document).ready(function(){

    let checkbox = $('#form-checkbox');

    let successMsg = $('#admin-success-message');

    if (checkbox.length !== 0){
        checkbox.on('change', function () {
            let cb = $(this);
            let val = cb.prop('checked') ? 1 : 0;

            $('#is_active').val(val);
        })
    }

    if (successMsg.length !== 0) {

        successMsg.fadeIn(300);

        setTimeout(function () {
            successMsg.fadeOut(300);
        }, 2000)
    }

});
