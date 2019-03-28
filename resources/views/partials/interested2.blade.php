<!-- Interested Modal -->
<div class="modal fade" id="interestedModal" tabindex="-1" role="dialog" aria-labelledby="interestedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content px-0 px-md-4">
            <div class="modal-header">
                <h5 class="modal-title" id="interestedModalLabel">Resort Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="mainForm" method="POST" action="/interested/{{ $unit->id }}" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
                <div class="modal-body">
                <input id="invisible_id" name="invisible" type="hidden" value="{{ $timeshare->id }}">
                    <div class="form-row">
                        <div class="col-md-6">
                            <lable for="resortName">Resort Name</lable>
                            <input class="form-control" type="text" name="resortName" value="{{ $timeshare->resort }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <lable for="resortWeek">Week</lable>
                            <input class="form-control" type="text" name="resortWeek" value="{{ $timeshare->week }}" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <lable for="resortModule">Module</lable>
                            <input class="form-control" type="text" name="resortModule" value="{{ $timeshare->module }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <lable for="price">Price</lable>
                            <input class="form-control" type="text" name="price" value="R {{ $timeshare->price }}" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <input class="form-control" type="text" name="name" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <input class="form-control" type="text" name="mobile" placeholder="Contact Number">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <input class="form-control" type="email" name="email" placeholder="Email">
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-blue" id="submit" type="submit">ENQUIRE NOW</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#registerModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
</script>