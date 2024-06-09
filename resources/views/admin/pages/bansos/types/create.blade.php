@extends('layouts.app')

@section('title', 'Tambah Bantuan Sosial')

@section('content_header')
    <h1>Tambah Bansos</h1>
@endsection

@section('content')
    <div class="container-fluid p-3 rounded-lg" style="background: #fff;">
        <form class="form" action="{{ url('/admin/bansos/jenis') }}" method="POST">
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
            <a href="{{ url('admin/bansos/jenis') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i>
                <span class="ms-1">Kembali</span>
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i>
                <span class="ms-1">Tambah</span>
            </button>
        </form>
    </div>

@endsection

@push('styles')
    {{-- Custom styles --}}
@endpush
