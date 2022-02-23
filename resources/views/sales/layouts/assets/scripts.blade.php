<script src="{{asset('assets/sales')}}/js/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('assets/sales')}}/js/popper.min.js"></script>
<script type="text/javascript" src="{{asset('assets/sales')}}/js/bootstrap.min.js"></script>
<!-- plugins -->
<script type="text/javascript" src="{{asset('assets/sales')}}/js/plugins/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="{{asset('assets/sales')}}/js/plugins/smooth-scrollbar.min.js"></script>
<script type="text/javascript" src="{{asset('assets/sales')}}/js/app.min.js"></script>
<!-- custom Js -->
<script src="{{asset('assets/sales')}}/js/plugins/datatables.min.js"></script>
<script type="text/javascript" href="{{asset('assets/sales')}}/js/custom.js"></script>
<script type="text/javascript" src="{{asset('assets/sales')}}/js/plugins/choices.min.js"></script>
<script type="text/javascript" src="{{asset('assets/sales')}}/js/toastr.js"></script>
@toastr_render
@yield('js')
<script>
    $('.spinner').fadeOut('slow')
    window.addEventListener("offline",function () {
        toastr.warning('No Internet')
    });
    window.addEventListener("online",function (){
        toastr.success('Internet Connected')
    });
    //for input number validation
    $(document).on('keyup','.numbersOnly',function () {
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });
    $.ajaxSetup({
        headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
</script>
