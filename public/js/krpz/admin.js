$(document).ready(function () {

    let checkbox = $('#form-checkbox');
    if (checkbox.length !== 0) {
        checkbox.on('change', function () {
            let cb = $(this);
            let val = cb.prop('checked') ? 1 : 0;

            $('#is_active').val(val);
        })
    }

    let successMsg = $('#admin-success-message');
    if (successMsg.length !== 0) {

        successMsg.fadeIn(300);

        setTimeout(function () {
            successMsg.fadeOut(300);
        }, 2000)
    }

    // Акривировать
    $('.control-image-btn').on('click', function (e) {

        e.preventDefault();

        let $this = $(this);
        let id = $this.data('id');
        let url = $this.data('url');

        $.ajax({
            url: url,
            async: true,
            dataType: "json",
            type: "PATCH",
            data: `id=${id}`,
            beforeSend: function () {
                $("#loader").fadeIn(300);
            },
            success: function (data) {

                $('#loader').hide();
                $('#success-alert').fadeIn(300);

                setTimeout(function () {
                    $('#success-alert').fadeOut(300);
                }, 2000);

                // Активировать
               if (data.status === 1) {
                   $('.tr-image-' + id).addClass('table-success');

                   $this.removeClass('btn-outline-secondary');
                   $this.addClass('btn-outline-success');
                   $this.html('<i class="fas fa-toggle-on"></i>');
               } else {
                   // Деактивировать
                   $('.tr-image-' + id).removeClass('table-success');

                   $this.removeClass('btn-outline-success');
                   $this.addClass('btn-outline-secondary');
                   $this.html('<i class="fas fa-toggle-off"></i>');
               }
            },
            error: function () {
                $('#loader').fadeOut(300);
                $('#error-alert').fadeIn(300);

                setTimeout(function () {
                    $('#error-alert').fadeOut(300);
                }, 2000)
            }
        });

    });
});
