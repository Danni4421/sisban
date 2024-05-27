@extends('layouts.app')

@section('title', 'Jenis Bansos')

@section('content_header')
    <h1>Jenis Bansos</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <hr>
        @if (isset($message))
            <div class="alert alert-{{ $message->status }} alert-dismissible fade show" role="alert">
                <strong>{{ $message->title }}!</strong> {{ $message->detail }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
            @foreach ($bansos as $bs)
                <div class="col">
                    <div class="card card-primary card-outline shadow-md" style="min-height: 140px;">
                        <div class="d-flex align-items-center">
                            <div>
                                <img src="{{ asset('assets/img/details-1.png') }}" class="img-fluid rounded-start"
                                    alt="Gambar Bansos" style="width: 100px; height: 100px;">
                            </div>
                            <div class="flex-grow-1">
                                <div class="card-header">
                                    <h5 class="card-title d-flex flex-column">
                                        <a href="{{ route('rt.bansos.alternative', ['id_bansos' => $bs->id_bansos]) }}">
                                            {{ $bs->nama_bansos }}
                                        </a>
                                        <p class="d-flex flex-column">
                                            <span>{{ $bs->keterangan }}</span>
                                            <b>Jumlah: {{ $bs->jumlah }}</b> 
                                        </p>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@endsection

@push('styles')
    <style>
        .shadow {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush
