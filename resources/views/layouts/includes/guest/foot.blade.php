{{-- Custom scripts --}}
<script src="{{ asset('assets/js/guest/index.js') }}"></script>

{{-- Dependencies scripts --}}
<script src="{{ asset('dist/js/app.js') }}"></script>
<script src="{{ asset('dist/js/datatable.js') }}"></script>
<script src="{{ asset('dist/js/sweetalert.js') }}"></script>


@stack('scripts')

<script>
    $(window).on('load', function () {
        setTimeout(() => {
            $('#loading').css({ animation: 'fadeOut 0.5s ease-in-out forwards' })
            setTimeout(() => {
                $('body').css({ 'overflow': 'unset' })
                $('#loading').hide();
            }, 400);
        }, 1000);
    })
</script>