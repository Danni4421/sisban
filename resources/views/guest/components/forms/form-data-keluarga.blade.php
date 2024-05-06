<div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="no_kk_label">No KK</span>
        <input type="text" class="form-control" placeholder="Masukkan No KK" aria-label="Nomor KK" wire:model="no_kk"
            aria-describedby="nomor kk">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="foto_kk_label">Foto KK</span>
        <input type="file" class="form-control" placeholder="Masukkan Foto Kartu Keluarga" aria-label="Foto KK"
            wire:model="foto_kk" aria-describedby="foto kk">
    </div>

    <span class="d-inline-block my-2">Kepala Keluarga</span>

    <div id="form-keluarga">

    </div>

    <button type="button" id="add-input-keluarga" class="btn btn-primary">Tambah Anggota Keluarga</button>

    <script>
        document.getElementById('add-input-keluarga').addEventListener('click', function() {
            document.getElementById('form-keluarga').append($(`
                @include('guest.components.forms.form-data-diri-keluarga')
            `));
        });
    </script>
</div>
