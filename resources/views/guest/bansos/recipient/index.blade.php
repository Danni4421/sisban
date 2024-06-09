<div>
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
</div>
@extends('layouts.guest')

@section('content')
    <main class="p-md-5 p-1">
        <div class="p-3">
            <div class="section-title w-100" data-aos="fade-up">
                <h2>Informasi</h2>
                <p class="fs-3">Daftar Penerima Bantuan Sosial</p>
            </div>  

            @if (isset($success))
                <div>{{ $success }}</div>
            @endif


            {{ $dataTable->table() }}
        </div>
    </main>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/dataTable/css/dataTable.css') }}">
@endpush

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush