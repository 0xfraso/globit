$(function() {
    const r = new rive.Rive({
        src: "assets/theme-switch.riv",
        canvas: document.getElementById("theme-switch"),
        autoplay: true,
        stateMachines: 'Toggle',
        fit: rive.Fit.cover,
        onLoad: (_) => {
            const inputs = r.stateMachineInputs('Toggle')
            const trigger = inputs.find(i => i.name === 'Toggle')
            const checkbox = $('#checkbox-theme-switch')
            const darkModeOn = checkbox.is(':checked')
            trigger.value = darkModeOn

            $('#theme-switch').click(() => {

                checkbox.prop('checked', () => {
                    return !trigger.value
                })
                trigger.value = !trigger.value

                const darkModeOn = checkbox.is(':checked')
                const curTheme = darkModeOn ? 'light' : 'dark'

                $('.navbar-light, .navbar-dark').toggleClass('navbar-light navbar-dark')
                $('.text-light, .text-dark').toggleClass('text-light text-dark')
                $('.text-primary, .text-secondary').toggleClass('text-primary text-secondary')
                $('.body-light, .body-dark').toggleClass('body-light body-dark')
                $('.bg-light, .bg-dark').toggleClass('bg-light bg-dark')
                $('.bg-primary, .bg-secondary').toggleClass('bg-primary bg-secondary')
                $('.btn-primary, .btn-secondary').toggleClass('btn-primary btn-secondary')

                document.cookie = 'theme=' + curTheme
            })
        }
    });
})
