
{{-- Link to a dependencies --}}

<script src="{{ asset('dist/js/app.js') }}"></script>
<script src="{{ asset('dist/js/datatable.js') }}"></script>
<script src="{{ asset('dist/js/sweetalert.js') }}"></script>
<script src="{{ asset('assets/js/admin/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/js/admin/index.js') }}"></script>
<script src="{{ asset('assets/js/admin/dashboard.js') }}"></script>

@stack('scripts')

<script>
    $(window).on('load', function () {
        setTimeout(() => {
            $('#loading').hide();
        }, 1000);
    })

    $(document).ready(function() {
        $(document).on('init.dt', function(e, settings) {
            var table = $(settings.nTable);
            table.removeClass('table-hover table-striped table-bordered no-footer');
        });
    });
</script>