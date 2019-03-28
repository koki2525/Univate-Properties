<!-- Contact Thank You Modal -->
<div class="modal fade" id="thankYouModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content px-0 px-md-4">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Thank you</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>
                    Thank you for contacting us. We will contact you as soon as possible. 
                </p>

            </div>
        </div>
    </div>
</div>

<script>
    $('#contactModal').on('shown.bs.modal', function () {
        $('#contactModal').trigger('focus')
    })
</script>