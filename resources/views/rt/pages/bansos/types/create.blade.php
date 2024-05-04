@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Tambah Bansos</h1>
@endsection

@section('content')
    <main class="px-3 pb-4">
        <hr>
        <div class="container">
            <form class="form" action="{{ url('/rt/bansos/jenis') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_bansos" class="form-label">Nama Bansos</label>
                    <input type="text" class="form-control" id="nama_bansos" name="nama_bansos"
                        aria-describedby="Nama Bansos" maxlength="100" value="{{ old('nama_bansos') }}">
                    <div id="nama_bansos_help" class="form-text">Masukkan nama untuk Bantuan Sosial baru.</div>
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control text-start" id="keterangan" name="keterangan">
                      {{ old('keterangan') }}
                    </textarea>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </main>

@endsection

@push('styles')
    {{-- Custom styles --}}
@endpush
