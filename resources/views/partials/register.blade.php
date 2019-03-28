<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content px-0 px-md-4">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registerForm" method="POST" action="/register" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                    <div class="modal-body">

                        <div class="form-row">
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="name" placeholder="Name">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="surname" placeholder="Surname">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <input class="form-control" type="email" name="email" placeholder="Email">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="mobile" placeholder="Contact Number">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="username" placeholder="Username">
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" type="password" name="password" placeholder="Password">
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" type="password" name="password1" placeholder="Confirm Password">
                            </div>
                        </div>
                        
                        <button class="btn btn-blue" id="submit" type="submit">SUBMIT</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#registerModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
</script>