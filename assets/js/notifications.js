$(function() {
    $(document).on('click', '.notification', function() {
        let notification_id = $(this).data('id')
        // send ajax request to mark the notification as seen
        $.ajax({
            url: 'actions/dismiss-notification.php',
            method: 'POST',
            data: {
                notification_id: notification_id
            },
        });
    })

    $(document).on('click', '.notification-delete', function() {
        let notification = $(this)
        let notification_id = $(this).siblings(".notification").data('id')
        // send ajax request to mark the notification as seen
        $.ajax({
            url: 'actions/delete-notification.php',
            method: 'POST',
            data: {
                notification_id: notification_id
            },
            success: function(response) {
                if (response == 1) {
                    $(notification).parent("li").remove()
                }
            }
        });
    })
})
