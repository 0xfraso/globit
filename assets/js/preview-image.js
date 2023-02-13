$(function() {
    $(document).on('click', '.preview-picture', function() {
        console.log('clicked')
        let img_src = $(this).attr('src')
        const previewModal = `
            <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewImageLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 80%">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <img src="${img_src}" alt="Anteprima immagine" class="w-100">
                    </div>
                </div>
            `

        $("body").append(previewModal)
        $("#previewModal").modal('show')

        $("#previewModal").on('hidden.bs.modal', function() {
            $('#previewModal').remove()
        })
    })
})

