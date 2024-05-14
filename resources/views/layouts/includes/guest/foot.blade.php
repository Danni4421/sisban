{{-- Custom scripts --}}
<script src="{{ asset('assets/js/guest/index.js') }}"></script>
<script src="{{ asset('assets/js/guest/guide.js') }}"></script>

{{-- Dependencies scripts --}}
<script src="{{ asset('dist/js/app.js') }}"></script>
<script src="{{ asset('dist/js/datatable.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

@stack('scripts')