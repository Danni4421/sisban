@extends('layouts.app')

@section('title', 'Data RW')

@section('content_header')
    <h1>Informasi Akun</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <hr>
        <form action="{{ route('account.information.update', $user->pengurus->id_pengurus) }}" method="POST">
            @csrf
            @method('PUT')

            <div id="image">

            </div>

            <div class="card">
                <div class="card-header bg-secondary">
                    <h5>Data Pribadi</h5>
                </div>
                <div class="card-body">
                   <div class="row">
                        <div class="col-12 col-lg-9">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="username_label">Username</span>
                                <input type="text" class="form-control py-4" placeholder="Username" aria-label="Username"
                                    aria-describedby="Username RW" name="username" id="username_input"
                                    value="{{ $user->username }}" disabled>
        
                            </div>
        
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="email_label">Email</span>
                                <input type="text" class="form-control py-4" placeholder="Email" aria-label="Email"
                                    aria-describedby="Email RW" name="email" id="email_input" value="{{ $user->email }}" disabled>
        
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="level_label">Level</span>
                                <input type="text" class="form-control py-4" placeholder="Level" aria-label="Level"
                                    aria-describedby="Level RW" name="level" id="level_input" value="{{ $user->level }}"
                                    disabled>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="jabatan_label">Jabatan</span>
                                <input type="text" class="form-control py-4" placeholder="Jabatan" aria-label="Jabatan"
                                    aria-describedby="Jabatan RW" name="jabatan" id="jabatan_input" value="{{ $user->pengurus->jabatan }}" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 d-flex justify-content-center">
                            <img src="{{ asset('assets/img/avatar.png') }}" alt="Foto Profil">
                        </div>
                   </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="nama_label">Nama</span>
                        <input type="text" class="form-control py-4" placeholder="Nama" aria-label="Nama"
                            aria-describedby="Nam RW" name="nama" id="nama_input" value="{{ $user->pengurus->nama }}">
                    </div>

                    @error('nama')
                        @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="nomor_telepon_label">Nomor Telepon</span>
                        <input type="text" class="form-control py-4" placeholder="Nomor Telepon" aria-label="Nomor Telepon"
                            aria-describedby="Nama RW" name="nomor_telepon" id="nomor_telepon_input"
                            value="{{ $user->pengurus->nomor_telepon }}">
                    </div>

                    @error('nomor_telepon')
                        @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="alamat_label">alamat</span>
                        <input type="text" class="form-control py-4" placeholder="Alamat" aria-label="Alamat"
                            aria-describedby="Alamat RW" name="alamat" id="alamat_input" value="{{ $user->pengurus->alamat }}">
                    </div>

                    @error('alamat')
                        @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                    @enderror

                    <button class="btn btn-secondary" style="width: 100%">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    {{-- Custom styles --}}
@endpush