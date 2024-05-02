<div>
    @livewire('guest.wizard', ['formIndex' => 1])

    <div class="row mx-auto mt-5" style="width: 75%">
        <div class="col">
            {{-- Input NIK --}}
            <x-form-group errorName="nik" class="mb-4">
                <x-label for="nik" class="mb-2">NIK</x-label>
                <x-input 
                    type="text" 
                    name="nik" 
                    model="nik"
                    minLength="16"
                    maxLength="16"
                    placeholder="Masukkan NIK"
                    value={{ $nik }} 
                />
            </x-form-group>

            {{-- Input Nama --}}
            <x-form-group errorName="nama" class="mb-4">
                <x-label for="nama" class="mb-2">Nama Pemohon</x-label>
                <x-input type="text" name="nama" model="nama" placeholder="Masukkan Nama Pemohon"
                    value="{{ $nama }}" />
            </x-form-group>
        </div>

        <div class="col">
            {{-- Input Jenis Kelamin --}}
            <x-form-group errorName="jenis_kelamin" class="mb-4">
                <x-label for="jenis_kelamin" class="mb-2">Jenis Kelamin</x-label>
                <div class="d-flex items-center gap-3 py-3">
                    <x-input.radio type="radio" name="jenis_kelamin" model="jenis_kelamin" value="lk"
                        content="Laki Laki" checked={{ $jenis_kelamin }} />
                    <x-input.radio type="radio" name="jenis_kelamin" model="jenis_kelamin" value="pr"
                        content="Perempuan" checked={{ $jenis_kelamin }} />
                </div>
            </x-form-group>

            {{-- Input Umur --}}
            <x-form-group errorName="umur" class="mb-4">
                <x-label for="umur" class="mb-2">Umur</x-label>
                <x-input type="number" name="umur" model="umur" placeholder="Masukkan Umur Anda"
                    value="{{ $umur }}" />
            </x-form-group>
        </div>

        {{-- Input Tempat Tanggal Lahir --}}
        <x-form-group errorName="tempat_tanggal_lahir" class="mb-3">
            <x-label for="tempat_tanggal_lahir">Tempat Tanggal Lahir</x-label>
            <x-input type="text" name="tempat_tanggal_lahir" model="tempat_tanggal_lahir"
                placeholder="Masukkan Tempat dan Tanggal Lahir Anda" value="{{ $tempat_tanggal_lahir }}" />
        </x-form-group>

        {{-- Input Nomor Telepon --}}
        <x-form-group errorName="nomor_telepon" class="mb-3">
            <x-label for="nomor_telepon">Nomor Telpon Aktif</x-label>
            <x-input type="text" maxLength="13" name="nomor_telepon" model="nomor_telepon"
                placeholder="Masukkan nomor telepon Anda yang sedang aktif" value="{{ $nomor_telepon }}" />
        </x-form-group>

        {{-- Input Penghasilan --}}
        <x-form-group errorName="penghasilan" class="mb-3">
            <x-label for="penghasilan">Penghasilan per Bulan</x-label>
            <x-input type="number" name="penghasilan" model="penghasilan"
                placeholder="Masukkan penghasilan Anda per bulan" value="{{ $penghasilan }}" />
        </x-form-group>

        <x-form-group errorName="foto_ktp" class="mb-3">

            @if (!is_null($foto_ktp))
                <img 
                    src="{{ asset('assets/' . $foto_ktp) }}" 
                    alt="Foto KTP Kepala Keluarga" 
                    width="256.8" height="161.88" class="m-2"
                />
            @endif

            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <x-input type="file" model="foto_ktp" value="{{ $foto_ktp }}" />

                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
            </div>
        </x-form-group>

        <div class="px-3">
            <x-button type="button" class="w-100" action="save" buttonColor="main">Selanjutnya</x-button>
        </div>
    </div>
</div>
