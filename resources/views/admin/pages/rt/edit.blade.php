@extends('layouts.app')

@section('title', 'Ubah Rukun Tetangga')

@section('content_header')
    <h1>Edit RT</h1>
@endsection

@section('content')
    <main class="px-3 pb-4">
        <hr>
        <section>
            <form class="form" action="{{ url('/admin/data-rt/' . $rt->id_pengurus) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan"
                        aria-describedby="Jabatan Pengurus" maxlength="100" value="{{ old('jabatan', $rt->jabatan) }}">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama"
                        aria-describedby="Nama Pengurus" maxlength="100" value="{{ old('nama', $rt->nama) }}">
                </div>
                <div class="mb-3">
                    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon"
                        aria-describedby="Nomor Telepon Pengurus" maxlength="100"
                        value="{{ old('nomor_telepon', $rt->nomor_telepon) }}">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat"
                        aria-describedby="Alamat Pengurus" maxlength="100" value="{{ old('alamat', $rt->alamat) }}">
                </div>
                <div class="table-footer">
                    <button type="submit" class="btn btn-warning">Ubah</button>
                    <a href="{{ url('admin/data-rt') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </section>
    </main>

@endsection

@push('styles')
    {{-- Custom styles --}}
@endpush
