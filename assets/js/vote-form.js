$(document).ready(function() {
    $('.vote-form .vote-checkbox').change(function(e) {
        e.preventDefault();
        let $form = $(this).closest('.vote-form');
        sendRequest($form)
    });

    function sendRequest(form) {
        $.ajax({
            url: 'actions/vote.php',
            type: 'post',
            data: form.serialize(),
            success: function(response) {
                if (response == -1) {
                    $('#nav-login-dropdown').dropdown('show')
                    $(form).find('.vote-checkbox').prop('checked', false)
                    return
                }

                const value = form.find('.vote-count').text()

                if (response == 1) {
                    form.find('.vote-count').text(parseInt(value) + 1)
                } else {
                    form.find('.vote-count').text(parseInt(value) - 1)
                }
            }
        });
    }
});
