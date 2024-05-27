<div>
    @livewire('guest.wizard', ['formIndex' => 2])
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <div class="row mx-auto my-5 form-step">
        <div class="col-12 col-6 mb-3">
            {{-- Input Nomor KK --}}
            <x-form-group errorName="no_kk" class="mb-3">
                <x-label for="no_kk" class="mb-3">Nomor Kartu Keluarga</x-label>
                <x-input 
                    type="text" 
                    name="no_kk" 
                    model="no_kk" 
                    minLength="16"
                    maxLength="16"
                    placeholder="Masukkan Nomor KK Keluarga Anda" 
                />
            </x-form-group>

            {{-- RT --}}
            <x-form-group errorName="rt" class="mb-3">
                <x-label for="rt" class="mb-3">Rukun Tetangga</x-label>
                <select class="form-select p-3" name="rt" id="rt" wire:model="rt">
                    @foreach ($list_rt as $rt)
                        <option value="{{$rt}}">{{'RT' . $rt}}</option>
                    @endforeach
                </select>
            </x-form-group>
        </div>
        <div class="col-12 col-6 mb-3">
            {{-- Input Foto KK --}}

            @if (!is_null($foto_kk))
                <img src="{{ asset('assets/' . $foto_kk) }}" 
                    alt="Foto KTP Kepala Keluarga" 
                    width="256.8"
                    height="161.88" class="m-2"
                    data-bs-toggle="modal" data-bs-target="#modal_image_show"
                    onclick="showImage('assets/{{$foto_kk}}')"
                >
            @endif

            <x-form-group errorName="foto_kk" class="mb-3">
                <x-label for="foto_kk" class="mb-3">Foto Kartu Keluarga</x-label>
                <x-input type="file" name="foto_kk" model="foto_kk" />
            </x-form-group>
        </div>

        {{-- Form Data Keluarga --}}
        <div class="col-12 my-3">
            <h6 class="text-secondary mb-2">
                Data Keluarga
                <span>(Kepala Keluarga)</span>
            </h6>
            <hr>

            {{-- Kepala Keluarga --}}
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="mb-4">
                        <x-label for="nik">NIK</x-label>
                        <x-input type="text" name="nik" value="{{ $aplicant['nik'] }}"
                            readonly="true" />
                    </div>
                    <div class="mb-4">
                        <x-label for="nama">Nama</x-label>
                        <x-input type="text" name="nama"
                            value="{{ $aplicant['nama'] }}" readonly="true" />
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="mb-4">
                        <x-label for="jenis_kelamin" class="mb-2">Jenis Kelamin</x-label>
                        <div class="d-flex items-center gap-3 pt-3">
                            <x-input.radio type="radio" name="jenis_kelamin" value="lk" content="Laki Laki"
                                checked="{{ $aplicant['jenis_kelamin'] }}" readonly="true" />
                            <x-input.radio type="radio" name="jenis_kelamin" value="pr" content="Perempuan"
                                checked="{{ $aplicant['jenis_kelamin'] }}" readonly="true" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <x-label for="umur" class="mb-2">Umur</x-label>
                        <x-input type="number" name="umur"
                            value="{{ $aplicant['umur'] }}" readonly="true" />
                    </div>
                </div>

                <div class="mb-4">
                    <x-label for="tempat_tanggal_lahir">Tempat Tanggal Lahir</x-label>
                    <x-input type="text" name="tempat_tanggal_lahir"
                        value="{{ $aplicant['tempat_tanggal_lahir'] }}" readonly="true" />
                </div>

                <div class="mb-4">
                    <x-label for="nomor_telepon">Nomor Telpon Aktif</x-label>
                    <x-input type="text" maxLength="13" name="nomor_telepon"
                        value="{{ $aplicant['nomor_telepon'] }}" readonly="true" />
                </div>

                <div class="mb-4">
                    <x-label for="penghasilan">Penghasilan</x-label>
                    <x-input type="text" name="penghasilan"
                        value="{{ $aplicant['penghasilan'] }}" readonly="true" />
                </div>
            </div>

            <div id="container-anggota-keluarga">
                {{-- Form Keluarga --}}
                @foreach ($inputs as $formIndex)
                    <x-input.form-anggota model="{{ $formIndex }}" index="{{ $formIndex + 1 }}" slipGaji="{{ $slip_gaji[$formIndex] ?? null }}"/>
                @endforeach
            </div>

            <button type="button" wire:click="addInput" class="btn btn-main d-flex align-items-center gap-2">
                <i class="fas fa-user-plus"></i>
                Tambah Data Keluarga
            </button>
        </div>

        <div class="row mx-auto mt-3 gap-3">
            <x-button type="button" class="col" action="previousStep" buttonColor="secondary">Kembali</x-button>
            <x-button type="button" class="col" action="save" buttonColor="main">Selanjutnya</x-button>
        </div>
    </div>
</div>
