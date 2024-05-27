<div>
    @livewire('guest.wizard', ['formIndex' => 3])
    
    @props(['inputs'])

    <div class="mx-auto mb-5 form-step">
        @foreach ($inputs as $formIndex)
            <div class="row">
                <div class="col-12">

                    {{-- Header Form Per Index --}}
                    <h6 class="text-secondary mt-5">
                        Data Aset Keluarga
                        <span>(Aset {{ $formIndex + 1 }})</span>
                    </h6>
                    <hr>

                    {{-- Input Nama Aset --}}
                    <x-form-group errorName="nama_aset.{{$formIndex}}" otherErrorName="nama_aset" class="mb-3">
                        <x-label for="nama_aset.{{$formIndex}}">Nama Aset</x-label>
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
                        <x-label for="tahun_beli.{{$formIndex}}">Tahun Beli</x-label>
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
                        <x-label for="harga_jual.{{$formIndex}}">Harga Jual (Rp.)</x-label>
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

                        <x-label for="foto_aset">Foto Aset</x-label>
                
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
        
        {{-- Navigation Buttons --}}
        <div class="row mx-auto mt-5 gap-3">
            <x-button type="button" class="col" action="previousStep" buttonColor="secondary">Kembali</x-button>
            <x-button type="button" class="col" action="save" buttonColor="main">Selanjutnya</x-button>
        </div>
    </div>
</div>
