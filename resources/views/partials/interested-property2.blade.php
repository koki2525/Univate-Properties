<!-- Interested Modal -->
<div class="modal fade" id="interestedPropertyModal" tabindex="-1" role="dialog" aria-labelledby="interestedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content px-0 px-md-4">
            <div class="modal-header">
                <h5 class="modal-title" id="interestedModalLabel">Property Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="mainForm" method="POST" action="/interested-property2/{{ $property->id }}" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
                <div class="modal-body">
                    <input id="invisible_id" type="hidden" value="{{ $property->ref }}">
                    <div class="form-row">
                        <div class="col-md-12">
                            <lable for="resortName">Property Name</lable>
                            <input class="form-control" type="text" value="{{ $property->name }}" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <lable for="resortName">Property Reference</lable>
                            <input class="form-control" type="text" value="{{ $property->ref }}" disabled>
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
                    <button class="btn btn-blue mr-auto" id="submit" type="submit">ENQUIRE NOW</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#interestedPropertyModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
</script>