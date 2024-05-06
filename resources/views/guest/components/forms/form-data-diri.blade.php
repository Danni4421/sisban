<div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="nik_kepala_label">NIK</span>
        <input type="text" class="form-control" placeholder="Masukkan NIK" aria-label="Nik"
            wire:model="nik_kepala_keluarga" aria-describedby="nik">

        @error('nik_kepala_keluarga')
            <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="nama_kepala_label">Nama</span>
        <input type="text" class="form-control" placeholder="Masukkan Nama" aria-label="Nama"
            wire:model="nama_kepala_keluarga" aria-describedby="nama">

        @error('nama_kepala_keluarga')
            <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>
    <div class="input-group mb-3">
        <label class="input-group-text" for="jenis_kelamin_kepala_label">Jenis Kelamin</label>
        <select class="form-select" id="jenis_kelamin_kepala" wire:model="jenis_kelamin_kepala_keluarga">
            <option selected>Pilih Jenis Kelamin...</option>
            <option value="lk">Laki-Laki</option>
            <option value="pr">Perempuan</option>
        </select>

        @error('jenis_kelamin_kepala_keluarga')
            <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="ttl_kepala_label">Tempat Tanggal Lahir</span>
        <input type="text" class="form-control" placeholder="Masukkan Tempat Tanggal Lahir"
            aria-label="Tempat Tanggal Lahir" aria-describedby="tempat tanggal lahir"
            wire:model="tempat_tanggal_lahir_kepala_keluarga">

        @error('tempat_tanggal_lahir_kepala_keluarga')
            <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="umur_kepala_label">Umur</span>
        <input type="text" class="form-control" placeholder="Masukkan Umur" aria-label="Umur Kepala Keluarga"
            wire:model="umur_kepala_keluarga" aria-describedby="umur">

        @error('umur_kepala_keluarga')
            <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="no_hp_label">Nomor Telepon</span>
        <input type="text" class="form-control" placeholder="Masukkan Nomor Telepon"
            aria-label="Nomor Telepon Kepala Keluarga" wire:model="no_hp_kepala_keluarga"
            aria-describedby="nomor telepon">

        @error('no_hp_kepala_keluarga')
            <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>
    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text" id="foto_ktp">Foto KTP</span>
            <input type="file" class="form-control" accept="[png, jpg, jpeg]" placeholder="Foto Ktp"
                aria-label="Foto Ktp" wire:model="foto_ktp_kepala_keluarga" aria-describedby="foto ktp">
        </div>

        <div>
            <span>Preview: </span>
            <img src="{{ asset('assets/temp/images/ktp/' . $this->foto_ktp_kepala_keluarga) }}" alt="Foto KTP"
                class="" width="160" height="90">
        </div>

        @error('foto_ktp_kepala_keluarga')
            <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>
</div>
