<script src="{{asset('assets/admin')}}/js/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('assets/admin')}}/js/popper.min.js"></script>
<script type="text/javascript" src="{{asset('assets/admin')}}/js/bootstrap.min.js"></script>
<!-- plugins -->
<script type="text/javascript" src="{{asset('assets/admin')}}/js/plugins/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="{{asset('assets/admin')}}/js/plugins/smooth-scrollbar.min.js"></script>
<script type="text/javascript" src="{{asset('assets/admin')}}/js/app.min.js"></script>
<!-- custom Js -->
<script src="{{asset('assets/admin')}}/js/plugins/datatables.min.js"></script>
<script type="text/javascript" href="{{asset('assets/admin')}}/js/custom.js"></script>
<script type="text/javascript" src="{{asset('assets/admin')}}/js/plugins/choices.min.js"></script>
<script type="text/javascript" src="{{asset('assets/admin')}}/js/toastr.js"></script>
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
</script>
