<div class="row mt-4">
    <h6 class="text-secondary my-2">
        Data Keluarga
        <span>(Anggota Keluarga {{ $index }})</span>
    </h6>
    <hr>

    <div class="col-12 col-sm-6">
        <x-form-group errorName="nik.{{$model}}" otherErrorName="form.nik" class="mb-4">
            <x-label for="nik">NIK</x-label>
            <x-input 
                type="text" 
                model="nik.{{$model}}" 
                value="{{ old('nik.'.$model) }}"
                minLength="16"
                maxLength="16"
                placeholder="Masukkan NIK Anggota Keluarga"
            />
        </x-form-group>
        <x-form-group errorName="nama.{{$model}}" otherErrorName="nama" class="mb-4">
            <x-label for="nama">Nama</x-label>
            <x-input 
                type="text" 
                name="nama" 
                model="nama.{{$model}}"
                value="{{ old('nama.'.$model) }}"
                placeholder="Masukkan Nama Anggota Keluarga" />
        </x-form-group>
    </div>
    <div class="col-12 col-sm-6">
        <x-form-group errorName="jenis_kelamin.{{$model}}" otherErrorName="jenis_kelamin" class="mb-4">
            <x-label for="jenis_kelamin" class="mb-2">Jenis Kelamin</x-label>
            <div class="d-flex items-center gap-2 pt-3">
                <x-input.radio 
                    type="radio" 
                    name="jenis_kelamin" 
                    model="jenis_kelamin.{{$model}}"
                    value="lk" content="Laki Laki" 
                />
                <x-input.radio 
                    type="radio" 
                    name="jenis_kelamin"
                    model="jenis_kelamin.{{$model}}"
                    value="pr" content="Perempuan" 
                />
            </div>
        </x-form-group>
        <x-form-group errorName="umur.{{$model}}" otherErrorName="umur" class="mb-4">
            <x-label for="umur" class="mb-2">Umur</x-label>
            <x-input 
                type="number" 
                name="umur" 
                model="umur.{{$model}}" 
                value="{{ old('umur.'.$model) }}"
                placeholder="Masukkan Umur Anda" 
            />
        </x-form-group>
    </div>

    <x-form-group errorName="tempat_tanggal_lahir.{{$model}}" otherErrorName="tempat_tanggal_lahir" class="mb-4">
        <x-label for="tempat_tanggal_lahir">Tempat Tanggal Lahir</x-label>
        <x-input 
            type="text" 
            name="tempat_tanggal_lahir" 
            model="tempat_tanggal_lahir.{{$model}}"
            value="{{ old('tempat_tanggal_lahir.'.$model) }}"
            placeholder="Masukkan Tempat dan Tanggal Lahir Anda" 
        />
    </x-form-group>

    <x-form-group errorName="nomor_telepon.{{$model}}" otherErrorName="nomor_telepon" class="mb-4">
        <x-label for="nomor_telepon">Nomor Telpon Aktif</x-label>
        <x-input 
            type="text" 
            maxLength="13" 
            name="nomor_telepon" 
            model="nomor_telepon.{{$model}}"
            value="{{ old('nomor_telepon.'.$model) }}"
            placeholder="Masukkan nomor telepon Anda yang sedang aktif" />
    </x-form-group>

    <x-form-group errorName="status.{{$model}}" otherErrorName="status" class="mb-3">
        <x-label for="status">Status</x-label>
        <select class="form-select p-3" name="status" wire:model="status.{{$model}}">
            <option selected>Pilih Status Pekerjaan Anda</option>
            <option value="bekerja">Bekerja</option>
            <option value="tidak_bekerja">Tidak Bekerja</option>
            <option value="sekolah">Sekolah</option>
        </select>
    </x-form-group>
    
    <x-form-group errorName="penghasilan.{{$model}}" otherErrorName="penghasilan" class="mb-4">
        <x-label for="penghasilan">Penghasilan per Bulan</x-label>
        <x-input 
            type="number" 
            name="penghasilan" 
            model="penghasilan.{{$model}}"
            value="{{ old('penghasilan.'.$model) }}"
            placeholder="Mohon masukkan penghasilan dalam tiap bulan" />
    </x-form-group>

    <x-form-group errorName="slip_gaji.{{$model}}" otherErrorName="slip_gaji" class="mb-4">

        <x-label for="slip_gaji">Slip Gaji</x-label>

        @if (!is_null($slipGaji))
            <div>
                <img 
                    src="{{ asset('assets/' . $slipGaji) }}" 
                    alt="Slip Gaji Anggota Keluarga" 
                    width="256.8" height="161.88" class="m-2"
                />
            </div>
        @endif

        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress">
            <x-input type="file" model="slip_gaji.{{$model}}" value="{{ old('slip_gaji'.$model) }}"/>

            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
        </div>
    </x-form-group>
</div>
