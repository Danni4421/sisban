@extends('layouts.app')

@section('title', 'Kandidat')

@section('content_header')
    <header>
        <h1>Kandidat Penerima Bantuan Sosial</h1>
    </header>
@endsection

@section('content')
    <div class="container-fluid">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> menambahkan kandidat baru.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-end">
            <a href="{{ route('rt.kandidat.add') }}" class="btn btn-primary">
                <i class="fas fa-user-plus"></i>
                <span>Tambah Kandidat</span>
            </a>
        </div>
        {{ $dataTable->table() }}
    </div>

    <div class="modal fade" id="modal_image_show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
            <img src="#" id="image_show">
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalInformasiPenerima" tabindex="-1" aria-labelledby="modalInformasiPenerimaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalInformasiPenerimaLabel">Informasi Permohonan Bantuan Sosial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="card">
                            <div class="card-header">
                                <h5>Data Penerima</h5>
                            </div>
                            <div class="card-body">
                                    <div class="row">
                                        <section class="col-12 col-lg-4" id="image">
                                            <img src="" alt="foto ktp" width="300" height="400">
                                        </section>
                                        <section class="col-12 col-lg-8">
                                            <table class="table table-striped table-hover">
                                            <tr>
                                                <th scope="col">NIK</th>
                                                <td id="modal_nik"></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">No KK</th>
                                                <td id="modal_no_kk"></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Nama</th>
                                                <td id="modal_nama"></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Jenis Kelamin</th>
                                                <td id="modal_jenis_kelamin"></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Tempat Tanggal Lahir</th>
                                                <td id="modal_ttl"></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Umur</th>
                                                <td id="modal_umur"></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">No HP</th>
                                                <td id="modal_no_hp"></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Penghasilan</th>
                                                <td id="modal_penghasilan"></td>
                                            </tr>
                                        </section>
                                    </div>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h5>Data Bantuan Sosial</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nama Bantuan</th>
                                            <td id="modal_nama_bansos"></td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Keterangan</th>
                                            <td id="modal_keterangan"></td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Tanggal Penerima</th>
                                            <td id="modal_tanggalPenerima"></td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/dataTable/css/dataTable.css') }}">
@endpush

@push('scripts')
    <script>
        function showImage(name) {
            $('#image_show').attr('src', name);
        }
    </script>

    {{ $dataTable->scripts() }}
@endpush