@extends('layouts.app')

@section('title', 'Tambah Rukun Tetangga')

@section('content_header')
    <h1>Tambah RT</h1>
@endsection

@section('content')
    <div class="container-fluid p-3 rounded-lg" style="background: #fff;">
        <section>
            <form class="form" action="{{ url('admin/data-rt') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                        aria-describedby="Username Pengurus" maxlength="50" value="{{ old('username') }}"
                        placeholder="Masukkan Username, Contoh: sariadi" required>

                    @error('username')
                        @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        aria-describedby="Email Pengurus" maxlength="100" value="{{ old('email') }}"
                        placeholder="Masukkan Email, Contoh: sariadi@mail.com" required>
                    
                    @error('email')
                        @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        aria-describedby="Password Pengurus" maxlength="20"
                        placeholder="Masukkan Password, Contoh: s4riad1._" required>
                    
                    @error('password')
                        @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan"
                        aria-describedby="Jabatan Pengurus" maxlength="11" value="{{ old('jabatan') }}"
                        placeholder="Masukkan Jabatan Pengurus Contoh: RT021, RT022" required>

                    @error('jabatan')
                        @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama"
                        aria-describedby="Nama Pengurus" maxlength="100" value="{{ old('nama') }}"
                        placeholder="Masukkan Nama Pengurus, Contoh: Sariadi Mulyadi" required>

                    @error('nama')
                        @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon"
                        aria-describedby="Nomor Telepon Pengurus" maxlength="13" value="{{ old('nomor_telepon') }}"
                        placeholder="Masukkan Nomor Telepon, Contoh: 081234567891" required>
                    
                    @error('nomor_telepon')
                        @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat"
                        aria-describedby="Alamat Pengurus" maxlength="100" value="{{ old('alamat') }}"
                        placeholder="Masukkan Alamat dari Pengurus, Contoh: Dusun Ketangi RW007/RT0XX Tegalgondo, Karangploso, Malang"
                        required>

                    @error('alamat')
                        @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                    @enderror
                </div>
                <div class="table-footer">
                    <a href="{{ url('admin/data-rt') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span class="ms-1">Kembali</span>
                    </a>
                    <button type="submit" class="btn btn-primary" id="submit_button">
                        <i class="fa-solid fa-plus"></i>
                        <span class="ms-1">Tambah</span>
                    </button>
                </div>
            </form>
        </section>
    </div>
@endsection
