@extends('layouts.app')

@section('content_header')
    <h2>Edit Data Ketua RT</h2>
@endsection

@section('content')
    <div class="container-fluid">
        <form method="POST" action="{{ url('rw/data-rt/' . $data->id_pengurus) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control py-4" id="nama" name="nama" value="{{ $data->nama }}">

                @error('nama')
                    @livewire('alert-message', ['class' => 'danger', 'message', $message])
                @enderror
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control py-4" id="jabatan" name="jabatan"
                    value="{{ $data->jabatan }}">

                @error('jabatan')
                    @livewire('alert-message', ['class' => 'danger', 'message', $message])
                @enderror
            </div>
            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon</label>
                <input type="number" class="form-control py-4" id="nomor_telepon" name="nomor_telepon"
                    value="{{ $data->nomor_telepon }}">

                @error('nomor_telepon')
                    @livewire('alert-message', ['class' => 'danger', 'message', $message])
                @enderror
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control py-4" id="alamat" name="alamat"
                    value="{{ $data->alamat }}">

                @error('alamat')
                    @livewire('alert-message', ['class' => 'danger', 'message', $message])
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ url('rw/data-rt') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
@endsection
