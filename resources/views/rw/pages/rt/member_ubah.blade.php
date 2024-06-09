@extends('layouts.app')

@section('content_header')
    <h4>Edit Data Ketua RT</h4>
@endsection

@section('breadcrumb')
    @livewire('admin.bread-crumb', [
      'links' => [
        ['href' => route('rw.data-rt'), 'label' => 'List RT']
      ],
      'active' => 'Ubah'
    ])
@endsection

@section('content')
    <div class="container-fluid p-3 rounded-lg" style="background: #fff;">
        <form method="POST" action="{{ url('rw/data-rt/' . $data->id_pengurus) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $data->nama }}">

                @error('nama')
                    @livewire('alert-message', ['class' => 'danger', 'message', $message])
                @enderror
            </div>
            <div class="mb-3">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan"
                    value="{{ $data->jabatan }}">

                @error('jabatan')
                    @livewire('alert-message', ['class' => 'danger', 'message', $message])
                @enderror
            </div>
            <div class="mb-3">
                <label for="nomor_telepon">Nomor Telepon</label>
                <input type="number" class="form-control" id="nomor_telepon" name="nomor_telepon"
                    value="{{ $data->nomor_telepon }}">

                @error('nomor_telepon')
                    @livewire('alert-message', ['class' => 'danger', 'message', $message])
                @enderror
            </div>
            <div class="mb-3">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat"
                    value="{{ $data->alamat }}">

                @error('alamat')
                    @livewire('alert-message', ['class' => 'danger', 'message', $message])
                @enderror
            </div>
            <div>
                <a href="{{ url('rw/data-rt') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span class="ms-1">Kembali</span>
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-regular fa-floppy-disk"></i>
                    <span class="ms-1">Simpan</span>
                </button>
            </div>
        </form>
    </div>
@endsection
