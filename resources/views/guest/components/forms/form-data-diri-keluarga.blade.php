<div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="nik_anggota_label">NIK</span>
        <input type="text" class="form-control" placeholder="Masukkan NIK" aria-label="Nik" wire:model="nik_anggota"
            aria-describedby="nik">

        @error('nik_kepala_anggota')
            <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="nama_anggota_label">Nama</span>
        <input type="text" class="form-control" placeholder="Masukkan Nama" aria-label="Nama"
            wire:model="nama_anggota" aria-describedby="nama">

        @error('nama_kepala_anggota')
            <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>
    <div class="input-group mb-3">
        <label class="input-group-text" for="jenis_kelamin_anggota_label">Jenis Kelamin</label>
        <select class="form-select" id="jenis_kelamin_anggota" wire:model="jenis_kelamin_anggota">
            <option selected>Pilih Jenis Kelamin...</option>
            <option value="lk">Laki-Laki</option>
            <option value="pr">Perempuan</option>
        </select>

        @error('jenis_kelamin_anggota')
            <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="ttl_anggota_label">Tempat Tanggal Lahir</span>
        <input type="text" class="form-control" placeholder="Masukkan Tempat Tanggal Lahir"
            aria-label="Tempat Tanggal Lahir" aria-describedby="tempat tanggal lahir"
            wire:model="tempat_tanggal_lahir_anggota">

        @error('tempat_tanggal_lahir_anggota')
            <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="umur_anggota_label">Umur</span>
        <input type="number" class="form-control" placeholder="Masukkan Umur" aria-label="Umur Anggota Keluarga"
            wire:model="umur_kepala_anggota" aria-describedby="umur">

        @error('umur_kepala_anggota')
            <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="no_hp_anggota_label">Nomor Telepon</span>
        <input type="text" class="form-control" placeholder="Masukkan Nomor Telepon"
            aria-label="Nomor Telepon Anggota" wire:model="no_hp_anggota" aria-describedby="nomor telepon">

        @error('no_hp_kepala_anggota')
            <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>
    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text" id="foto_ktp">Foto KTP</span>
            <input type="file" class="form-control" accept="[png, jpg, jpeg]" placeholder="Foto Ktp"
                aria-label="Foto Ktp" wire:model="foto_ktp_anggota" aria-describedby="foto ktp">
        </div>
    </div>
</div>
