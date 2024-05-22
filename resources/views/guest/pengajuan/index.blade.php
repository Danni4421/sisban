@extends('layouts.guest')

@section('content')
    <main class="p-md-5 p-1">
        <div class="pt-5">
            <div class="section-title px-5 w-100" data-aos="fade-up">
                <h2>Pengajuan</h2>
                <p class="fs-3">Formulir Pengajuan Bantuan Sosial</p>
            </div>

            @if (isset($success))
                <div>{{ $success }}</div>
            @endif

            @livewire('pengajuan-wizard')
        </div>
    </main>

    <div class="modal fade" id="modal_image_show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <img src="#" id="image_show">
          </div>
        </div>
      </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ url('assets/css/guest/form-wizard.css') }}">

    <style>
        @media (max-width: 576px) {
            .form-step {
                width: 90%;
            }
        }

        @media (min-width: 576px) {
            .form-step {
                width: 75%;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <script>
        function showImage(name) {
            console.log(name);
            $('#image_show').attr('src', name);
        }
    </script>
@endpush
