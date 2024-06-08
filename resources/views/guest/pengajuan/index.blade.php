@extends('layouts.guest')

@section('content')
    <main class="p-md-5 p-1">
       {{--  <div class="arc">
        </div>
        <h1><span>LOADING</span></h1> --}}

        <div class="pt-5">
            <div class="section-title px-5 w-100" data-aos="fade-up">
                <h2>Pengajuan</h2>
                <p class="fs-3">Formulir Pengajuan Bantuan Sosial</p>
            </div>

            @if (session()->has('success'))
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
    <link rel="stylesheet" href="{{ asset('assets/scss/spinner.scss') }}">

    <style>
        label.required::after {
            content: '*';
            position: relative;
            left: 3px;
            color: #ff0000;
        }

        .btn-save {
            position: fixed;
            bottom: 3rem;
            right: 3rem;
            padding: 0 0 !important;
            width: 4.5rem !important;
            height: 4.5rem !important;
            border-radius: 50%;
            font-size: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

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
    <script>
        function showImage(name) {
            $('#image_show').attr('src', name);
        }

        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('showLoadingOverlay', () => {
                document.getElementById('loadingOverlay').style.display = 'flex';
            });

            Livewire.on('hideLoadingOverlay', () => {
                document.getElementById('loadingOverlay').style.display = 'none';
            });
        });

        document.addEventListener('livewire:init', () => {
            Livewire.on('stepChanged', () => {
                window.location.reload();
            });
        });
    </script>
@endpush
