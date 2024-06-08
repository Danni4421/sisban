<div>
    @livewire('guest.wizard', ['formIndex' => 4])
    
    <div class="mx-auto my-5 form-step">
        
        {{-- Form --}}
        <div class="row">
            {{-- Input Daya Listrik --}}
            <x-form-group errorName="daya_listrik" class="mb-4">
                <x-label class="mb-3 required" for="daya_listrik">Daya Listrik</x-label>
                <select name="daya_listrik" id="daya_listrik" class="form-control p-3" wire:model="daya_listrik">
                    <option selected>Pilih daya listrik...</option>
                    <option value="none">Tidak Punya Listrik</option>
                    <option value="450">450 Watt</option>
                    <option value="900">900 Watt</option>
                    <option value="1300">1300 Watt</option>
                </select>
            </x-form-group>
            {{-- End Input Daya Listrik --}}

             {{-- Input Biaya Listrik --}}
             <x-form-group errorName="biaya_listrik" class="mb-4">
                <x-label class="mb-3 required" for="biaya_listrik">Biaya Listrik</x-label>
                <x-input 
                    type="text" 
                    name="biaya_listrik" 
                    model="biaya_listrik"
                    placeholder="Masukkan daya listrik rumah Anda saat ini"
                />
            </x-form-group>
            {{-- End Input Biaya Listrik --}}

            {{-- Input Foto Tagihan Listrik --}}
            <x-form-group errorName="foto_tagihan_listrik" class="mb-4">

                <x-label class="mb-3" for="foto_tagihan_listrik">Foto Tagihan Listrik</x-label>
        
                @if (!is_null($foto_tagihan_listrik)) 
                    <div>
                        <img 
                            src="{{ asset('assets/' . $foto_tagihan_listrik) }}" 
                            alt="Foto Aset"
                            width="256.8" height="161.88" class="m-2"
                            data-bs-toggle="modal" data-bs-target="#modal_image_show"
                            onclick="showImage('assets/{{$foto_tagihan_listrik}}')"
                        />
                    </div>
                @endif
        
                <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <x-input type="file" model="foto_tagihan_listrik" value="{{ old('foto_tagihan_listrik') }}" wireInput="save_image_tagihan"/>
        
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>
            </x-form-group>
            {{-- End Input Foto Tagihan Listrik --}}

            {{-- Input Biaya Air --}}
            <x-form-group errorName="biaya_air" class="mb-4">
                <x-label class="mb-3 required" for="biaya_air">Biaya Air</x-label>
                <x-input 
                    type="text" 
                    name="biaya_air" 
                    model="biaya_air"
                    placeholder="Masukkan biaya air rumah Anda saat ini"
                />
            </x-form-group>
            {{-- End Input Biaya Air --}}

            {{-- Input Foto Tagihan Air --}}
            <x-form-group errorName="foto_tagihan_air" class="mb-4">

                <x-label class="mb-3" for="foto_tagihan_air">Foto Tagihan Air</x-label>
        
                @if (!is_null($foto_tagihan_air)) 
                    <div>
                        <img 
                            src="{{ asset('assets/' . $foto_tagihan_air) }}" 
                            alt="Foto Aset"
                            width="256.8" height="161.88" class="m-2"
                            data-bs-toggle="modal" data-bs-target="#modal_image_show"
                            onclick="showImage('assets/{{$foto_tagihan_air}}')"
                            
                        />
                    </div>
                @endif
        
                <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <x-input type="file" model="foto_tagihan_air" value="{{ old('foto_tagihan_air') }}" wireInput="save_image_tagihan"/>
        
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>
            </x-form-group>
            {{-- End Input Foto Tagihan Air --}}

            {{-- Input Pengeluaran --}}
            <x-form-group errorName="pengeluaran" class="mb-4">
                <x-label class="mb-3 required" for="pengeluaran">Pengeluaran per Bulan</x-label>
                <x-input 
                    type="text" 
                    name="pengeluaran" 
                    model="pengeluaran"
                    placeholder="Masukkan pengeluaran Keluarga perbulan"
                />
            </x-form-group>
            {{-- End Input Pengeluaran --}}

            <div class="row mt-3">
                @foreach ($hutangs as $hutangIndex)
                    {{-- Header Form Per Index --}}
                    <h6 class="text-secondary mt-3">
                        Data Hutang
                        <span>(Hutang ke-{{ $hutangIndex + 1 }})</span>
                    </h6>
                    <hr>

                    {{-- Input Hutang --}}
                    <x-form-group errorName="hutang.{{$hutangIndex}}" class="mb-4">
                        <x-label class="mb-3 required" for="hutang.{{$hutangIndex}}">Hutang</x-label>
                        <x-input 
                            type="text" 
                            name="hutang.{{$hutangIndex}}" 
                            model="hutang.{{$hutangIndex}}"
                            placeholder="Masukkan hutang"
                        />
                    </x-form-group>
                    {{-- End Input Hutang --}}

                    {{-- Input Hutang --}}
                    <x-form-group errorName="hutang.{{$hutangIndex}}" class="mb-4">
                        <x-label class="mb-3 required" for="hutang.{{$hutangIndex}}">Keterangan Hutang</x-label>
                        <x-input 
                            type="text" 
                            name="deskripsi_hutang.{{$hutangIndex}}" 
                            model="deskripsi_hutang.{{$hutangIndex}}"
                            placeholder="Masukkan deskripsi hutang"
                        />
                    </x-form-group>
                    {{-- End Input Hutang --}}

                    {{-- Input Foto Aset --}}
                    <x-form-group errorName="foto_hutang.{{$hutangIndex}}" otherErrorName="foto_hutang" class="mb-4">

                        <x-label class="mb-3" for="foto_aset.{{$hutangIndex}}">Foto Hutang</x-label>
                
                        @if (!empty($foto_hutang)) 
                            @if (isset($foto_hutang[$hutangIndex]))
                                <div>
                                    <img 
                                        src="{{ asset('assets/' . $foto_hutang[$hutangIndex]) }}" 
                                        alt="Foto Bukti Hutang"
                                        width="256.8" height="161.88" class="m-2"
                                        data-bs-toggle="modal" data-bs-target="#modal_image_show"
                                        onclick="showImage('assets/{{$foto_hutang[$hutangIndex]}}')"
                                    />
                                </div>
                            @endif
                        @endif
                
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <x-input type="file" model="foto_hutang.{{$hutangIndex}}" value="{{ old('foto_hutang'.$hutangIndex) }}"/>
                
                            <div x-show="isUploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>
                    </x-form-group>
                    {{-- End Input Foto Aset --}}
                @endforeach
            </div> 
        </div>

        {{-- CTA Button Tambah Hutang --}}
        <button type="button" wire:click="addHutang" class="btn btn-main d-flex align-items-center gap-2">
            <i class="fas fa-plus"></i>
            Tambah Data Hutang
        </button>
        
        {{-- Navigation Buttons --}}
        <div class="row mx-auto mt-3 gap-3">
            <x-button type="button" class="col" action="previousStep" buttonColor="secondary">Kembali</x-button>
            <x-button type="button" class="col" action="saveAndNext" buttonColor="main">Ajukan</x-button>
        </div>

        <x-button type="button" class="col btn-save shadow-sm" action="save" buttonColor="main">
            <i class='bx bxs-save' ></i>
        </x-button>
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
