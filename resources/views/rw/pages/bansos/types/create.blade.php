@extends('layouts.app')

@section('title', 'Tambah Bansos')

@section('content_header')
    <h4>Tambah Bansos</h4>
@endsection

@section('breadcrumb')
    @livewire('admin.bread-crumb', [
        'links' => [['href' => route('rw.bansos'), 'label' => 'Bantuan Sosial']],
        'active' => 'Tambah',
    ])
@endsection

@section('content')
    <div class="container-fluid p-3 rounded-lg" style="background: #fff;">
        <form class="form" action="{{ url('/rw/bansos/jenis') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_bansos" class="form-label">Nama Bansos</label>
                <input type="text" class="form-control" id="nama_bansos" name="nama_bansos" aria-describedby="Nama Bansos"
                    maxlength="100" value="{{ old('nama_bansos') }}">
                <div id="nama_bansos_help" class="form-text">Masukkan nama untuk Bantuan Sosial baru.</div>

                @error('nama_bansos')
                    @livewire('admin.alert-message', ['class' => 'danger', 'message', $message])
                @enderror

            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control text-start" id="keterangan" name="keterangan">
                  {{ old('keterangan') }}
                </textarea>

                @error('keterangan')
                    @livewire('admin.alert-message', ['class' => 'danger', 'message', $message])
                @enderror

            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah Bansos</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" aria-describedby="Jumlah Bansos"
                    value="{{ old('jumlah') }}">
                <div id="jumlah_bansos_help" class="form-text">Masukkan jumlah bantuan sosial.</div>

                @error('jumlah')
                    @livewire('admin.alert-message', ['class' => 'danger', 'message', $message])
                @enderror

            </div>
            <a href="{{ url('rw/bansos/jenis') }}" class="btn btn-outline-secondary">
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
