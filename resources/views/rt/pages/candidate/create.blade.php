@extends('layouts.app')

@section('title', 'Tambah Kandidat')

@section('content_header')
    <header>
        <h1>Tambah Kandidat Bantuan Sosial</h1>
    </header>
@endsection

@section('content')
    {{-- <div class="container-fluid"> --}}
        @livewire('pengajuan-wizard')
    {{-- </div> --}}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ url('assets/css/guest/form-wizard.css') }}">

    <style>
        @media (max-width: 576px) {
            .form-step {
                width: 90%;
            }
        }

        /* @media (min-width: 576px) {
            .form-step {
                width: 75%;
            }
        } */
    </style>
@endpush


