@extends('layouts.app')

@section('title', 'Pemohon')

@section('content_header')
    <header>
        <h1>Pemohon</h1>
    </header>
@endsection

@section('content')
    <main class="px-3">
        <hr>
        <table class="table table-striped table-hover">
            <thead>
                <th>NIK</th>
                <th>Nama</th>
                <th>Usia</th>
                <th>No.WA</th>
                <th>Status</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($aplicants as $aplicant)
                    <tr>
                        <td>{{ $aplicant->keluarga->no_kk }}</td>
                        <td>{{ $aplicant->keluarga->anggota_keluarga[0]->nama }}</td>
                        <td>{{ $aplicant->keluarga->anggota_keluarga[0]->umur }}</td>
                        <td>{{ $aplicant->keluarga->anggota_keluarga[0]->no_hp }}</td>
                        <td>
                            @if ($aplicant->status_pengajuan == 'diterima')
                                <span class="badge text-bg-success">Diterima</span>
                            @endif

                            @if ($aplicant->status_pengajuan == 'proses')
                                <span class="badge text-bg-warning">Diproses</span>
                            @endif

                            @if ($aplicant->status_pengajuan == 'ditolak')
                                <span class="badge text-bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td class="d-flex gap-2">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modal_detail_pemohon" data-aplicant="{{ $aplicant->no_kk }}"
                                id="detail_aplicant_button">
                                <i class="fas fa-search"></i>
                            </button>

                            <form action="{{ url('admin/pemohon/' . $aplicant->no_kk . '/approve') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            <form action="{{ url('admin/pemohon/' . $aplicant->no_kk . '/decline') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

    <div class="modal fade" id="modal_detail_pemohon" tabindex="-1" aria-labelledby="modalPemohonBansos"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalPemohonBansos">Detail Permohonan</h1>
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
                                    <td id="modal_nik_kepala_keluarga">83198371928379</td>
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
@endsection

@push('styles')
    {{-- Custom styles --}}
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#detail_aplicant_button').on('click', function(e) {
                const noKK = this.getAttribute('data-aplicant');

                $.ajax({
                    type: 'POST',
                    url: `/admin/pemohon/${noKK}`,
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
    </script>
@endpush
