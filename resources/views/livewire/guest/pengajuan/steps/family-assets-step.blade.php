<div>
    @livewire('guest.wizard', ['formIndex' => 3])
    
    @props(['inputs'])

    <div class="mx-auto mt-4 form-step p-3" style="background: #fff">
        @foreach ($inputs as $formIndex)
            <div class="row">
                <div class="col-12 mb-3">
                    {{-- Header Form Per Index --}}
                    <h6 class="text-secondary">
                        Data Aset Keluarga
                        <span>(Aset {{ $formIndex + 1 }})</span>
                    </h6>
                    <hr>

                    {{-- Input Nama Aset --}}
                    <x-form-group errorName="nama_aset.{{$formIndex}}" otherErrorName="nama_aset" class="mb-3">
                        <x-label class="mb-3 required" for="nama_aset.{{$formIndex}}">Nama Aset</x-label>
                        <x-input 
                            type="text" 
                            name="nama_aset.{{$formIndex}}" 
                            model="nama_aset.{{$formIndex}}"
                            placeholder="Masukkan nama aset Anda"
                        />
                    </x-form-group>
                    {{-- End Input Nama Aset --}}
                    
                    {{-- Input Tahun Beli Aset --}}
                    <x-form-group errorName="tahun_beli.{{$formIndex}}" otherErrorName="tahun_beli" class="mb-3">
                        <x-label class="mb-3 required" for="tahun_beli.{{$formIndex}}">Tahun Beli</x-label>
                        <x-input 
                            type="text"
                            maxLength="4"
                            name="tahun_beli.{{$formIndex}}"
                            model="tahun_beli.{{$formIndex}}"
                            placeholder="Masukkan pada tahun berapa Anda beli"
                        />
                    </x-form-group>
                    {{-- End Input Tahun Beli Aset --}}

                    {{-- Input Harga Jual Aset --}}
                    <x-form-group errorName="harga_jual.{{$formIndex}}" otherErrorName="harga_jual" class="mb-3">
                        <x-label class="mb-3 required" for="harga_jual.{{$formIndex}}">Harga Jual (Rp.)</x-label>
                        <x-input 
                            type="number"
                            name="harga_jual.{{$formIndex}}"
                            model="harga_jual.{{$formIndex}}"
                            placeholder="Masukkan harga jual dari aset"
                        />
                    </x-form-group>
                    {{-- End Input Harga Jual Aset --}}

                    {{-- Input Foto Aset --}}
                    <x-form-group errorName="foto_aset.{{$formIndex}}" otherErrorName="foto_aset" class="mb-4">

                        <x-label class="mb-3" for="foto_aset">Foto Aset</x-label>
                
                        @if (!empty($foto_aset)) 
                            @if (isset($foto_aset[$formIndex]))
                                <div>
                                    <img 
                                        src="{{ asset('assets/' . $foto_aset[$formIndex]) }}" 
                                        alt="Foto Aset"
                                        width="256.8" height="161.88" class="m-2"
                                        data-bs-toggle="modal" data-bs-target="#modal_image_show"
                                        onclick="showImage('assets/{{$foto_aset[$formIndex]}}')"
                                    />
                                </div>
                            @endif
                        @endif
                
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <x-input type="file" model="foto_aset.{{$formIndex}}" value="{{ old('foto_aset'.$formIndex) }}"/>
                
                            <div x-show="isUploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>
                    </x-form-group>
                    {{-- End Input Foto Aset --}}
                </div>
            </div>
        @endforeach
        
        {{-- CTA Button Tambah Form Aset --}}
        <button type="button" wire:click="addInput" class="btn btn-main d-flex align-items-center gap-2">
            <i class="fas fa-stream"></i>
            Tambah Data Aset
        </button>

        <x-button type="button" class="col btn-save shadow-sm" action="save" buttonColor="main">
            <i class='bx bxs-save'></i>
        </x-button>
    </div>

    {{-- Navigation Buttons --}}
    <div class="mx-auto mt-4 row gap-2 form-step">
        <x-button type="button" class="col" action="previousStep" buttonColor="secondary">Kembali</x-button>
        <x-button type="button" class="col" action="saveAndNext" buttonColor="main">Selanjutnya</x-button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (e) => {
            Livewire.on('alert', function (message) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: message,
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });
    </script>
</div>
