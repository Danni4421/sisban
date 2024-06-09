@extends('layouts.app')

@section('title', 'Pengajuan Masuk')

@section('content_header')
    <h1>Data Masuk</h1>
@endsection

@section('content')
    <div class="container-fluid p-3 rounded-lg" style="background: #fff;">
        {{-- Tampilkan pesan sukses jika ada --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Tampilkan pesan error jika ada --}}
        @error('errorPengajuan')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        
        <section>
            {{ $dataTable->table() }}
        </section>
    </div>

    <div class="modal fade" id="modal_detail_pengajuan" tabindex="-1" aria-labelledby="modalPengajuanBansos"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalPengajuanBansos">Detail Permohonan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <section class="col-12 col-lg-4" id="image">
                            <img src="" alt="nothing" width="300" height="400">
                        </section>
                        <section class="col-12 col-lg-8">
                            <table class="table table-striped">
                                <tr>
                                    <th>No KK</th>
                                    <td id="modal_no_kk"></td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td id="modal_nik_kepala_keluarga"></td>
                                </tr>
                                <tr>
                                    <th>Nama Kepala Keluarga</th>
                                    <td id="modal_nama_kepala_keluarga"></td>
                                </tr>
                                <tr>
                                    <th>Nomor Telepon</th>
                                    <td id="modal_nomor_telepon"></td>
                                </tr>
                                <tr>
                                    <th>Daya Listrik</th>
                                    <td>
                                        <span id="modal_daya_listrik"></span> Watt
                                    </td>
                                </tr>
                                <tr>
                                    <th>Biaya Listrik</th>
                                    <td>
                                        Rp.
                                        <span id="modal_biaya_listrik"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Biaya Air</th>
                                    <td>
                                        Rp.
                                        <span id="modal_biaya_air"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Hutang</th>
                                    <td>
                                        Rp.
                                        <span id="modal_hutang"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Pengeluaran</th>
                                    <td>
                                        Rp.
                                        <span id="modal_pengeluaran"></span>
                                    </td>
                                </tr>
                            </table>
                        </section>
                        <div class="divider">
                            <h5>Anggota Keluarga</h5>
                            <hr>
                        </div>
                        <section class="row col-12" id="modal_anggota_keluarga">
                            {{-- Anggota Keluarga --}}
                        </section>
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
        function getDetailPengajuan(no_kk) {
            const route = `/admin/pemohon/${no_kk}`
            
            $.ajax({
                type: 'POST',
                url: route,
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                    contentType: 'application/json'
                },
                success: function(response) {
                    updateInformasiPermohonan(response);
                    setAnggotaKeluarga(response.keluarga.anggota_keluarga);
                }
            });
        }

        function updateInformasiPermohonan(pengajuan) {
            const kepalaKeluarga = pengajuan.keluarga.kepala_keluarga;

            $('#modal_no_kk').text(pengajuan.no_kk);
            $('#modal_nik_kepala_keluarga').text(kepalaKeluarga.nik);
            $('#modal_nama_kepala_keluarga').text(kepalaKeluarga.nama);
            $('#modal_nomor_telepon').text(kepalaKeluarga.no_hp);
            $('#modal_daya_listrik').text(pengajuan.keluarga.daya_listrik);
            $('#modal_biaya_listrik').text(pengajuan.keluarga.biaya_listrik);
            $('#modal_biaya_air').text(pengajuan.keluarga.biaya_air);
            $('#modal_hutang').text(pengajuan.keluarga.hutang);
            $('#modal_pengeluaran').text(pengajuan.keluarga.pengeluaran);
        }

        function setAnggotaKeluarga(anggota_keluarga) {
            $('#modal_anggota_keluarga').html('');

            anggota_keluarga.forEach((anggota) => {
                $('#modal_anggota_keluarga').append(`
                    <div class="col">
                        <div class="card">
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="${anggota.foto_kk}" class="img-fluid rounded-start"
                                        alt="Gambar Bansos">
                                </div>
                                <div class="flex-grow-1">
                                    <div class="card-body">
                                        <table class="table">
                                            <tr>
                                                <th>NIK</th>
                                                <td>${anggota.nik}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama</th>
                                                <td>${anggota.nama}</td>
                                            </tr>
                                            <tr>
                                                <th>Nomor HP</th>
                                                <td>${anggota.no_hp}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
            });
        }

        function confirmApprove(no_kk) {
            Swal.fire({
                title: "Yakin konfirmasi pengajuan ini?",
                text: "Kamu tidak bisa mengubah jika sudah dikonfirmasi!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Setujui",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'PUT',
                        url: `{{ url('rt/pengajuan/approve/${no_kk}') }}`,
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}",
                            contentType: 'application/json'
                        },
                        success: function () {
                            Swal.fire({
                                title: "Menyetujui Pengajuan!",
                                text: "Data pengajuan berhasil diterima.",
                                icon: "success"
                            });
                            
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000)
                        }
                    })
                }
            });
        }

        function confirmDecline(no_kk) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Tolak"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'PUT',
                        url: `{{ url('rt/pengajuan/decline/${no_kk}') }}`,
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}",
                            contentType: 'application/json'
                        },
                        success: function () {
                            Swal.fire({
                                title: "Menolak Pengajuan!",
                                text: "Data pengajuan berhasil ditolak.",
                                icon: "success"
                            });
                            
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000)
                        }
                    })
                }
            });
        }
    </script>

    {{ $dataTable->scripts() }}
@endpush
