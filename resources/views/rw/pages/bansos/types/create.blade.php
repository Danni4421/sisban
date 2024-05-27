@extends('layouts.app')

@section('title', 'Tambah Bansos')

@section('content_header')
    <h1>Tambah Bansos</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <form class="form" action="{{ url('/rw/bansos/jenis') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_bansos" class="form-label">Nama Bansos</label>
                <input type="text" class="form-control" id="nama_bansos" name="nama_bansos"
                    aria-describedby="Nama Bansos" maxlength="100" value="{{ old('nama_bansos') }}">
                <div id="nama_bansos_help" class="form-text">Masukkan nama untuk Bantuan Sosial baru.</div>

                @error('nama_bansos')
                    @livewire('alert-message', ['class' => 'danger', 'message', $message])
                @enderror

            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control text-start" id="keterangan" name="keterangan">
                  {{ old('keterangan') }}
                </textarea>

                @error('keterangan')
                    @livewire('alert-message', ['class' => 'danger', 'message', $message])
                @enderror

            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah Bansos</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah"
                    aria-describedby="Jumlah Bansos"
                    value="{{ old('jumlah') }}">
                <div id="jumlah_bansos_help" class="form-text">Masukkan jumlah bantuan sosial.</div>

                @error('jumlah')
                    @livewire('alert-message', ['class' => 'danger', 'message', $message])
                @enderror

            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <a href="{{ url('rw/bansos/jenis') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

@endsection