<footer class="py-4">
    <p class="text-center mb-0">
        Copyright &#169; <?php echo date('Y'); ?> Uni-Vate Properties. All Rights Reserved.<br/>
        <a href="/privacy-policy"> Privacy Policy |</a>
        <a href="/terms-and-conditions"> Terms and Conditions</a>
    </p>
</footer>

<script src="{{ asset('/js/jquery.min.js') }}"></script>

<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>

<script src="{{ asset('/js/popper.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>

<script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>

<script>
    function toggleDropdown (e) {
      let _d = $(e.target).closest('.dropdown'),
          _m = $('.dropdown-menu', _d);
      setTimeout(function(){
        let shouldOpen = e.type !== 'click' && _d.is(':hover');
        _m.toggleClass('show', shouldOpen);
        _d.toggleClass('show', shouldOpen);
        $('[data-toggle="dropdown"]', _d).attr('aria-expanded', shouldOpen);
      }, e.type === 'mouseleave' ? 150 : 0);
    }

    $('body')
      .on('mouseenter mouseleave','.dropdown',toggleDropdown)
      .on('click', '.dropdown-menu a', toggleDropdown);

    $(document).ready(function() {

        if(window.location.href.indexOf('#contactModal') != -1) {
            $('#contactModal').modal('show');
        }

    });

</script>

<script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy'
    });
    $('#datepicker1').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy'
    });
    $('#datepicker2').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy'
    });
    $('#datepicker3').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy'
    });
    $('#datepicker4').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy'
    });
    $('#datepicker5').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy'
    });
    $('#datepicker6').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy'
    });
    $('#statusDate').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy'
    });
</script>

<script>
    document.getElementById('mobile').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
      });
</script>

<script>
    document.getElementById('phone').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
      });
</script>

<script>
    $(document).ready(function(){
        $(".close").click(function(){
            $(this).parent().hide();
        });
    });
</script>
<script>
    ClassicEditor
    .create( document.querySelector( '.editor' ) )
    .catch( error => {
        console.error( error );
    } );
</script>
