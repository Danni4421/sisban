@extends('layouts.app')

@section('content_header')
    <h1>Data Pemohon</h1>
@endsection

@section('content')
<div class="container-md">
    <main class="px-3">
        <hr>
        <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="bg-info text-white">
                <th>No KK</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>No. HP</th>
                <th>RT</th>
                <th>Status Pengajuan</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($dataPengajuan as $pengajuan)
                    <tr>
                        <td>{{ $pengajuan->keluarga->no_kk }}</td>
                        <td>{{ $pengajuan->keluarga->anggota_keluarga[0]->nama }}</td>
                        <td>{{ $pengajuan->keluarga->anggota_keluarga[0]->umur }}</td>
                        <td>{{ $pengajuan->keluarga->anggota_keluarga[0]->no_hp }}</td>
                        <td>{{ $pengajuan->keluarga->rt }}</td>
                        @if ($pengajuan->status_pengajuan == 'diterima')
                            <td><span class="badge text-bg-success">Diterima</span></td>
                        @elseif ($pengajuan->status_pengajuan == 'proses')
                            <td><span class="badge text-bg-warning">Diproses</span></td>
                        @elseif ($pengajuan->status_pengajuan == 'ditolak')
                            <td><span class="badge text-bg-danger">Ditolak</span></td>
                        @endif
                        <td>
                            <!-- Button detail pemohon -->
                            <button type="button" class="btn btn-primary detail_pengajuan_button" data-bs-toggle="modal"
                                data-bs-target="#modal_detail_pengajuan" data-pengajuan="{{ $pengajuan->no_kk}}">
                                <i class="fas fa-search"></i> Lihat
                            </button>

                            <!-- Button aksi sesuai status -->
                            @if ($pengajuan->status_pengajuan == 'diterima')
                              <button class="btn btn-success" onclick="downloadPDF('{{ $pengajuan->no_kk }}')"><i class="fa fa-print"></i> Cetak</button>
                            @else
                              <!-- Tombol cetak dinonaktifkan -->
                              <button class="btn btn-success" disabled="disabled"><i class="fa fa-print"></i> Cetak</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </main>

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
                                    <td id="modal_no_kk">19837129731298</td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td id="modal_nik_kepala_keluarga">8319837192837</td>
                                </tr>
                                <tr>
                                    <th>Nama Kepala Keluarga</th>
                                    <td id="modal_nama_kepala_keluarga">Papir</td>
                                </tr>
                                <tr>
                                    <th>Nomor Telepon</th>
                                    <td id="modal_nomor_telepon">082387238723</td>
                                </tr>
                                <tr>
                                    <th>Daya Listrik</th>
                                    <td>
                                        <span id="modal_daya_listrik">450</span> Watt
                                    </td>
                                </tr>
                                <tr>
                                    <th>Biaya Listrik</th>
                                    <td>
                                        Rp.
                                        <span id="modal_biaya_listrik">0</span>
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
</div>
@endsection

@push('styles')
    {{-- Custom styles --}}
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.detail_pengajuan_button').on('click', function(e) {
                const no_kk = this.getAttribute('data-pengajuan');

                $.ajax({
                    type: 'POST',
                    url: `/rw/pengajuan/${no_kk}`,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        contentType: 'application/json'
                    },
                    success: function(response) {
                        updateInformasiPermohonan(response);
                        setAnggotaKeluarga(response.keluarga.anggota_keluarga);
                    }
                });
            });

            function updateInformasiPermohonan(pengajuan) {
                const kepalaKeluarga = pengajuan.keluarga.anggota_keluarga.filter((anggota) => {
                    return anggota.level === 'kepala_keluarga';
                })[0];

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
        });

        // Dokumen PDF
        function downloadPDF(no_kk) {
          window.location.href = "/rw/pengajuan/" + no_kk + "/cetak";
        }
    </script>
@endpush
