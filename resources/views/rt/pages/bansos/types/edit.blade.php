@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit Bansos</h1>
@endsection

@section('content')
    <main class="px-3 pb-4">
        <hr>
        <div class="container">
            <form class="form" action="{{ url('/rt/bansos/jenis/' . $bansos->id_bansos) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_bansos" class="form-label">Nama Bansos</label>
                    <input type="text" class="form-control" id="nama_bansos" name="nama_bansos"
                        aria-describedby="Nama Bansos" maxlength="100"
                        value="{{ old('nama_bansos', $bansos->nama_bansos) }}">
                    <div id="nama_bansos_help" class="form-text">Masukkan nama untuk Bantuan Sosial baru.</div>
                </div>
                <div class="mb-3">
                    <label for="keterangan">keterangan</label>
                    <textarea class="form-control" id="keterangan" style="height: 100px" name="keterangan">{{ old('keterangan', $bansos->keterangan) }}</textarea>
                </div>
                <button type="submit" class="btn btn-warning">Ubah</button>
            </form>
        </div>
    </main>

@endsection

@push('styles')
    {{-- Custom styles --}}
@endpush
