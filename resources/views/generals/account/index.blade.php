@extends('layouts.app')

@section('title', 'Informasi Akun')

@section('content_header')
    @if ($tab == "info")
        <h4>Informasi Akun</h4>
    @elseif ($tab == "notification")
        <h4>Notifikasi</h4>
    @endif
@endsection

@section('content')
    <div class="container-fluid row py-3 rounded-lg" style="background: #fff;">
        <div class="col-12 col-md-2">
            <ul class="navbar-nav gap-2 flex-md-column flex-row mb-md-0 mb-3" id="navigation">
                <li class="nav-item">
                    <a 
                        href="{{ route('account.information', ['tab' => 'info']) }}" 
                        class="btn"
                        id="btn-info"
                        style="width: 10rem"
                    >Akun Saya</a>
                </li>
                <li class="nav-item">
                    <a 
                        href="{{ route('account.information', ['tab' => 'notification']) }}" 
                        class="btn"
                        id="btn-notification"
                        style="width: 10rem"
                    >Notifikasi</a>
                </li>
            </ul>
        </div>
        <div class="col-12 col-md-10">
            @if ($tab == "info")
                <div class="mt-4 mt-md-0">
                    <h5 class="card-text">Profil Saya</h5>

                    {{-- Spoiler --}}
                    <div class="card shadow-none border">
                        <div class="card-body d-flex gap-3">
                            <img 
                                src="{{ asset('assets/img/person/kepala_keluarga_1.jpg') }}" 
                                alt="Profile Photo"
                                class="rounded-circle"
                                width="70px"
                                height="70px"
                            >
                            <div class="h-full d-flex flex-column justify-content-center">
                                <h5 class="card-title text-md">{{ $user->pengurus->nama }}</h5>
                                <h6 class="card-subtitle text-sm mt-1">
                                    <b>{{ $user->pengurus->jabatan }}</b>
                                </h6>
                                <p 
                                    class="card-text text-dark"
                                >
                                    @if ($user->level == "rw")
                                        Kepala Rukun Warga
                                    @else
                                        Kepala Rukun Tetangga
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Personal Information --}}
                    <div class="card shadow-none border">
                        <div class="card-body d-flex flex-column gap-2">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-text">Informasi Diri</h5>
                                <button class="btn m-0 px-3 py-2 border" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Edit <i class="fas fa-pen"></i>
                                </button>
                            </div>

                            <div class="group">
                                <label for="username">Username</label>
                                <span>{{ $user->username }}</span>
                            </div>

                            <div class="group">
                                <label for="name">Nama</label>
                                <span>{{ $user->pengurus->nama }}</span>
                            </div>

                            <div class="group">
                                <label for="email">Email</label>
                                <span>{{ $user->email }}</span>
                            </div>

                            <div class="group">
                                <label for="name">Nomor Telepon</label>
                                <span>{{ $user->pengurus->nomor_telepon }}</span>
                            </div>

                            <div class="group">
                                <label for="name">Alamat</label>
                                <span>{{ $user->pengurus->alamat }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Update Account --}}
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('account.information.update', ['id' => $user->pengurus->id_pengurus]) }}" method="POST">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Informasi Diri</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="username">Username</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="username" 
                                                name="username" 
                                                value="{{ $user->username }}"
                                            >
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama">Nama</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="nama" 
                                                name="nama" 
                                                value="{{ $user->pengurus->nama }}"
                                            >
                                        </div>
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input 
                                                type="email" 
                                                class="form-control" 
                                                id="email" 
                                                name="email" 
                                                value="{{ $user->email }}"
                                            >
                                        </div>
                                        <div class="mb-3">
                                            <label for="password">Password</label>
                                            <input 
                                                type="password" 
                                                class="form-control" 
                                                id="password" 
                                                name="password"
                                            >
                                            <div id="password_help" class="form-text">Masukkan password jika ingin mengganti.</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nomor_telepon">Nomor Telepon</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="nomor_telepon" 
                                                name="nomor_telepon"
                                                max="13" 
                                                value="{{ $user->pengurus->nomor_telepon }}"
                                            >
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat">Alamat</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="alamat" 
                                                name="alamat" 
                                                value="{{ $user->pengurus->alamat }}"
                                            >
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="fa-solid fa-x"></i>
                                        <span class="ms-1">Tutup</span>
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa-regular fa-floppy-disk"></i>
                                        <span class="ms-1">Simpan</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @elseif ($tab == "notification")
                <div class="mt-4 mt-md-0">
                    @livewire('notification-page')
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            border-radius: 20px;
        }

        .group {
            display: flex;
            flex-direction: column;
        }

        .group label {
            margin-bottom: 0;
            font-size: .9rem;
            font-weight: 400 !important;
            color: rgb(130, 129, 129);
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(() => {
            const activeSection = @json($tab);
            $(`#btn-${activeSection}`).addClass('btn-primary');

            $('.nav-item .btn').on('click', (e) => {
                $('.btn-primary').removeClass('btn-primary');
                e.currentTarget.classList.add('btn-primary');
            });
        });
    </script>
@endpush
