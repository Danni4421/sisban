{{-- jQuery --}}
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
{{-- jQuery UI --}}
<script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

{{-- AdminLTE --}}
<script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/pages/dashboard.js') }}"></script>

{{-- Scripts --}}
<script src="{{ asset('assets/js/admin/dashboard.js') }}"></script>

{{-- Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>

@stack('scripts')
