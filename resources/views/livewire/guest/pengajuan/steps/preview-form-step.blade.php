<div>
    <div class="mx-auto my-5" style="width: 95%">

        {{-- Data Pemohon --}}
        <div class="card  mb-3">
            <div class="card-header">
                Data Pemohon
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <x-label for="nik_pemohon">NIK</x-label>
                            <x-input type="text" class="mb-3" model="nik_kepala_keluarga" disabled="true" />
                        </div>

                        <div class="mb-3">
                            <x-label for="nama_kepala_keluarga">Nama</x-label>
                            <x-input type="text" model="nama_kepala_keluarga" disabled="true" />
                        </div>

                        <div class="mb-3">
                            <x-label for="umur_kepala_keluarga">Umur</x-label>
                            <x-input type="number" model="umur_kepala_keluarga" disabled="true" />
                        </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="row">
                            <div class="col">
                                <x-label for="jenis_kelamin_kepala_keluarga">Jenis Kelamin</x-label>
                                <div class="d-flex items-center gap-3 py-3 mb-3">
                                    <x-input.radio type="radio" name="jenis_kelamin" model="jenis_kelamin_kepala_keluarga"
                                        value="lk" content="Laki Laki" disabled="true" />
                                    <x-input.radio type="radio" name="jenis_kelamin" model="jenis_kelamin_kepala_keluarga"
                                        value="pr" content="Perempuan" disabled="true" />
                                </div>
                            </div>

                            <div class="col">
                                <x-label for="foto_ktp">Foto Kartu Tanda Kependudukan</x-label>
                                <img 
                                    src="{{ asset('assets/' . $foto_ktp_kepala_keluarga) }}" 
                                    alt="Foto KTP"
                                    width="256.8" height="161.88" 
                                    class="m-2"
                                    data-bs-toggle="modal" data-bs-target="#modal_image_show"
                                    onclick="showImage('assets/{{$foto_ktp_kepala_keluarga}}')"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <x-label for="tempat_tanggal_lahir_kepala_keluarga">Tempat Tanggal Lahir</x-label>
                        <x-input type="text" model="tempat_tanggal_lahir_kepala_keluarga" disabled="true" />
                    </div>

                    <div class="col-12 mb-3">
                        <x-label for="nomor_telepon_kepala_keluarga">Nomor Telepon</x-label>
                        <x-input type="text" model="nomor_telepon_kepala_keluarga" minLength="16" maxLength="16"
                            disabled="true" />
                    </div>

                    <div class="col-12 mb-3">
                        <x-label for="status_kepala_keluarga">Status</x-label>
                        <x-input type="text" model="status_kepala_keluarga"
                            disabled="true" />
                    </div>

                    <div class="col-12">
                        <x-label for="penghasilan_kepala_keluarga">Penghasilan</x-label>
                        <x-input type="text" model="penghasilan_kepala_keluarga"
                            disabled="true" />
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Keluarga --}}
        <div class="card mb-3">
            <div class="card-header">
                Data Keluarga
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="row col-12">
                        <div class="col-12 col-sm-9 mb-3">
                            <div class="mb-3">
                                <x-label for="no_kk">Nomor Kartu Keluarga</x-label>
                                <x-input type="text" model="no_kk" disabled="true" />
                            </div>
                            <div class="mb-3">
                                <x-label for="rt">RT</x-label>
                                <x-input type="text" model="rt" disabled="true" />
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <x-label for="foto_kk">Foto Kartu Keluarga</x-label>
                            <img 
                                src="{{ asset('assets/' . $foto_kk) }}" 
                                alt="Foto KTP Kepala Keluarga" 
                                width="256.8" height="161.88" 
                                class="m-2"
                                data-bs-toggle="modal" data-bs-target="#modal_image_show"
                                onclick="showImage('assets/{{$foto_kk}}')"
                            >
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            @foreach ($inputKeluarga as $anggotaIndex)
                                <div class="row">
                                    <h6 class="text-secondary my-2 mt-5">
                                        Data Keluarga
                                        <span>(Anggota Keluarga {{ $anggotaIndex + 1 }})</span>
                                    </h6>
                                    <hr>

                                    <div class="col">
                                        <div class="mb-3">
                                            <x-label for="nik.{{$anggotaIndex}}">NIK</x-label>
                                            <x-input 
                                                type="text" 
                                                name="nik.{{$anggotaIndex}}" 
                                                model="nik.{{$anggotaIndex}}"
                                                disabled="true" 
                                            />
                                        </div>

                                        <div class="mb-3">
                                            <x-label for="nama.{{$anggotaIndex}}">Nama</x-label>
                                            <x-input 
                                                type="text"
                                                name="nama.{{$anggotaIndex}}" 
                                                model="nama.{{$anggotaIndex}}" 
                                                disabled="true" 
                                            />
                                        </div>
                                        <div class="mb-3">
                                            <x-label for="umur.{{$anggotaIndex}}">Umur</x-label>
                                            <x-input 
                                                type="number" 
                                                name="umur.{{$anggotaIndex}}"
                                                model="umur.{{$anggotaIndex}}" 
                                                disabled="true" 
                                            />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <x-label for="jenis_kelamin.{{$anggotaIndex}}">Jenis Kelamin</x-label>
                                                <div class="d-flex items-center gap-3 py-3 mb-3">
                                                    <x-input.radio 
                                                        type="radio" 
                                                        name="jenis_kelamin.{{$anggotaIndex}}"
                                                        model="jenis_kelamin.{{$anggotaIndex}}" 
                                                        value="lk" content="Laki Laki" disabled="true" 
                                                    />
                                                    <x-input.radio 
                                                        type="radio" 
                                                        name="jenis_kelamin.{{$anggotaIndex}}"
                                                        model="jenis_kelamin.{{$anggotaIndex}}" 
                                                        value="pr" content="Perempuan" disabled="true" 
                                                    />
                                                </div>
                                            </div>

                                            @if (isset($slip_gaji[$anggotaIndex]))
                                                <div class="col">
                                                    <x-label for="slip_gaji">Foto Slip Gaji</x-label>
                                                    <img src="{{ asset('assets/' . $slip_gaji[$anggotaIndex]) }}"
                                                        alt="Foto slip gaji anggota keluarga" 
                                                        width="256.8" height="161.88" 
                                                        class="m-2"
                                                        data-bs-toggle="modal" data-bs-target="#modal_image_show"
                                                        onclick="showImage('assets/{{$slip_gaji[$anggotaIndex]}}')"
                                                    >
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <x-label for="tempat_tanggal_lahir.{{$anggotaIndex}}">Tempat Tanggal Lahir</x-label>
                                        <x-input 
                                            type="text" 
                                            name="tempat_tanggal_lahir.{{$anggotaIndex}}"
                                            model="tempat_tanggal_lahir.{{$anggotaIndex}}"
                                            disabled="true" 
                                        />
                                    </div>

                                    <div class="col-12 mb-3">
                                        <x-label for="nomor_telepon.{{$anggotaIndex}}">Nomor Telepon</x-label>
                                        <x-input 
                                            type="text" 
                                            name="nomor_telepon.{{$anggotaIndex}}"
                                            model="nomor_telepon.{{$anggotaIndex}}" 
                                            minLength="16" maxLength="16" disabled="true" 
                                        />
                                    </div>

                                    <div class="col-12 mb-3">
                                        <x-label for="status.{{$anggotaIndex}}">Status</x-label>
                                        <x-input 
                                            type="text" 
                                            name="status.{{$anggotaIndex}}"
                                            model="status.{{$anggotaIndex}}" 
                                            disabled="true" 
                                        />
                                    </div>

                                    <div class="col-12">
                                        <x-label for="penghasilan.{{$anggotaIndex}}">Penghasilan</x-label>
                                        <x-input 
                                            type="text" 
                                            name="penghasilan.{{$anggotaIndex}}"
                                            model="penghasilan.{{$anggotaIndex}}" 
                                            disabled="true" 
                                        />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Aset --}}
        <div class="card mb-3">
            <div class="card-header">
                Data Aset Keluarga
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            @foreach ($inputAset as $assetIndex)
                                <div class="row">
                                    <h6 class="text-secondary my-2">
                                        Data Aset Ke-
                                        <span>({{ $assetIndex + 1 }})</span>
                                    </h6>
                                    <hr>

                                    <div class="col-12 col-md-8">
                                        <div class="mb-3">
                                            <x-label for="nama_aset.{{$assetIndex}}">Nama Aset</x-label>
                                            <x-input 
                                                type="text" 
                                                name="nama_aset.{{$assetIndex}}" 
                                                model="nama_aset.{{$assetIndex}}"
                                                disabled="true" 
                                            />
                                        </div>
    
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-3">
                                                <x-label for="tahun_beli.{{$assetIndex}}">Tahun Beli</x-label>
                                                <x-input 
                                                    type="text"
                                                    name="tahun_beli.{{$assetIndex}}" 
                                                    model="tahun_beli.{{$assetIndex}}" 
                                                    disabled="true" 
                                                />
                                            </div>
        
                                            <div class="col-12 col-md-6 mb-3">
                                                <x-label for="harga_jual.{{$assetIndex}}">Harga Jual</x-label>
                                                <x-input 
                                                    type="text"
                                                    name="harga_jual.{{$assetIndex}}" 
                                                    model="harga_jual.{{$assetIndex}}" 
                                                    disabled="true" 
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    @if (isset($foto_aset[$assetIndex]))
                                        <div class="col-12 col-md-4 mb-3 d-flex flex-column align-items-center">
                                            <x-label for="foto_aset.{{$assetIndex}}">Foto Aset</x-label>
                                            <img src="{{ asset('assets/' . $foto_aset[$assetIndex]) }}"
                                                alt="Foto aset" 
                                                width="256.8" height="161.88" 
                                                class="m-2"
                                                data-bs-toggle="modal" data-bs-target="#modal_image_show"
                                                onclick="showImage('assets/{{$foto_aset[$assetIndex]}}')"
                                            >
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Ekonomi Keluarga --}}
        <div class="card mb-3">
            <div class="card-header">
                Ekonomi Keluarga
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="row col-12">
                        <div class="col-12 col-md-8">
                            <div class="col-12">
                                <x-label for="daya_listrik">Daya Listrik</x-label>
                                <x-input type="text" model="daya_listrik" disabled="true" />
                            </div>
                            <div class="col-12">
                                <x-label for="biaya_listrik">Biaya Listrik</x-label>
                                <x-input type="text" model="biaya_listrik" disabled="true" />
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex flex-column align-items-center">
                            <x-label for="foto_tagihan_listrik">Foto Tagihan Listrik</x-label>
                            <img src="{{ asset('assets/' . $foto_tagihan_listrik) }}"
                                alt="Foto tagihan listrik" 
                                width="256.8" height="161.88" 
                                class="m-2"
                                data-bs-toggle="modal" data-bs-target="#modal_image_show"
                                onclick="showImage('assets/{{$foto_tagihan_listrik}}')"
                            >
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="col-12 col-md-8">
                            <div class="col-12">
                                <x-label for="biaya_air">Biaya Air</x-label>
                                <x-input type="text" model="biaya_air" disabled="true" />
                            </div>
                            <div class="col-12">
                                <x-label for="pengeluaran">pengeluaran</x-label>
                                <x-input type="text" model="pengeluaran" disabled="true" />
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex flex-column align-items-center">
                            <x-label for="foto_tagihan_air">Foto Tagihan Air</x-label>
                            <img src="{{ asset('assets/' . $foto_tagihan_air) }}"
                                alt="Foto tagihan air" 
                                width="256.8" height="161.88" 
                                class="m-2"
                                data-bs-toggle="modal" data-bs-target="#modal_image_show"
                                onclick="showImage('assets/{{$foto_tagihan_air}}')"
                            >   
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row mt-5">
                            @foreach ($hutang as $key => $ht)
                               <div class="row col-12">
                                    {{-- Header Form Per Index --}}
                                    <h6 class="text-secondary mt-3">
                                        Data Hutang
                                        <span>(Hutang ke-{{ $key + 1 }})</span>
                                    </h6>
                                    <hr>

                                    <div class="col-12 col-md-8">
                                        <div class="col-12">
                                            <x-label for="hutang">Jumlah Hutang</x-label>
                                            <x-input type="text" model="hutang.{{$key}}" disabled="true" />
                                        </div> 
                                        <div class="col-12">
                                            <x-label for="hutang">Keterangan</x-label>
                                            <x-input type="text" model="deskripsi_hutang.{{$key}}" disabled="true" />
                                        </div> 
                                    </div>
                                    @if (isset($foto_hutang[$key]))
                                            <div class="col-12 col-md-4 d-flex flex-column align-items-center">
                                                <x-label for="foto_tagihan_air">Foto Hutang</x-label>
                                                <img src="{{ asset('assets/' . $foto_hutang[$key]) }}"
                                                    alt="Foto tagihan air" 
                                                    width="256.8" height="161.88" 
                                                    class="m-2"
                                                    data-bs-toggle="modal" data-bs-target="#modal_image_show"
                                                    onclick="showImage('assets/{{$foto_hutang[$key]}}')"
                                                >   
                                            </div>
                                        @endif
                                </div>   
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mx-auto px-3 gap-3">
            <x-button type="button" class="col" action="previousStep" buttonColor="secondary">Kembali</x-button>
            <x-button type="button" class="col" action="$dispatch('submitPopUp')" buttonColor="main">Submit</x-button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (e) => {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            Livewire.on('submitPopUp', (message) => {
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Periksa kembali apabila belum yakin dengan data Anda!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Ajukan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.submit()
                    }
                });
            });

            Livewire.on('showAlertSuccess', () => {
                Toast.fire({
                    icon: "success",
                    title: "Pengajuan berhasil"
                });
            });

            Livewire.on('showFailPengajuanAlert', (message) => {
                Toast.fire({
                    icon: "error",
                    title: message
                });
            });
        });
    </script>
</div>
