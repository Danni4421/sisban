<div class="row mt-4">
    <h6 class="text-secondary my-2">
        Data Keluarga
        <span>(Anggota Keluarga {{ $index }})</span>
    </h6>
    <hr>

    <div class="col">
        <x-form-group errorName="nik.{{$model}}" otherErrorName="form.nik" class="mb-4">
            <x-label for="nik">NIK</x-label>
            <x-input 
                type="text" 
                model="nik.{{$model}}" 
                {{-- @if (!empty($nik)) value="{{ $nik }}" @endif --}}
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
                {{-- @if (!empty($nama)) value="{{ $nama }}" @endif --}}
                value="{{ old('nama.'.$model) }}"
                placeholder="Masukkan Nama Anggota Keluarga" />
        </x-form-group>
    </div>
    <div class="col">
        <x-form-group errorName="jenis_kelamin.{{$model}}" otherErrorName="jenis_kelamin" class="mb-4">
            <x-label for="jenis_kelamin" class="mb-2">Jenis Kelamin</x-label>
            <div class="d-flex items-center gap-2 pt-3">
                <x-input.radio 
                    type="radio" 
                    name="jenis_kelamin" 
                    model="jenis_kelamin.{{$model}}"
                    {{-- @if (!empty($jenis_kelamin)) checked="{{ $jenis_kelamin }}" @endif --}}
                    value="lk" content="Laki Laki" 
                />
                <x-input.radio 
                    type="radio" 
                    name="jenis_kelamin"
                    model="jenis_kelamin.{{$model}}"
                    {{-- @if (!empty($jenis_kelamin)) checked="{{ $jenis_kelamin }}" @endif --}}
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
                {{-- @if (!empty($umur)) value="{{ $umur }}" @endif --}}
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
            {{-- @if (!empty($tempat_tanggal_lahir)) value="{{ $tempat_tanggal_lahir }}" @endif --}}
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
            {{-- @if (!empty($nomor_telepon)) value="{{ $nomor_telepon }}" @endif --}}
            value="{{ old('nomor_telepon.'.$model) }}"
            placeholder="Masukkan nomor telepon Anda yang sedang aktif" />
    </x-form-group>
    
    <x-form-group errorName="penghasilan.{{$model}}" otherErrorName="penghasilan" class="mb-4">
        <x-label for="penghasilan">Penghasilan per Bulan</x-label>
        <x-input 
            type="number" 
            name="penghasilan" 
            model="penghasilan.{{$model}}"
            {{-- @if (!empty($penghasilan)) value="{{ $penghasilan }}" @endif --}}
            value="{{ old('penghasilan.'.$model) }}"
            placeholder="Mohon masukkan penghasilan dalam tiap bulan" />
    </x-form-group>
</div>
