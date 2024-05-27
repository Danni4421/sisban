
{{-- Link to a dependencies --}}

<script src="{{ asset('dist/js/app.js') }}"></script>
<script src="{{ asset('dist/js/datatable.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/admin/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/js/admin/dashboard.js') }}"></script>

@stack('scripts')

<script>
    $(document).ready(function() {
        $(document).on('init.dt', function(e, settings) {
            var table = $(settings.nTable);
            table.removeClass('table-hover table-striped table-bordered no-footer');
        });
    });
</script>