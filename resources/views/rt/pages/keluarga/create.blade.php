@extends('layouts.app')

@section('title', 'Tambah Keluarga')

@section('content_header')
    <header>
        <h1>Form Tambah Keluarga </h1>
    </header>
@endsection

@section('breadcrumb')
    @livewire('admin.bread-crumb', [
      'links' => [
        ['href' => route('rt.keluarga'), 'label' => 'Keluarga']
      ],
      'active' => 'Tambah'
    ])
@endsection

@section('content')
    <div class="container-fluid p-3 rounded-lg" style="background: #fff;">
        <form class="form" action="{{ url('/rt/keluarga') }}" method="POST">
            @csrf

            {{-- Nomor Kartu Keluarga --}}
            <div class="mb-3">
                <label for="no_kk" class="form-label">Nomor Kartu Keluarga</label>
                <x-input 
                    type="text" 
                    id="no_kk" 
                    name="no_kk" 
                    minLength="16"
                    maxLength="16"
                    placeholder="Masukkan Nomor kartu Keluarga"
                    value="{{ old('no_kk') }}"
                />

                {{-- On Validation Error Nomor Kartu Keluarga --}}
                @error('no_kk')
                    @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                @enderror
                {{-- End On Validation Error Nomor Kartu Keluarga --}}
            </div>
            {{-- End Nomor Kartu Keluarga --}}

            {{-- Nomor Induk Kependudukan --}}
            <div class="mb-3">
                <label for="nik" class="form-label p-3">Nomor Induk Kependudukan</label>
                <x-input 
                    type="text"
                    id="nik"
                    name="nik"
                    minLength="16"
                    maxLength="16"
                    placeholder="Masukkan Nomor Induk Kependudukan Baru"
                    value="{{ old('nik') }}"
                />

                {{-- On Validation Error Nomor Induk Kependudukan --}}
                @error('nik')
                    @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                @enderror
                {{-- End On Validation Error Nomor Induk Kependudukan --}}
            </div>
            {{-- End Nomor Induk Kependudukan --}}

            {{-- Nama --}}
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <x-input 
                    type="text"
                    id="nama"
                    name="nama"
                    placeholder="Masukkan Nama"
                    value="{{ old('nama') }}"
                />

                {{-- On Validation Error Nama --}}
                @error('nama')
                    @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                @enderror
                {{-- End On Validation Error Nama --}}
            </div>
            {{-- End Nama --}}

            {{-- Username --}}
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <x-input 
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Masukkan Username"
                    value="{{ old('username') }}"
                />

                {{-- On Validation Error Username --}}
                @error('username')
                    @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                @enderror
                {{-- End On Validation Error Username --}}
            </div>
            {{-- End Username --}}

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <x-input 
                    type="text"
                    id="email"
                    name="email"
                    placeholder="Masukkan Email"
                    value="{{ old('email') }}"
                />

                {{-- On Validation Error Email --}}
                @error('email')
                    @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                @enderror
                {{-- End On Validation Error Email --}}
            </div>
            {{-- End Email --}}

            {{-- Password --}}
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <x-input 
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan Password"
                    value="{{ old('password') }}"
                />

                {{-- On Validation Error Password --}}
                @error('password')
                    @livewire('admin.alert-message', ['class' => 'danger', 'message' => $message])
                @enderror
                {{-- End On Validation Error Password --}}
            </div>
            {{-- End Password --}}
            
            <a href="{{ url('/rt/keluarga') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i>
                <span class="ms-1">Kembali</span>
            </a>
            <button class="btn btn-primary" type="submit">
                <i class="fa-solid fa-plus"></i>
                <span class="ms-1">Tambah</span>
            </button>
        </form>
    </div>
@endsection