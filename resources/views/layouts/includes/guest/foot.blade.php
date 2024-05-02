{{-- Custom scripts --}}
<script src="{{ asset('assets/js/guest/index.js') }}"></script>
<script src="{{ asset('assets/js/guest/guide.js') }}"></script>

{{-- Dependencies scripts --}}
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>

@stack('scripts')

<script>
    AOS.init({
        easing: 'ease-in-out-sine'
    });
</script>
