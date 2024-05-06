@extends('layouts.app')

@section('title', 'Data RW')

@section('content_header')
    <h1>Data RW</h1>
@endsection

@section('content')
    <main class="px-3">
        <hr>
        <form action="{{ url('admin/data-rw/' . $rw->id_pengurus) }}" method="POST">
            @csrf
            @method('PUT')

            <div id="image">

            </div>

            <div class="card">
                <div class="card-header bg-secondary">
                    <h5>Data Ketua Rukun Warga 07</h5>
                </div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="username_label">Username</span>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                            aria-describedby="Username RW" name="username" id="username_input"
                            value="{{ $rw->user->username }}">

                    </div>

                    @error('username')
                        @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="email_label">Email</span>
                        <input type="text" class="form-control" placeholder="Email" aria-label="Email"
                            aria-describedby="Email RW" name="email" id="email_input" value="{{ $rw->user->email }}">

                    </div>

                    @error('email')
                        @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="level_label">Level</span>
                        <input type="text" class="form-control" placeholder="Level" aria-label="Level"
                            aria-describedby="Level RW" name="level" id="level_input" value="{{ $rw->user->level }}"
                            disabled>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="jabatan_label">Jabatan</span>
                        <input type="text" class="form-control" placeholder="Jabatan" aria-label="Jabatan"
                            aria-describedby="Jabatan RW" name="jabatan" id="jabatan_input" value="{{ $rw->jabatan }}">
                    </div>

                    @error('jabatan')
                        @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="nama_label">Nama</span>
                        <input type="text" class="form-control" placeholder="Nama" aria-label="Nama"
                            aria-describedby="Nam RW" name="nama" id="nama_input" value="{{ $rw->nama }}">
                    </div>

                    @error('nama')
                        @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="nomor_telepon_label">Nomor Telepon</span>
                        <input type="text" class="form-control" placeholder="Nomor Telepon" aria-label="Nomor Telepon"
                            aria-describedby="Nama RW" name="nomor_telepon" id="nomor_telepon_input"
                            value="{{ $rw->nomor_telepon }}">
                    </div>

                    @error('nomor_telepon')
                        @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="alamat_label">alamat</span>
                        <input type="text" class="form-control" placeholder="Alamat" aria-label="Alamat"
                            aria-describedby="Alamat RW" name="alamat" id="alamat_input" value="{{ $rw->alamat }}">
                    </div>

                    @error('alamat')
                        @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                    @enderror

                    <button class="btn btn-secondary" style="width: 100%">Simpan</button>
                </div>
            </div>
        </form>
    </main>
@endsection

@push('styles')
    {{-- Custom styles --}}
@endpush
