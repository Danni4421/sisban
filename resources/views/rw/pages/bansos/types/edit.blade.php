@extends('layouts.app')

@section('title', 'Ubah Bansos')

@section('content_header')
    <h4>Edit Bansos</h4>
@endsection

@section('breadcrumb')
    @livewire('admin.bread-crumb', [
        'links' => [['href' => route('rw.bansos'), 'label' => 'Bantuan Sosial']],
        'active' => 'Ubah',
    ])
@endsection

@section('content')
    <div class="container-fluid p-3 rounded-lg" style="background: #fff;">
        <form class="form" action="{{ url('/rw/bansos/jenis/' . $bansos->id_bansos) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_bansos" class="form-label">Nama Bansos</label>
                <input type="text" class="form-control" id="nama_bansos" name="nama_bansos" aria-describedby="Nama Bansos"
                    maxlength="100" value="{{ old('nama_bansos', $bansos->nama_bansos) }}">
                <div id="nama_bansos_help" class="form-text">Masukkan nama untuk Bantuan Sosial baru.</div>

                @error('nama_bansos')
                    @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                @enderror

            </div>
            <div class="mb-3">
                <label for="keterangan">keterangan</label>
                <input 
                    class="form-control" 
                    id="keterangan" 
                    name="keterangan" 
                    value="{{ old('keterangan', $bansos->keterangan) }}" 
                    required 
                />
                
                @error('keterangan')
                    @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                @enderror

            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah Bansos</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" aria-describedby="Jumlah Bansos"
                    value="{{ old('jumlah', $bansos->jumlah) }}">
                <div id="jumlah_bansos_help" class="form-text">Masukkan jumlah bantuan sosial.</div>

                @error('jumlah')
                    @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                @enderror

            </div>
            <a href="{{ url('rw/bansos/jenis') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left"></i>
                <span class="ms-1">Kembali</span>
            </a>
            <button type="submit" class="btn btn-warning">
                <i class="fa-regular fa-pen-to-square"></i>
                <span class="ms-1">Ubah</span>
            </button>
        </form>
        </main>

    @endsection
