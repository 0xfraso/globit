$(document).ready(function() {
    $(document).on('submit', '.registration-form', function(e) {
        const password = $(this).find("input[name='password']").val();
        const passwordRepeat = $(this).find("input[name='password_repeat']").val();
        if (password !== passwordRepeat) {
            //alert("le password devono essere uguali")
            e.preventDefault();
            $(".form-error").html("Le password devono essere uguali!")
        }
    });
});
