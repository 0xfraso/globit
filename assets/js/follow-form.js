$(document).ready(function() {
    $('.follow-form .follow-checkbox').change(function(e) {
        e.preventDefault();
        let $form = $(this).closest('.follow-form');
        sendRequest($form)
    });

    function sendRequest(form) {
        $.ajax({
            url: 'actions/follow.php',
            type: 'post',
            data: form.serialize(),
            success: function(response) {
                if (response == -1) return

                const value = form.parent('section').find('.followers-count').text()

                if (response == 1) {
                    form.parent('section').find('.followers-count').text(parseInt(value) + 1)
                    form.find("span").text("Non seguire")
                } else {
                    form.parent('section').find('.followers-count').text(parseInt(value) - 1)
                    form.find("span").text("Segui")
                }
            }
        });
    }
});
