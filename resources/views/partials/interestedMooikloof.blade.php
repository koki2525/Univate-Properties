 <!-- Interested Modal -->
 <div class="modal fade" id="interestedMooikloof" tabindex="-1" role="dialog" aria-labelledby="interestedMooikloof" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content px-0 px-md-4">
            <div class="modal-header">
                <h5 class="modal-title" id="interestedModalLabel">Property Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mt-3">
                    <div class="col-md-6">
                        <p>
                            <img class="img-fluid" src="{{ $unit->image1 }}" alt="Lombardy">
                        </p>
                        <p>
                            {{ $unit->intro }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <form id="mainForm" method="POST" action="/interested-mooikloof/{{ $unit->id }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        @csrf
                            <div class="modal-body">
                            <input id="invisible_id" name="invisible" type="hidden" value="{{ $unit->id }}">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <lable for="resortName">Property Name</lable>
                                        <input class="form-control" type="text" name="name" value="{{ $unit->name }}" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <lable for="resortWeek">Reference Number</lable>
                                        <input class="form-control" type="text" name="ref" value="{{ $unit->ref }}" disabled>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <lable for="resortModule">Price</lable>
                                        <input class="form-control" type="text" name="price" value="{{ $unit->price }}" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <lable for="price">Unit</lable>
                                        <input class="form-control" type="text" name="unit" value="{{ $unit->unit }}" disabled>
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

                                <button class="btn btn-blue" id="submit" type="submit">ENQUIRE NOW</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#interestedMooikloof').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
</script>