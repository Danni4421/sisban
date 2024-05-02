@extends('layouts.guest')

@section('content')
    <main class="p-md-5 p-1">
        <div class="pt-5">
            <div class="section-title px-5 w-100" data-aos="fade-up">
                <h2>Pengajuan</h2>
                <p>Formulir Pengajuan Bantuan Sosial</p>
            </div>

            @if (isset($success))
                <div>{{ $success }}</div>
            @endif

            @livewire('pengajuan-wizard')
        </div>
    </main>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ url('assets/css/guest/form-wizard.css') }}">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
@endpush
