<!-- Login or Register Modal -->
<div class="modal fade" id="loginOrRegister" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content px-0 px-md-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login or Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-0">
                            <a class="btn btn-blue" href="#" data-toggle="modal" data-target="#loginModal">
                                Login
                            </a>

                            <a class="btn btn-blue" href="/register">
                                Register
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $('#loginOrRegister').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    </script>