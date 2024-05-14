@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <header>
        <h1>Data Penerima Bantuan Sosial</h1>
    </header>
@endsection

@section('content')
    <div class="container-fluid">
        {{ $dataTable->table() }}
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
        function confirmDelete(idBansos, nik) {
            Swal.fire({
                title: "Yakin menghapus penerima bansos?",
                text: "Perubahan tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: `{{ url('/rt/bansos/${idBansos}/penerima/${nik}') }}`,
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            contentType: 'application/json'
                        },
                        success: function() {
                            Swal.fire({
                                title: "Menghapus Penerima Bantuan Sosial!",
                                text: "Data pengajuan berhasil dihapus.",
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

        function getDetailPenerima(nik, idBansos) {
            const route = `/rt/bansos/penerima/${nik}/${idBansos}`

            $.ajax({
                type: 'POST',
                url: route,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    contentType: 'application/json'
                },
                success: function(response) {
                    updateInformasiPenerima(response.penerimaBansos);
                }
            });
        }

        function updateInformasiPenerima(penerimaBansos) {
            // Populate warga data
            $('#modal_nik').text(penerimaBansos.warga.nik);
            $('#modal_nik').text(penerimaBansos.warga.nik);
            $('#modal_no_kk').text(penerimaBansos.warga.no_kk);
            $('#modal_nama').text(penerimaBansos.warga.nama);
            $('#modal_jenis_kelamin').text(penerimaBansos.warga.jenis_kelamin);
            $('#modal_ttl').text(penerimaBansos.warga.tempat_tanggal_lahir);
            $('#modal_umur').text(penerimaBansos.warga.umur);
            $('#modal_no_hp').text(penerimaBansos.warga.no_hp);
            $('#modal_penghasilan').text(penerimaBansos.warga.penghasilan);
            $('#modal_foto_ktp').attr('src', penerimaBansos.warga.foto_ktp);
            // Jenis Bansos
            $('#modal_nama_bansos').text(penerimaBansos.bansos.nama_bansos);
            $('#modal_keterangan').text(penerimaBansos.bansos.keterangan);
            $('#modal_tanggalPenerima').text(penerimaBansos.tanggal_penerimaan);

        }
    </script>
    {{ $dataTable->scripts() }}
@endpush
