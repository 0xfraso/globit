$(function() {
    $(document).on('click', '.collapse-comment', function() {
        const parent_comment = $(this).closest('.comment')
        $(parent_comment).append('<svg class="expand-comment" fill="currentColor" width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M2,21V11a1,1,0,0,1,2,0v7.586L18.586,4H11a1,1,0,0,1,0-2H21a1,1,0,0,1,1,1V13a1,1,0,0,1-2,0V5.414L5.414,20H13a1,1,0,0,1,0,2H3A1,1,0,0,1,2,21Z"/></svg>')
        $(parent_comment).find(".comment-body").hide()
        $(this).hide()
    })

    $(document).on('click', '.expand-comment', function() {
        const parent_comment = $(this).closest('.comment')
        $(parent_comment).find(".comment-body").show()
        $(parent_comment).find(".collapse-comment").show()
        $(this).hide()
    })
})
