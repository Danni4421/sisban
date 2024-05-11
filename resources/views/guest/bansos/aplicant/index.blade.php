<div>
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
</div>
@extends('layouts.guest')

@section('content')
    <main class="p-md-5 p-1">
        <div class="pt-5">
            <div class="section-title w-100" data-aos="fade-up">
                <h2>Informasi</h2>
                <p>Daftar Pemohon Bantuan Sosial</p>
            </div>  

            @if (isset($success))
                <div>{{ $success }}</div>
            @endif


            <div>
                {{ $dataTable->table() }}
            </div>
        </div>
    </main>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/dataTable/css/dataTable.css') }}">
@endpush

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush