@extends('layouts.app')

@section('title', 'Jenis Bansos')

@section('content_header')
    <h1>Jenis Bansos</h1>
@endsection

@section('content')
    <main class="px-3">
        <hr>
        <div class="d-flex justify-content-end mb-3">
            <a class="btn btn-primary" href="{{ url('rt/bansos/jenis/create') }}">
                <i class="fas fa-plus"></i>
                Tambah Bansos
            </a>
        </div>

        @if (isset($message))
            <div class="alert alert-{{ $message->status }} alert-dismissible fade show" role="alert">
                <strong>{{ $message->title }}!</strong> {{ $message->detail }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
            @foreach ($bansos as $bs)
                <div class="col">
                    <div class="card card-primary card-outline shadow-md">
                        <div class="d-flex align-items-center">
                            <div>
                                <img src="{{ asset('assets/img/details-1.png') }}" class="img-fluid rounded-start"
                                    alt="Gambar Bansos" style="width: 100px; height: 100px;">
                            </div>
                            <div class="flex-grow-1">
                                <div class="card-header">
                                    <h5 class="card-title" style="cursor: pointer;">
                                        {{ $bs->nama_bansos }}
                                    </h5>
                                </div>
                                <div class="card-body d-flex gap-2">
                                    <a href="{{ url('rt/bansos/jenis/' . $bs->id_bansos . '/edit') }}"
                                        class="btn btn-warning">Edit</a>
                                    <form action="{{ url('rt/bansos/jenis/' . $bs->id_bansos) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </main>

@endsection

@push('styles')
    <style>
        .shadow {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush
